<x-frontend-layout>
    <x-slot:title>Riwayat Booking - MELODI</x-slot:title>

    <section class="pt-28 pb-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-subtitle">Riwayat</div>
            <h1 class="text-3xl md:text-4xl font-serif text-brown-50 mb-2">Riwayat Booking Anda</h1>
            <p class="text-brown-400 mb-10">Lihat dan pantau status booking Anda.</p>

            @if($bookings->count() > 0)
                <div class="space-y-6">
                    @foreach($bookings as $booking)
                        <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden hover:border-gold-500/20 transition-all duration-300">
                            <div class="flex flex-col md:flex-row">
                                {{-- Left: Icon Placeholder --}}
                                <div class="md:w-48 md:flex-shrink-0">
                                    <div class="w-full h-48 md:h-full bg-dark-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gold-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>

                                {{-- Details --}}
                                <div class="flex-1 p-6">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                        <div class="w-full">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="font-serif text-lg text-brown-100">{{ $booking->jenis_acara ?? 'Acara' }}</h3>
                                                @php
                                                    $status = $booking->detailBooking->status ?? 'pending';
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400',
                                                        'di booking' => 'bg-blue-900/30 border-blue-700/30 text-blue-400',
                                                        'selesai' => 'bg-green-900/30 border-green-700/30 text-green-400',
                                                    ];
                                                @endphp
                                                <span class="px-2 py-0.5 text-[10px] uppercase tracking-widest border rounded-sm {{ $statusColors[$status] ?? $statusColors['pending'] }}">
                                                    {{ $status }}
                                                </span>
                                            </div>
                                            <p class="text-brown-500 text-xs uppercase tracking-widest mb-3">{{ $booking->nama_lengkap }} • {{ $booking->no_whatsapp }}</p>

                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Tanggal</span>
                                                    <span class="text-brown-200">{{ $booking->tanggal->format('d M Y') }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Waktu</span>
                                                    <span class="text-brown-200">{{ $booking->acara_mulai ?? '-' }} - {{ $booking->acara_selesai ?? '-' }}</span>
                                                </div>
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Jumlah Tamu</span>
                                                    <span class="text-brown-200">{{ $booking->jumlah_tamu ?? $booking->jumlah_porsi ?? '-' }} Paks</span>
                                                </div>
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Total</span>
                                                    <span class="text-gold-500 font-semibold">{{ $booking->formatted_subtotal }}</span>
                                                </div>
                                                @if($booking->metode_pembayaran === 'dp_30')
                                                <div class="mt-2 sm:mt-0">
                                                    <span class="text-brown-500 text-xs block">DP (30%)</span>
                                                    <span class="text-gold-500 font-semibold">Rp {{ number_format($booking->subtotal * 0.3, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="mt-2 sm:mt-0">
                                                    <span class="text-red-400/80 text-xs block italic">Kekurangan</span>
                                                    <span class="text-red-400/90 font-semibold">Rp {{ number_format($booking->subtotal * 0.7, 0, ',', '.') }}</span>
                                                </div>
                                                @endif
                                            </div>

                                            {{-- Layanan Terpilih --}}
                                            @if($booking->layanans && $booking->layanans->count() > 0)
                                                <div class="mt-4 pt-3 border-t border-brown-800/20">
                                                    <span class="text-brown-500 text-[10px] uppercase tracking-widest block mb-2">Layanan Tambahan</span>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($booking->layanans as $lay)
                                                            <span class="inline-block px-2 py-1 bg-dark-200 border border-brown-800/30 rounded text-[11px] text-brown-300">
                                                                {{ $lay->acara->nama ?? 'Layanan' }} 
                                                                @if($lay->qty > 1 || optional(optional($lay->acara)->kategori)->nama == 'Catering' || optional(optional($lay->acara)->kategori)->nama == 'Buku Undangan')
                                                                    <span class="text-brown-500">({{ $lay->qty }})</span>
                                                                @endif
                                                                — <span class="text-gold-500">Rp {{ number_format($lay->harga, 0, ',', '.') }}</span>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif


                                            @if($booking->paketBundling)
                                                <div class="mt-3 pt-3 border-t border-brown-800/20">
                                                    <span class="text-brown-500 text-[10px] uppercase tracking-widest block mb-1">Bundling Exclusive</span>
                                                    <span class="inline-block px-2 py-1 bg-dark-200 border border-brown-800/30 rounded text-[11px] text-brown-300">
                                                        {{ $booking->paketBundling->nama }} — <span class="text-gold-500">Rp {{ number_format($booking->paketBundling->harga, 0, ',', '.') }}</span>
                                                    </span>
                                                </div>
                                            @endif

                                            @if($booking->catatan)
                                                <p class="text-brown-400 text-sm mt-3 italic">"{{ $booking->catatan }}"</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-dark-100 border border-brown-800/20 rounded-xl">
                    <svg class="w-16 h-16 text-brown-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <h3 class="text-brown-300 font-serif text-xl mb-2">Belum Ada Booking</h3>
                    <p class="text-brown-500 mb-6">Anda belum melakukan booking apapun.</p>
                    <a href="{{ route('home') }}#formulir-pemesanan" class="btn-gold">Buat Pesanan Sekarang</a>
                </div>
            @endif
        </div>
    </section>
</x-frontend-layout>
