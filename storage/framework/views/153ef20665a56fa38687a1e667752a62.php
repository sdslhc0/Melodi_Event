<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="MELODI - Wedding & Event Organizer. Rayakan momen paling berharga hidupmu bersama kami.">
    <meta property="og:title" content="MELODI - Wedding & Event Organizer">
    <meta property="og:description" content="Rayakan momen paling berharga hidupmu bersama kami. Layanan pernikahan eksklusif.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">

    <title><?php echo e($title ?? 'MELODI - Wedding & Event Organizer'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <script>
        // Set scroll restoration to manual to prevent browser scroll memory
        if (history.scrollRestoration) {
            history.scrollRestoration = 'manual';
        }

        (function() {
            // Detect if the page was reloaded
            const navEntries = performance.getEntriesByType('navigation');
            const isReload = (
                (window.performance.navigation && window.performance.navigation.type === 1) ||
                (navEntries.length > 0 && navEntries[0].type === 'reload')
            );

            // If it was a reload, and we are not already at the clean home root, redirect
            if (isReload) {
                // If on homepage but with hash/params, or on another page, go to root home
                if (window.location.pathname !== '/' || window.location.hash !== '' || window.location.search !== '') {
                    window.location.href = "<?php echo e(route('home')); ?>";
                } else {
                    // Already at root house, just ensure we are at the top
                    window.scrollTo(0, 0);
                }
            }
        })();
    </script>
</head>
<body class="bg-dark text-brown-100 font-sans antialiased bg-pattern">
    
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{ mobileOpen: false, scrolled: false }"
         x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
         :class="scrolled ? 'bg-dark/95 backdrop-blur-md shadow-lg shadow-black/20' : 'bg-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12">
            <div class="flex justify-between items-center h-24 border-b border-brown-700/50">
                
                <a href="<?php echo e(route('home')); ?>" class="flex items-center">
                    <span class="text-gold-500 font-serif text-3xl tracking-[0.25em] font-normal">M E L O D I</span>
                </a>

                
                <div class="hidden md:flex items-center space-x-10 h-full">
                    <a href="<?php echo e(route('home')); ?>#about" class="text-brown-200 font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] hover:text-gold-400 transition-colors duration-300">About</a>
                    
                    <div x-data="{ open: false }" class="relative h-full flex items-center" @mouseenter="open = true" @mouseleave="open = false">
                        <a href="<?php echo e(route('kategori')); ?>" class="font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] transition-colors duration-300 <?php echo e(request()->routeIs('kategori') ? 'text-gold-500' : 'text-brown-200 hover:text-gold-400'); ?>">Categories</a>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-300 transform"
                             x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-200 transform"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                             class="absolute left-1/2 -translate-x-1/2 top-[100%] w-56 bg-[#181411] border border-gold-500/30 shadow-[0_10px_40px_rgba(0,0,0,0.8)] z-50 rounded-b-lg overflow-hidden flex flex-col"
                             style="display: none;">
                            <?php if(isset($kategori_tipes)): ?>
                                <?php $__currentLoopData = $kategori_tipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('kategori')); ?>?tipe=<?php echo e(urlencode($tipe)); ?>" 
                                       class="relative block px-6 py-4 text-center text-brown-200 font-serif text-[11px] md:text-xs uppercase tracking-[0.2em] border-b border-gold-500/10 last:border-b-0 hover:text-gold-400 hover:bg-gold-500/5 transition-all duration-300 group">
                                        
                                        <span class="relative z-10"><?php echo e($tipe); ?></span>
                                        
                                        <div class="absolute inset-y-0 left-0 w-1 bg-gold-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        <div class="absolute inset-y-0 right-0 w-1 bg-gold-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <a href="<?php echo e(route('home')); ?>#contact" class="text-brown-200 font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] hover:text-gold-400 transition-colors duration-300">Contact</a>
                    <a href="<?php echo e(route('home')); ?>#formulir-pemesanan" class="text-brown-200 font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] hover:text-gold-400 transition-colors duration-300">Booking</a>
                    <a href="<?php echo e(route('home')); ?>#testimonial" class="text-brown-200 font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] hover:text-gold-400 transition-colors duration-300">Review</a>

                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-brown-200 font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] hover:text-gold-400 transition-colors duration-300">Login</a>
                    <?php else: ?>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="group flex items-center gap-3 focus:outline-none">
                                <div class="w-8 h-8 rounded-full border border-gold-500/30 overflow-hidden bg-dark-200 flex items-center justify-center transition-all group-hover:border-gold-500/60">
                                    <?php if(Auth::user()->foto): ?>
                                        <img src="<?php echo e(asset('storage/' . Auth::user()->foto)); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <span class="text-gold-500 text-[10px] font-bold"><?php echo e(strtoupper(substr(Auth::user()->nama, 0, 1))); ?></span>
                                    <?php endif; ?>
                                </div>
                                <span class="text-gold-400 font-serif text-[11px] md:text-[13px] uppercase tracking-[0.1em] group-hover:text-gold-300 transition-colors duration-300"><?php echo e(Auth::user()->nama); ?></span>
                                <svg class="w-3 h-3 text-gold-500/50 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                 class="absolute right-0 mt-3 w-48 bg-dark-100 border border-brown-800/40 rounded-lg shadow-xl py-2 z-50">
                                <?php if(Auth::user()->isAdmin()): ?>
                                    <a href="<?php echo e(route('backend.dashboard')); ?>" class="block px-4 py-2 text-sm text-brown-200 hover:text-gold-400 hover:bg-dark-200 transition-colors">Admin Panel</a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2 text-sm text-brown-200 hover:text-gold-400 hover:bg-dark-200 transition-colors">Profil</a>
                                <a href="<?php echo e(route('booking.riwayat')); ?>" class="block px-4 py-2 text-sm text-brown-200 hover:text-gold-400 hover:bg-dark-200 transition-colors">Riwayat Booking</a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-brown-200 hover:text-gold-400 hover:bg-dark-200 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="flex items-center gap-4 md:hidden">
                    <?php if(auth()->guard()->check()): ?>
                        <div x-data="{ openProfile: false }" class="relative">
                            <button @click="openProfile = !openProfile" class="w-8 h-8 rounded-full border border-gold-500/30 overflow-hidden bg-dark-200 flex items-center justify-center transition-all hover:border-gold-500/60 focus:outline-none">
                                <?php if(Auth::user()->foto): ?>
                                    <img src="<?php echo e(asset('storage/' . Auth::user()->foto)); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-gold-500 text-[10px] font-bold"><?php echo e(strtoupper(substr(Auth::user()->nama, 0, 1))); ?></span>
                                <?php endif; ?>
                            </button>
                            
                            
                            <div x-show="openProfile" @click.away="openProfile = false" x-transition
                                 class="absolute right-0 mt-3 w-56 bg-[#181411] border border-gold-500/30 shadow-[0_10px_40px_rgba(0,0,0,0.8)] rounded-lg py-2 z-50"
                                 style="display: none;">
                                <div class="px-4 py-3 border-b border-gold-500/10 mb-1">
                                    <div class="text-brown-100 text-sm font-medium truncate"><?php echo e(Auth::user()->nama); ?></div>
                                    <div class="text-brown-400 text-[10px] truncate"><?php echo e(Auth::user()->email); ?></div>
                                </div>
                                <?php if(Auth::user()->isAdmin()): ?>
                                    <a href="<?php echo e(route('backend.dashboard')); ?>" class="block px-4 py-2.5 text-sm text-brown-200 hover:text-gold-400 hover:bg-gold-500/5 transition-colors">Admin Panel</a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('profile.edit')); ?>" class="block px-4 py-2.5 text-sm text-brown-200 hover:text-gold-400 hover:bg-gold-500/5 transition-colors">Profil</a>
                                <a href="<?php echo e(route('booking.riwayat')); ?>" class="block px-4 py-2.5 text-sm text-brown-200 hover:text-gold-400 hover:bg-gold-500/5 transition-colors">Riwayat Booking</a>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-sm text-brown-200 hover:text-gold-400 hover:bg-gold-500/5 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button @click="mobileOpen = !mobileOpen" class="text-brown-200 hover:text-gold-400 transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        
        <div x-show="mobileOpen" 
             x-transition:enter="transition ease-out duration-300 transform origin-top"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200 transform origin-top"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden absolute top-[100%] left-0 right-0 z-40"
             style="display: none; background-color: rgba(18, 13, 10, 0.98); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); box-shadow: 0 20px 40px rgba(0,0,0,0.8); border-bottom: 1px solid rgba(201,168,76,0.15);">
            <div class="px-6 py-2 flex flex-col">
                <a href="<?php echo e(route('home')); ?>#about" @click="mobileOpen = false" class="py-4 text-brown-200 font-serif text-[11px] uppercase tracking-[0.2em] hover:text-gold-400 transition-all duration-300" style="border-bottom: 1px solid rgba(201,168,76,0.1);">About</a>
                <a href="<?php echo e(route('kategori')); ?>" @click="mobileOpen = false" class="py-4 text-brown-200 font-serif text-[11px] uppercase tracking-[0.2em] hover:text-gold-400 transition-all duration-300" style="border-bottom: 1px solid rgba(201,168,76,0.1);">Categories</a>
                <a href="<?php echo e(route('home')); ?>#contact" @click="mobileOpen = false" class="py-4 text-brown-200 font-serif text-[11px] uppercase tracking-[0.2em] hover:text-gold-400 transition-all duration-300" style="border-bottom: 1px solid rgba(201,168,76,0.1);">Contact</a>
                <a href="<?php echo e(route('home')); ?>#formulir-pemesanan" @click="mobileOpen = false" class="py-4 text-brown-200 font-serif text-[11px] uppercase tracking-[0.2em] hover:text-gold-400 transition-all duration-300" style="border-bottom: 1px solid rgba(201,168,76,0.1);">Booking</a>
                <a href="<?php echo e(route('home')); ?>#testimonial" @click="mobileOpen = false" class="py-4 text-brown-200 font-serif text-[11px] uppercase tracking-[0.2em] hover:text-gold-400 transition-all duration-300" style="border-bottom: 1px solid rgba(201,168,76,0.1);">Review</a>
                
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="py-4 text-gold-500 font-serif text-[11px] uppercase tracking-[0.2em] hover:text-gold-400 transition-all duration-300" style="border-bottom: 1px solid rgba(201,168,76,0.1);">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    
    <?php if(session('success')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    html: `<p class="text-[#a89880] text-[13px] font-sans leading-relaxed tracking-wide mt-2"><?php echo e(session('success')); ?></p>`,
                    background: '#1a140e',
                    color: '#f0e8d8',
                    showConfirmButton: false,
                    timer: 3500,
                    customClass: {
                        popup: 'border-2 border-[#c9a84c]/30 rounded-2xl shadow-[0_0_50px_rgba(201,168,76,0.1)] bg-gradient-to-b from-[#1f1812] to-[#120d0a]',
                        title: 'font-serif text-[#c9a84c] text-3xl tracking-widest uppercase mt-4 block',
                    }
                });
            });
        </script>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `<p class="text-[#a89880] text-[13px] font-sans leading-relaxed tracking-wide mt-2"><?php echo e(session('error')); ?></p>`,
                    background: '#1a140e',
                    color: '#f0e8d8',
                    confirmButtonColor: '#c9a84c',
                    customClass: {
                        popup: 'border-2 border-[#c9a84c]/30 rounded-2xl shadow-[0_0_50px_rgba(201,168,76,0.1)] bg-gradient-to-b from-[#1f1812] to-[#120d0a]',
                        title: 'font-serif text-[#c9a84c] text-2xl tracking-widest uppercase mt-4 block',
                        confirmButton: 'font-bold tracking-widest text-[#1a140e] px-8 py-3 rounded-lg text-xs'
                    }
                });
            });
        </script>
    <?php endif; ?>
    
    <?php if($errors->any()): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMsgs = `
                    <ul class="text-[#a89880] text-[13px] font-sans leading-relaxed tracking-wide mt-2 text-left list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                `;
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: errorMsgs,
                    background: '#1a140e',
                    color: '#f0e8d8',
                    confirmButtonColor: '#c9a84c',
                    customClass: {
                        popup: 'border-2 border-[#c9a84c]/30 rounded-2xl shadow-[0_0_50px_rgba(201,168,76,0.1)] bg-gradient-to-b from-[#1f1812] to-[#120d0a]',
                        title: 'font-serif text-[#c9a84c] text-2xl tracking-widest uppercase mt-4 block',
                        confirmButton: 'font-bold tracking-widest text-[#1a140e] px-8 py-3 rounded-lg text-xs'
                    }
                });
            });
        </script>
    <?php endif; ?>

    
    <main>
        <?php echo e($slot); ?>

    </main>

    
    <footer class="bg-dark pt-6 pb-6 mt-auto">
        
        <div class="max-w-7xl mx-auto w-full mb-8 px-4 md:px-8" style="opacity: 0.6;">
            <div class="w-full" style="height: 1px; background: linear-gradient(to right, transparent, #c9a84c 20%, #c9a84c 80%, transparent);"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 flex flex-col items-center text-center">
            
            
            <div class="mb-5">
                <h2 class="text-[#c9a84c] font-serif text-2xl md:text-3xl tracking-[0.25em] font-normal mb-2 relative inline-block">
                    M E L O D I
                </h2>
                <p class="text-[#a89880] text-xs font-serif italic tracking-[0.05em] leading-relaxed">
                    Crafting Your Unforgettable Moments
                </p>
            </div>
            
            
            <div class="flex flex-wrap justify-center gap-5 md:gap-8 mb-6">
                 <a href="<?php echo e(route('home')); ?>" class="text-[#d4c8b0] text-[9px] md:text-[10px] uppercase tracking-[0.2em] relative group pb-1">
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-[#c9a84c]">Home</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-[#c9a84c] transition-all duration-300 group-hover:w-full group-hover:left-0 opacity-70"></span>
                 </a>
                 <a href="<?php echo e(route('kategori')); ?>" class="text-[#d4c8b0] text-[9px] md:text-[10px] uppercase tracking-[0.2em] relative group pb-1">
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-[#c9a84c]">Categories</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-[#c9a84c] transition-all duration-300 group-hover:w-full group-hover:left-0 opacity-70"></span>
                 </a>
                 <a href="<?php echo e(route('home')); ?>#about" class="text-[#d4c8b0] text-[9px] md:text-[10px] uppercase tracking-[0.2em] relative group pb-1">
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-[#c9a84c]">About</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-[#c9a84c] transition-all duration-300 group-hover:w-full group-hover:left-0 opacity-70"></span>
                 </a>
                 <a href="<?php echo e(route('home')); ?>#contact" class="text-[#d4c8b0] text-[9px] md:text-[10px] uppercase tracking-[0.2em] relative group pb-1">
                    <span class="relative z-10 transition-colors duration-300 group-hover:text-[#c9a84c]">Contact</span>
                    <span class="absolute bottom-0 left-1/2 w-0 h-[1px] bg-[#c9a84c] transition-all duration-300 group-hover:w-full group-hover:left-0 opacity-70"></span>
                 </a>
            </div>

            
            <div class="flex items-center gap-4 mb-6">
                <a href="#" class="w-8 h-8 rounded-full border border-[#4a4239]/70 flex items-center justify-center text-[#a89880] hover:text-[#1a140e] hover:bg-[#c9a84c] hover:border-[#c9a84c] transition-all duration-300">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" class="w-8 h-8 rounded-full border border-[#4a4239]/70 flex items-center justify-center text-[#a89880] hover:text-[#1a140e] hover:bg-[#c9a84c] hover:border-[#c9a84c] transition-all duration-300">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </a>
            </div>

            
            <div class="text-[#7d7161] text-[9.5px] uppercase tracking-[0.1em] font-medium border-t border-[#4a4239]/40 pt-4 w-full max-w-xs mx-auto">
                &copy; <?php echo e(date('Y')); ?> MELODI Event. All rights reserved.
            </div>
            <br>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\0704\2505\wedding-organizer\resources\views/layouts/frontend.blade.php ENDPATH**/ ?>