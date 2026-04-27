<x-backend-layout>
    <x-slot:header>Kelola User</x-slot:header>

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-serif text-brown-100">Daftar User</h2>
        <a href="{{ route('backend.user.create') }}" class="btn-gold flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah User
        </a>
    </div>

    <div class="bg-dark-100 rounded-xl border border-brown-800/30 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-dark-200 border-b border-brown-800/30 text-brown-300">
                    <tr>
                        <th class="p-4 font-medium">Nama</th>
                        <th class="p-4 font-medium">Email</th>
                        <th class="p-4 font-medium">Telepon</th>
                        <th class="p-4 font-medium">Role</th>
                        <th class="p-4 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/30">
                    @forelse($users as $user)
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="p-4 text-brown-100">{{ $user->nama }}</td>
                            <td class="p-4 text-brown-300">{{ $user->email }}</td>
                            <td class="p-4 text-brown-300">{{ $user->telepon }}</td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium {{ $user->role == '1' ? 'bg-gold-500/20 text-gold-400' : 'bg-brown-500/20 text-brown-300' }}">
                                    {{ $user->role == '1' ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td class="p-4 flex gap-2 justify-end">
                                <a href="{{ route('backend.user.edit', $user) }}" class="p-2 text-blue-400 hover:bg-blue-500/20 rounded-lg transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('backend.user.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:bg-red-500/20 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-brown-400">Belum ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-4 border-t border-brown-800/30">
            {{ $users->links() }}
        </div>
    </div>
</x-backend-layout>
