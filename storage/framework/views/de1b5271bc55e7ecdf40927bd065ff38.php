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

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-xl font-serif text-brown-100">Manajemen Booking</h2>
            <p class="text-brown-500 text-sm">Kelola dan update status booking</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            
            <div class="flex flex-wrap gap-2">
                <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'all'])); ?>"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          <?php echo e(!request('status') || request('status') == 'all' ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                    Semua
                </a>
                <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'pending'])); ?>"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          <?php echo e(request('status') == 'pending' ? 'bg-yellow-900/30 border-yellow-700/30 text-yellow-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                    Pending
                </a>
                <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'di booking'])); ?>"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          <?php echo e(request('status') == 'di booking' ? 'bg-blue-900/30 border-blue-700/30 text-blue-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                    Di Booking
                </a>
                <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'selesai'])); ?>"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          <?php echo e(request('status') == 'selesai' ? 'bg-green-900/30 border-green-700/30 text-green-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                    Selesai
                </a>
                <a href="<?php echo e(request()->fullUrlWithQuery(['status' => 'batal'])); ?>"
                   class="px-4 py-2 border rounded-sm text-xs uppercase tracking-widest transition-all duration-300
                          <?php echo e(request('status') == 'batal' ? 'bg-red-900/30 border-red-700/30 text-red-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50'); ?>">
                    Batal
                </a>
            </div>

            <div class="w-px h-6 bg-brown-800/50 hidden sm:block"></div>

            
            <div x-data="{ open: false }" class="relative" @click.away="open = false">
                <button @click="open = !open" 
                        class="flex items-center gap-2 px-4 py-2 bg-dark-200 border <?php echo e(request('start_date') || request('end_date') ? 'border-gold-500/50 text-gold-400' : 'border-brown-700/50 text-brown-300'); ?> text-xs uppercase tracking-widest rounded-sm hover:border-gold-500/50 hover:text-gold-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <?php if(request('start_date') && request('end_date')): ?>
                        <?php echo e(\Carbon\Carbon::parse(request('start_date'))->format('d/m/y')); ?> - <?php echo e(\Carbon\Carbon::parse(request('end_date'))->format('d/m/y')); ?>

                    <?php elseif(request('start_date')): ?>
                        > <?php echo e(\Carbon\Carbon::parse(request('start_date'))->format('d/m/y')); ?>

                    <?php elseif(request('end_date')): ?>
                        < <?php echo e(\Carbon\Carbon::parse(request('end_date'))->format('d/m/y')); ?>

                    <?php else: ?>
                        Rentang Tanggal
                    <?php endif; ?>
                    <svg class="w-3 h-3 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="open" x-transition.opacity 
                     class="absolute right-0 mt-2 p-4 bg-dark-100 border border-brown-800/50 rounded-md shadow-xl z-20 w-72" style="display: none;">
                    <form action="<?php echo e(route('backend.booking.index')); ?>" method="GET" class="flex flex-col gap-3">
                        <?php if(request('status')): ?>
                            <input type="hidden" name="status" value="<?php echo e(request('status')); ?>">
                        <?php endif; ?>
                        <?php if(request('sort_date')): ?>
                            <input type="hidden" name="sort_date" value="<?php echo e(request('sort_date')); ?>">
                        <?php endif; ?>
                        
                        <div>
                            <label class="block text-xs text-brown-500 mb-1">Mulai Dari</label>
                            <input type="date" name="start_date" value="<?php echo e(request('start_date')); ?>" class="w-full bg-dark-200 border border-brown-700/50 rounded-sm text-brown-300 text-sm focus:ring-1 focus:ring-gold-500 focus:border-gold-500 p-2 [color-scheme:dark]">
                        </div>
                        
                        <div>
                            <label class="block text-xs text-brown-500 mb-1">Sampai Dengan</label>
                            <input type="date" name="end_date" value="<?php echo e(request('end_date')); ?>" class="w-full bg-dark-200 border border-brown-700/50 rounded-sm text-brown-300 text-sm focus:ring-1 focus:ring-gold-500 focus:border-gold-500 p-2 [color-scheme:dark]">
                        </div>
                        
                        <div class="flex items-center justify-between mt-2">
                            <?php if(request('start_date') || request('end_date')): ?>
                                <a href="<?php echo e(request()->fullUrlWithQuery(['start_date' => null, 'end_date' => null])); ?>" class="text-xs text-red-400 hover:text-red-300 transition-colors">
                                    Reset Filter
                                </a>
                            <?php else: ?>
                                <div></div>
                            <?php endif; ?>
                            <button type="submit" class="px-4 py-2 bg-gold-500/10 border border-gold-500/50 text-gold-400 text-xs uppercase tracking-widest rounded-sm hover:bg-gold-500 hover:text-dark-100 transition-colors">
                                Terapkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="w-px h-6 bg-brown-800/50 hidden sm:block"></div>

            
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" @click.away="open = false" 
                        class="flex items-center gap-2 px-4 py-2 bg-dark-200 border border-brown-700/50 text-brown-300 text-xs uppercase tracking-widest rounded-sm hover:border-gold-500/50 hover:text-gold-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    <?php if(request('sort_date') == 'asc'): ?>
                        Tanggal Terdekat
                    <?php elseif(request('sort_date') == 'desc'): ?>
                        Tanggal Terjauh
                    <?php else: ?>
                        Urutkan
                    <?php endif; ?>
                    <svg class="w-3 h-3 ml-1 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="open" x-transition.opacity 
                     class="absolute right-0 mt-2 w-48 bg-dark-100 border border-brown-800/50 rounded-md shadow-xl z-20 py-1" style="display: none;">
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort_date' => null])); ?>" 
                       class="block px-4 py-2 text-xs text-brown-300 hover:bg-dark-200 hover:text-gold-400 transition-colors <?php echo e(!request('sort_date') ? 'text-gold-500 bg-dark-200/50' : ''); ?>">
                        Order Masuk (Default)
                    </a>
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort_date' => 'asc'])); ?>" 
                       class="block px-4 py-2 text-xs text-brown-300 hover:bg-dark-200 hover:text-gold-400 transition-colors <?php echo e(request('sort_date') == 'asc' ? 'text-gold-500 bg-dark-200/50' : ''); ?>">
                        Tanggal Acara Terdekat
                    </a>
                    <a href="<?php echo e(request()->fullUrlWithQuery(['sort_date' => 'desc'])); ?>" 
                       class="block px-4 py-2 text-xs text-brown-300 hover:bg-dark-200 hover:text-gold-400 transition-colors <?php echo e(request('sort_date') == 'desc' ? 'text-gold-500 bg-dark-200/50' : ''); ?>">
                        Tanggal Acara Terjauh
                    </a>
                </div>
            </div>
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
                        <?php
                            $isDp = ($booking->metode_pembayaran === 'dp_30');
                            $rowClass = $isDp ? 'bg-gradient-to-r from-yellow-900/10 to-transparent hover:from-yellow-900/20 hover:to-dark-200/20' : 'hover:bg-dark-200/50';
                        ?>
                        <tr class="transition-colors <?php echo e($rowClass); ?>">
                            <td class="px-6 py-4 text-sm <?php echo e($isDp ? 'text-yellow-500 font-semibold' : 'text-brown-400'); ?>">
                                #<?php echo e($booking->id); ?>

                                <?php if($isDp): ?>
                                    <span class="inline-block w-1.5 h-1.5 rounded-full bg-yellow-500 ml-1 shadow-[0_0_5px_rgba(234,179,8,0.8)]" title="Pembayaran DP"></span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-brown-200"><?php echo e($booking->nama_lengkap ?? $booking->user->nama); ?></div>
                                <div class="text-xs text-brown-500"><?php echo e($booking->no_whatsapp ?? $booking->user->email); ?></div>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->jenis_acara ?: '-'); ?></td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->tanggal->format('d M Y')); ?></td>
                            <td class="px-6 py-4 text-sm text-brown-300"><?php echo e($booking->acara_mulai); ?> - <?php echo e($booking->acara_selesai); ?></td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gold-500 font-semibold"><?php echo e($booking->formatted_subtotal); ?></div>
                                <?php if($isDp): ?>
                                    <div class="inline-block mt-1 px-1.5 py-0.5 bg-yellow-900/30 border border-yellow-700/30 text-yellow-500 text-[8px] uppercase tracking-widest rounded-sm">
                                        Status DP
                                    </div>
                                <?php endif; ?>
                            </td>
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
<?php /**PATH C:\0704\2505\wedding-organizer\resources\views/backend/booking/index.blade.php ENDPATH**/ ?>