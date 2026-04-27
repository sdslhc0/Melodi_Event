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
     <?php $__env->slot('header', null, []); ?> Edit Pemesanan #<?php echo e($booking->id); ?> <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto pb-12">
        <div class="flex items-center gap-4 mb-8">
            <a href="<?php echo e(route('backend.booking.show', $booking)); ?>" class="inline-flex items-center gap-2 text-brown-400 hover:text-gold-400 transition-colors text-xs font-semibold tracking-[0.15em] uppercase px-4 py-2 border border-brown-800/40 rounded-full bg-dark-100/50 hover:bg-dark-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <h2 class="text-xl font-serif text-brown-100">Edit Data Pesanan</h2>
        </div>

        <div class="bg-dark-100 border border-brown-800/40 rounded-2xl p-8 shadow-xl shadow-black/10">
            <form action="<?php echo e(route('backend.booking.update', $booking)); ?>" method="POST" class="space-y-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-brown-300 mb-2">Nama Pemesan</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?php echo e(old('nama_lengkap', $booking->nama_lengkap)); ?>" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required>
                        <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- No WhatsApp -->
                    <div>
                        <label for="no_whatsapp" class="block text-sm font-medium text-brown-300 mb-2">No. WhatsApp</label>
                        <input type="text" name="no_whatsapp" id="no_whatsapp" value="<?php echo e(old('no_whatsapp', $booking->no_whatsapp)); ?>" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required>
                        <?php $__errorArgs = ['no_whatsapp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Jenis Acara -->
                    <div>
                        <label for="jenis_acara" class="block text-sm font-medium text-brown-300 mb-2">Jenis Acara</label>
                        <select name="jenis_acara" id="jenis_acara" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required>
                            <option value="Wedding" <?php echo e(old('jenis_acara', $booking->jenis_acara) == 'Wedding' ? 'selected' : ''); ?>>Wedding</option>
                            <option value="Engagement" <?php echo e(old('jenis_acara', $booking->jenis_acara) == 'Engagement' ? 'selected' : ''); ?>>Engagement</option>
                            <option value="Prewedding" <?php echo e(old('jenis_acara', $booking->jenis_acara) == 'Prewedding' ? 'selected' : ''); ?>>Prewedding</option>
                            <option value="Lainnya" <?php echo e(old('jenis_acara', $booking->jenis_acara) == 'Lainnya' ? 'selected' : ''); ?>>Lainnya</option>
                        </select>
                        <?php $__errorArgs = ['jenis_acara'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Tanggal Acara -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-brown-300 mb-2">Tanggal Acara</label>
                        <input type="date" name="tanggal" id="tanggal" value="<?php echo e(old('tanggal', $booking->tanggal->format('Y-m-d'))); ?>" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" style="color-scheme: dark;" required>
                        <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Waktu Mulai -->
                    <div>
                        <label for="acara_mulai" class="block text-sm font-medium text-brown-300 mb-2">Waktu Mulai</label>
                        <input type="time" name="acara_mulai" id="acara_mulai" value="<?php echo e(old('acara_mulai', $booking->acara_mulai)); ?>" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" style="color-scheme: dark;" required>
                        <?php $__errorArgs = ['acara_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Waktu Selesai -->
                    <div>
                        <label for="acara_selesai" class="block text-sm font-medium text-brown-300 mb-2">Waktu Selesai</label>
                        <input type="time" name="acara_selesai" id="acara_selesai" value="<?php echo e(old('acara_selesai', $booking->acara_selesai)); ?>" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" style="color-scheme: dark;" required>
                        <?php $__errorArgs = ['acara_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Jumlah Tamu -->
                    <div class="md:col-span-2">
                        <label for="jumlah_tamu" class="block text-sm font-medium text-brown-300 mb-2">Jumlah Tamu (Target)</label>
                        <input type="number" name="jumlah_tamu" id="jumlah_tamu" value="<?php echo e(old('jumlah_tamu', $booking->jumlah_tamu)); ?>" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4" required min="1">
                        <?php $__errorArgs = ['jumlah_tamu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <!-- Catatan -->
                    <div class="md:col-span-2">
                        <label for="catatan" class="block text-sm font-medium text-brown-300 mb-2">Catatan Tambahan</label>
                        <textarea name="catatan" id="catatan" rows="4" class="w-full bg-dark-200 border border-brown-700/60 text-brown-100 rounded-xl focus:ring-gold-500 focus:border-gold-500 py-3 px-4"><?php echo e(old('catatan', $booking->catatan)); ?></textarea>
                        <?php $__errorArgs = ['catatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-4">
                    <a href="<?php echo e(route('backend.booking.show', $booking)); ?>" class="px-6 py-3 border border-brown-700 text-brown-300 rounded-xl hover:bg-dark-200 transition-colors">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-gold-500 hover:bg-gold-400 text-dark-100 font-bold tracking-widest uppercase text-xs rounded-xl transition-all shadow-[0_5px_20px_rgba(201,168,76,0.3)]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
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
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/backend/booking/edit.blade.php ENDPATH**/ ?>