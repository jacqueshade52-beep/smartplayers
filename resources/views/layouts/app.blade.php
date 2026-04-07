<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPlayer · Détection & Valorisation</title>

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        benin: {
                            green: '#008751',
                            greenLight: '#e6f3ed',
                            yellow: '#FCD116',
                            yellowLight: '#fffbea',
                            red: '#E8112D',
                            redLight: '#fde7ea',
                            dark: '#0a1a1f',
                            gray: '#f4f7fb'
                        }
                    },
                    boxShadow: {
                        'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                        'floating': '0 20px 40px -10px rgba(0,0,0,0.1)',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                        'scroll': 'scroll 40s linear infinite',
                        'bounce-slow': 'bounce 3s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        scroll: {
                            '0%': { transform: 'translateX(0)' },
                            '100%': { transform: 'translateX(-50%)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Utilities */
        body {
            background-color: #f8fafc;
            overflow-x: hidden;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .text-gradient {
            background: linear-gradient(135deg, #008751 0%, #005e39 50%, #FCD116 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.5, 0, 0, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Hide scrollbar for carousel but keep functionality */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        /* Background blob patterns */
        .bg-blobs {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            filter: blur(90px);
            opacity: 0.4;
            border-radius: 50%;
        }
        
        /* Ligne décorative pour l'écosystème */
        .flow-line {
            background: linear-gradient(90deg, transparent, #008751, #FCD116, #E8112D, transparent);
            height: 2px;
            width: 80%;
            opacity: 0.3;
        }
    </style>
</head>

<body class="text-slate-800 antialiased selection:bg-benin-green selection:text-white flex flex-col min-h-screen">

    @include('partials.nav')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

    <x-onboarding />

    <!-- Animations additionnelles pour l'onboarding -->
    <style>
        @keyframes zoom-in {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes zoom-out {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.95); }
        }
        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fade-out {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        .animate-in { animation: fade-in 0.5s ease-out, zoom-in 0.5s ease-out; }
        .animate-out { animation: fade-out 0.3s ease-in, zoom-out 0.3s ease-in; }
    </style>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // 1. Mobile Menu Toggle
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                const icon = btn.querySelector('i');
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    if (menu.classList.contains('hidden')) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    } else {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    }
                });
            }

            // 2. Scroll Reveal Animation (Intersection Observer)
            const reveals = document.querySelectorAll('.reveal');
            const revealOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            };

            const revealOnScroll = new IntersectionObserver(function (entries, observer) {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target); // Run once
                });
            }, revealOptions);

            reveals.forEach(reveal => {
                revealOnScroll.observe(reveal);
            });

            // 3. Numbers Counter Animation
            const counters = document.querySelectorAll('.counter');
            const speed = 200; // lower is slower

            const counterObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = +counter.getAttribute('data-target');

                        const updateCount = () => {
                            const count = +counter.innerText;
                            const inc = target / speed;

                            if (count < target) {
                                counter.innerText = Math.ceil(count + inc);
                                setTimeout(updateCount, 10);
                            } else {
                                counter.innerText = target;
                            }
                        };
                        updateCount();
                        observer.unobserve(counter);
                    }
                });
            }, { threshold: 0.5 });

            counters.forEach(counter => {
                counterObserver.observe(counter);
            });

        });
    </script>
    
    @stack('scripts')
</body>

</html>
