<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_bundlings', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->bigInteger('harga');
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });

        // Pivot table: which layanan (acara) are included in each bundling package
        Schema::create('paket_bundling_acara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_bundling_id')->constrained('paket_bundlings')->cascadeOnDelete();
            $table->foreignId('acara_id')->constrained('acaras')->cascadeOnDelete();
            $table->timestamps();
        });

        // Add bundling reference to bookings
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('id_paket_bundling')->nullable()->after('acara_selesai')->constrained('paket_bundlings')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['id_paket_bundling']);
            $table->dropColumn('id_paket_bundling');
        });

        Schema::dropIfExists('paket_bundling_acara');
        Schema::dropIfExists('paket_bundlings');
    }
};
