<x-backend-layout>
    <x-slot:header>Edit Acara</x-slot:header>

    <div class="max-w-2xl">
        <a href="{{ route('backend.acara.index') }}" class="inline-flex items-center gap-2 text-brown-400 hover:text-gold-400 transition-colors mb-6 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="bg-dark-100 border border-brown-800/30 rounded-xl p-6">
            <h2 class="text-xl font-serif text-brown-100 mb-6">Edit Acara</h2>

            <form method="POST" action="{{ route('backend.acara.update', $acara) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="label-melodi">Kategori</label>
                    <select name="id_kategori" class="select-melodi" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('id_kategori', $acara->id_kategori) == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="label-melodi">Nama Acara</label>
                    <input type="text" name="nama" class="input-melodi" value="{{ old('nama', $acara->nama) }}" required>
                    @error('nama')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="label-melodi">Harga (per porsi)</label>
                    <input type="number" name="harga" class="input-melodi" value="{{ old('harga', $acara->harga) }}" required min="0">
                    @error('harga')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="label-melodi">Foto</label>
                    @if($acara->foto)
                        <div class="mb-3">
                            <img src="{{ asset( $acara->foto) }}" alt="{{ $acara->nama }}" class="w-40 h-28 object-cover rounded-lg border border-brown-800/30">
                            <p class="text-brown-500 text-xs mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                        </div>
                    @endif
                    <input type="file" name="foto" accept="image/*"
                           class="w-full text-brown-300 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gold-500/10 file:text-gold-400 hover:file:bg-gold-500/20 file:cursor-pointer file:transition-colors">
                    @error('foto')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="label-melodi">Deskripsi</label>
                    <textarea name="deskripsi" rows="5" class="input-melodi resize-none">{{ old('deskripsi', $acara->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-gold">Update Acara</button>
            </form>
        </div>
    </div>
</x-backend-layout>
