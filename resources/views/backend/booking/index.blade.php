<x-backend-layout>
    <x-slot:header>Booking</x-slot:header>

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-serif text-brown-100">Manajemen Booking</h2>
            <p class="text-brown-500 text-sm">Kelola dan update status booking</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            {{-- Status Filters --}}
            <div class="flex flex-wrap gap-2">
                <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          {{ !request('status') || request('status') == 'all' ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50' }}">
                    Semua
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          {{ request('status') == 'pending' ? 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50' }}">
                    Pending
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'di booking']) }}"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          {{ request('status') == 'di booking' ? 'bg-blue-900/30 border-blue-700/30 text-blue-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50' }}">
                    Di Booking
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'selesai']) }}"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          {{ request('status') == 'selesai' ? 'bg-green-900/30 border-green-700/30 text-green-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50' }}">
                    Selesai
                </a>
                <a href="{{ request()->fullUrlWithQuery(['status' => 'batal']) }}"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          {{ request('status') == 'batal' ? 'bg-red-900/30 border-red-700/30 text-red-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50' }}">
                    Batal
                </a>
            </div>

            <div class="w-px h-6 bg-brown-800/50 hidden sm:block"></div>

            {{-- Date Range Filter Dropdown --}}
            <div x-data="{ open: false }" class="relative" @click.away="open = false">
                <button @click="open = !open" 
                        class="flex items-center gap-2 px-4 py-2 bg-dark-200 border {{ request('start_date') || request('end_date') ? 'border-gold-500/50 text-gold-400' : 'border-brown-700/50 text-brown-300' }} text-xs uppercase tracking-widest rounded-sm hover:border-gold-500/50 hover:text-gold-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    @if(request('start_date') && request('end_date'))
                        {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/y') }} - {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/y') }}
                    @elseif(request('start_date'))
                        > {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/y') }}
                    @elseif(request('end_date'))
                        < {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/y') }}
                    @else
                        Rentang Tanggal
                    @endif
                    <svg class="w-3 h-3 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="open" x-transition.opacity 
                     class="absolute right-0 mt-2 p-4 bg-dark-100 border border-brown-800/50 rounded-md shadow-xl z-20 w-72" style="display: none;">
                    <form action="{{ route('backend.booking.index') }}" method="GET" class="flex flex-col gap-3">
                        @if(request('status'))
                            <input type="hidden" name="status" value="{{ request('status') }}">
                        @endif
                        @if(request('sort_date'))
                            <input type="hidden" name="sort_date" value="{{ request('sort_date') }}">
                        @endif
                        
                        <div>
                            <label class="block text-xs text-brown-500 mb-1">Mulai Dari</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full bg-dark-200 border border-brown-700/50 rounded-sm text-brown-300 text-sm focus:ring-1 focus:ring-gold-500 focus:border-gold-500 p-2 [color-scheme:dark]">
                        </div>
                        
                        <div>
                            <label class="block text-xs text-brown-500 mb-1">Sampai Dengan</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full bg-dark-200 border border-brown-700/50 rounded-sm text-brown-300 text-sm focus:ring-1 focus:ring-gold-500 focus:border-gold-500 p-2 [color-scheme:dark]">
                        </div>
                        
                        <div class="flex items-center justify-between mt-2">
                            @if(request('start_date') || request('end_date'))
                                <a href="{{ request()->fullUrlWithQuery(['start_date' => null, 'end_date' => null]) }}" class="text-xs text-red-400 hover:text-red-300 transition-colors">
                                    Reset Filter
                                </a>
                            @else
                                <div></div>
                            @endif
                            <button type="submit" class="px-4 py-2 bg-gold-500/10 border border-gold-500/50 text-gold-400 text-xs uppercase tracking-widest rounded-sm hover:bg-gold-500 hover:text-dark-100 transition-colors">
                                Terapkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-px h-6 bg-brown-800/50 hidden sm:block"></div>

            {{-- Sorting Dropdown --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.away="open = false" 
                        class="flex items-center gap-2 px-4 py-2 bg-dark-200 border border-brown-700/50 text-brown-300 text-xs uppercase tracking-widest rounded-sm hover:border-gold-500/50 hover:text-gold-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    @if(request('sort_date') == 'asc')
                        Tanggal Terdekat
                    @elseif(request('sort_date') == 'desc')
                        Tanggal Terjauh
                    @else
                        Urutkan
                    @endif
                    <svg class="w-3 h-3 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="open" x-transition.opacity 
                     class="absolute right-0 mt-2 w-48 bg-dark-100 border border-brown-800/50 rounded-md shadow-xl z-20 py-1" style="display: none;">
                    <a href="{{ request()->fullUrlWithQuery(['sort_date' => null]) }}" 
                       class="block px-4 py-2 text-xs text-brown-300 hover:bg-dark-200 hover:text-gold-400 transition-colors {{ !request('sort_date') ? 'text-gold-500 bg-dark-200/50' : '' }}">
                        Order Masuk (Default)
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort_date' => 'asc']) }}" 
                       class="block px-4 py-2 text-xs text-brown-300 hover:bg-dark-200 hover:text-gold-400 transition-colors {{ request('sort_date') == 'asc' ? 'text-gold-500 bg-dark-200/50' : '' }}">
                        Tanggal Acara Terdekat
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['sort_date' => 'desc']) }}" 
                       class="block px-4 py-2 text-xs text-brown-300 hover:bg-dark-200 hover:text-gold-400 transition-colors {{ request('sort_date') == 'desc' ? 'text-gold-500 bg-dark-200/50' : '' }}">
                        Tanggal Acara Terjauh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Jenis Acara</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Jam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Subtotal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    @forelse($bookings as $booking)
                        @php
                            $isDp = ($booking->metode_pembayaran === 'dp_30');
                            $rowClass = $isDp ? 'bg-gradient-to-r from-yellow-900/10 to-transparent hover:from-yellow-900/20 hover:to-dark-200/20' : 'hover:bg-dark-200/50';
                        @endphp
                        <tr class="transition-colors {{ $rowClass }}">
                            <td class="px-6 py-4 text-sm {{ $isDp ? 'text-yellow-500 font-semibold' : 'text-brown-400' }}">
                                #{{ $booking->id }}
                                @if($isDp)
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-yellow-500 ml-1 shadow-[0_0_5px_rgba(234,179,8,0.8)]" title="Pembayaran DP"></span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-brown-200">{{ $booking->nama_lengkap ?? $booking->user->nama }}</div>
                                <div class="text-xs text-brown-500">{{ $booking->no_whatsapp ?? $booking->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-300">{{ $booking->jenis_acara ?: '-' }}</td>
                            <td class="px-6 py-4 text-sm text-brown-300">{{ $booking->tanggal->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-brown-300">{{ $booking->acara_mulai }} - {{ $booking->acara_selesai }}</td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gold-500 font-semibold">{{ $booking->formatted_subtotal }}</div>
                                @if($isDp)
                                    <div class="inline-block mt-1 px-1.5 py-0.5 bg-yellow-900/30 border border-yellow-700/30 text-yellow-500 text-[8px] uppercase tracking-widest rounded-sm">
                                        Status DP
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $status = $booking->detailBooking->status ?? 'pending';
                                    $colors = [
                                        'pending' => 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400',
                                        'di booking' => 'bg-blue-900/30 border-blue-700/30 text-blue-400',
                                        'selesai' => 'bg-green-900/30 border-green-700/30 text-green-400',
                                        'batal' => 'bg-red-900/30 border-red-700/30 text-red-400',
                                    ];
                                @endphp
                                <span class="px-2 py-0.5 text-[10px] uppercase tracking-widest border rounded-sm {{ $colors[$status] }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('backend.booking.show', $booking) }}" class="btn-outline-sm">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-brown-500">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-backend-layout>
