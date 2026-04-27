<x-frontend-layout>
    <x-slot name="title">Profil Saya - MELODI</x-slot>

    {{-- Page Hero --}}
    <div class="relative w-full bg-[#120d0a]" style="padding-top: 96px;">
        <div class="relative py-10 text-center overflow-hidden">
            {{-- Subtle background decoration --}}
            <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(ellipse at center top, rgba(201,168,76,0.06) 0%, transparent 65%);"></div>
            <p class="text-[#c9a84c]/50 font-serif text-[10px] uppercase tracking-[0.4em] mb-3" style="animation: fadeDown 0.8s ease-out">Welcome</p>
            <h1 class="text-[#c9a84c] font-serif text-2xl md:text-4xl tracking-[0.2em] font-medium uppercase mb-4" style="animation: fadeDown 1s ease-out">Profil Saya</h1>
            <div class="w-16 md:w-24 h-px bg-gradient-to-r from-transparent via-[#c9a84c] to-transparent mx-auto"></div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pb-32">
        <div class="mb-10 p-6 sm:p-8 bg-[#1f1a16]/40 border border-[#c9a84c]/20 rounded-xl backdrop-blur-sm flex flex-col md:flex-row items-center justify-between gap-6" style="animation: fadeInUp 1s ease-out">
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 rounded-full border-2 border-[#c9a84c]/50 overflow-hidden shadow-2xl">
                    @if($user->foto)
                        <img src="{{ asset('storage/' . $user->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[#c9a84c]/10 flex items-center justify-center text-[#c9a84c]">
                            <span class="text-3xl font-serif">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                <div>
                    <h2 class="text-2xl font-serif text-[#f5f0e8] mb-1">Halo, {{ explode(' ', $user->nama)[0] }}!</h2>
                    <p class="text-[13px] text-[#a89880] tracking-wide">Selamat Datang kembali di Melodi.</p>
                </div>
            </div>
            
            <div class="flex items-center justify-center md:justify-end gap-8 sm:gap-10 w-full md:w-auto">
                {{-- Total Booking --}}
                <div class="flex flex-col items-center justify-between min-w-[80px] h-[52px] group">
                    <span class="text-2xl font-serif text-[#c9a84c] leading-none group-hover:scale-110 transition-transform">{{ $totalBookings }}</span>
                    <span class="text-[9px] uppercase tracking-[0.2em] text-[#a89880] font-bold">Total Booking</span>
                </div>
                
                <div class="w-px h-10 bg-[#4a4239]/50 self-center"></div>
                
                {{-- Status Terakhir --}}
                <div class="flex flex-col items-center justify-between min-w-[80px] h-[52px]">
                    @if($latestBooking)
                        @php
                            $status = $latestBooking->detailBooking->status ?? 'pending';
                            $color = $status == 'pending' ? 'text-yellow-500' : ($status == 'selesai' ? 'text-green-500' : 'text-blue-500');
                        @endphp
                        <span class="text-2xl font-serif {{ $color }} leading-none capitalize">{{ $status }}</span>
                        <span class="text-[9px] uppercase tracking-[0.2em] text-[#a89880] font-bold">Status Terakhir</span>
                    @else
                        <span class="text-2xl font-serif text-[#a89880]/50 leading-none">–</span>
                        <span class="text-[9px] uppercase tracking-[0.2em] text-[#a89880] font-bold">Status Terakhir</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            
            {{-- Form Profil --}}
            <div class="md:col-span-7 bg-[#1f1a16] border border-[#4a4239]/50 rounded-lg p-6 sm:p-10 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-[#c9a84c]/5 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-[1.5s] ease-in-out pointer-events-none"></div>
                <div class="mb-8 border-b border-[#4a4239]/50 pb-5">
                    <h2 class="text-2xl font-serif text-[#d4c8b0] tracking-wider mb-2">Informasi Akun</h2>
                    <p class="text-[14px] text-[#a89880] font-sans leading-relaxed">Perbarui informasi profil dasar Anda agar tim kami mudah menghubungi Anda.</p>
                </div>

                <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="flex flex-col items-center mb-8 border-b border-[#4a4239]/20 pb-8">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full border-2 border-[#c9a84c] overflow-hidden bg-[#2a231d] flex items-center justify-center">
                                @if($user->foto)
                                    <img id="avatar-preview" src="{{ asset('storage/' . $user->foto) }}" class="w-full h-full object-cover">
                                @else
                                    <div id="avatar-placeholder" class="text-[#c9a84c]">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <img id="avatar-preview" class="w-full h-full object-cover hidden">
                                @endif
                            </div>
                            <label for="foto-input" class="absolute bottom-0 right-0 bg-[#c9a84c] text-[#1a140e] p-1.5 rounded-full cursor-pointer hover:bg-[#d4b065] transition-colors shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 011.664.89l.812 1.22A2 2 0 0010.07 10H14a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </label>
                            <input type="file" id="foto-input" name="foto" class="hidden" accept="image/*" @change="previewImage">
                        </div>
                        <p class="text-[10px] text-[#a89880] uppercase tracking-widest mt-3 font-bold">Foto Profil</p>
                        @error('foto') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama', $user->nama) }}" required 
                                   class="w-full bg-[#2a231d] border border-[#4a4239] text-[#f5f0e8] px-4 py-3 text-[14px] font-medium outline-none focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 transition-all rounded-sm placeholder:text-[#a89880]/50">
                            @error('nama') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                                   class="w-full bg-[#2a231d] border border-[#4a4239] text-[#f5f0e8] px-4 py-3 text-[14px] font-medium outline-none focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 transition-all rounded-sm placeholder:text-[#a89880]/50">
                            @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-2">No. Telepon / WhatsApp</label>
                            <input type="text" name="telepon" value="{{ old('telepon', $user->telepon) }}"
                                   class="w-full bg-[#2a231d] border border-[#4a4239] text-[#f5f0e8] px-4 py-3 text-[14px] font-medium outline-none focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 transition-all rounded-sm placeholder:text-[#a89880]/50">
                            @error('telepon') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="pt-6 mt-4 flex items-center justify-between border-t border-[#4a4239]/30">
                        <button type="submit" class="bg-[#c9a84c] border border-[#c9a84c] text-[#1a140e] px-8 py-3 font-bold uppercase tracking-[0.15em] text-[11px] hover:bg-[#d4b065] hover:border-[#d4b065] transition-colors rounded-sm shadow-md">
                            Simpan Profil
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition class="text-[13px] text-green-500/90 font-medium font-sans flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Profil berhasil diperbarui
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Form Password --}}
            <div class="md:col-span-5 bg-[#1f1a16] border border-[#4a4239]/50 rounded-lg p-6 sm:p-10 relative overflow-hidden group">
                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-[#c9a84c]/5 to-transparent translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-[1.5s] ease-in-out pointer-events-none"></div>
                <div class="mb-8 border-b border-[#4a4239]/50 pb-5">
                    <h2 class="text-2xl font-serif text-[#d4c8b0] tracking-wider mb-2">Keamanan</h2>
                    <p class="text-[14px] text-[#a89880] font-sans leading-relaxed">Ubah password akun Anda untuk menjaga keamanan.</p>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required 
                               class="w-full bg-[#2a231d] border border-[#4a4239] text-[#f5f0e8] px-4 py-3 text-[14px] font-medium outline-none focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 transition-all rounded-sm">
                        @error('current_password', 'updatePassword') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-2">Password Baru</label>
                        <input type="password" name="password" required 
                               class="w-full bg-[#2a231d] border border-[#4a4239] text-[#f5f0e8] px-4 py-3 text-[14px] font-medium outline-none focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 transition-all rounded-sm">
                        @error('password', 'updatePassword') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full bg-[#2a231d] border border-[#4a4239] text-[#f5f0e8] px-4 py-3 text-[14px] font-medium outline-none focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 transition-all rounded-sm">
                        @error('password_confirmation', 'updatePassword') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 mt-4 flex items-center justify-between border-t border-[#4a4239]/30">
                        <button type="submit" class="border border-[#c9a84c] text-[#c9a84c] hover:bg-[#c9a84c] hover:text-[#1a140e] px-8 py-3 font-bold uppercase tracking-[0.15em] text-[11px] transition-all duration-300 rounded-sm">
                            Perbarui Password
                        </button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition class="text-[13px] text-green-500/90 font-medium font-sans flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Tersimpan
                            </p>
                        @endif
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-frontend-layout>
