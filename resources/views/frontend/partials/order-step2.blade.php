{{-- STEP 2: LAYANAN --}}
<div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
    <h3 class="text-[#f0e8d8] font-serif text-[17px] mb-8">Pilih Layanan Tambahan <span class="text-[#a89880] text-[15px] font-sans font-normal ml-1">(opsional)</span></h3>

    {{-- Bundle Active Info --}}
    <div x-show="idPaketBundling" class="mb-8 p-4 border border-[#c9a84c]/30 bg-[#c9a84c]/5 rounded-sm">
        <p class="text-[#c9a84c] text-xs font-serif leading-relaxed">
            <span class="font-bold uppercase tracking-wider block mb-1">Paket Bundling Aktif</span>
            Anda telah memilih <span class="text-[#f0e8d8]" x-text="bundlingsData.find(b => b.id == idPaketBundling)?.nama"></span>. 
            Paket ini sudah mencakup layanan utama. Jika Anda ingin memilih layanan secara manual, silakan hapus pilihan paket bundling di langkah pertama.
        </p>
    </div>

    <div class="space-y-3" x-show="!idPaketBundling">


        <template x-for="layanan in layananData" :key="layanan.tipe">
            <div class="mb-3">
                {{-- Dropdown Toggle --}}
                <button type="button" 
                      @click="toggleDropdown(layanan.tipe)"
                      :class="selectedLayanan[layanan.tipe] ? 'border-[#c9a84c]' : 'border-[#4a4239] hover:border-[#6b5e4f]'"
                      class="w-full flex items-center justify-between px-5 py-4 border rounded-sm transition-all duration-300 focus:outline-none bg-transparent">
                    <span class="text-[13px] tracking-[0.05em] uppercase font-serif text-left"
                          :class="selectedLayanan[layanan.tipe] ? 'text-[#c9a84c]' : 'text-[#a89880]'"
                          x-text="selectedLayanan[layanan.tipe] ? selectedLayanan[layanan.tipe].length + ' LAYANAN ' + layanan.tipe.toUpperCase() + ' DIPILIH' : 'PILIH PAKET ' + layanan.tipe.toUpperCase()">
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-300 text-[#6b5e4f]"
                         :class="openDropdown === layanan.tipe ? 'rotate-180 text-[#c9a84c]' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                {{-- Dropdown Options --}}
                <div x-show="openDropdown === layanan.tipe"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="border border-t-0 border-[#4a4239] bg-[#2a231d]">
                    <template x-for="pkg in layanan.packages" :key="pkg.id">
                        <div :class="selectedLayanan[layanan.tipe]?.some(i => i.id === pkg.id) ? 'bg-[#c9a84c]/10 border-l-2 border-l-[#c9a84c]' : 'border-l-2 border-l-transparent hover:bg-[#2e261f]'"
                             class="px-5 py-3 cursor-pointer transition-all duration-200">
                            <div class="flex items-center justify-between" @click="selectLayanan(layanan.tipe, pkg)">
                                <div class="flex items-center gap-3">
                                    <div class="w-4 h-4 border border-[#4a4239] rounded-sm flex items-center justify-center transition-colors"
                                         :class="selectedLayanan[layanan.tipe]?.some(i => i.id === pkg.id) ? 'bg-[#c9a84c] border-[#c9a84c]' : ''">
                                        <svg x-show="selectedLayanan[layanan.tipe]?.some(i => i.id === pkg.id)" class="w-3 h-3 text-[#1a140e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                    <span class="text-sm text-[#d4c8b0]" x-text="pkg.nama"></span>
                                </div>
                                <span class="text-sm font-semibold text-[#c9a84c]" x-text="formatRupiah(pkg.harga)"></span>
                            </div>
                            
                            {{-- Quantity for Undangan & Catering --}}
                            <div x-show="selectedLayanan[layanan.tipe]?.some(i => i.id === pkg.id) && (layanan.tipe === 'Buku Undangan' || layanan.tipe === 'Catering')" 
                                 x-transition
                                 class="mt-3 ml-7 flex items-center gap-4 py-2 border-t border-[#4a4239]/30">
                                <span class="text-[11px] text-[#a89880] font-bold tracking-widest uppercase">JUMLAH ORDER:</span>
                                <div class="flex items-center">
                                    <input type="number" 
                                           :value="selectedLayanan[layanan.tipe]?.find(i => i.id === pkg.id)?.qty"
                                           @input.stop="updateLayananQty(layanan.tipe, pkg.id, $event.target.value)"
                                           style="background-color: #3d3024 !important; color: #ffffff !important; border: 1px solid rgba(201, 168, 76, 0.5) !important;"
                                           class="w-24 text-center text-sm px-3 py-2 focus:border-[#c9a84c] focus:ring-1 focus:ring-[#c9a84c]/30 rounded-none outline-none font-bold"
                                           min="0"
                                           placeholder="0">
                                    <span class="ml-3 text-[11px] text-[#a89880] font-sans font-bold" x-text="layanan.tipe === 'Catering' ? 'PAKS' : 'SET / PCS'"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </template>
        
        <template x-if="layananData.length === 0">
            <div class="py-10 text-center border border-dashed border-[#4a4239] rounded-sm">
                <p class="text-[#a89880] text-sm">Tidak ada layanan tambahan tersedia untuk saat ini.</p>
            </div>
        </template>
    </div>

    {{-- Navigation Buttons --}}
    <div class="flex gap-4 mt-8">
        <button type="button" @click="step = 1"
                class="flex-1 py-3 border border-[#4a4239] text-[#a89880] text-xs uppercase tracking-[0.1em] font-bold hover:border-[#c9a84c] hover:text-[#c9a84c] transition-all duration-300 rounded-none">
            KEMBALI
        </button>
        <button type="button" @click="step = 3"
                class="flex-[1.5] py-3 bg-[#c9a84c] text-[#1a140e] text-xs uppercase tracking-[0.1em] font-bold hover:bg-[#d4b065] transition-all duration-300 rounded-none">
            LANJUT PEMBAYARAN
        </button>
    </div>
</div>
