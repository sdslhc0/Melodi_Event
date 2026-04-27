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
     <?php $__env->slot('title', null, []); ?> Kategori - MELODI <?php $__env->endSlot(); ?>

    <section class="pt-28 pb-24 relative overflow-hidden">
        
        <div class="ornament-circles">
            <div class="ornament-circle-inner"></div>
            <div class="ornament-circle-innermost"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="mb-16 relative">
                <div class="relative z-10">
                    <div class="section-subtitle">Pilihan <?php echo e($tipe === 'all' ? 'Semua Paket' : ($tipe ?? 'Kategori')); ?></div>
                    <h1 class="text-4xl md:text-5xl font-serif text-brown-50 mb-4">Hadirkan <?php echo e($tipe === 'all' ? 'Momen' : ($tipe ?? 'Dekorasi')); ?> Terindah untuk Acaramu</h1>
                    <p class="text-brown-400 max-w-2xl">Temukan paket acara yang sempurna untuk momen spesial Anda.</p>
                </div>
            </div>

            
            <?php if($tipe === 'all'): ?>
                <?php $allTipes = \App\Models\Kategori::select('tipe')->distinct()->pluck('tipe'); ?>
                <div class="flex flex-wrap gap-3 mb-6">
                    <a href="<?php echo e(route('kategori')); ?>"
                       class="px-6 py-2.5 border rounded-sm text-xs uppercase tracking-[0.2em] transition-all duration-300 <?php echo e(!request('t') ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400'); ?>">
                        Semua
                    </a>
                    <?php $__currentLoopData = $allTipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('kategori', ['t' => $t])); ?>"
                           class="px-6 py-2.5 border rounded-sm text-xs uppercase tracking-[0.2em] transition-all duration-300 <?php echo e(request('t') === $t ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400'); ?>">
                            <?php echo e($t); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if(request('t')): ?>
                    <div class="flex flex-wrap gap-2 mb-12 border-l-2 border-gold-500/30 pl-4 py-1">
                        <a href="<?php echo e(route('kategori', ['t' => request('t')])); ?>"
                           class="px-4 py-1.5 border rounded-sm text-[10px] uppercase tracking-[0.2em] transition-all duration-300 <?php echo e(!request('kategori') ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400'); ?>">
                            Semua <?php echo e(request('t')); ?>

                        </a>
                        <?php $__currentLoopData = \App\Models\Kategori::where('tipe', request('t'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('kategori', ['t' => request('t'), 'kategori' => $kat->id])); ?>"
                               class="px-4 py-1.5 border rounded-sm text-[10px] uppercase tracking-[0.2em] transition-all duration-300 <?php echo e(request('kategori') == $kat->id ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400'); ?>">
                                <?php echo e($kat->nama); ?>

                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="mb-12"></div>
                <?php endif; ?>
            <?php else: ?>
                
                <div class="flex flex-wrap gap-2 mb-12 pl-1 py-1">
                    <a href="<?php echo e(route('kategori', ['tipe' => $tipe])); ?>"
                       class="px-4 py-2 border rounded-sm text-[11px] uppercase tracking-[0.2em] transition-all duration-300 <?php echo e(!request('kategori') || request('kategori') == 'all' ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400'); ?>">
                        Semua <?php echo e($tipe); ?>

                    </a>
                    <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('kategori', ['tipe' => $tipe, 'kategori' => $kat->id])); ?>"
                           class="px-4 py-2 border rounded-sm text-[11px] uppercase tracking-[0.2em] transition-all duration-300 <?php echo e(request('kategori') == $kat->id ? 'bg-gold-500/10 border-gold-500 text-gold-400' : 'border-brown-700/40 text-brown-300 hover:border-gold-500/50 hover:text-gold-400'); ?>">
                            <?php echo e($kat->nama); ?>

                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            
            <?php if($acaras->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $acaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acara): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card-dark group flex flex-col h-full" x-data="{ showModal: false }">
                            <div class="relative aspect-[4/3] overflow-hidden">
                                <?php if($acara->foto): ?>
                                    <img src="<?php echo e(asset('storage/' . $acara->foto)); ?>" alt="<?php echo e($acara->nama); ?>"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <?php else: ?>
                                    <div class="w-full h-full bg-dark-200 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-dark via-dark/50 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 bg-gold-500/20 border border-gold-500/30 text-gold-400 text-[10px] uppercase tracking-widest rounded-sm">
                                        <?php echo e($acara->kategori->nama); ?>

                                    </span>
                                </div>
                                <div class="absolute bottom-4 left-4 right-4 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    <button type="button" @click="showModal = true" class="btn-gold-sm block text-center w-full focus:outline-none">Detail</button>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <h3 class="font-serif text-lg text-brown-100 mb-2"><?php echo e($acara->nama); ?></h3>
                                <p class="text-brown-400 text-sm mb-3 line-clamp-2 flex-1"><?php echo e($acara->deskripsi); ?></p>
                                <p class="text-gold-500 font-semibold"><?php echo e($acara->formatted_harga); ?></p>
                            </div>

                            
                            <template x-teleport="body">
                                <div x-show="showModal" 
                                     style="display: none;" 
                                     class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6 lg:p-10"
                                     @keydown.escape.window="showModal = false">
                                    
                                    
                                    <div x-show="showModal" 
                                         x-transition:enter="ease-out duration-300" 
                                         x-transition:enter-start="opacity-0" 
                                         x-transition:enter-end="opacity-100" 
                                         x-transition:leave="ease-in duration-200" 
                                         x-transition:leave-start="opacity-100" 
                                         x-transition:leave-end="opacity-0" 
                                         class="absolute inset-0 bg-black/60 backdrop-blur-md" 
                                         @click="showModal = false"></div>
                                    
                                    
                                    <div x-show="showModal" 
                                         x-transition:enter="ease-out duration-300 transform" 
                                         x-transition:enter-start="opacity-0 scale-95 translate-y-4" 
                                         x-transition:enter-end="opacity-100 scale-100 translate-y-0" 
                                         x-transition:leave="ease-in duration-200 transform" 
                                         x-transition:leave-start="opacity-100 scale-100 translate-y-0" 
                                         x-transition:leave-end="opacity-0 scale-95 translate-y-4" 
                                         class="relative w-full max-w-5xl bg-dark border border-brown-700/50 rounded-xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col md:flex-row overflow-hidden max-h-[90vh]">
                                        
                                        
                                        <button @click="showModal = false" class="absolute top-4 right-4 z-10 text-brown-300 hover:text-gold-400 bg-dark/70 p-2 rounded-full backdrop-blur-sm transition-all hover:bg-dark-100 focus:outline-none ring-1 ring-brown-700/30">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>

                                        
                                        <div class="w-full md:w-5/12 lg:w-1/2 aspect-square md:aspect-auto">
                                            <?php if($acara->foto): ?>
                                                <img src="<?php echo e(asset('storage/' . $acara->foto)); ?>" alt="<?php echo e($acara->nama); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-dark-200 flex items-center justify-center">
                                                    <svg class="w-20 h-20 text-brown-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        
                                        <div class="w-full md:w-7/12 lg:w-1/2 p-6 md:p-10 lg:p-12 flex flex-col bg-dark-100 overflow-y-auto">
                                            <span class="inline-block px-3 py-1 bg-gold-500/10 border border-gold-500/20 text-gold-400 text-[10px] uppercase tracking-[0.2em] rounded-sm mb-4 w-max">
                                                <?php echo e($acara->kategori->nama); ?>

                                            </span>
                                            
                                            <h2 class="text-3xl lg:text-4xl font-serif text-brown-100 mb-2 leading-tight"><?php echo e($acara->nama); ?></h2>
                                            <div class="text-gold-500 font-serif font-semibold text-xl lg:text-2xl mb-6"><?php echo e($acara->formatted_harga); ?></div>
                                            
                                            <div class="text-brown-300 text-sm md:text-base leading-relaxed mb-10 flex-1 prose prose-invert prose-p:text-brown-300 pr-2">
                                                <?php echo nl2br(e($acara->deskripsi)); ?>

                                            </div>
                                            
                                            <div class="pt-6 border-t border-brown-800/30 mt-auto">
                                                <a href="<?php echo e(route('home')); ?>#formulir-pemesanan" class="btn-gold w-full text-center py-4 text-sm hover:-translate-y-1 transform transition-transform">
                                                    Booking Paket Ini
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-20">
                    <svg class="w-16 h-16 text-brown-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-brown-300 font-serif text-xl mb-2">Belum Ada Acara</h3>
                    <p class="text-brown-500">Belum ada paket acara untuk kategori ini.</p>
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
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/frontend/kategori.blade.php ENDPATH**/ ?>