<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'MELODI - Masuk' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: #14110e url('/wedding_bg.png') no-repeat center center;
            background-size: cover;
            font-family: 'Inter', sans-serif;
            overflow: hidden;
        }

        /* Subtle bg glow & overlay */
        body::before {
            content: '';
            position: fixed; inset: 0;
            background: linear-gradient(rgba(20, 17, 14, 0.65), rgba(20, 17, 14, 0.9)),
                        radial-gradient(ellipse 80% 60% at 50% 50%, rgba(201,168,76,0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        /* =========================================================
           MAIN AUTH CARD
        ========================================================= */
        .auth-card {
            position: relative;
            width: 860px; max-width: 96vw;
            height: 520px; max-height: 96vh;
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 40px 100px rgba(0,0,0,0.8), 0 0 0 1px rgba(201,168,76,0.15);
            background: rgba(28, 24, 19, 0.5);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* =========================================================
           LEFT DECORATIVE PANEL
        ========================================================= */
        .left-panel {
            position: relative;
            width: 42%;
            flex-shrink: 0;
            background: rgba(20, 16, 12, 0.3);
            overflow: visible; /* allow puzzle bump to protrude right */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 2rem 0 2rem 2.5rem;
            z-index: 5;
        }

        /* === Diagonal layered shapes (material design) === */
        .layer {
            position: absolute;
            border-radius: 12px;
        }
        .layer-1 {
            width: 320px; height: 320px;
            background: rgba(201,168,76,0.12);
            top: -80px; left: -80px;
            transform: rotate(45deg);
        }
        .layer-2 {
            width: 240px; height: 240px;
            background: rgba(201,168,76,0.08);
            top: -40px; left: -40px;
            transform: rotate(45deg);
        }
        .layer-3 {
            width: 280px; height: 280px;
            background: rgba(201,168,76,0.07);
            bottom: -100px; left: -60px;
            transform: rotate(45deg);
        }
        .layer-4 {
            width: 180px; height: 180px;
            background: rgba(201,168,76,0.06);
            bottom: -60px; left: -20px;
            transform: rotate(45deg);
        }

        /* Logo on left panel */
        .left-logo {
            position: absolute;
            top: 2.5rem; left: 2.5rem;
            z-index: 10;
            font-family: 'Playfair Display', serif;
            color: #c9a84c;
            font-size: 1.6rem;
            letter-spacing: 0.35em;
            text-decoration: none;
            display: block;
        }

        /* Divider line */
        .left-divider {
            display: none;
        }

        /* =========================================================
           SLEEK ANGLED TABS
        ========================================================= */
        .auth-tabs {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 16px;
            z-index: 20;
            padding-right: 0;
        }

        .auth-tab {
            position: relative;
            cursor: pointer;
            border: none;
            background: rgba(201,168,76,0.05);
            backdrop-filter: blur(10px);
            width: 155px;
            height: 48px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            color: rgba(201,168,76,0.6);
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            transition: all 0.4s ease;
            border-radius: 24px 0 0 24px;
            border: 1px solid rgba(201,168,76,0.15);
            border-right: none;
        }

        .auth-tab::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(201,168,76,0.15) 0%, transparent 100%);
            opacity: 0;
            border-radius: 24px 0 0 24px;
            transition: opacity 0.4s ease;
        }

        .auth-tab:hover {
            color: rgba(201,168,76,0.9);
            background: rgba(201,168,76,0.1);
            width: 165px;
        }

        .auth-tab.active {
            background: linear-gradient(135deg, #c9a84c 0%, #b39032 100%);
            color: #1a140e;
            width: 175px;
            box-shadow: -10px 0 20px rgba(0,0,0,0.4);
            z-index: 21;
        }

        .auth-tab.active::before {
            opacity: 1;
        }

        .auth-tab.active .tab-dot {
            background: #1a140e;
            box-shadow: 0 0 8px rgba(0,0,0,0.3);
            animation: pulse-gold 2s infinite;
        }

        .auth-tab.active span {
            color: #1a140e;
            font-weight: 800;
        }

        .auth-tab .tab-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            margin-right: 12px;
            box-shadow: 0 0 10px currentColor;
        }

        .auth-tab.active .tab-dot {
            animation: pulse-gold 2s infinite;
        }

        @keyframes pulse-gold {
            0% { transform: scale(1); opacity: 1; box-shadow: 0 0 0 0 rgba(201,168,76,0.7); }
            70% { transform: scale(1.2); opacity: 0.8; box-shadow: 0 0 0 10px rgba(201,168,76,0); }
            100% { transform: scale(1); opacity: 1; box-shadow: 0 0 0 0 rgba(201,168,76,0); }
        }

        /* =========================================================
           RIGHT FORM PANEL
        ========================================================= */
        .right-panel {
            flex: 1;
            position: relative;
            background: rgba(20, 16, 12, 0.85);
            overflow: hidden;
            z-index: 1;
        }

        /* Slides container */
        .slides-track {
            position: absolute; inset: 0;
        }

        /* Individual form slide */
        .form-slide {
            position: absolute;
            inset: 0;
            display: flex; flex-direction: column; justify-content: center;
            padding: 2.8rem 3rem;
            transition: transform 0.55s cubic-bezier(0.76, 0, 0.24, 1),
                        opacity 0.4s ease;
        }

        /* States */
        .form-slide.state-current  { transform: translateY(0);     opacity: 1; }
        .form-slide.state-below    { transform: translateY(100%);   opacity: 0; }
        .form-slide.state-above    { transform: translateY(-100%);  opacity: 0; }

        /* =========================================================
           FORM STYLES
        ========================================================= */
        .form-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.65rem; color: #f5f0e8;
            font-weight: 500; margin-bottom: 0.2rem;
        }
        .form-subtitle {
            font-size: 0.78rem; color: #a89880;
            margin-bottom: 1.5rem; letter-spacing: 0.03em;
        }

        .fgroup { margin-bottom: 0.9rem; }
        .flabel {
            display: block; font-size: 0.66rem; font-weight: 700;
            letter-spacing: 0.14em; text-transform: uppercase;
            color: #cbbfa6; margin-bottom: 0.35rem;
        }
        .fwrap { position: relative; }
        .finput {
            width: 100%;
            background: rgba(201,168,76,0.08);
            border: 1px solid rgba(201,168,76,0.2);
            border-radius: 7px;
            color: #f5f0e8;
            font-size: 0.85rem;
            padding: 0.58rem 0.9rem;
            outline: none;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.25s, box-shadow 0.25s;
        }
        .finput:focus {
            border-color: rgba(201,168,76,0.5);
            box-shadow: 0 0 0 3px rgba(201,168,76,0.07);
        }
        .finput::placeholder { color: rgba(168,152,128,0.38); }
        .finput.iconed { padding-right: 2.6rem; }
        .finput:-webkit-autofill,
        .finput:-webkit-autofill:hover,
        .finput:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 100px #1a1510 inset !important;
            -webkit-text-fill-color: #f5f0e8 !important;
        }

        .eye-toggle {
            position: absolute; right: 0; top: 0; bottom: 0; width: 2.5rem;
            display: flex; align-items: center; justify-content: center;
            color: rgba(168,152,128,0.4); background: none; border: none;
            cursor: pointer; transition: color 0.2s;
        }
        .eye-toggle:hover { color: #c9a84c; }

        .ferror { color: #f87171; font-size: 0.68rem; margin-top: 0.25rem; }

        .fgrid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;
        }
        .fgrid .fcol-full { grid-column: 1/-1; }

        .frow {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 0.85rem;
        }
        .fcheck-label {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.76rem; color: #a89880; cursor: pointer;
        }
        .fcheck-label input { accent-color: #c9a84c; width: 13px; height: 13px; }
        .flink { font-size: 0.76rem; color: #c9a84c; text-decoration: none; transition: color 0.2s; }
        .flink:hover { color: #d4b065; }

        .btn-auth {
            width: 100%; padding: 0.72rem;
            background: linear-gradient(135deg, #c9a84c, #d4b065);
            border: none; border-radius: 7px;
            color: #1a140e; font-size: 0.72rem; font-weight: 800;
            letter-spacing: 0.18em; text-transform: uppercase;
            cursor: pointer; font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        .btn-auth:hover {
            background: linear-gradient(135deg, #d4b065, #e4c87a);
            box-shadow: 0 6px 22px rgba(201,168,76,0.3);
            transform: translateY(-1px);
        }

        /* Subtle top border accent on right panel */
        .right-panel::before {
            content: '';
            position: absolute; left: 0; top: 0; bottom: 0; width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(201,168,76,0.2) 30%, rgba(201,168,76,0.2) 70%, transparent);
            z-index: 10;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */
        @media (max-width: 640px) {
            body {
                background-image: none;
                background-color: #14110e;
            }
            
            body::before {
                display: none;
            }

            .auth-card {
                width: 100vw;
                height: 100dvh;
                border-radius: 0;
                flex-direction: column;
                box-shadow: none;
            }

            .left-panel {
                width: 100%;
                height: auto;
                padding: 1.2rem 1.5rem;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                overflow: visible;
                background: rgba(20, 16, 12, 0.85); /* matching right panel for seamless look on mobile */
                border-bottom: 1px solid rgba(201,168,76,0.1);
            }

            .left-logo {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 0;
                font-size: 1.1rem;
                letter-spacing: 0.2em;
            }

            .left-divider { display: none; }

            .auth-tabs {
                position: relative;
                top: 0;
                right: 0;
                transform: none;
                flex-direction: row;
                gap: 8px;
            }

            .auth-tab {
                width: auto;
                height: 36px;
                padding: 0 16px;
                font-size: 0.65rem;
                letter-spacing: 0.1em;
                border-radius: 18px;
                background: rgba(201,168,76,0.08);
                border: 1px solid rgba(201,168,76,0.1);
            }

            .auth-tab.active {
                width: auto;
                background: linear-gradient(135deg, #c9a84c 0%, #b39032 100%);
                color: #1a140e;
                border: 1px solid transparent;
                transform: scale(1.05);
            }

            .auth-tab.active span {
                color: #1a140e;
            }

            .auth-tab:hover {
                transform: translateY(-2px);
            }

            .auth-tab .tab-dot {
                display: none; /* hide dot on mobile to save space */
            }

            .right-panel {
                flex: 1;
            }

            .right-panel::before {
                width: 100%;
                height: 1px;
                background: linear-gradient(to right, transparent, rgba(201,168,76,0.2), transparent);
            }

            .form-slide {
                padding: 2rem 1.5rem;
            }

            .layer-1, .layer-2, .layer-3, .layer-4 {
                display: none;
            }
        }
    </style>
</head>
<body>

@php
    $activeForm = request()->routeIs('register') ? 'register' : 'login';
@endphp

<div class="auth-card">

    {{-- ===== LEFT DECORATIVE PANEL ===== --}}
    <div class="left-panel">
        {{-- Material design layers --}}
        <div class="layer layer-1"></div>
        <div class="layer layer-2"></div>
        <div class="layer layer-3"></div>
        <div class="layer layer-4"></div>

        {{-- Logo --}}
        <a href="{{ route('home') }}" class="left-logo">M E L O D I</a>
        <div class="left-divider"></div>

        {{-- Sleek Angled Tabs --}}
        <div class="auth-tabs">
            <button class="auth-tab {{ $activeForm === 'login' ? 'active' : '' }}"
                    onclick="switchForm('login')" id="tabLogin">
                <div class="tab-dot"></div>
                <span>Masuk</span>
            </button>

            <button class="auth-tab {{ $activeForm === 'register' ? 'active' : '' }}"
                    onclick="switchForm('register')" id="tabRegister">
                <div class="tab-dot"></div>
                <span>Daftar</span>
            </button>
        </div>
    </div>

    {{-- ===== RIGHT FORM PANEL ===== --}}
    <div class="right-panel">
        <div class="slides-track">

            {{-- LOGIN SLIDE --}}
            <div class="form-slide {{ $activeForm === 'login' ? 'state-current' : 'state-below' }}" id="slideLogin">
                <h2 class="form-title">Masuk ke Akun Anda</h2>
                <p class="form-subtitle">Selamat datang kembali di MELODI</p>

                <x-auth-session-status class="mb-3" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="fgroup">
                        <label class="flabel">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               required autofocus autocomplete="username"
                               class="finput" placeholder="email@contoh.com">
                        @error('email') <p class="ferror">{{ $message }}</p> @enderror
                    </div>

                    <div class="fgroup" x-data="{ sp: false }">
                        <label class="flabel">Password</label>
                        <div class="fwrap">
                            <input :type="sp ? 'text' : 'password'" name="password"
                                   required autocomplete="current-password"
                                   class="finput iconed" placeholder="••••••••">
                            <button type="button" class="eye-toggle" @click="sp=!sp">
                                <template x-if="!sp">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </template>
                                <template x-if="sp">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                                </template>
                            </button>
                        </div>
                        @error('password') <p class="ferror">{{ $message }}</p> @enderror
                    </div>

                    <div class="frow">
                        <label class="fcheck-label">
                            <input type="checkbox" name="remember"> Ingat saya
                        </label>
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="flink">Lupa password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-auth">Masuk</button>
                </form>
            </div>

            {{-- REGISTER SLIDE --}}
            <div class="form-slide {{ $activeForm === 'register' ? 'state-current' : 'state-below' }}" id="slideRegister">
                <h2 class="form-title">Buat Akun Baru</h2>
                <p class="form-subtitle">Mulai perjalanan pernikahan Anda bersama MELODI</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="fgrid">
                        <div class="fgroup fcol-full">
                            <label class="flabel">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                   required autocomplete="name"
                                   class="finput" placeholder="Nama lengkap Anda">
                            @error('nama') <p class="ferror">{{ $message }}</p> @enderror
                        </div>

                        <div class="fgroup fcol-full">
                            <label class="flabel">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   required autocomplete="username"
                                   class="finput" placeholder="email@contoh.com">
                            @error('email') <p class="ferror">{{ $message }}</p> @enderror
                        </div>

                        <div class="fgroup">
                            <label class="flabel">No. Telepon</label>
                            <input type="text" name="telepon" value="{{ old('telepon') }}"
                                   autocomplete="tel"
                                   class="finput" placeholder="08xxxxxxxxxx">
                            @error('telepon') <p class="ferror">{{ $message }}</p> @enderror
                        </div>

                        <div class="fgroup" x-data="{ rp: false }">
                            <label class="flabel">Password</label>
                            <div class="fwrap">
                                <input :type="rp ? 'text' : 'password'" name="password"
                                       required autocomplete="new-password"
                                       class="finput iconed" placeholder="Min. 8 karakter">
                                <button type="button" class="eye-toggle" @click="rp=!rp">
                                    <template x-if="!rp"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></template>
                                    <template x-if="rp"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg></template>
                                </button>
                            </div>
                            @error('password') <p class="ferror">{{ $message }}</p> @enderror
                        </div>

                        <div class="fgroup fcol-full" x-data="{ rc: false }">
                            <label class="flabel">Konfirmasi Password</label>
                            <div class="fwrap">
                                <input :type="rc ? 'text' : 'password'" name="password_confirmation"
                                       required autocomplete="new-password"
                                       class="finput iconed" placeholder="Ulangi password">
                                <button type="button" class="eye-toggle" @click="rc=!rc">
                                    <template x-if="!rc"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></template>
                                    <template x-if="rc"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg></template>
                                </button>
                            </div>
                            @error('password_confirmation') <p class="ferror">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn-auth" style="margin-top:0.3rem">Daftar Sekarang</button>
                </form>
            </div>

        </div>
    </div>

</div>

<script>
var currentForm = '{{ $activeForm }}';

function switchForm(target) {
    if (target === currentForm) return;

    var leaving = document.getElementById('slide' + capitalize(currentForm));
    var entering = document.getElementById('slide' + capitalize(target));

    // Exit upward (sweep up like puzzle)
    leaving.classList.remove('state-current');
    leaving.classList.add('state-above');

    // Enter from below
    entering.classList.remove('state-below', 'state-above');
    entering.classList.add('state-current');

    // Update tab buttons
    document.getElementById('tab' + capitalize(currentForm)).classList.remove('active');
    document.getElementById('tab' + capitalize(target)).classList.add('active');

    currentForm = target;
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// On load: if register page, set register as state (already set via Blade)
// Animate register entry on load if coming from login route
document.addEventListener('DOMContentLoaded', function() {
    if (currentForm === 'register') {
        var regSlide = document.getElementById('slideRegister');
        regSlide.style.transition = 'none';
        regSlide.classList.remove('state-current');
        regSlide.classList.add('state-below');

        requestAnimationFrame(function() {
            requestAnimationFrame(function() {
                regSlide.style.transition = '';
                regSlide.classList.remove('state-below');
                regSlide.classList.add('state-current');
            });
        });
    }
});
</script>

</body>
</html>
