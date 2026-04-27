<x-backend-layout>
    <x-slot:header>Edit Kategori</x-slot:header>

    <div class="max-w-lg">
        <a href="{{ route('backend.kategori.index') }}" class="inline-flex items-center gap-2 text-brown-400 hover:text-gold-400 transition-colors mb-6 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>

        <div class="bg-dark-100 border border-brown-800/30 rounded-xl p-6">
            <h2 class="text-xl font-serif text-brown-100 mb-6">Edit Kategori</h2>

            <form method="POST" action="{{ route('backend.kategori.update', $kategori) }}">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="label-melodi">Tipe Layanan</label>
                    <input type="text" name="tipe" class="input-melodi" value="{{ old('tipe', $kategori->tipe) }}" required>
                    @error('tipe')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="label-melodi">Spesialisasi Acara (opsional / pelengkap tipe)</label>
                    <input type="text" name="nama" class="input-melodi" value="{{ old('nama', $kategori->nama) }}" required>
                    @error('nama')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-gold">Update Kategori</button>
            </form>
        </div>
    </div>
</x-backend-layout>
