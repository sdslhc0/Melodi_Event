<x-backend-layout>
    <x-slot:header>Edit Pemesanan #{{ $booking->id }}</x-slot:header>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('backend.booking.show', $booking) }}" class="inline-flex items-center gap-2 text-brown-400 hover:text-gold-400 transition-colors text-xs font-semibold tracking-[0.15em] uppercase px-4 py-2 border border-brown-800/40 rounded-full bg-dark-100/50 hover:bg-dark-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <h2 class="text-xl font-serif text-brown-100">Edit Data Pesanan</h2>
        </div>

        <div class="bg-dark-100 border border-brown-800/40 rounded-2xl p-8 shadow-xl shadow-black/10">
            <form action="{{ route('backend.booking.update', $booking) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-brown-300 mb-2">Nama Pemesan</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap', $booking->nama_lengkap) }}" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required>
                        @error('nama_lengkap')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No WhatsApp -->
                    <div>
                        <label for="no_whatsapp" class="block text-sm font-medium text-brown-300 mb-2">No. WhatsApp</label>
                        <input type="text" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp', $booking->no_whatsapp) }}" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required>
                        @error('no_whatsapp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Acara -->
                    <div>
                        <label for="jenis_acara" class="block text-sm font-medium text-brown-300 mb-2">Jenis Acara</label>
                        <select name="jenis_acara" id="jenis_acara" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required>
                            <option value="Wedding" {{ old('jenis_acara', $booking->jenis_acara) == 'Wedding' ? 'selected' : '' }}>Wedding</option>
                            <option value="Engagement" {{ old('jenis_acara', $booking->jenis_acara) == 'Engagement' ? 'selected' : '' }}>Engagement</option>
                            <option value="Prewedding" {{ old('jenis_acara', $booking->jenis_acara) == 'Prewedding' ? 'selected' : '' }}>Prewedding</option>
                            <option value="Lainnya" {{ old('jenis_acara', $booking->jenis_acara) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_acara')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Acara -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-brown-300 mb-2">Tanggal Acara</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $booking->tanggal->format('Y-m-d')) }}" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" style="color-scheme: dark;" required>
                        @error('tanggal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu Mulai -->
                    <div>
                        <label for="acara_mulai" class="block text-sm font-medium text-brown-300 mb-2">Waktu Mulai</label>
                        <input type="time" name="acara_mulai" id="acara_mulai" value="{{ old('acara_mulai', $booking->acara_mulai) }}" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" style="color-scheme: dark;" required>
                        @error('acara_mulai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu Selesai -->
                    <div>
                        <label for="acara_selesai" class="block text-sm font-medium text-brown-300 mb-2">Waktu Selesai</label>
                        <input type="time" name="acara_selesai" id="acara_selesai" value="{{ old('acara_selesai', $booking->acara_selesai) }}" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" style="color-scheme: dark;" required>
                        @error('acara_selesai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Tamu -->
                    <div class="md:col-span-2">
                        <label for="jumlah_tamu" class="block text-sm font-medium text-brown-300 mb-2">Jumlah Tamu (Target)</label>
                        <input type="number" name="jumlah_tamu" id="jumlah_tamu" value="{{ old('jumlah_tamu', $booking->jumlah_tamu) }}" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required min="1">
                        @error('jumlah_tamu')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="md:col-span-2">
                        <label for="catatan" class="block text-sm font-medium text-brown-300 mb-2">Catatan Tambahan</label>
                        <textarea name="catatan" id="catatan" rows="4" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4">{{ old('catatan', $booking->catatan) }}</textarea>
                        @error('catatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('backend.booking.show', $booking) }}" class="px-6 py-3 border border-brown-700 text-brown-300 rounded-xl hover:bg-dark-200 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-gold-500 hover:bg-gold-400 text-dark-100 font-bold tracking-widest uppercase text-xs rounded-xl transition-all shadow-[0_5px_20px_rgba(201,168,76,0.3)]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-backend-layout>
