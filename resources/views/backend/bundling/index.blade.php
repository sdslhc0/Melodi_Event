<x-backend-layout>
    <x-slot:header>Kelola Paket Bundling</x-slot:header>

    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-serif text-brown-50">Daftar Paket Bundling</h2>
        <a href="{{ route('backend.bundling.create') }}" class="bg-gold-500 hover:bg-gold-400 text-dark-900 px-4 py-2 rounded font-bold text-sm uppercase tracking-wider transition-colors inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Paket
        </a>
    </div>

    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-4 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Gambar</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Nama Paket</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Layanan Termasuk</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-brown-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    @forelse($paketBundlings as $bundling)
                    <tr class="hover:bg-dark-200/50 transition-colors">
                        <td class="px-6 py-4">
                            @if($bundling->gambar)
                                <img src="{{ asset(  $bundling->gambar) }}" alt="{{ $bundling->nama }}" class="w-16 h-16 object-cover rounded-lg border border-brown-800/30">
                            @else
                                <div class="w-16 h-16 bg-dark rounded-lg border border-brown-800/30 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-brown-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-brown-100 font-medium">{{ $bundling->nama }}</div>
                            <div class="text-xs text-brown-500 mt-1">{{ Str::limit($bundling->deskripsi, 40) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-gold-500">{{ $bundling->formatted_harga }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($bundling->acaras as $acara)
                                    <span class="inline-flex items-center px-2 py-0.5 text-[10px] uppercase tracking-wider border rounded-sm bg-gold-500/10 border-gold-500/30 text-gold-400">
                                        {{ $acara->nama }}
                                    </span>
                                @endforeach
                                @if($bundling->acaras->isEmpty())
                                    <span class="text-xs text-brown-500 italic">Belum ada layanan</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('backend.bundling.edit', $bundling) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                                <form action="{{ route('backend.bundling.destroy', $bundling) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-brown-500">
                            Belum ada paket bundling.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-backend-layout>
