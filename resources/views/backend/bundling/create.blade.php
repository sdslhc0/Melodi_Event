<x-backend-layout>
    <x-slot:header>Tambah Paket Bundling</x-slot:header>

    <div class="max-w-3xl bg-dark-100 border border-brown-800/30 rounded-xl p-6 md:p-8">
        <form action="{{ route('backend.bundling.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Nama Paket Bundling</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required placeholder="Contoh: Paket Platinum Wedding"
                           class="w-full bg-dark border border-brown-800 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring focus:ring-gold-500/20 outline-none transition-all">
                    @error('nama') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Harga Paket</label>
                    <input type="number" name="harga" value="{{ old('harga') }}" required placeholder="Contoh: 15000000"
                           class="w-full bg-dark border border-brown-800 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring focus:ring-gold-500/20 outline-none transition-all">
                    @error('harga') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" rows="3" placeholder="Contoh: Paket lengkap untuk pernikahan impian Anda..."
                              class="w-full bg-dark border border-brown-800 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring focus:ring-gold-500/20 outline-none transition-all resize-none">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Gambar (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*" id="gambar-input"
                           class="w-full bg-dark border border-brown-800 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring focus:ring-gold-500/20 outline-none transition-all file:mr-4 file:py-1 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-gold-500/20 file:text-gold-400 hover:file:bg-gold-500/30">
                    @error('gambar') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    <div id="gambar-preview" class="mt-3 hidden">
                        <img id="gambar-preview-img" class="w-32 h-32 object-cover rounded-lg border border-brown-800/30" alt="Preview">
                    </div>
                </div>

                {{-- Layanan Selection --}}
                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-3">Pilih Layanan yang Termasuk dalam Paket</label>
                    @error('layanan') <span class="text-sm text-red-500 mb-2 block">{{ $message }}</span> @enderror

                    <div class="space-y-4">
                        @foreach($acarasByTipe as $tipe => $acaras)
                            <div class="bg-dark border border-brown-800/50 rounded-lg p-4">
                                <h4 class="text-gold-500 text-xs font-bold uppercase tracking-widest mb-3 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $tipe }}
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    @foreach($acaras as $acara)
                                        <label class="flex items-center gap-3 p-3 rounded-lg border border-brown-800/30 hover:border-gold-500/40 transition-colors cursor-pointer group">
                                            <input type="checkbox" name="layanan[]" value="{{ $acara->id }}"
                                                   {{ in_array($acara->id, old('layanan', [])) ? 'checked' : '' }}
                                                   class="w-4 h-4 rounded border-brown-700 text-gold-500 focus:ring-gold-500/20 bg-dark">
                                            <div class="flex-1 min-w-0">
                                                <span class="text-sm text-brown-200 group-hover:text-brown-100 block truncate">{{ $acara->nama }}</span>
                                                <span class="text-xs text-gold-500/70">{{ $acara->formatted_harga }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('backend.bundling.index') }}" class="px-5 py-2.5 border border-brown-700 text-brown-300 rounded-lg hover:bg-dark-200 transition-colors">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-gold-500 text-dark-900 font-medium rounded-lg hover:bg-gold-400 transition-colors">Simpan Paket</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('gambar-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('gambar-preview-img').src = ev.target.result;
                    document.getElementById('gambar-preview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-backend-layout>
