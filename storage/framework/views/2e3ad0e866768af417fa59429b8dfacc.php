
<div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">

    
    <div x-show="isBundlingFromUrl && idPaketBundling" x-transition class="mb-6 p-4 border border-[#c9a84c]/40 bg-gradient-to-r from-[#c9a84c]/10 to-transparent rounded-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-1 h-full bg-[#c9a84c]"></div>
        <div class="flex items-start gap-3 pl-2">
            <svg class="w-5 h-5 text-[#c9a84c] mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="text-[#c9a84c] text-xs font-serif font-bold uppercase tracking-wider mb-1">Paket Bundling Terpilih</p>
                <p class="text-[#f0e8d8] text-sm font-serif font-semibold" x-text="bundlingsData.find(b => b.id == idPaketBundling)?.nama"></p>
                <p class="text-[#c9a84c] text-sm font-bold mt-1" x-text="formatRupiah(hargaBundling)"></p>
                <p class="text-[#a89880] text-[11px] mt-1 leading-relaxed">Lengkapi data acara Anda di bawah ini, lalu langsung lanjut ke pembayaran.</p>
            </div>
        </div>
    </div>

    <h3 class="text-[#d4c8b0] font-serif text-lg mb-5">Jenis Acara</h3>

    
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-4">
        <?php 
            $staticEventTypes = [
                'Wedding' => '
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                ',
                'Lamaran' => '
                    <path d="M12 2c-4.97 0-9 4.03-9 9 0 4.17 2.84 7.67 6.69 8.69L12 22l2.31-2.31C18.16 18.67 21 15.17 21 11c0-4.97-4.03-9-9-9zm0 16c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zm-1-11h2v4h-2zm0 6h2v2h-2z"/>
                ',
                'Engagement' => '
                    <path d="M22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6zm-2 0l-8 5-8-5h16zm0 12H4V8l8 5 8-5v10z"/>
                ',
                'Birthday' => '
                    <path d="M12 6a2 2 0 110-4 2 2 0 010 4zm7 4H5c-1.1 0-2 .9-2 2v8c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-8c0-1.1-.9-2-2-2zM9 18H7v-4h2v4zm4 0h-2v-4h2v4zm4 0h-2v-4h2v4z"/>
                ',
                'Corporate' => '
                    <path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/>
                ',
                'Lainnya' => '
                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                ',
            ];
        ?>

        <?php $__currentLoopData = $staticEventTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" 
                 @click="setJenisAcara('<?php echo e($tipe); ?>'); if('<?php echo e($tipe); ?>' !== 'Lainnya') customJenisAcara = ''"
                 :class="jenisAcara === '<?php echo e($tipe); ?>' ? 'border-[#c9a84c] bg-[#c9a84c]/5' : 'border-[#4a4239] hover:border-[#6b5e4f]'"
                 class="flex flex-col items-center justify-center h-24 border transition-all duration-300 group focus:outline-none rounded-none">
                <div :class="jenisAcara === '<?php echo e($tipe); ?>' ? 'text-[#c9a84c]' : 'text-[#a89880] group-hover:text-[#d4c8b0]'">
                    <svg class="w-8 h-8 mb-2" viewBox="0 0 24 24" fill="currentColor">
                        <?php echo $icon; ?>

                    </svg>
                </div>
                <span class="text-[10px] uppercase tracking-[0.2em] font-serif font-bold"
                      :class="jenisAcara === '<?php echo e($tipe); ?>' ? 'text-[#c9a84c]' : 'text-[#a89880] group-hover:text-[#d4c8b0]'">
                    <?php echo e($tipe); ?>

                </span>
                
                <div x-show="jenisAcara === '<?php echo e($tipe); ?>'" class="w-1 h-1 bg-[#c9a84c] rounded-full mt-1"></div>
            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


    
    <div x-show="jenisAcara === 'Lainnya'" x-transition class="mb-6 mb-8 mt-2">
        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">TULIS JENIS ACARA</label>
        <input type="text" x-model="customJenisAcara" placeholder="Contoh: Perpisahan, Pameran, dll."
               class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none placeholder:text-[#a89880]/50">
    </div>
    
    <div class="grid grid-cols-2 gap-4 mb-4 mt-2">
        <div>
            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">NAMA LENGKAP</label>
            <input type="text" name="nama_lengkap" x-model="namaLengkap" placeholder="Masukan nama"
                   class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none placeholder:text-[#a89880]/50">
        </div>
        <div>
            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">NO. WHATSAPP</label>
            <input type="number" name="no_whatsapp" x-model="noWhatsapp" placeholder="Masukan No Whatsapp Valid"
                   class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none placeholder:text-[#a89880]/50">
        </div>
    </div>

    
    <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">TANGGAL ACARA</label>
            <input type="date" name="tanggal" x-model="tanggalAcara" required min="<?php echo e(date('Y-m-d')); ?>" @change="checkDateAvailability()"
                   class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none" style="color-scheme: dark;">
        </div>
        <div>
            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">JUMLAH TAMU</label>
            <input type="number" name="jumlah_tamu" x-model.number="jumlahTamu" placeholder="Max. 1500 Tamu" max="1500"
                   class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none placeholder:text-[#a89880]/50">
        </div>
    </div>

    
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">ACARA MULAI</label>
            <input type="time" name="acara_mulai" x-model="acaraMulai"
                   class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none" style="color-scheme: dark;">
        </div>
        <div>
            <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">ACARA SELESAI</label>
            <input type="time" name="acara_selesai" x-model="acaraSelesai"
                   class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-3 py-2 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none" style="color-scheme: dark;">
        </div>
    </div>

    
    <div class="mb-6 mb-8 mt-4" x-show="bundlingsData.length > 0">
        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5 flex justify-between items-center">
            PILIH PAKET BUNDLING (OPSIONAL)
            <span class="text-[9px] text-[#a89880] lowercase italic font-normal">*paket lengkap gedung & layanan</span>
        </label>
        
        <div class="relative">
            <button type="button" 
                  @click="toggleDropdown('bundling')"
                  :class="idPaketBundling !== '' ? 'border-[#c9a84c]' : 'border-[#5d5248] hover:border-[#6b5e4f]'"
                  class="w-full flex items-center justify-between px-3 py-2 border bg-[#2e261f] text-[#f5f0e8] text-[13px] font-medium outline-none transition-all duration-300 focus:outline-none">
                <span x-text="idPaketBundling !== '' ? bundlingsData.find(b => b.id == idPaketBundling).nama + ' - ' + formatRupiah(bundlingsData.find(b => b.id == idPaketBundling).harga) : 'PILIH PAKET BUNDLING (GEDUNG + LAYANAN)'"></span>
                <svg class="w-4 h-4 transition-transform duration-300 text-[#6b5e4f]"
                     :class="openDropdown === 'bundling' ? 'rotate-180 text-[#c9a84c]' : ''"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            
            <div x-show="openDropdown === 'bundling'"
                 x-transition
                 class="absolute z-[60] w-full border border-t-0 border-[#c9a84c]/50 bg-[#2a231d] shadow-2xl max-h-60 overflow-y-auto">
                <div @click="selectBundling(''); toggleDropdown('')"
                     :class="idPaketBundling === '' ? 'bg-[#c9a84c]/10 border-l-2 border-l-[#c9a84c]' : 'border-l-2 border-l-transparent hover:bg-[#2e261f]'"
                     class="flex items-center justify-between px-4 py-2.5 cursor-pointer transition-all duration-200">
                    <span class="text-xs text-[#d4c8b0]">Tanpa Paket (Custom Layanan)</span>
                </div>
                <template x-for="pkg in bundlingsData" :key="pkg.id">
                    <div @click="selectBundling(pkg.id); toggleDropdown('')"
                         :class="idPaketBundling == pkg.id ? 'bg-[#c9a84c]/10 border-l-2 border-l-[#c9a84c]' : 'border-l-2 border-l-transparent hover:bg-[#2e261f]'"
                         class="flex items-center justify-between px-4 py-2.5 cursor-pointer transition-all duration-200">
                        <div class="flex-1">
                            <div class="text-xs text-[#f5f0e8] font-bold" x-text="pkg.nama"></div>
                            <div class="text-[9px] text-[#a89880] mt-0.5" x-text="'Termasuk: ' + pkg.acaras.map(a => a.nama).join(', ')"></div>
                        </div>
                        <span class="text-xs font-semibold text-[#c9a84c] ml-4" x-text="formatRupiah(pkg.harga)"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    
    <div class="mt-10">
        <button type="button" 
                @click="if(!isLoggedIn) { 
                    Swal.fire({
                        title: 'Akses Terbatas',
                        text: 'Silakan login terlebih dahulu untuk melanjutkan pemesanan layanan.',
                        icon: 'info',
                        background: '#231d18',
                        color: '#f0e8d8',
                        showCancelButton: true,
                        confirmButtonColor: '#c9a84c',
                        cancelButtonColor: '#4a4239',
                        confirmButtonText: 'LOGIN SEKARANG',
                        cancelButtonText: 'NANTI SAJA',
                        customClass: {
                            popup: 'border border-[#c9a84c]/30 rounded-xl',
                            title: 'font-serif text-[#c9a84c] text-2xl',
                            confirmButton: 'font-bold tracking-[0.1em] rounded-sm',
                            cancelButton: 'font-bold tracking-[0.1em] rounded-sm'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?php echo e(route('login')); ?>';
                        }
                    });
                    return;
                }
                const validation = validateStep1();
                if(validation === true) { 
                    if(idPaketBundling) step = 3; else step = 2; 
                } else {
                    showWarning(validation);
                }"
                class="w-full bg-[#c9a84c] hover:bg-[#b8973d] text-[#1a140e] font-serif font-bold py-3 text-[13px] tracking-[0.2em] transition-all duration-300 uppercase shadow-lg">
            <span x-text="idPaketBundling ? 'LANJUT KE PEMBAYARAN' : 'LANJUT PILIH LAYANAN'"></span>
        </button>
    </div>
</div>
<?php /**PATH C:\laravel10\Melodi_event\resources\views/frontend/partials/order-step1.blade.php ENDPATH**/ ?>