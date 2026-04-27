<x-frontend-layout>
    <x-slot:title>{{ $acara->nama }} - MELODI</x-slot:title>

    <section class="pt-28 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Back Button --}}
            <a href="{{ route('kategori') }}" class="inline-flex items-center gap-2 text-brown-400 hover:text-gold-400 transition-colors mb-8 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Kategori
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                {{-- Image --}}
                <div class="relative">
                    <div class="aspect-[4/3] rounded-xl overflow-hidden border border-brown-800/20">
                        @if($acara->foto)
                            <img src="{{ asset( $acara->foto) }}" alt="{{ $acara->nama }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-dark-100 flex items-center justify-center">
                                <svg class="w-24 h-24 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="absolute -bottom-3 -right-3 w-24 h-24 border border-gold-500/10 rounded-xl -z-10"></div>
                </div>

                {{-- Details --}}
                <div>
                    <span class="px-3 py-1 bg-gold-500/20 border border-gold-500/30 text-gold-400 text-[10px] uppercase tracking-widest rounded-sm">
                        {{ $acara->kategori->nama }}
                    </span>

                    <h1 class="text-3xl md:text-4xl font-serif text-brown-50 mt-4 mb-4">{{ $acara->nama }}</h1>

                    <div class="flex items-baseline gap-2 mb-8">
                        <span class="text-3xl font-serif text-gold-500">{{ $acara->formatted_harga }}</span>
                        <span class="text-brown-500 text-sm">/ porsi</span>
                    </div>

                    <div class="border-t border-brown-800/30 pt-6 mb-8">
                        <h3 class="text-brown-200 font-semibold text-sm uppercase tracking-widest mb-4">Deskripsi</h3>
                        <p class="text-brown-400 leading-relaxed">{{ $acara->deskripsi }}</p>
                    </div>

                    <div class="border-t border-brown-800/30 pt-6 mb-8">
                        <h3 class="text-brown-200 font-semibold text-sm uppercase tracking-widest mb-4">Yang Termasuk</h3>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-brown-300 text-sm">
                                <svg class="w-4 h-4 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Dekorasi premium sesuai tema
                            </li>
                            <li class="flex items-center gap-3 text-brown-300 text-sm">
                                <svg class="w-4 h-4 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Katering berkualitas tinggi
                            </li>
                            <li class="flex items-center gap-3 text-brown-300 text-sm">
                                <svg class="w-4 h-4 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Dokumentasi foto & video
                            </li>
                            <li class="flex items-center gap-3 text-brown-300 text-sm">
                                <svg class="w-4 h-4 text-gold-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Koordinator acara profesional
                            </li>
                        </ul>
                    </div>

                    @auth
                        <a href="{{ route('home') }}#formulir-pemesanan" class="btn-gold inline-block">Booking Sekarang</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-gold inline-block">Login untuk Booking</a>
                    @endauth
                </div>
            </div>

            {{-- Related Acara --}}
            @if($related->count() > 0)
                <div class="mt-24">
                    <div class="section-subtitle">Paket Serupa</div>
                    <h2 class="text-3xl font-serif text-brown-50 mb-8">Mungkin Anda Juga Tertarik</h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @foreach($related as $item)
                            <div class="card-dark group">
                                <div class="relative aspect-[4/3] overflow-hidden">
                                    @if($item->foto)
                                        <img src="{{ asset( $item->foto) }}" alt="{{ $item->nama }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    @else
                                        <div class="w-full h-full bg-dark-200 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent opacity-60"></div>
                                    <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                        <a href="{{ route('acara.detail', $item) }}" class="btn-gold-sm block text-center">Detail</a>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="font-serif text-lg text-brown-100 mb-2">{{ $item->nama }}</h3>
                                    <p class="text-gold-500 font-semibold">{{ $item->formatted_harga }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
</x-frontend-layout>
