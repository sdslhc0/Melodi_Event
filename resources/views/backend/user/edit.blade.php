<x-backend-layout>
    <x-slot:header>Edit User</x-slot:header>

    <div class="max-w-2xl">
        <div class="bg-dark-100 rounded-xl border border-brown-800/30 p-6">
            <form action="{{ route('backend.user.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required
                           class="w-full bg-dark-200 border-brown-800/50 rounded-lg px-4 py-2.5 text-brown-100 focus:ring-gold-500 focus:border-gold-500">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full bg-dark-200 border-brown-800/50 rounded-lg px-4 py-2.5 text-brown-100 focus:ring-gold-500 focus:border-gold-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $user->telepon) }}" required
                           class="w-full bg-dark-200 border-brown-800/50 rounded-lg px-4 py-2.5 text-brown-100 focus:ring-gold-500 focus:border-gold-500">
                    @error('telepon')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="p-4 border border-brown-800/30 rounded-lg bg-dark-200/50">
                    <p class="text-xs text-brown-400 mb-4">Abaikan jika tidak ingin mengubah password.</p>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-brown-300 mb-2">Password Baru</label>
                            <input type="password" name="password" autocomplete="new-password"
                                   class="w-full bg-dark-200 border-brown-800/50 rounded-lg px-4 py-2.5 text-brown-100 focus:ring-gold-500 focus:border-gold-500">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-brown-300 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" autocomplete="new-password"
                                   class="w-full bg-dark-200 border-brown-800/50 rounded-lg px-4 py-2.5 text-brown-100 focus:ring-gold-500 focus:border-gold-500">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-brown-300 mb-2">Role</label>
                    <select name="role" required class="w-full bg-dark-200 border-brown-800/50 rounded-lg px-4 py-2.5 text-brown-100 focus:ring-gold-500 focus:border-gold-500">
                        <option value="0" {{ old('role', $user->role) == '0' ? 'selected' : '' }}>User</option>
                        <option value="1" {{ old('role', $user->role) == '1' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4 border-t border-brown-800/30">
                    <button type="submit" class="btn-gold">
                        Perbarui
                    </button>
                    <a href="{{ route('backend.user.index') }}" class="px-6 py-2.5 rounded-lg border border-brown-700 text-brown-300 hover:bg-brown-800/30 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-backend-layout>
