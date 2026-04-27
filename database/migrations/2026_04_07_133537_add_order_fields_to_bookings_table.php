<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('nama_lengkap')->nullable()->after('id_users');
            $table->string('no_whatsapp')->nullable()->after('nama_lengkap');
            $table->string('jenis_acara')->nullable()->after('no_whatsapp');
            $table->bigInteger('biaya_venue')->default(0)->after('jenis_acara');
            $table->integer('jumlah_tamu')->default(0)->after('biaya_venue');
            $table->string('acara_mulai')->nullable()->after('jumlah_tamu');
            $table->string('acara_selesai')->nullable()->after('acara_mulai');
            $table->string('metode_pembayaran')->nullable()->after('subtotal');
            $table->string('bank')->nullable()->after('metode_pembayaran');

            // Make legacy fields nullable for new form
            $table->foreignId('id_acara')->nullable()->change();
            $table->integer('jumlah_porsi')->nullable()->change();
            $table->string('waktu')->nullable()->change();
        });

        Schema::create('booking_layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_booking')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('id_acara')->constrained('acaras')->onDelete('cascade');
            $table->bigInteger('harga');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_layanans');

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'nama_lengkap', 'no_whatsapp', 'jenis_acara', 'biaya_venue',
                'jumlah_tamu', 'acara_mulai', 'acara_selesai',
                'metode_pembayaran', 'bank'
            ]);
        });
    }
};
