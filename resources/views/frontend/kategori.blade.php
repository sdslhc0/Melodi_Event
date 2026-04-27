<x-frontend-layout>
    <x-slot:title>Kategori - MELODI</x-slot:title>

    <section class="pt-28 pb-24 relative overflow-hidden">
        {{-- Background Ornaments --}}
        <div class="ornament-circles">
            <div class="ornament-circle-inner"></div>
            <div class="ornament-circle-innermost"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Header --}}
            <div class="mb-16 relative">
                <div class="relative z-10">
                    <div class="section-subtitle">Pilihan {{ $tipe === 'all' ? 'Semua Paket' : ($tipe ?? 'Kategori') }}</div>
                    <h1 class="text-4xl md:text-5xl font-serif text-brown-50 mb-4">Hadirkan {{ $tipe === 'all' ? 'Momen' : ($tipe ?? 'Dekorasi') }} Terindah untuk Acaramu</h1>
                    <p class="text-brown-400 max-w-2xl">Temukan paket acara yang sempurna untuk momen spesial Anda.</p>
                </div>
            </div>

            {{-- Category Filter --}}
            @if($tipe === 'all')
                @php $allTipes = \App\Models\Kategori::select('tipe')->distinct()->pluck('tipe'); @endphp
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="{{ route('kategori') }}"
                       class="px-6 py-2.5 border rounded-sm text-xs uppercase tracking-[0.2em] transition-all duration-300 {{ !request('t') ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400' }}">
                        Semua
                    </a>
                    @foreach($allTipes as $t)
                        <a href="{{ route('kategori', ['t' => $t]) }}"
                           class="px-6 py-2.5 border rounded-sm text-xs uppercase tracking-[0.2em] transition-all duration-300 {{ request('t') === $t ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400' }}">
                            {{ $t }}
                        </a>
                    @endforeach
                </div>

                @if(request('t'))
                    <div class="flex flex-wrap gap-2 mb-12 border-l-2 border-gold-500/30 pl-4 py-1">
                        <a href="{{ route('kategori', ['t' => request('t')]) }}"
                           class="px-4 py-1.5 border rounded-sm text-[10px] uppercase tracking-[0.2em] transition-all duration-300 {{ !request('kategori') ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400' }}">
                            Semua {{ request('t') }}
                        </a>
                        @foreach(\App\Models\Kategori::where('tipe', request('t'))->get() as $kat)
                            <a href="{{ route('kategori', ['t' => request('t'), 'kategori' => $kat->id]) }}"
                               class="px-4 py-1.5 border rounded-sm text-[10px] uppercase tracking-[0.2em] transition-all duration-300 {{ request('kategori') == $kat->id ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400' }}">
                                {{ $kat->nama }}
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="mb-12"></div>
                @endif
            @else
                {{-- Sub Category Filter ONLY (Main categories row is hidden) --}}
                <div class="flex flex-wrap gap-2 mb-12 pl-1 py-1">
                    <a href="{{ route('kategori', ['tipe' => $tipe]) }}"
                       class="px-4 py-2 border rounded-sm text-[11px] uppercase tracking-[0.2em] transition-all duration-300 {{ !request('kategori') || request('kategori') == 'all' ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400' }}">
                        Semua {{ $tipe }}
                    </a>
                    @foreach($kategoris as $kat)
                        <a href="{{ route('kategori', ['tipe' => $tipe, 'kategori' => $kat->id]) }}"
                           class="px-4 py-2 border rounded-sm text-[11px] uppercase tracking-[0.2em] transition-all duration-300 {{ request('kategori') == $kat->id ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400' }}">
                            {{ $kat->nama }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Acara Grid --}}
            @if($acaras->count() > 0)
                <div x-data="{ showAllItems: false }">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($acaras as $acara)
                            <div class="card-dark group h-full flex-col {{ $loop->index < 5 ? 'flex' : '' }}" 
                                 x-data="{ showModal: false }"
                                 @if($loop->index >= 5 && $loop->index < 9)
                                     :class="!showAllItems ? 'hidden md:flex' : 'flex'"
                                 @elseif($loop->index >= 9)
                                     :class="!showAllItems ? 'hidden' : 'flex'"
                                 @endif>
                            <div class="relative aspect-[4/3] overflow-hidden">
                                @if($acara->foto)
                                    <img src="{{ asset( $acara->foto) }}" alt="{{ $acara->nama }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-dark-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-gold-500/20 border border-gold-500/30 text-gold-400 text-[10px] uppercase tracking-widest rounded-sm">
                                        {{ $acara->kategori->nama }}
                                    </span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    <button type="button" @click="showModal = true" class="btn-gold-sm block text-center w-full focus:outline-none">Detail</button>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="font-serif text-lg text-brown-100 mb-2">{{ $acara->nama }}</h3>
                                <p class="text-brown-400 text-sm mb-3 line-clamp-2 flex-1">{{ $acara->deskripsi }}</p>
                                <p class="text-gold-500 font-semibold">{{ $acara->formatted_harga }}</p>
                            </div>

                            {{-- Modal Pop Up Lebar --}}
                            <template x-teleport="body">
                                <div x-show="showModal" 
                                     style="display: none;" 
                                     class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 lg:p-10"
                                     @keydown.escape.window="showModal = false">
                                    
                                    {{-- Blurred Backdrop --}}
                                    <div x-show="showModal" 
                                         x-transition:enter="ease-out duration-300" 
                                         x-transition:enter-start="opacity-0" 
                                         x-transition:enter-end="opacity-100" 
                                         x-transition:leave="ease-in duration-200" 
                                         x-transition:leave-start="opacity-100" 
                                         x-transition:leave-end="opacity-0" 
                                         class="absolute inset-0 bg-black/60 backdrop-blur-md" 
                                         @click="showModal = false"></div>
                                    
                                    {{-- Modal Box (Lebar / Wide) --}}
                                    <div x-show="showModal" 
                                         x-transition:enter="ease-out duration-300 transform" 
                                         x-transition:enter-start="opacity-0 scale-95 translate-y-4" 
                                         x-transition:enter-end="opacity-100 scale-100 translate-y-0" 
                                         x-transition:leave="ease-in duration-200 transform" 
                                         x-transition:leave-start="opacity-100 scale-100 translate-y-0" 
                                         x-transition:leave-end="opacity-0 scale-95 translate-y-4" 
                                         class="relative w-full max-w-5xl bg-dark border border-brown-700/50 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col md:flex-row overflow-hidden max-h-[90vh]">
                                        
                                        {{-- Close Button --}}
                                        <button @click="showModal = false" class="absolute top-4 right-4 z-10 text-brown-300 hover:text-gold-400 bg-dark/70 p-2 rounded-full backdrop-blur-sm transition-all hover:bg-dark-100 focus:outline-none ring-1 ring-brown-700/30">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>

                                        {{-- Image Section (Lebih lebar proporsinya) --}}
                                        <div class="w-full md:w-5/12 lg:w-1/2 aspect-square md:aspect-auto">
                                            @if($acara->foto)
                                                <img src="{{ asset( $acara->foto) }}" alt="{{ $acara->nama }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-dark-200 flex items-center justify-center">
                                                    <svg class="w-20 h-20 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Content Section --}}
                                        <div class="w-full md:w-7/12 lg:w-1/2 p-6 md:p-10 lg:p-12 flex flex-col bg-dark-100 overflow-y-auto">
                                            <span class="inline-block px-3 py-1 bg-gold-500/10 border border-gold-500/20 text-gold-400 text-[10px] uppercase tracking-[0.2em] rounded-sm mb-4 w-max">
                                                {{ $acara->kategori->nama }}
                                            </span>
                                            
                                            <h2 class="text-3xl lg:text-4xl font-serif text-brown-100 mb-2 leading-tight">{{ $acara->nama }}</h2>
                                            <div class="text-gold-500 font-serif font-semibold text-xl lg:text-2xl mb-6">{{ $acara->formatted_harga }}</div>
                                            
                                            <div class="text-brown-300 text-sm md:text-base leading-relaxed mb-10 flex-1 prose prose-invert prose-p:text-brown-300 pr-2">
                                                {!! nl2br(e($acara->deskripsi)) !!}
                                            </div>
                                            
                                            <div class="pt-6 border-t border-brown-800/30 mt-auto">
                                                <a href="{{ route('home') }}#formulir-pemesanan" class="btn-gold w-full text-center py-4 text-sm hover:-translate-y-1 transform transition-transform">
                                                    Booking Paket Ini
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    @endforeach
                    </div>
                    
                    @if($acaras->count() > 5)
                        <div class="mt-12 flex flex-col items-center gap-4">
                            <button x-show="!showAllItems" @click="showAllItems = true" 
                                    class="px-8 py-3 border border-gold-500 text-gold-400 text-xs uppercase tracking-[0.2em] rounded-sm hover:bg-gold-500 hover:text-dark transition-all duration-300 font-medium w-full max-w-xs {{ $acaras->count() <= 9 ? 'md:hidden block' : 'block' }}">
                                Lihat Semua
                            </button>
                            
                            <button x-show="showAllItems" style="display: none;" @click="showAllItems = false; window.scrollTo({ top: $el.closest('.grid').offsetTop - 100, behavior: 'smooth' })" 
                                    class="px-8 py-3 border border-brown-700/50 text-brown-300 text-xs uppercase tracking-[0.2em] rounded-sm hover:border-gold-500 hover:text-gold-400 transition-all duration-300 font-medium w-full max-w-xs {{ $acaras->count() <= 9 ? 'md:hidden block' : 'block' }}">
                                Lihat Lebih Sedikit
                            </button>
                        </div>
                    @endif
                </div>
            @else
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-brown-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-brown-300 font-serif text-xl mb-2">Belum Ada Acara</h3>
                    <p class="text-brown-500">Belum ada paket acara untuk kategori ini.</p>
                </div>
            @endif
        </div>
    </section>
</x-frontend-layout>
