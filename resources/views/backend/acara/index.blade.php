<x-backend-layout>
    <x-slot:header>Acara</x-slot:header>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-serif text-brown-100">Manajemen Acara</h2>
            <p class="text-brown-500 text-sm">Kelola paket acara</p>
        </div>
        <a href="{{ route('backend.acara.create') }}" class="btn-gold-sm">+ Tambah Acara</a>
    </div>

    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    @forelse($acaras as $acara)
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="w-16 h-12 rounded-lg overflow-hidden bg-dark-200">
                                    @if($acara->foto)
                                        <img src="{{ asset( $acara->foto) }}" alt="{{ $acara->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-6 h-6 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-200 font-medium">{{ $acara->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-gold-500/10 text-gold-400 text-xs rounded-sm">{{ $acara->kategori->nama }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gold-500 font-semibold">{{ $acara->formatted_harga }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('backend.acara.edit', $acara) }}" class="btn-outline-sm">Edit</a>
                                    <form method="POST" action="{{ route('backend.acara.destroy', $acara) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus acara ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-brown-500">Belum ada acara.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-backend-layout>
