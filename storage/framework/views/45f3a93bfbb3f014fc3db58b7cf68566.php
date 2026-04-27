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
     <?php $__env->slot('title', null, []); ?> MELODI - Rayakan Momen Paling Berharga Hidupmu <?php $__env->endSlot(); ?>

    
    <section class="relative min-h-screen flex items-center overflow-hidden">
        
        <div class="ornament-circles">
            <div class="ornament-circle-inner"></div>
            <div class="ornament-circle-innermost"></div>
        </div>

        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-12 pt-16 md:pt-16 relative z-10 -mt-16 md:mt-0">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 md:gap-6 mb-3 md:mb-6" style="animation: fadeInUp 1s ease-out">
                    <span class="w-12 md:w-24 h-px bg-[#4a4239]"></span>
                    <span class="text-brown-200 font-serif text-[10px] md:text-sm uppercase tracking-[0.1em] md:tracking-[0.15em]">Venue & Event Specialist</span>
                </div>

                <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-[5.5rem] font-serif text-brown-50 leading-[1.05] md:leading-[1.05] mb-5 md:mb-10"
                    style="animation: fadeInUp 1s ease-out 0.1s both">
                    Rayakan Momen<br>
                    Paling Berharga<br>
                    Hidupmu
                </h1>

                <div class="flex flex-col sm:flex-row gap-3 md:gap-5" style="animation: fadeInUp 1s ease-out 0.3s both">
                    <a href="#formulir-pemesanan" class="inline-flex items-center justify-center w-full sm:w-auto text-center bg-[#e4c278] hover:bg-[#d4b065] text-[#1a1715] px-8 md:px-12 py-4 font-serif text-xs uppercase tracking-[0.15em] font-bold transition-colors">Mulai Booking</a>
                    <a href="<?php echo e(route('kategori')); ?>" class="inline-flex items-center justify-center w-full sm:w-auto text-center border border-[#4a4239] hover:border-[#e4c278] text-brown-200 hover:text-[#e4c278] bg-[#1f1a16]/50 px-8 md:px-12 py-4 font-serif text-xs uppercase tracking-[0.15em] font-bold transition-colors">Lihat Semua Layanan</a>
                </div>
            </div>
        </div>

        
    </section>

    
    <div class="max-w-4xl mx-auto flex items-center justify-center w-full" style="opacity: 0.8; padding: 1rem;">
        <div class="flex-1" style="height: 1px; background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.5));"></div>
        <div style="margin: 0 1rem; width: 6px; height: 6px; background-color: #c9a84c; transform: rotate(45deg);"></div>
        <div class="flex-1" style="height: 1px; background: linear-gradient(to left, transparent, rgba(201, 168, 76, 0.5));"></div>
    </div>

    
    <section id="paket-bundling" class="py-16 bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <div class="text-center mb-16" style="animation: fadeInUp 0.8s ease-out">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <span class="w-12 h-[1px] bg-[#4a4239]"></span>
                    <span class="text-[#a89880] font-serif text-[11px] uppercase tracking-[0.2em] font-normal">EXCLUSIVE PACKAGES</span>
                    <span class="w-12 h-[1px] bg-[#4a4239]"></span>
                </div>
                <h2 class="text-4xl md:text-5xl font-serif text-[#f5f0e8] leading-tight mb-4">Paket Bundling</h2>
                <p class="text-[#a89880] max-w-2xl mx-auto text-sm leading-relaxed">
                    Pilih paket pernikahan impian Anda yang sudah mencakup venue dan layanan esensial untuk momen tak terlupakan.
                </p>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $paketBundlings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bundling): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group relative bg-[#231d18] border border-[#4a4239]/60 overflow-hidden transition-all duration-500 hover:border-[#c9a84c]/50 hover:shadow-[0_8px_40_rgba(201,168,76,0.08)]"
                     style="animation: fadeInUp 0.8s ease-out <?php echo e(($index * 0.15)); ?>s both">

                    
                    <div class="relative h-56 overflow-hidden">
                        <?php if($bundling->gambar): ?>
                            <img src="<?php echo e(asset('storage/' . $bundling->gambar)); ?>" alt="<?php echo e($bundling->nama); ?>"
                                 loading="lazy"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-br from-[#2e261f] to-[#1a1715] flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-[#4a4239] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                    <span class="text-[#4a4239] text-xs uppercase tracking-widest">Bundling</span>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#231d18] via-transparent to-transparent opacity-60"></div>

                        
                        <div class="absolute top-4 right-4 bg-[#1a1715]/90 backdrop-blur-sm border border-[#c9a84c]/30 px-3 py-1.5">
                            <span class="text-[#c9a84c] font-serif text-sm font-bold"><?php echo e($bundling->formatted_harga); ?></span>
                        </div>
                    </div>

                    
                    <div class="p-6">
                        <h3 class="font-serif text-xl text-[#f5f0e8] mb-2 group-hover:text-[#c9a84c] transition-colors duration-300"><?php echo e($bundling->nama); ?></h3>
                        
                        <?php if($bundling->acaras->count() > 0): ?>
                        <div class="mb-3">
                            <ul class="space-y-1">
                                <?php $__currentLoopData = $bundling->acaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acara): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-center gap-2 text-[#a89880] text-[11px] uppercase tracking-wider">
                                    <svg class="w-3 h-3 text-[#c9a84c]" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <?php echo e($acara->nama); ?>

                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <?php if($bundling->deskripsi): ?>
                            <p class="text-[#a89880] text-[13px] leading-relaxed line-clamp-2 italic mb-1 opacity-80">"<?php echo e($bundling->deskripsi); ?>"</p>
                        <?php endif; ?>

                        
                        <div class="mt-5 pt-5 border-t border-[#4a4239]/40 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-[#6b5e4f]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                                <span class="text-[10px] uppercase tracking-widest font-bold">Package</span>
                            </div>
                            <a href="<?php echo e(url('/?paket_bundling=' . $bundling->id . '#formulir-pemesanan')); ?>" 
                               onclick="confirmBooking(event, this.href, '<?php echo e(addslashes($bundling->nama)); ?>')" 
                               class="group relative inline-flex items-center justify-center gap-2 px-5 py-2 bg-[#c9a84c] hover:bg-[#e4c278] text-[#1a140e] text-[10px] uppercase tracking-widest font-bold transition-all duration-300 overflow-hidden rounded-sm shadow-md hover:shadow-lg">
                                <span class="relative z-10 flex items-center gap-1.5">
                                    Booking
                                    <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-16">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full border-2 border-[#4a4239]/30 flex items-center justify-center">
                        <svg class="w-10 h-10 text-[#4a4239]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="text-[#a89880] font-serif text-lg mb-2">Belum Ada Paket Bundling</h3>
                    <p class="text-[#6b5e4f] text-sm">Paket bundling akan segera tersedia.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    
    <div class="max-w-4xl mx-auto flex items-center justify-center w-full" style="opacity: 0.8; padding: 1rem;">
        <div class="flex-1" style="height: 1px; background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.5));"></div>
        <div style="margin: 0 1rem; width: 6px; height: 6px; background-color: #c9a84c; transform: rotate(45deg);"></div>
        <div class="flex-1" style="height: 1px; background: linear-gradient(to left, transparent, rgba(201, 168, 76, 0.5));"></div>
    </div>

    
    <section id="about" class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="section-subtitle">Tentang Kami</div>
                    <h2 class="text-4xl md:text-5xl font-serif text-brown-50 mb-6">Mengapa Memilih MELODI?</h2>
                    <p class="text-brown-400 leading-relaxed mb-8">
                        Kami adalah tim profesional yang berdedikasi untuk menghadirkan pengalaman acara yang tak terlupakan.
                        Dengan pengalaman bertahun-tahun dan perhatian pada setiap detail, kami memastikan momen spesial Anda
                        menjadi sempurna.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-dark-100 rounded-xl border border-brown-800/20">
                            <div class="text-3xl font-serif text-gold-500 mb-2">500+</div>
                            <div class="text-xs uppercase tracking-widest text-brown-400">Acara Sukses</div>
                        </div>
                        <div class="text-center p-6 bg-dark-100 rounded-xl border border-brown-800/20">
                            <div class="text-3xl font-serif text-gold-500 mb-2">50+</div>
                            <div class="text-xs uppercase tracking-widest text-brown-400">Venue Partner</div>
                        </div>
                        <div class="text-center p-6 bg-dark-100 rounded-xl border border-brown-800/20">
                            <div class="text-3xl font-serif text-gold-500 mb-2">100%</div>
                            <div class="text-xs uppercase tracking-widest text-brown-400">Kepuasan</div>
                        </div>
                        <div class="text-center p-6 bg-dark-100 rounded-xl border border-brown-800/20">
                            <div class="text-3xl font-serif text-gold-500 mb-2">8+</div>
                            <div class="text-xs uppercase tracking-widest text-brown-400">Tahun Pengalaman</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-[4/5] bg-dark-100 rounded-2xl border border-brown-800/20 overflow-hidden flex items-center justify-center">
                        <div class="text-center p-8">
                            <div class="w-24 h-24 mx-auto mb-6 rounded-full border-2 border-gold-500/30 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-gold-500 font-serif text-2xl mb-2">Crafted with Love</h3>
                            <p class="text-brown-400 text-sm">Setiap detail dirancang dengan penuh cinta dan dedikasi</p>
                        </div>
                    </div>
                    
                    <div class="absolute -top-4 -right-4 w-32 h-32 border border-gold-500/10 rounded-2xl -z-10"></div>
                    <div class="absolute -bottom-4 -left-4 w-32 h-32 border border-gold-500/10 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    
    <div class="max-w-4xl mx-auto flex items-center justify-center w-full" style="opacity: 0.8; padding: 0 1rem 1rem 1rem;">
        <div class="flex-1" style="height: 1px; background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.5));"></div>
        <div style="margin: 0 1rem; width: 6px; height: 6px; background-color: #c9a84c; transform: rotate(45deg);"></div>
        <div class="flex-1" style="height: 1px; background: linear-gradient(to left, transparent, rgba(201, 168, 76, 0.5));"></div>
    </div>

    
    <section id="contact" class="py-16 bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <div class="text-center mb-16">
                <h2 class="contact-section-title">Contact Us</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                
                <div>
                    
                    <div class="grid grid-cols-2 gap-5 mb-8">
                        
                        <div class="contact-info-card bg-dark-100">
                            <div class="contact-icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                                    <path d="M11.999 2C6.477 2 2 6.477 2 12c0 1.89.525 3.66 1.438 5.168L2 22l4.918-1.417A9.955 9.955 0 0012 22c5.523 0 10-4.477 10-10S17.522 2 12 2zm0 18a7.945 7.945 0 01-4.074-1.125l-.292-.174-3.025.872.853-3.11-.19-.312A7.956 7.956 0 014 12c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z"/>
                                </svg>
                            </div>
                            <p class="contact-card-label">WhatsApp</p>
                            <p class="contact-card-value">+62897654321</p>
                        </div>

                        
                        <div class="contact-info-card bg-dark-100">
                            <div class="contact-icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79a15.053 15.053 0 006.59 6.59l2.2-2.2a1 1 0 011.01-.24c1.12.37 2.33.57 3.57.57a1 1 0 011 1V20a1 1 0 01-1 1C10.61 21 3 13.39 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57.12.32.04.7-.24 1.01l-2.21 2.21z"/>
                                </svg>
                            </div>
                            <p class="contact-card-label">Phone</p>
                            <p class="contact-card-value">+62897654321</p>
                        </div>

                        
                        <div class="contact-info-card bg-dark-100">
                            <div class="contact-icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <p class="contact-card-label">Email</p>
                            <p class="contact-card-value">Melodi@gmail.com</p>
                        </div>

                        
                        <div class="contact-info-card bg-dark-100">
                            <div class="contact-icon-wrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="contact-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17 11H7V9h10v2zm2-7H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V6h14v14zM7 13h6v2H7v-2z"/>
                                </svg>
                            </div>
                            <p class="contact-card-label">Alamat</p>
                            <p class="contact-card-value">Bekasi Utara</p>
                        </div>
                    </div>

                    
                    
                    <div class="contact-map-wrap">
                        <iframe
                            id="contact-map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966!2d106.8171264!3d-6.2226432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698949017569b5%3A0x97dde5e9dd2cfbe5!2sMelodi%20Wedding%2C%20Sanggar%2C%20%26%20Salon!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                            width="100%"
                            height="100%"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                
                <div class="contact-form-wrap bg-dark-100">
                    <h3 class="contact-form-title">Mari Wujudkan Acaramu</h3>
                    <p class="contact-form-subtitle">Hubungi kami untuk konsultasi dekorasi terbaik</p>

                    <form action="<?php echo e(route('contact.send')); ?>" method="POST" class="space-y-5 mt-8">
                        <?php echo csrf_field(); ?>
                        <div>
                            <label class="contact-label" for="contact_name">Name</label>
                            <input id="contact_name" type="text" name="name" placeholder="" class="contact-input" required>
                        </div>
                        <div>
                            <label class="contact-label" for="contact_email">Email</label>
                            <input id="contact_email" type="email" name="email" placeholder="" class="contact-input" required>
                        </div>
                        <div>
                            <label class="contact-label" for="contact_subject">Subject</label>
                            <input id="contact_subject" type="text" name="subject" placeholder="" class="contact-input" required>
                        </div>
                        <div>
                            <label class="contact-label" for="contact_message">Message</label>
                            <textarea id="contact_message" name="message" rows="5" placeholder="" class="contact-input contact-textarea" required></textarea>
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="contact-submit-btn">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    
    <div class="max-w-4xl mx-auto flex items-center justify-center w-full" style="opacity: 0.8; padding: 1rem;">
        <div class="flex-1" style="height: 1px; background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.5));"></div>
        <div style="margin: 0 1rem; width: 6px; height: 6px; background-color: #c9a84c; transform: rotate(45deg);"></div>
        <div class="flex-1" style="height: 1px; background: linear-gradient(to left, transparent, rgba(201, 168, 76, 0.5));"></div>
    </div>

    
    <?php echo $__env->make('frontend.partials.order-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <div class="max-w-4xl mx-auto flex items-center justify-center w-full" style="opacity: 0.8; padding: 1rem;">
        <div class="flex-1" style="height: 1px; background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.5));"></div>
        <div style="margin: 0 1rem; width: 6px; height: 6px; background-color: #c9a84c; transform: rotate(45deg);"></div>
        <div class="flex-1" style="height: 1px; background: linear-gradient(to left, transparent, rgba(201, 168, 76, 0.5));"></div>
    </div>

    
    <section id="testimonial" class="py-16 overflow-hidden bg-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            
            <div class="mb-14">
                <div class="flex items-center gap-4 mb-4">
                    <span class="w-12 h-[1px] bg-[#4a4239]"></span>
                    <span class="text-[#a89880] font-serif text-[11px] uppercase tracking-[0.2em] font-normal">TESTIMONIAL</span>
                </div>
                <h2 class="text-4xl md:text-5xl font-serif text-[#f5f0e8] leading-tight">
                    Cerita Bahagia<br>Klien Kami
                </h2>
            </div>

            
            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scroll-bar gap-6 pb-8" style="scrollbar-width: none; -ms-overflow-style: none;">
                <style>
                    .hide-scroll-bar::-webkit-scrollbar { display: none; }
                </style>

                <?php
                    // Fallback static testimonials if no reviews in DB
                    $staticTestimonials = [
                        [
                            'name' => 'Lee Haechan',
                            'text' => 'Pelayanannya luar biasa! Dari dekorasi sampai dokumentasi semuanya sangat rapi dan sesuai dengan yang kami impikan. Timnya juga ramah dan profesional. Terima kasih sudah membuat hari pernikahan kami jadi sempurna!',
                            'rating' => 5,
                            'image' => 'https://ui-avatars.com/api/?name=Lee+Haechan&background=2e261f&color=c9a84c&bold=true'
                        ],
                        [
                            'name' => 'Sarah & Budi',
                            'text' => 'Sangat puas dengan servis dari Melodi! Mereka sangat detail dan sabar menghadapi revisi dari kami. Kateringnya juara, banyak tamu yang memuji rasanya. Seluruh proses terasa sangat menenangkan. Sangat direkomendasikan!',
                            'rating' => 5,
                            'image' => 'https://ui-avatars.com/api/?name=Sarah+Budi&background=2e261f&color=c9a84c&bold=true'
                        ],
                        [
                            'name' => 'Dinda Kirana',
                            'text' => 'Venue yang disediakan sangat elegan dan sesuai budget kami. Acara berjalan mulus tanpa hambatan berarti berkat koordinasi tim di hari H yang sangat sigap. Terima kasih banyak tim Melodi atas bantuannya!',
                            'rating' => 5,
                            'image' => 'https://ui-avatars.com/api/?name=Dinda+Kirana&background=2e261f&color=c9a84c&bold=true'
                        ],
                        [
                            'name' => 'Reza & Gita',
                            'text' => 'Respons cepat dan solutif. Dekorasi pelaminannya megah banget melebihi ekspektasi kami, fotografernya pintar mengarahkan gaya sehingga kami tidak canggung. Sukses selalu untuk Melodi Wedding!',
                            'rating' => 4,
                            'image' => 'https://ui-avatars.com/api/?name=Reza+Gita&background=2e261f&color=c9a84c&bold=true'
                        ]
                    ];

                    $displayReviews = isset($reviews) && $reviews->count() > 0 ? $reviews : collect();
                ?>

                
                <?php $__currentLoopData = $displayReviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="w-80 lg:w-96 flex-none snap-center shrink-0 border border-[#4a4239]/60 bg-[#231d18] p-6 lg:p-8 transition-colors hover:border-[#c9a84c]/50">
                    
                    <div class="flex gap-1 mb-5">
                        <?php for($i=1; $i<=5; $i++): ?>
                        <svg class="w-4 h-4 <?php echo e($i <= $review->rating ? 'text-[#c9a84c]' : 'text-[#4a4239]'); ?>" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <?php endfor; ?>
                    </div>
                    
                    
                    <div class="h-32 overflow-hidden mb-6">
                        <p class="text-[#a89880] text-[13px] leading-relaxed font-serif italic text-left">
                            "<?php echo e($review->komentar); ?>"
                        </p>
                    </div>
                    
                    
                    <div class="flex items-center gap-3 mt-auto border-t border-[#4a4239]/40 pt-4">
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($review->nama)); ?>&background=2e261f&color=c9a84c&bold=true" alt="<?php echo e($review->nama); ?>" class="w-10 h-10 rounded-full border border-[#4a4239]">
                        <div>
                            <span class="text-[#d4c8b0] font-serif text-[13px] font-medium block"><?php echo e($review->nama); ?></span>
                            <span class="text-[#6b5e4f] text-[10px]"><?php echo e($review->created_at->diffForHumans()); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $staticTestimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="w-80 lg:w-96 flex-none snap-center shrink-0 border border-[#4a4239]/60 bg-[#231d18] p-6 lg:p-8 transition-colors hover:border-[#c9a84c]/50">
                    
                    <div class="flex gap-1 mb-5">
                        <?php for($i=1; $i<=5; $i++): ?>
                        <svg class="w-4 h-4 <?php echo e($i <= $testi['rating'] ? 'text-[#c9a84c]' : 'text-[#4a4239]'); ?>" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                        <?php endfor; ?>
                    </div>
                    
                    
                    <div class="h-32 overflow-hidden mb-6">
                        <p class="text-[#a89880] text-[13px] leading-relaxed font-serif italic text-left">
                            "<?php echo e($testi['text']); ?>"
                        </p>
                    </div>
                    
                    
                    <div class="flex items-center gap-3 mt-auto border-t border-[#4a4239]/40 pt-4">
                        <img src="<?php echo e($testi['image']); ?>" alt="<?php echo e($testi['name']); ?>" class="w-10 h-10 rounded-full border border-[#4a4239]">
                        <span class="text-[#d4c8b0] font-serif text-[13px] font-medium"><?php echo e($testi['name']); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="mt-12 text-center" x-data="{ showReviewModal: false }">
                <?php if(auth()->guard()->check()): ?>
                <button @click="showReviewModal = true"
                        class="group relative inline-flex items-center gap-3 border border-[#c9a84c] text-[#c9a84c] px-10 py-4 text-[12px] uppercase tracking-[0.2em] font-bold font-serif hover:bg-[#c9a84c] hover:text-[#1a140e] transition-all duration-300 overflow-hidden">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    BERIKAN FEEDBACK
                    <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/10 to-transparent group-hover:translate-x-full transition-transform duration-700"></div>
                </button>
                <?php else: ?>
                <a href="<?php echo e(route('login')); ?>"
                   class="group relative inline-flex items-center gap-3 border border-[#c9a84c] text-[#c9a84c] px-10 py-4 text-[12px] uppercase tracking-[0.2em] font-bold font-serif hover:bg-[#c9a84c] hover:text-[#1a140e] transition-all duration-300 overflow-hidden">
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    LOGIN UNTUK REVIEW
                </a>
                <?php endif; ?>

                
                <?php if(auth()->guard()->check()): ?>
                <div x-show="showReviewModal" x-cloak class="fixed inset-0 z-[100]" aria-modal="true">
                    
                    <div x-show="showReviewModal"
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                         @click="showReviewModal = false"
                         class="fixed inset-0 bg-[#0a0806]/80 backdrop-blur-sm"></div>

                    
                    <div class="fixed inset-0 flex items-center justify-center p-4">
                        <div x-show="showReviewModal"
                             x-transition:enter="ease-out duration-400" x-transition:enter-start="opacity-0 translate-y-8 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-8 scale-95"
                             @click.away="showReviewModal = false"
                             class="relative w-full max-w-lg bg-[#231d18] border border-[#c9a84c]/40 shadow-[0_20px_60px_rgba(0,0,0,0.9)] p-8 md:p-10 overflow-hidden"
                             x-data="{ rating: 0, hoverRating: 0 }">

                            <div class="absolute top-0 left-0 w-16 h-16 border-t-2 border-l-2 border-[#c9a84c]/30"></div>
                            <div class="absolute bottom-0 right-0 w-16 h-16 border-b-2 border-r-2 border-[#c9a84c]/30"></div>

                            <button @click="showReviewModal = false" class="absolute top-4 right-4 text-[#6b5e4f] hover:text-[#c9a84c] transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>

                            <div class="text-center mb-8">
                                <h3 class="text-2xl md:text-3xl font-serif text-[#f5f0e8] mb-2">Berikan Ulasanmu</h3>
                                <p class="text-[#a89880] text-sm font-serif">Bagikan pengalamanmu bersama MELODI</p>
                            </div>

                            <form method="POST" action="<?php echo e(route('review.store')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="rating" x-model="rating">

                                <div class="flex flex-col items-center mb-8">
                                    <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.15em] font-bold mb-3">RATING</label>
                                    <div class="flex gap-2">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                        <button type="button"
                                                @click="rating = <?php echo e($i); ?>"
                                                @mouseenter="hoverRating = <?php echo e($i); ?>"
                                                @mouseleave="hoverRating = 0"
                                                class="focus:outline-none transition-transform duration-200 hover:scale-125">
                                            <svg class="w-10 h-10 transition-colors duration-200"
                                                 :class="(hoverRating >= <?php echo e($i); ?> || rating >= <?php echo e($i); ?>) ? 'text-[#c9a84c] drop-shadow-[0_0_6px_rgba(201,168,76,0.4)]' : 'text-[#4a4239]'"
                                                 fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                            </svg>
                                        </button>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-[#a89880] text-xs mt-2 font-serif" x-show="rating > 0" x-text="['','Buruk','Kurang','Cukup','Bagus','Luar Biasa'][rating]"></span>
                                </div>

                                <div class="grid grid-cols-1 gap-5">
                                    <div>
                                        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">NAMA</label>
                                        <input type="text" name="nama" value="<?php echo e(Auth::user()->nama); ?>" required
                                               class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-4 py-3 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none placeholder:text-[#a89880]/50">
                                    </div>
                                    <div>
                                        <label class="block text-[#cbbfa6] text-[10px] uppercase tracking-[0.1em] font-bold mb-1.5">ULASAN</label>
                                        <textarea name="komentar" rows="4" required placeholder="Ceritakan pengalamanmu bersama MELODI..."
                                                  class="w-full bg-[#2e261f] border border-[#5d5248] text-[#f5f0e8] px-4 py-3 text-[13px] font-medium outline-none focus:border-[#c9a84c] transition-colors rounded-none placeholder:text-[#a89880]/50 resize-none"></textarea>
                                    </div>
                                </div>

                                <?php if($errors->any()): ?>
                                <div class="mt-4 text-red-400 text-xs">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <p><?php echo e($error); ?></p>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>

                                <div class="mt-6">
                                    <button type="submit"
                                            :disabled="rating === 0"
                                            :class="rating === 0 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-[#b8973d]'"
                                            class="w-full bg-[#c9a84c] text-[#1a140e] font-serif font-bold py-3.5 text-[13px] tracking-[0.2em] transition-all duration-300 uppercase shadow-lg">
                                        KIRIM ULASAN
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
        function confirmBooking(event, url, packageName) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Booking',
                html: `<p class="text-[#a89880] font-sans text-sm mt-2">Apakah Anda ingin melanjutkan pemesanan untuk<br><b class="text-[#c9a84c] text-[15px] block mt-1">${packageName}</b>?</p>`,
                icon: 'question',
                showCancelButton: true,
                background: '#1a140e',
                color: '#f0e8d8',
                confirmButtonColor: '#c9a84c',
                cancelButtonColor: '#2e261f',
                confirmButtonText: 'Ya, Booking Sekarang',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'border-2 border-[#c9a84c]/30 rounded-2xl shadow-[0_0_50px_rgba(201,168,76,0.1)] bg-gradient-to-b from-[#1f1812] to-[#120d0a]',
                    title: 'font-serif text-[#c9a84c] text-2xl tracking-widest uppercase mt-4 block',
                    confirmButton: 'font-bold tracking-widest text-[#1a140e] px-6 py-3 rounded-md text-[11px] uppercase transition-all duration-300 shadow-md',
                    cancelButton: 'font-bold tracking-widest text-[#f0e8d8] px-6 py-3 rounded-md text-[11px] uppercase border border-[#5d5248] hover:bg-[#3a3028] transition-colors',
                    actions: 'gap-3 mt-6 flex flex-row-reverse',
                    icon: 'border-[#c9a84c] text-[#c9a84c]'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ─── Contact Section ─────────────────────────────── */
        .contact-section-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 3rem;
            font-weight: 700;
            color: #f5f0e8;
            letter-spacing: 0.08em;
            text-transform: capitalize;
            position: relative;
            display: inline-block;
        }
        .contact-section-title::first-letter {
            font-variant: small-caps;
            font-size: 1.2em;
        }

        /* Info Cards */
        .contact-info-card {
            background-color: #2e261f;
            border: 1px solid #3a3028;
            border-radius: 4px;
            padding: 1.5rem 1rem;
            text-align: center;
            transition: border-color 0.3s, transform 0.3s;
        }
        .contact-info-card:hover {
            border-color: #c9a84c;
            transform: translateY(-3px);
        }
        .contact-icon-wrap {
            width: 52px;
            height: 52px;
            margin: 0 auto 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #3a3028;
            border-radius: 6px;
        }
        .contact-icon {
            width: 28px;
            height: 28px;
            color: #c9a84c;
        }
        .contact-card-label {
            color: #d4c8b0;
            font-size: 0.82rem;
            font-weight: 500;
            margin-bottom: 0.2rem;
        }
        .contact-card-value {
            color: #a89880;
            font-size: 0.78rem;
        }

        /* Map */
        .contact-map-wrap {
            width: 100%;
            height: 345px;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid #3a3028;
        }

        /* Form */
        .contact-form-wrap {
            background-color: #2e261f;
            border: 1px solid #3a3028;
            border-radius: 6px;
            padding: 2.5rem 2rem;
        }
        .contact-form-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.6rem;
            color: #c9a84c;
            margin-bottom: 0.5rem;
        }
        .contact-form-subtitle {
            color: #a89880;
            font-size: 0.9rem;
        }
        .contact-label {
            display: block;
            color: #d4c8b0;
            font-size: 0.82rem;
            margin-bottom: 0.4rem;
            font-weight: 500;
        }
        .contact-input {
            width: 100%;
            background-color: #3a3028;
            border: 1px solid #4a3e30;
            border-radius: 4px;
            color: #f0e8d8;
            padding: 0.65rem 1rem;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.25s;
        }
        .contact-input:focus {
            border-color: #c9a84c;
        }
        .contact-textarea {
            resize: vertical;
            min-height: 110px;
        }
        .contact-submit-btn {
            width: 100%;
            background-color: #c9a84c;
            color: #1a140e;
            font-weight: 700;
            font-size: 0.85rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.85rem 2rem;
            border-radius: 50px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        .contact-submit-btn:hover {
            background-color: #e4c278;
            transform: translateY(-2px);
        }
    </style>
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
<?php /**PATH C:\0704\1304\wedding-organizer\resources\views/frontend/home.blade.php ENDPATH**/ ?>