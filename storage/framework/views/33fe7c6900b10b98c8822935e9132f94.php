
<div x-show="step === 4" x-cloak class="relative z-[100]" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    
    
    <div x-show="step === 4" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

    
    <div class="fixed inset-0 z-10 flex items-center justify-center p-4 md:p-6">
            
        
        <div x-show="step === 4" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
             class="bg-dark-100 border-2 border-gold-500/30 rounded-2xl shadow-2xl w-full flex flex-col justify-between overflow-hidden"
             style="max-width: 480px; max-height: 90vh;">
            
            
            <div class="px-6 py-5 border-b border-brown-700/40 bg-dark-200 text-center shrink-0">
                <h3 class="text-2xl font-serif text-gold-400 mb-1 tracking-wide" id="modal-title">Konfirmasi Final</h3>
                <p class="text-brown-300 text-xs font-sans">Pastikan detail pesanan Anda sudah Sesuai.</p>
            </div>

            
            <div class="px-4 py-5 md:px-6 overflow-y-auto" style="scrollbar-width: thin;">
                
                
                <div class="bg-dark border border-brown-700/50 rounded-xl p-4 md:p-5 mb-5 shadow-inner">
                    <h4 class="text-gold-500 text-[10px] font-bold uppercase tracking-widest mb-3 border-b border-brown-700/30 pb-2">Informasi Pemesan</h4>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-brown-400">Nama Lengkap</span>
                            <span class="text-brown-100 font-medium" x-text="namaLengkap || '-'"></span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-brown-400">WhatsApp</span>
                            <span class="text-brown-100 font-mono tracking-wide" x-text="noWhatsapp || '-'"></span>
                        </div>
                        <div class="flex justify-between items-start text-xs pt-1 border-t border-brown-700/20 mt-1">
                            <span class="text-brown-400">Format & Tamu</span>
                            <div class="text-right">
                                <span class="text-brown-100 font-medium" x-text="(jenisAcara === 'Lainnya' ? customJenisAcara : jenisAcara) || '-'"></span>
                                <span class="text-gold-500/80 ml-1 font-mono text-[11px]" x-text="jumlahTamu ? '— ' + jumlahTamu + ' paks' : ''"></span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-brown-400">Jadwal Pelaksanaan</span>
                            <span class="text-brown-100 font-medium" x-text="(tanggalAcara ? tanggalAcara.split('-').reverse().join('/') : '-') + ' • ' + acaraMulai + '-' + acaraSelesai"></span>
                        </div>
                    </div>
                </div>

                
                <div class="bg-dark border border-brown-700/50 rounded-xl p-4 md:p-5 shadow-inner">
                    <h4 class="text-gold-500 text-[10px] font-bold uppercase tracking-widest mb-3 border-b border-brown-700/30 pb-2">Rincian Layanan</h4>
                    
                    <div class="space-y-4">
                        
                        <template x-if="idPaketBundling">
                            <div class="flex items-start justify-between gap-4">
                                <div class="text-brown-100 flex-1">
                                    <div class="text-[12px] font-medium leading-tight mb-1" x-text="bundlingsData.find(b => b.id == idPaketBundling)?.nama || 'Paket Bundling'"></div>
                                    <div class="text-[9px] text-gold-500 font-bold uppercase tracking-widest">Bundling (Venue + Layanan)</div>
                                </div>
                                <span class="text-brown-200 font-mono text-[12px] tracking-wide" x-text="formatRupiah(hargaBundling)"></span>
                            </div>
                        </template>



                        
                        <template x-for="tipe in Object.keys(selectedLayanan)" :key="'modv-'+tipe">
                            <template x-for="item in selectedLayanan[tipe]" :key="'modv-item-'+item.id">
                                <div class="flex items-start justify-between gap-4 mb-3">
                                    <div class="text-brown-100 flex-1">
                                        <div class="text-[12px] font-medium leading-tight mb-1" x-text="item.nama"></div>
                                        <div class="text-[9px] text-gold-500 font-bold uppercase tracking-widest" x-text="tipe + ((tipe === 'Buku Undangan' || tipe === 'Catering') ? ' (' + item.qty + (tipe === 'Catering' ? ' Paks)' : ' Pcs)') : '')"></div>
                                    </div>
                                    <span class="text-brown-200 font-mono text-[12px] tracking-wide" x-text="formatRupiah(item.harga * (Number(item.qty) || 1))"></span>
                                </div>
                            </template>
                        </template>
                        
                        <template x-if="Object.keys(selectedLayanan).length === 0">
                            <div class="text-brown-500 text-[11px] italic text-center py-2">Hanya paket dasar. Tidak ada tambahan layanan.</div>
                        </template>
                    </div>
                </div>

            </div>

            
            <div class="bg-dark-200 border-t border-brown-700/50 shrink-0">
                
                
                <div class="flex justify-between items-center px-5 py-4 lg:px-6 lg:py-5 border-b border-brown-700/30">
                    <div>
                        <span class="block text-brown-400 text-[9px] uppercase tracking-widest mb-1">Metode Pembayaran</span>
                        <span class="text-gold-500 font-bold text-[10px] tracking-wider uppercase" x-text="metodePembayaran ? (metodePembayaran.replace('_', ' ') + ' - ' + bank) : '-'"></span>
                    </div>
                    <div class="text-right">
                        <span class="block text-brown-400 text-[9px] uppercase tracking-widest mb-0.5">Total Keseluruhan</span>
                        <span class="text-2xl font-serif text-gold-400 font-bold tracking-wide" x-text="formatRupiah(grandTotal) || '-'"></span>
                    </div>
                </div>

                
                <div class="grid grid-cols-3 gap-3 p-4 bg-dark-100">
                    <button type="button" @click="step = 3" 
                            class="col-span-1 flex items-center justify-center py-3.5 text-[11px] font-bold tracking-widest uppercase rounded-lg border border-brown-700 hover:bg-brown-800/30 transition-all font-sans" style="color: #cbbfa6 !important;">
                        KEMBALI
                    </button>

                    <button type="button" @click="$refs.orderForm.submit()" 
                            class="col-span-2 flex items-center justify-center gap-2 py-3.5 text-[11px] font-bold tracking-widest bg-gold-500 rounded-lg uppercase hover:bg-gold-400 transition-all shadow-lg font-sans" style="color: #0a0806 !important;">
                        KIRIM PESANAN 
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/frontend/partials/order-step4.blade.php ENDPATH**/ ?>