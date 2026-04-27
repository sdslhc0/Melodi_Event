<x-backend-layout>
    <x-slot:header>Detail Pemesanan #{{ $booking->id }}</x-slot:header>

    @php
        $status = $booking->detailBooking->status ?? 'pending';
        $statusColors = [
            'pending' => 'bg-yellow-900/40 text-yellow-500 border-yellow-700/50',
            'di booking' => 'bg-blue-900/40 text-blue-400 border-blue-700/50',
            'selesai' => 'bg-green-900/40 text-green-400 border-green-700/50',
            'batal' => 'bg-red-900/40 text-red-400 border-red-700/50',
        ];
        $currentStatusColor = $statusColors[$status] ?? $statusColors['pending'];
    @endphp

    <div class="max-w-6xl mx-auto pb-12">
        {{-- Top Navigation & Badge --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <a href="{{ route('backend.booking.index') }}" class="inline-flex items-center gap-2 text-brown-400 hover:text-gold-400 transition-colors text-xs font-semibold tracking-[0.15em] uppercase px-4 py-2 border border-brown-800/40 rounded-full bg-dark-100/50 hover:bg-dark-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('backend.booking.edit', $booking) }}" class="inline-flex items-center gap-2 text-gold-500 hover:text-gold-400 transition-colors text-xs font-semibold tracking-[0.15em] uppercase px-4 py-2 border border-gold-500/40 rounded-full bg-gold-500/10 hover:bg-gold-500/20 shadow-lg shadow-black/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    Edit Data
                </a>
                <span class="text-xs text-brown-400 uppercase tracking-widest ml-4">Status Saat Ini:</span>
                <span class="inline-block px-4 py-1.5 text-[11px] font-bold uppercase tracking-[0.2em] border rounded-full {{ $currentStatusColor }} shadow-lg shadow-black/20">
                    {{ $status }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- ====== KIRI: MAIN DETAILS ====== --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- 1. Info Klien (Grouped) --}}
                <div class="bg-dark-100 border border-brown-800/40 rounded-2xl p-8 relative overflow-hidden group shadow-xl shadow-black/10 transition-all hover:border-gold-500/20">
                    <h2 class="text-xl font-serif text-gold-400 mb-6 flex items-center gap-3 border-b border-brown-800/30 pb-4">
                        <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Informasi Pemesan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                        <div>
                            <span class="block text-[10px] uppercase tracking-widest text-[#7d7161] mb-2">Nama Klien / User</span>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full border border-gold-500/30 overflow-hidden bg-dark-200 flex items-center justify-center shrink-0">
                                    @if(optional($booking->user)->foto)
                                        <img src="{{ asset( $booking->user->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-gold-500 text-sm font-bold">{{ strtoupper(substr($booking->nama_lengkap ?? optional($booking->user)->nama ?? 'U', 0, 1)) }}</span>
                                    @endif
                                </div>
                                <p class="text-brown-100 font-medium text-lg">{{ $booking->nama_lengkap ?? optional($booking->user)->nama ?? '-' }}</p>
                            </div>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase tracking-widest text-[#7d7161] mb-1">WhatsApp / Telepon</span>
                            <p class="text-brown-100 font-medium text-lg flex items-center gap-2">
                                {{ $booking->no_whatsapp ?? $booking->user->telepon ?? '-' }}
                                @if($booking->no_whatsapp)
                                    @php
                                        $waText = "Halo Kak " . ($booking->nama_lengkap ?? $booking->user->nama ?? '') . ",\n\n";
                                        $waText .= "Terima kasih telah mempercayakan acara Kakak kepada Melodi Event Organizer. Berikut adalah ringkasan pesanan Kakak:\n\n";
                                        $waText .= "ID Pesanan: #" . $booking->id . "\n";
                                        $waText .= "Jenis Acara: " . ($booking->jenis_acara ?? optional($booking->acara)->nama ?? '-') . "\n";
                                        if ($booking->biaya_venue > 0) {
                                            $waText .= "Biaya Venue / Dasar: Rp " . number_format($booking->biaya_venue, 0, ',', '.') . "\n";
                                        }
                                        $waText .= "Tanggal Acara: " . $booking->tanggal->format('d F Y') . "\n";
                                        $waText .= "Waktu: " . ($booking->waktu ?? ($booking->acara_mulai . ' - ' . $booking->acara_selesai)) . "\n";
                                        $waText .= "Jumlah Tamu: " . ($booking->jumlah_tamu ?? $booking->jumlah_porsi ?? '-') . " Orang\n";
                                        $waText .= "Total Biaya: " . $booking->formatted_subtotal . "\n";
                                        $waText .= "Metode Pembayaran: " . str_replace('_', ' ', strtoupper($booking->metode_pembayaran ?? 'Belum Diatur')) . ($booking->bank ? ' - ' . strtoupper($booking->bank) : '') . "\n";
                                        
                                        if ($booking->metode_pembayaran === 'dp_30') {
                                            $waText .= "Wajib Dibayar (DP 30%): Rp " . number_format($booking->subtotal * 0.3, 0, ',', '.') . "\n";
                                            $waText .= "Kekurangan: Rp " . number_format($booking->subtotal * 0.7, 0, ',', '.') . "\n";
                                        }
                                        $waText .= "\n";
                                        
                                        if (isset($booking->layanans) && $booking->layanans->count() > 0) {
                                            $waText .= "Layanan Tambahan:\n";
                                            foreach ($booking->layanans as $lay) {
                                                $namaLayanan = $lay->acara->nama ?? 'Layanan Terarsip';
                                                $qtyText = "";
                                                if ($lay->qty > 1 || optional(optional($lay->acara)->kategori)->nama == 'Catering' || optional(optional($lay->acara)->kategori)->nama == 'Buku Undangan') {
                                                    $satuan = optional(optional($lay->acara)->kategori)->nama == 'Catering' ? 'Paks' : 'Item';
                                                    $qtyText = " (x" . $lay->qty . " " . $satuan . ")";
                                                }
                                                $waText .= "- " . $namaLayanan . $qtyText . " - Rp " . number_format($lay->harga, 0, ',', '.') . "\n";
                                            }
                                            $waText .= "\n";
                                        }

                                        $waText .= "Untuk proses selanjutnya, tim kami siap berdiskusi lebih lanjut mengenai detail acara.\n\n";
                                        $waText .= "Salam hangat,\nTim Melodi Event Organizer";
                                        
                                        $waTextEncoded = urlencode($waText);
                                    @endphp
                                    <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->no_whatsapp) }}?text={{ $waTextEncoded }}" target="_blank" class="text-green-500 hover:text-green-400" title="Chat via WhatsApp">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    </a>
                                @endif
                            </p>
                        </div>
                        <div class="md:col-span-2">
                            <span class="block text-[10px] uppercase tracking-widest text-[#7d7161] mb-1">Email Klien (Akun Terdaftar)</span>
                            <p class="text-brown-200">{{ $booking->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- 2. Detail Acara (Grouped) --}}
                <div class="bg-dark-100 border border-brown-800/40 rounded-2xl p-8 shadow-xl shadow-black/10 transition-all hover:border-gold-500/20">
                    <h2 class="text-xl font-serif text-gold-400 mb-6 flex items-center gap-3 border-b border-brown-800/30 pb-4">
                        <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Rincian Acara
                    </h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="sm:col-span-2 md:col-span-1 bg-dark-200/40 p-4 rounded-xl border border-brown-800/20">
                            <span class="block text-[10px] uppercase tracking-widest text-gold-500 mb-1">Format Acara</span>
                            <p class="text-brown-100 font-medium text-lg">{{ $booking->jenis_acara ?? optional($booking->acara)->nama ?? '-' }}</p>
                        </div>
                        <div class="bg-dark-200/40 p-4 rounded-xl border border-brown-800/20">
                            <span class="block text-[10px] uppercase tracking-widest text-gold-500 mb-1">Tanggal Acara</span>
                            <p class="text-brown-100 font-medium text-lg">{{ $booking->tanggal->format('d F Y') }}</p>
                        </div>
                        <div class="bg-dark-200/40 p-4 rounded-xl border border-brown-800/20">
                            <span class="block text-[10px] uppercase tracking-widest text-gold-500 mb-1">Waktu Pelaksanaan</span>
                            <p class="text-brown-100 font-medium text-lg">{{ $booking->waktu ?? ($booking->acara_mulai . ' - ' . $booking->acara_selesai) }}</p>
                        </div>
                        
                        <div class="bg-dark-200/40 p-4 rounded-xl border border-brown-800/20">
                            <span class="block text-[10px] uppercase tracking-widest text-gold-500 mb-1">Jumlah Tamu (Target)</span>
                            <p class="text-brown-100 font-medium text-lg">{{ $booking->jumlah_tamu ?? $booking->jumlah_porsi ?? '-' }} <span class="text-xs text-brown-400 font-normal">Paks</span></p>
                        </div>
                        
                        @if($booking->biaya_venue)
                        <div class="md:col-span-2 bg-dark-200/40 p-4 rounded-xl border border-brown-800/20">
                            <span class="block text-[10px] uppercase tracking-widest text-brown-500 mb-1">Alokasi Biaya Venue / Dasar</span>
                            <p class="text-brown-200 font-mono text-sm leading-6 tracking-wide">Rp {{ number_format($booking->biaya_venue, 0, ',', '.') }}</p>
                        </div>
                        @else
                        <div class="md:col-span-2 bg-dark-200/40 p-4 rounded-xl border border-brown-800/20">
                            <span class="block text-[10px] uppercase tracking-widest text-brown-500 mb-1">Kategori Tradisional</span>
                            <p class="text-brown-200 text-sm leading-6">{{ optional(optional($booking->acara)->kategori)->nama ?? 'Layanan Fleksibel' }}</p>
                        </div>
                        @endif
                    </div>

                    @if($booking->catatan)
                        <div class="mt-6 bg-yellow-900/10 border-l-4 border-yellow-600/50 p-4 rounded-r-lg">
                            <span class="block text-xs uppercase tracking-widest text-yellow-600 mb-1 font-bold">Catatan Khusus Klien</span>
                            <p class="text-brown-200 italic leading-relaxed text-sm">"{{ $booking->catatan }}"</p>
                        </div>
                    @endif
                </div>

                {{-- 3. Paket Utama Katering & Layanan Tambahan (Grouped) --}}
                <div class="bg-dark-100 border border-brown-800/40 rounded-2xl p-8 shadow-xl shadow-black/10 transition-all hover:border-gold-500/20">
                    <h2 class="text-xl font-serif text-gold-400 mb-6 flex items-center gap-3 border-b border-brown-800/30 pb-4">
                        <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>
                        Layanan Dipesan
                    </h2>
                    
                    <div class="space-y-6">


                        {{-- Vendor Tambahan / Spesifikasi --}}
                        <div class="bg-dark-200/30 rounded-xl border border-brown-800/40 overflow-hidden">
                            <div class="bg-dark-200/50 px-5 py-3 border-b border-brown-800/40 flex items-center gap-2">
                                <svg class="w-4 h-4 text-brown-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <h4 class="text-xs text-brown-300 uppercase tracking-widest font-semibold flex-1">Layanan Vendor Tambahan</h4>
                            </div>
                            
                            @if(isset($booking->layanans) && $booking->layanans->count() > 0)
                                <ul class="divide-y divide-brown-800/20">
                                    @foreach($booking->layanans as $lay)
                                        <li class="flex justify-between items-center p-5 hover:bg-dark-200/50 transition-colors group">
                                            <div class="flex items-center gap-3">
                                                <div class="w-2 h-2 bg-gold-600/50 rounded-full group-hover:bg-gold-500 transition-colors"></div>
                                                <span class="text-brown-100 flex items-center gap-2">
                                                    {{ $lay->acara->nama ?? 'Layanan Terarsip' }}
                                                    @if($lay->qty > 1 || optional(optional($lay->acara)->kategori)->nama == 'Catering' || optional(optional($lay->acara)->kategori)->nama == 'Buku Undangan')
                                                        <span class="bg-dark-300 text-[10px] px-2 py-0.5 rounded-full text-brown-400">× {{ $lay->qty }} {{ optional(optional($lay->acara)->kategori)->nama == 'Catering' ? 'Paks' : 'Item' }}</span>
                                                    @endif
                                                </span>
                                            </div>
                                            <span class="text-brown-300 font-mono text-sm">Rp {{ number_format($lay->harga, 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-brown-500 italic text-sm text-center py-8 px-5">Tidak ada vendor layanan tambahan yang dipilih. Klien menggunakan struktur paket murni.</div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- ====== KANAN: PAYMENT & ACTION ====== --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Payment Box --}}
                @php
                    $isDp = ($booking->metode_pembayaran === 'dp_30');
                    $boxBorderClass = $isDp ? 'border-yellow-600/50 shadow-[0_0_30px_rgba(202,138,4,0.15)]' : 'border-gold-500/30 shadow-[0_10px_40px_rgba(201,168,76,0.06)]';
                @endphp
                <div class="bg-gradient-to-br from-dark-100 to-[#1e1915] border {{ $boxBorderClass }} rounded-2xl p-8 relative overflow-hidden text-center transform transition-transform hover:-translate-y-1 duration-500">
                    <div class="absolute inset-0 bg-pattern opacity-[0.03]"></div>
                    
                    @if($isDp)
                        <div class="absolute top-0 right-0 bg-yellow-600 text-[#1a140e] font-bold text-[9px] uppercase tracking-widest px-4 py-1.5 rounded-bl-xl shadow-lg z-20">
                            Status DP
                        </div>
                    @endif
                    
                    <h3 class="text-[10px] sm:text-xs uppercase tracking-[0.2em] text-brown-400 mb-3 relative z-10 font-bold">Total Nilai Pembayaran</h3>
                    <div class="text-3xl sm:text-4xl font-serif text-gold-400 mb-6 font-normal drop-shadow-sm relative z-10">{{ $booking->formatted_subtotal }}</div>
                    
                    @if($isDp)
                    <div class="grid grid-cols-2 gap-3 mb-6 relative z-10">
                        <div class="bg-yellow-900/20 border border-yellow-700/30 rounded-xl p-3 flex flex-col justify-center">
                            <span class="block text-[9px] uppercase tracking-widest text-yellow-500 mb-1 font-bold">Wajib DP (30%)</span>
                            <span class="text-[15px] font-mono text-yellow-400 font-bold">Rp {{ number_format($booking->subtotal * 0.3, 0, ',', '.') }}</span>
                        </div>
                        <div class="bg-red-900/20 border border-red-700/30 rounded-xl p-3 flex flex-col justify-center">
                            <span class="block text-[9px] uppercase tracking-widest text-red-400/80 mb-1 font-bold">Kekurangan</span>
                            <span class="text-[15px] font-mono text-red-400 font-bold">Rp {{ number_format($booking->subtotal * 0.7, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endif
                    
                    <div class="pt-6 border-t border-gold-800/40 text-left relative z-10">
                        <span class="text-[9px] uppercase tracking-[0.15em] text-brown-500 block mb-2 font-bold">Tipe Pembayaran & Bank</span>
                        <div class="font-bold tracking-wider text-gold-100 bg-dark/60 p-4 rounded-xl border border-gold-900/40 text-xs flex items-center justify-center gap-2 shadow-inner">
                            <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            {{ str_replace('_', ' ', strtoupper($booking->metode_pembayaran ?? 'BELUM DIATUR')) }} 
                            @if($booking->bank)
                            <span class="text-brown-400 font-normal mx-1">—</span> {{ strtoupper($booking->bank) }}
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Admin Action Form --}}
                <div class="bg-dark-100 border border-brown-800/40 rounded-2xl p-7 shadow-xl shadow-black/10">
                    <h3 class="text-lg font-serif text-brown-100 mb-6 flex items-center gap-2 border-b border-brown-800/40 pb-4">
                        <svg class="w-5 h-5 text-brown-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Tindakan Admin
                    </h3>

                    <form method="POST" action="{{ route('backend.booking.updateStatus', $booking) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-6 relative">
                            <label class="block text-[10px] uppercase tracking-widest text-brown-400 mb-2 font-bold ml-1">Ubah Status Order</label>
                            
                            {{-- Custom Select Arrow Wrapper --}}
                            <div class="relative">
                                <select name="status" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3.5 pl-4 pr-10 text-sm font-medium appearance-none cursor-pointer hover:border-brown-600 transition-colors shadow-inner" required>
                                    <option value="pending" {{ $status == 'pending' ? 'selected' : '' }} class="bg-dark text-yellow-500 py-2">⏳ PENDING</option>
                                    <option value="di booking" {{ $status == 'di booking' ? 'selected' : '' }} class="bg-dark text-blue-400 py-2">📝 DI BOOKING</option>
                                    <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }} class="bg-dark text-green-400 py-2">✅ SELESAI / LUNAS</option>
                                    <option value="batal" {{ $status == 'batal' ? 'selected' : '' }} class="bg-dark text-red-400 py-2">❌ BATAL</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-brown-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full relative group overflow-hidden bg-gold-500 hover:bg-gold-400 tracking-[0.2em] uppercase font-bold text-[11px] py-4 rounded-xl transition-all duration-300 shadow-[0_5px_20px_rgba(201,168,76,0.3)] hover:-translate-y-0.5 flex justify-center items-center gap-2" style="color: #1a140e !important;">
                            <span class="relative z-10 w-full text-center" style="color: #1a140e !important;">Terapkan Perubahan</span>
                            <div class="absolute inset-0 h-full w-0 bg-white/20 transition-all duration-300 ease-out group-hover:w-full z-0"></div>
                        </button>
                    </form>

                    <div class="mt-8 pt-5 border-t border-brown-800/30 grid grid-cols-2 gap-4">
                        <div>
                            <span class="block text-[9px] uppercase tracking-widest text-[#6b5e4f] mb-1 font-bold">Waktu Masuk</span>
                            <span class="text-xs text-brown-300">{{ $booking->created_at->format('d M y, H:i') }}</span>
                        </div>
                        <div>
                            <span class="block text-[9px] uppercase tracking-widest text-[#6b5e4f] mb-1 font-bold">Terakhir Update</span>
                            <span class="text-xs text-brown-300">{{ $booking->updated_at->format('d M y, H:i') }}</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-backend-layout>
