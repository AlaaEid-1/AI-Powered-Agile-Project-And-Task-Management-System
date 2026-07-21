<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Forgot Password | TaskFlow Pro</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&amp;family=JetBrains+Mono:wght@400&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet">
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .ambient-glow {
            background: radial-gradient(circle at 50% 50%, rgba(79, 70, 229, 0.05) 0%, rgba(250, 248, 255, 0) 70%);
        }

        .auth-card-shadow {
            box-shadow: 0 1px 3px rgba(226, 232, 240, 0.5), 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .input-focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }
    </style>
</head>

<body class="bg-background font-body-md text-on-surface min-h-screen flex flex-col antialiased">
    <!-- Top Navigation Header (Brand Identity Anchor) -->
    <header class="bg-surface w-full px-margin-mobile md:px-margin-desktop h-16 flex justify-between items-center z-50">
        <div class="text-headline-md font-headline-md font-bold text-primary">
            TaskFlow Pro
        </div>
        <div class="hidden md:flex gap-lg items-center">
            <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors"
                href="#">Features</a>
            <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors"
                href="#">Support</a>
        </div>
    </header>
    <main
        class="flex-grow flex items-center justify-center relative px-margin-mobile py-2xl overflow-hidden ambient-glow">
        <!-- Decorative Elements -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-primary-fixed-dim/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-secondary-fixed-dim/20 rounded-full blur-3xl"></div>
        <!-- Centered Forgot Password Card -->
        <div class="relative z-10 w-full max-w-[440px]">
            <div
                class="bg-surface-container-lowest auth-card-shadow border border-outline-variant rounded-xl p-xl md:p-2xl">
                <!-- Icon Header -->
                <div class="flex justify-center mb-xl">
                    <div
                        class="w-16 h-16 rounded-full bg-primary-container/10 flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined !text-[32px]">lock_reset</span>
                    </div>
                </div>
                <!-- Text Content -->
                <div class="text-center mb-xl">
                    <h1 class="font-headline-md text-headline-md font-bold text-on-background mb-sm">Forgot your
                        password?</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant">
                        Enter the email address associated with your account and we'll send you a link to reset your
                        password.
                    </p>
                </div>
                <!-- Reset Form -->
                @if (session('status'))
                    <div class="mb-4 font-body-sm text-primary">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('password.email') }}" class="space-y-lg" method="POST">
                    @csrf
                    <div class="space-y-base">
                        <label class="font-label-md text-label-md text-on-surface-variant ml-1" for="email">Email
                            address</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline-variant">mail</span>
                            <input
                                class="w-full h-[48px] pl-[44px] pr-md bg-surface border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary input-focus-ring transition-all placeholder:text-outline-variant"
                                id="email" name="email" placeholder="name@company.com" required=""
                                type="email" value="{{ old('email') }}">
                        </div>
                        @error('email')
                            <p class="text-error font-body-sm text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button
                        class="w-full h-[48px] bg-primary text-on-primary font-label-md text-label-md rounded-lg hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-sm shadow-md"
                        type="submit">
                        Email Password Reset Link
                        <span class="material-symbols-outlined !text-[18px]">arrow_forward</span>
                    </button>
                </form>
                <!-- Footer Link -->
                <div class="mt-2xl text-center">
                    <a class="inline-flex items-center gap-xs font-label-md text-label-md text-primary hover:underline group"
                        href="{{ route('login') }}">
                        <span
                            class="material-symbols-outlined !text-[16px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                        Back to login
                    </a>
                </div>
            </div>
            <!-- Trust Badge/Hint -->
            <p class="mt-lg text-center font-body-sm text-body-sm text-on-surface-variant">
                Wait, I remembered! <a class="text-primary font-bold" href="{{ route('login') }}">Sign In</a>
            </p>
        </div>
    </main>
    <!-- Footer Component -->
    <footer
        class="w-full py-xl px-margin-desktop bg-surface border-t border-outline-variant max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-md">
        <div class="font-label-md text-label-md font-bold text-on-background">TaskFlow Pro</div>
        <p class="font-body-sm text-body-sm text-on-surface-variant">© 2024 TaskFlow Pro. All rights reserved.</p>
        <div class="flex gap-lg">
            <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors"
                href="#">Privacy Policy</a>
            <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors"
                href="#">Terms of Service</a>
            <a class="font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors"
                href="#">Security</a>
        </div>
    </footer>
    <script>
        // Simple micro-interaction for button feedback
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('button');

        form.addEventListener('submit', (e) => {
            // Simulated loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            submitBtn.innerHTML = `
                <span class="animate-spin material-symbols-outlined !text-[18px]">progress_activity</span>
                Sending Link...
            `;

            // In a real app, the browser would handle the POST redirect
            // This is just for UI demonstration
        });

        // Focus handling for better accessibility/UI
        const emailInput = document.getElementById('email');
        const icon = emailInput.previousElementSibling;

        emailInput.addEventListener('focus', () => {
            icon.classList.replace('text-outline-variant', 'text-primary');
        });

        emailInput.addEventListener('blur', () => {
            icon.classList.replace('text-primary', 'text-outline-variant');
        });
    </script>
</body>

</html>
