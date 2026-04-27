<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the admin's profile form.
     */
    public function edit(Request $request): View
    {
        return view('backend.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the admin's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($request->hasFile('foto')) {
            $uploaded = cloudinary()->upload($request->file('foto')->getRealPath(), [
                'folder' => 'avatars'
            ]);
            $user->foto = $uploaded->getSecurePath();
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('backend.profile.edit')->with('success', 'Profil admin berhasil diperbarui.');
    }
}