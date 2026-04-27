
<div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
    <h3 class="text-[#d4c8b0] font-serif text-lg mb-5 uppercase tracking-wider text-sm font-semibold">Metode Pembayaran</h3>

    
    <div class="grid grid-cols-2 gap-3 mb-6">
        
        <button type="button" @click="metodePembayaran = 'full_payment'"
             :class="metodePembayaran === 'full_payment' ? 'border-[#c9a84c] bg-[#c9a84c]/5' : 'border-[#3a3028] hover:border-[#6b5e4f]'"
             class="p-4 border rounded transition-all duration-300 relative text-left focus:outline-none">
            <span class="absolute top-2 right-2 text-[8px] uppercase tracking-wider px-2 py-0.5 rounded-sm"
                  :class="metodePembayaran === 'full_payment' ? 'bg-[#c9a84c] text-[#1a140e]' : 'bg-[#3a3028] text-[#6b5e4f]'">DISARANKAN</span>
            <h4 class="text-[#d4c8b0] font-bold text-sm mt-3 mb-1">Full Payment</h4>
            <p class="text-[#6b5e4f] text-[11px] leading-relaxed">Bayar 100% sekarang, dapatkan diskon khusus 5% dan prioritas jadwal.</p>
        </button>

        
        <button type="button" @click="metodePembayaran = 'dp_30'"
             :class="metodePembayaran === 'dp_30' ? 'border-[#c9a84c] bg-[#c9a84c]/5' : 'border-[#3a3028] hover:border-[#6b5e4f]'"
             class="p-4 border rounded transition-all duration-300 relative text-left focus:outline-none">
            <span class="absolute top-2 right-2 text-[8px] uppercase tracking-wider px-2 py-0.5 rounded-sm"
                  :class="metodePembayaran === 'dp_30' ? 'bg-[#c9a84c] text-[#1a140e]' : 'bg-[#3a3028] text-[#6b5e4f]'">FLEKSIBEL</span>
            <h4 class="text-[#d4c8b0] font-bold text-sm mt-3 mb-1">DP 30%</h4>
            <p class="text-[#6b5e4f] text-[11px] leading-relaxed">Amankan tanggal dengan Down Payment 30%. Sisa dibayar H-7 acara.</p>
        </button>
    </div>

    
    <div x-data="{ openBank: false }" class="relative mb-6">
        <label class="block text-[#f0e8d8] text-[9px] uppercase tracking-[0.1em] font-bold mb-2">PILIH BANK / E-WALLET</label>
        
        <button type="button" @click="openBank = !openBank"
                class="w-full flex items-center justify-between px-4 py-3 border rounded-sm transition-all duration-300 focus:outline-none"
                :class="openBank || bank ? 'border-[#c9a84c] bg-[#c9a84c]/5' : 'border-[#4a4239] hover:border-[#6b5e4f] bg-transparent'">
            <span class="text-sm font-semibold" :class="bank ? 'text-[#c9a84c]' : 'text-[#a89880]'" x-text="bank ? bank : 'Pilih...'"></span>
            <svg class="w-4 h-4 text-[#a89880] transition-transform duration-300" :class="openBank ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>

        <div x-show="openBank" @click.away="openBank = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             class="absolute z-30 w-full mt-2 bg-[#231d18] border border-[#c9a84c]/30 shadow-[0_10px_40px_rgba(0,0,0,0.8)] rounded-md overflow-hidden py-1 max-h-56 overflow-y-auto" style="display: none;">
             
            <div class="px-3 py-2 text-[10px] text-[#a89880] uppercase tracking-wider font-semibold bg-[#2e261f]">Bank Transfer</div>
            <template x-for="item in ['BCA - Transfer', 'BNI - Transfer', 'BRI - Transfer', 'Mandiri - Transfer']" :key="item">
                <button type="button" @click="bank = item; openBank = false"
                        class="w-full text-left px-4 py-2.5 text-sm text-[#f0e8d8] hover:bg-[#c9a84c]/15 hover:text-[#c9a84c] transition-colors border-b border-[#4a4239]/20"
                        :class="bank === item ? 'bg-[#c9a84c]/10 text-[#c9a84c]' : ''"
                        x-text="item">
                </button>
            </template>
            
            <div class="px-3 py-2 text-[10px] text-[#a89880] uppercase tracking-wider font-semibold bg-[#2e261f]">E-Wallet</div>
            <template x-for="item in ['GoPay', 'OVO', 'DANA', 'ShopeePay']" :key="item">
                <button type="button" @click="bank = item; openBank = false"
                        class="w-full text-left px-4 py-2.5 text-sm text-[#f0e8d8] hover:bg-[#c9a84c]/15 hover:text-[#c9a84c] transition-colors border-b border-[#4a4239]/20 last:border-0"
                        :class="bank === item ? 'bg-[#c9a84c]/10 text-[#c9a84c]' : ''"
                        x-text="item">
                </button>
            </template>
        </div>
    </div>

    
    <div class="mb-8">
        <label class="block text-[#f0e8d8] text-[9px] uppercase tracking-[0.1em] font-bold mb-2">CATATAN TAMBAHAN</label>
        <textarea name="catatan" x-model="catatan" rows="4" placeholder="Tema warna, permintaan khusus atau info tambahan.."
                  class="w-full bg-[#362e25] border border-[#4a4239] text-[#f0e8d8] px-3 py-2.5 text-sm outline-none focus:border-[#c9a84c] transition-colors resize-none placeholder-[#a89880] rounded-none"></textarea>
    </div>

    
    <div class="flex gap-4">
        <button type="button" @click="step = idPaketBundling ? 1 : 2"
                class="flex-1 py-3 border border-[#4a4239] text-[#a89880] text-xs uppercase tracking-[0.1em] font-bold hover:border-[#c9a84c] hover:text-[#c9a84c] transition-all duration-300 rounded-none">
            KEMBALI
        </button>
        <button type="button" @click="doSubmit()"
                :class="canStep3() ? 'bg-[#c9a84c] hover:bg-[#d4b065] text-[#1a140e]' : 'bg-[#c9a84c] text-[#1a140e] opacity-80'"
                class="flex-[1.5] py-3 text-xs uppercase tracking-[0.1em] font-bold transition-all duration-300 rounded-none">
            LANJUT KONFIRMASI
        </button>
    </div>
</div>
<?php /**PATH C:\laravel10\Melodi_event\resources\views/frontend/partials/order-step3.blade.php ENDPATH**/ ?>