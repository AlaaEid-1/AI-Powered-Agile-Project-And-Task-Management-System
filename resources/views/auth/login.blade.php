<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sign In | TaskFlow Pro</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&amp;family=JetBrains+Mono:wght@400&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#ffdbcc",
                        "error": "#ba1a1a",
                        "primary-fixed": "#e2dfff",
                        "tertiary-container": "#a44100",
                        "primary": "#3525cd",
                        "on-secondary": "#ffffff",
                        "surface": "#faf8ff",
                        "surface-tint": "#4d44e3",
                        "on-primary-fixed-variant": "#3323cc",
                        "tertiary-fixed-dim": "#ffb695",
                        "on-primary-fixed": "#0f0069",
                        "on-error": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e2e7ff",
                        "primary-fixed-dim": "#c3c0ff",
                        "inverse-surface": "#283044",
                        "on-secondary-fixed-variant": "#5a00c6",
                        "on-tertiary-fixed": "#351000",
                        "surface-variant": "#dae2fd",
                        "secondary-container": "#8a4cfc",
                        "secondary-fixed": "#eaddff",
                        "on-primary-container": "#dad7ff",
                        "tertiary": "#7e3000",
                        "surface-container": "#eaedff",
                        "on-background": "#131b2e",
                        "outline": "#777587",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "surface-container-low": "#f2f3ff",
                        "background": "#faf8ff",
                        "on-tertiary-container": "#ffd2be",
                        "on-secondary-container": "#fffbff",
                        "on-surface": "#131b2e",
                        "on-surface-variant": "#464555",
                        "secondary": "#712ae2",
                        "surface-bright": "#faf8ff",
                        "outline-variant": "#c7c4d8",
                        "error-container": "#ffdad6",
                        "surface-container-highest": "#dae2fd",
                        "surface-dim": "#d2d9f4",
                        "inverse-primary": "#c3c0ff",
                        "on-tertiary-fixed-variant": "#7b2f00",
                        "secondary-fixed-dim": "#d2bbff",
                        "primary-container": "#4f46e5",
                        "on-primary": "#ffffff",
                        "inverse-on-surface": "#eef0ff",
                        "on-secondary-fixed": "#25005a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "base": "4px",
                        "lg": "24px",
                        "margin-mobile": "16px",
                        "md": "16px",
                        "sm": "8px",
                        "3xl": "64px",
                        "xs": "4px",
                        "2xl": "48px",
                        "xl": "32px",
                        "gutter": "24px",
                        "margin-desktop": "32px"
                    },
                    "fontFamily": {
                        "label-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "code-sm": ["JetBrains Mono"],
                        "headline-lg-mobile": ["Inter"],
                        "body-sm": ["Inter"],
                        "body-md": ["Inter"],
                        "display-lg": ["Inter"],
                        "headline-lg": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "label-md": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.05em",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "code-sm": ["13px", {
                            "lineHeight": "18px",
                            "fontWeight": "400"
                        }],
                        "headline-lg-mobile": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "display-lg": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .ambient-shadow {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 4px 6px rgba(0, 0, 0, 0.07);
        }

        .focus-ring:focus-within {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body-md min-h-screen flex flex-col">
    <!-- TopAppBar -->
    <header
        class="bg-surface text-primary font-headline-md text-headline-md docked full-width top-0 bg-surface flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16">
        <div class="text-headline-md font-headline-md font-bold text-primary">TaskFlow Pro</div>
        <div class="hidden md:flex gap-lg">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md"
                href="#">Features</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md"
                href="#">Solutions</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-md text-label-md"
                href="#">Pricing</a>
        </div>
    </header>
    <main
        class="flex-grow flex items-center justify-center px-margin-mobile py-2xl bg-gradient-to-br from-surface to-surface-container-low">
        <!-- Login Card -->
        <div
            class="w-full max-w-[440px] bg-surface-container-lowest p-xl rounded-xl ambient-shadow border border-outline-variant">
            <!-- Header Section -->
            <div class="text-center mb-xl">
                <div
                    class="inline-flex items-center justify-center w-12 h-12 bg-primary-container text-on-primary rounded-xl mb-md">
                    <span class="material-symbols-outlined text-[28px]" data-icon="rocket_launch">rocket_launch</span>
                </div>
                <h1 class="font-headline-md text-headline-md text-on-surface">Welcome Back</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-xs">Precision Productivity starts here.
                </p>
            </div>
            <!-- Login Form -->
            <form action="{{ route('login') }}" class="space-y-lg" method="POST">
                <!-- Email Field -->
                @csrf
                @error(config('fortify.username'))
                    <div class="p-4 bg-red-400">{{ $message }}</div>
                @enderror
                <div class="space-y-xs group">
                    <label class="font-label-md text-label-md text-on-surface-variant" for="email">Email
                        Address</label>
                    <div class="relative focus-ring rounded-lg transition-all">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]"
                            data-icon="mail">mail</span>
                        <input
                            class="w-full h-12 pl-10 pr-md bg-surface border border-outline-variant rounded-lg font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:border-primary transition-colors"
                            id="email" name="{{ config('fortify.username') }}" placeholder="name@company.com"
                            required="" type="email" value=" {{ old(config('fortify.username')) }}" />
                    </div>
                </div>
                <!-- Password Field -->
                @error(config('fortify.password'))
                    <div class="p-4 bg-red-400">{{ $message }}</div>
                @enderror
                <div class="space-y-xs group">
                    <div class="flex justify-between items-center">
                        <label class="font-label-md text-label-md text-on-surface-variant"
                            for="password">Password</label>
                        <a class="font-label-md text-label-md text-primary hover:underline" href="{{ route('password.request') }}">Forgot your
                            password?</a>
                    </div>
                    <div class="relative focus-ring rounded-lg transition-all">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]"
                            data-icon="lock">lock</span>
                        <input
                            class="w-full h-12 pl-10 pr-10 bg-surface border border-outline-variant rounded-lg font-body-md text-on-surface placeholder:text-outline focus:outline-none focus:border-primary transition-colors"
                            id="password" name="password" placeholder="••••••••" required="" type="password" />
                        <button
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
                            type="button">
                            <span class="material-symbols-outlined text-[20px]" data-icon="visibility">visibility</span>
                        </button>
                    </div>
                </div>
                <!-- Remember Me & Extra -->
                <div class="flex items-center">
                    <input class="w-4 h-4 text-primary border-outline-variant rounded focus:ring-primary/20 bg-surface"
                        id="remember" name="remember" type="checkbox" />
                    <label class="ml-sm font-body-sm text-body-sm text-on-surface-variant cursor-pointer select-none"
                        for="remember">Remember me for 30 days</label>
                </div>
                <!-- Primary Action -->
                <button
                    class="w-full h-12 bg-primary text-on-primary font-label-md text-label-md rounded-lg ambient-shadow hover:bg-primary/90 active:scale-[0.98] transition-all flex items-center justify-center gap-sm"
                    type="submit">
                    Sign In
                    <span class="material-symbols-outlined text-[18px]" data-icon="arrow_forward">arrow_forward</span>
                </button>
            </form>
            <!-- Footer Links -->
            <div class="mt-xl pt-lg border-t border-outline-variant text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Don't have an account?
                   <a class="text-primary font-label-md text-label-md hover:underline ml-xs" href="{{ route('register') }}">Create an account</a>
                </p>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <footer
        class="bg-surface text-on-surface-variant font-body-sm text-body-sm full-width bottom-0 border-t border-outline-variant w-full py-xl px-margin-desktop flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto">
        <div class="font-label-md text-label-md font-bold mb-md md:mb-0">TaskFlow Pro</div>
        <div class="flex gap-lg items-center mb-md md:mb-0">
            <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="hover:text-primary transition-colors" href="#">Security</a>
        </div>
        <div class="text-on-surface-variant opacity-70">© 2024 TaskFlow Pro. All rights reserved.</div>
    </footer>
    <script>
        // Simple micro-interaction for password visibility toggle
        document.querySelectorAll('button[type="button"]').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('.material-symbols-outlined');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility_off';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility';
                }
            });
        });

        // Atmospheric mouse glow effect on the login card
        const card = document.querySelector('.bg-surface-container-lowest');
        document.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            if (x > -100 && x < rect.width + 100 && y > -100 && y < rect.height + 100) {
                card.style.background = `radial-gradient(circle at ${x}px ${y}px, #ffffff 0%, #faf8ff 100%)`;
            }
        });
    </script>
</body>

</html>
