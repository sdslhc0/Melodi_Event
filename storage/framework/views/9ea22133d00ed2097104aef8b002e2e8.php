<?php if (isset($component)) { $__componentOriginal292c42cda3271405dc664835e31595e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal292c42cda3271405dc664835e31595e3 = $attributes; } ?>
<?php $component = App\View\Components\FrontendLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('frontend-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\FrontendLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Riwayat Booking - MELODI <?php $__env->endSlot(); ?>

    <section class="pt-28 pb-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="section-subtitle">Riwayat</div>
            <h1 class="text-3xl md:text-4xl font-serif text-brown-50 mb-2">Riwayat Booking Anda</h1>
            <p class="text-brown-400 mb-10">Lihat dan pantau status booking Anda.</p>

            <?php if($bookings->count() > 0): ?>
                <div class="space-y-6">
                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden hover:border-gold-500/20 transition-all duration-300">
                            <div class="flex flex-col md:flex-row">
                                
                                <div class="md:w-48 md:flex-shrink-0">
                                    <div class="w-full h-48 md:h-full bg-dark-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gold-500/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                </div>

                                
                                <div class="flex-1 p-6">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                        <div class="w-full">
                                            <div class="flex items-center gap-3 mb-2">
                                                <h3 class="font-serif text-lg text-brown-100"><?php echo e($booking->jenis_acara ?? 'Acara'); ?></h3>
                                                <?php
                                                    $status = $booking->detailBooking->status ?? 'pending';
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400',
                                                        'di booking' => 'bg-blue-900/30 border-blue-700/30 text-blue-400',
                                                        'selesai' => 'bg-green-900/30 border-green-700/30 text-green-400',
                                                    ];
                                                ?>
                                                <span class="px-2 py-0.5 text-[10px] uppercase tracking-widest border rounded-sm <?php echo e($statusColors[$status] ?? $statusColors['pending']); ?>">
                                                    <?php echo e($status); ?>

                                                </span>
                                            </div>
                                            <p class="text-brown-500 text-xs uppercase tracking-widest mb-3"><?php echo e($booking->nama_lengkap); ?> • <?php echo e($booking->no_whatsapp); ?></p>

                                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Tanggal</span>
                                                    <span class="text-brown-200"><?php echo e($booking->tanggal->format('d M Y')); ?></span>
                                                </div>
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Waktu</span>
                                                    <span class="text-brown-200"><?php echo e($booking->acara_mulai ?? '-'); ?> - <?php echo e($booking->acara_selesai ?? '-'); ?></span>
                                                </div>
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Jumlah Tamu</span>
                                                    <span class="text-brown-200"><?php echo e($booking->jumlah_tamu ?? $booking->jumlah_porsi ?? '-'); ?> Paks</span>
                                                </div>
                                                <div>
                                                    <span class="text-brown-500 text-xs block">Total</span>
                                                    <span class="text-gold-500 font-semibold"><?php echo e($booking->formatted_subtotal); ?></span>
                                                </div>
                                            </div>

                                            
                                            <?php if($booking->layanans && $booking->layanans->count() > 0): ?>
                                                <div class="mt-4 pt-3 border-t border-brown-800/20">
                                                    <span class="text-brown-500 text-[10px] uppercase tracking-widest block mb-2">Layanan Tambahan</span>
                                                    <div class="flex flex-wrap gap-2">
                                                        <?php $__currentLoopData = $booking->layanans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <span class="inline-block px-2 py-1 bg-dark-200 border border-brown-800/30 rounded text-[11px] text-brown-300">
                                                                <?php echo e($lay->acara->nama ?? 'Layanan'); ?> 
                                                                <?php if($lay->qty > 1 || optional(optional($lay->acara)->kategori)->nama == 'Catering' || optional(optional($lay->acara)->kategori)->nama == 'Buku Undangan'): ?>
                                                                    <span class="text-brown-500">(<?php echo e($lay->qty); ?>)</span>
                                                                <?php endif; ?>
                                                                — <span class="text-gold-500">Rp <?php echo e(number_format($lay->harga, 0, ',', '.')); ?></span>
                                                            </span>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>


                                            <?php if($booking->paketBundling): ?>
                                                <div class="mt-3 pt-3 border-t border-brown-800/20">
                                                    <span class="text-brown-500 text-[10px] uppercase tracking-widest block mb-1">Bundling Exclusive</span>
                                                    <span class="inline-block px-2 py-1 bg-dark-200 border border-brown-800/30 rounded text-[11px] text-brown-300">
                                                        <?php echo e($booking->paketBundling->nama); ?> — <span class="text-gold-500">Rp <?php echo e(number_format($booking->paketBundling->harga, 0, ',', '.')); ?></span>
                                                    </span>
                                                </div>
                                            <?php endif; ?>

                                            <?php if($booking->catatan): ?>
                                                <p class="text-brown-400 text-sm mt-3 italic">"<?php echo e($booking->catatan); ?>"</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-20 bg-dark-100 border border-brown-800/20 rounded-xl">
                    <svg class="w-16 h-16 text-brown-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <h3 class="text-brown-300 font-serif text-xl mb-2">Belum Ada Booking</h3>
                    <p class="text-brown-500 mb-6">Anda belum melakukan booking apapun.</p>
                    <a href="<?php echo e(route('home')); ?>#formulir-pemesanan" class="btn-gold">Buat Pesanan Sekarang</a>
                </div>
            <?php endif; ?>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal292c42cda3271405dc664835e31595e3)): ?>
<?php $attributes = $__attributesOriginal292c42cda3271405dc664835e31595e3; ?>
<?php unset($__attributesOriginal292c42cda3271405dc664835e31595e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal292c42cda3271405dc664835e31595e3)): ?>
<?php $component = $__componentOriginal292c42cda3271405dc664835e31595e3; ?>
<?php unset($__componentOriginal292c42cda3271405dc664835e31595e3); ?>
<?php endif; ?>
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/frontend/riwayat.blade.php ENDPATH**/ ?>