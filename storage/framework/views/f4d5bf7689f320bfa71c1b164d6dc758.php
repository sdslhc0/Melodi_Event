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
     <?php $__env->slot('title', null, []); ?> Profil Admin - MELODI <?php $__env->endSlot(); ?>
     <?php $__env->slot('header', null, []); ?> Profil Admin <?php $__env->endSlot(); ?>

    <div class="max-w-5xl mx-auto space-y-8">
        
        <div class="bg-dark-100 border border-brown-800/30 rounded-xl p-6 md:p-8 flex flex-col md:flex-row items-center gap-6 shadow-sm">
            <div class="w-24 h-24 rounded-full border-2 border-gold-500/30 overflow-hidden bg-dark-200 flex items-center justify-center shrink-0 shadow-lg">
                <?php if($user->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $user->foto)); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                    <span class="text-3xl text-gold-400 font-serif font-bold"><?php echo e(strtoupper(substr($user->nama, 0, 1))); ?></span>
                <?php endif; ?>
            </div>
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-serif text-brown-100 mb-1"><?php echo e($user->nama); ?></h2>
                <p class="text-sm text-brown-400">Admin Utama MELODI</p>
                <div class="mt-3 flex items-center justify-center md:justify-start gap-2 text-xs text-gold-500/80 uppercase tracking-widest font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Akses Penuh
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-7 bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden shadow-sm">
                <div class="p-6 border-b border-brown-800/30 bg-dark-100/50">
                    <h3 class="text-lg font-serif text-brown-100">Informasi Pribadi</h3>
                    <p class="text-sm text-brown-400 mt-1">Perbarui nama, email, nomor telepon, dan foto profil Anda.</p>
                </div>
                
                <form method="post" action="<?php echo e(route('backend.profile.update')); ?>" enctype="multipart/form-data" class="p-6 space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('patch'); ?>

                    
                    <div class="flex flex-col items-center border-b border-brown-800/30 pb-6 mb-6">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full border border-gold-500/40 overflow-hidden bg-dark-200 flex items-center justify-center shadow-inner">
                                <?php if($user->foto): ?>
                                    <img id="avatar-preview" src="<?php echo e(asset('storage/' . $user->foto)); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div id="avatar-placeholder" class="text-gold-500/50">
                                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                    <img id="avatar-preview" class="w-full h-full object-cover hidden">
                                <?php endif; ?>
                            </div>
                            <label for="foto-input" class="absolute bottom-0 right-0 bg-gold-500 text-dark-100 p-1.5 rounded-full cursor-pointer hover:bg-gold-400 transition-colors shadow-lg border border-dark-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 011.664.89l.812 1.22A2 2 0 0010.07 10H14a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </label>
                            <input type="file" id="foto-input" name="foto" class="hidden" accept="image/*" @change="previewImage">
                        </div>
                        <p class="text-xs text-brown-400 uppercase tracking-widest mt-3 font-semibold">Ubah Foto</p>
                        <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-brown-300 mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="<?php echo e(old('nama', $user->nama)); ?>" required 
                                   class="w-full bg-dark-200 border border-brown-700/50 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
                            <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-brown-300 mb-2">Email</label>
                            <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required 
                                   class="w-full bg-dark-200 border border-brown-700/50 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-brown-300 mb-2">No. Telepon / WhatsApp</label>
                            <input type="text" name="telepon" value="<?php echo e(old('telepon', $user->telepon)); ?>"
                                   class="w-full bg-dark-200 border border-brown-700/50 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
                            <?php $__errorArgs = ['telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end">
                        <button type="submit" class="bg-gold-500 hover:bg-gold-400 text-dark-100 px-6 py-2.5 rounded-lg text-sm font-semibold uppercase tracking-wider transition-colors shadow-md">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="lg:col-span-5 bg-dark-100 border border-brown-800/30 rounded-xl overflow-hidden shadow-sm h-fit">
                <div class="p-6 border-b border-brown-800/30 bg-dark-100/50">
                    <h3 class="text-lg font-serif text-brown-100">Ubah Password</h3>
                    <p class="text-sm text-brown-400 mt-1">Ganti kata sandi secara berkala untuk menjaga keamanan akun admin Anda.</p>
                </div>

                <form method="post" action="<?php echo e(route('password.update')); ?>" class="p-6 space-y-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brown-300 mb-2">Password Saat Ini</label>
                        <input type="password" name="current_password" required 
                               class="w-full bg-dark-200 border border-brown-700/50 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
                        <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brown-300 mb-2">Password Baru</label>
                        <input type="password" name="password" required 
                               class="w-full bg-dark-200 border border-brown-700/50 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
                        <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-brown-300 mb-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" required 
                               class="w-full bg-dark-200 border border-brown-700/50 rounded-lg px-4 py-2.5 text-brown-100 focus:border-gold-500 focus:ring-1 focus:ring-gold-500 outline-none transition-all">
                        <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-xs text-red-500 mt-1 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="pt-4 flex items-center justify-between">
                        <?php if(session('status') === 'password-updated'): ?>
                            <p x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition class="text-xs text-green-400 font-medium">
                                Berhasil disimpan.
                            </p>
                        <?php else: ?>
                            <div></div>
                        <?php endif; ?>
                        
                        <button type="submit" class="border border-gold-500 text-gold-400 hover:bg-gold-500 hover:text-dark-100 px-6 py-2.5 rounded-lg text-sm font-semibold uppercase tracking-wider transition-colors">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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
<?php /**PATH C:\0704\2505\wedding-organizer\resources\views/backend/profile.blade.php ENDPATH**/ ?>