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
     <?php $__env->slot('header', null, []); ?> Kategori <?php $__env->endSlot(); ?>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-serif text-brown-100">Manajemen Kategori</h2>
            <p class="text-brown-500 text-sm">Kelola kategori acara</p>
        </div>
        <a href="<?php echo e(route('backend.kategori.create')); ?>" class="btn-gold-sm">+ Tambah Kategori</a>
    </div>

    <div class="bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-brown-800/20">
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Nama Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Jumlah Acara</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-brown-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brown-800/20">
                    <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-dark-200/50 transition-colors">
                            <td class="px-6 py-4 text-sm text-brown-400"><?php echo e($index + 1); ?></td>
                            <td class="px-6 py-4 text-sm text-brown-200 font-medium"><?php echo e($kategori->nama); ?></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 bg-gold-500/10 text-gold-400 text-xs rounded-sm">
                                    <?php echo e($kategori->acaras_count); ?> acara
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('backend.kategori.edit', $kategori)); ?>" class="btn-outline-sm">Edit</a>
                                    <form method="POST" action="<?php echo e(route('backend.kategori.destroy', $kategori)); ?>"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-brown-500">Belum ada kategori.</td>
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
<?php /**PATH C:\0704\2505\wedding-organizer\resources\views/backend/kategori/index.blade.php ENDPATH**/ ?>