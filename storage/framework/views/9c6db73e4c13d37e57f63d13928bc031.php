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
     <?php $__env->slot('header', null, []); ?> Review & Rating <?php $__env->endSlot(); ?>

    
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-yellow-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-serif text-brown-50 mb-1"><?php echo e($averageRating ? number_format($averageRating, 1) : '-'); ?></p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Rata-rata Rating</p>
            
            <div class="flex gap-1 mt-2">
                <?php for($i = 1; $i <= 5; $i++): ?>
                    <svg class="w-4 h-4 <?php echo e($i <= round($averageRating ?? 0) ? 'text-yellow-400' : 'text-brown-700'); ?>" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                <?php endfor; ?>
            </div>
        </div>

        
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-serif text-brown-50 mb-1"><?php echo e($totalReviews); ?></p>
            <p class="text-brown-500 text-xs uppercase tracking-widest">Total Review</p>
        </div>

        
        <div class="stat-card">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm font-serif text-brown-200 mb-2">Distribusi Rating</p>
            <div class="space-y-1.5">
                <?php for($i = 5; $i >= 1; $i--): ?>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] text-brown-400 w-8"><?php echo e($i); ?> ★</span>
                        <div class="flex-1 bg-brown-800/30 rounded-full h-2 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500 <?php echo e($i >= 4 ? 'bg-yellow-400' : ($i >= 3 ? 'bg-yellow-600' : 'bg-red-500')); ?>"
                                 style="width: <?php echo e($totalReviews > 0 ? ($ratingCounts[$i] / $totalReviews) * 100 : 0); ?>%"></div>
                        </div>
                        <span class="text-[10px] text-brown-500 w-6 text-right"><?php echo e($ratingCounts[$i]); ?></span>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    
    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="px-6 py-4 border-b border-brown-800/30 flex items-center justify-between">
            <h2 class="font-serif text-lg text-brown-100">Semua Review</h2>
            <span class="text-brown-500 text-xs"><?php echo e($totalReviews); ?> ulasan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Komentar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    <?php $__empty_1 = true; $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($review->nama)); ?>&background=2e261f&color=c9a84c&bold=true&size=32" 
                                         alt="<?php echo e($review->nama); ?>" class="w-8 h-8 rounded-full">
                                    <div>
                                        <div class="text-sm text-brown-200 font-medium"><?php echo e($review->nama); ?></div>
                                        <div class="text-xs text-brown-500"><?php echo e($review->user->email ?? '-'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-0.5">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                        <svg class="w-4 h-4 <?php echo e($i <= $review->rating ? 'text-yellow-400' : 'text-brown-700'); ?>" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-xs text-brown-500 mt-1 block"><?php echo e($review->rating); ?>/5</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-brown-300 max-w-xs truncate" title="<?php echo e($review->komentar); ?>"><?php echo e($review->komentar); ?></p>
                            </td>
                            <td class="px-6 py-4 text-sm text-brown-400">
                                <?php echo e($review->created_at->format('d M Y')); ?>

                                <span class="block text-xs text-brown-600"><?php echo e($review->created_at->format('H:i')); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="<?php echo e(route('backend.review.destroy', $review)); ?>" 
                                      onsubmit="return confirm('Yakin hapus review ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-500 hover:text-red-400 text-xs uppercase tracking-widest transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-brown-500">
                                <svg class="w-12 h-12 mx-auto text-brown-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                Belum ada review.
                            </td>
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
<?php /**PATH C:\0704\2505\wedding-organizer\resources\views/backend/review/index.blade.php ENDPATH**/ ?>