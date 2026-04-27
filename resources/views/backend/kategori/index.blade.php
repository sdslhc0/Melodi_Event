<x-backend-layout>
    <x-slot:header>Kategori</x-slot:header>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-serif text-brown-100">Manajemen Kategori</h2>
            <p class="text-brown-500 text-sm">Kelola kategori acara</p>
        </div>
        <a href="{{ route('backend.kategori.create') }}" class="btn-gold-sm">+ Tambah Kategori</a>
    </div>

    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Jumlah Acara</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    @forelse($kategoris as $index => $kategori)
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-brown-400">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-brown-200 font-medium">{{ $kategori->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-gold-500/10 text-gold-400 text-xs rounded-sm">
                                    {{ $kategori->acaras_count }} acara
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('backend.kategori.edit', $kategori) }}" class="btn-outline-sm">Edit</a>
                                    <form method="POST" action="{{ route('backend.kategori.destroy', $kategori) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-brown-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-backend-layout>
