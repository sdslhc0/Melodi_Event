<?php if (isset($component)) { $__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30 = $attributes; } ?>
<?php $component = App\View\Components\BackendLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('backend-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\BackendLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> Booking <?php $__env->endSlot(); ?>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-serif text-brown-100">Manajemen Booking</h2>
            <p class="text-brown-500 text-sm">Kelola dan update status booking</p>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo e(route('backend.booking.index')); ?>"
               class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                      <?php echo e(!request('status') || request('status') == 'all' ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                Semua
            </a>
            <a href="<?php echo e(route('backend.booking.index', ['status' => 'pending'])); ?>"
               class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                      <?php echo e(request('status') == 'pending' ? 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                Pending
            </a>
            <a href="<?php echo e(route('backend.booking.index', ['status' => 'di booking'])); ?>"
               class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                      <?php echo e(request('status') == 'di booking' ? 'bg-blue-900/30 border-blue-700/30 text-blue-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                Di Booking
            </a>
            <a href="<?php echo e(route('backend.booking.index', ['status' => 'selesai'])); ?>"
               class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                      <?php echo e(request('status') == 'selesai' ? 'bg-green-900/30 border-green-700/30 text-green-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                Selesai
            </a>
            <a href="<?php echo e(route('backend.booking.index', ['status' => 'batal'])); ?>"
               class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                      <?php echo e(request('status') == 'batal' ? 'bg-red-900/30 border-red-700/30 text-red-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                Batal
            </a>
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
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-brown-400">#<?php echo e($booking->id); ?></td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-brown-200"><?php echo e($booking->nama_lengkap ?? $booking->user->nama); ?></div>
                                <div class="text-xs text-brown-500"><?php echo e($booking->no_whatsapp ?? $booking->user->email); ?></div>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->jenis_acara ?: '-'); ?></td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->tanggal->format('d M Y')); ?></td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->acara_mulai); ?> - <?php echo e($booking->acara_selesai); ?></td>
                            <td class="px-6 py-4 text-sm text-gold-500 font-semibold"><?php echo e($booking->formatted_subtotal); ?></td>
                            <td class="px-6 py-4">
                                <?php
                                    $status = $booking->detailBooking->status ?? 'pending';
                                    $colors = [
                                        'pending' => 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400',
                                        'di booking' => 'bg-blue-900/30 border-blue-700/30 text-blue-400',
                                        'selesai' => 'bg-green-900/30 border-green-700/30 text-green-400',
                                        'batal' => 'bg-red-900/30 border-red-700/30 text-red-400',
                                    ];
                                ?>
                                <span class="px-2 py-0.5 text-[10px] uppercase tracking-widest border rounded-sm <?php echo e($colors[$status]); ?>">
                                    <?php echo e($status); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('backend.booking.show', $booking)); ?>" class="btn-outline-sm">Detail</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-brown-500">Belum ada booking.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30)): ?>
<?php $attributes = $__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30; ?>
<?php unset($__attributesOriginala2edde5e1c82a5de5f92a34d70a8fe30); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30)): ?>
<?php $component = $__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30; ?>
<?php unset($__componentOriginala2edde5e1c82a5de5f92a34d70a8fe30); ?>
<?php endif; ?>
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/backend/booking/index.blade.php ENDPATH**/ ?>