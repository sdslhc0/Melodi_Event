<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactNotificationMail;

class ContactController extends Controller
{
    /**
     * Handle the contact form submission.
     */
    public function send(Request $request)
    {
        // Validasi data form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        try {
            // Ganti email penerima dengan email admin yang diinginkan
            Mail::to('mr.riuuus@gmail.com')->send(new ContactNotificationMail($data));

            // Jika sukses, kembali ke halaman sebelumnya dengan pesan sukses
            return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim. Tim kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim pesan Contact Us: ' . $e->getMessage());
            // Jika gagal, kembali dengan pesan error
            return back()->with('error', 'Mohon maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi nanti atau hubungi kami via WhatsApp.');
        }
    }
}
