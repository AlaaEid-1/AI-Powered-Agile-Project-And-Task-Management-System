<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Register | TaskFlow Pro</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&amp;family=JetBrains+Mono&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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
                        "label-md": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }],
                        "code-sm": ["13px", { "lineHeight": "18px", "fontWeight": "400" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.02em", "fontWeight": "600" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .ambient-shadow { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .focus-ring:focus { outline: none; border-color: #3525cd; box-shadow: 0 0 0 3px rgba(53, 37, 205, 0.1); }
    </style>
</head>

<body class="bg-surface text-on-surface min-h-screen flex flex-col">
    <header class="bg-surface dark:bg-on-background flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 sticky top-0 z-50">
        <div class="text-headline-md font-headline-md font-bold text-primary dark:text-primary-fixed">
            TaskFlow Pro
        </div>
        <div class="hidden md:flex gap-lg">
            <a class="text-on-surface-variant dark:text-outline-variant font-label-md text-label-md hover:text-primary transition-colors" href="#">Support</a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-margin-mobile py-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-20 overflow-hidden">
            <div class="absolute -top-1/4 -left-1/4 w-[600px] h-[600px] bg-primary-container rounded-full blur-[120px]"></div>
            <div class="absolute top-1/2 -right-1/4 w-[500px] h-[500px] bg-secondary-container rounded-full blur-[120px]"></div>
        </div>

        <div class="w-full max-w-md z-10">
            <div class="bg-surface-container-lowest ambient-shadow rounded-xl p-xl border border-outline-variant/30">
                <div class="mb-xl text-center">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-xs">Create Account</h1>
                    <p class="font-body-md text-body-md text-on-surface-variant">Start your productivity journey today.</p>
                </div>

                <form action="{{ route('register') }}" class="space-y-md" method="POST">
                    @csrf

                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface-variant block" for="name">Full Name</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">person</span>
                            <input class="w-full h-10 pl-11 pr-md bg-surface border border-outline-variant rounded-lg focus-ring font-body-sm text-body-sm transition-all duration-200"
                                id="name" name="name" placeholder="John Doe" required type="text" value="{{ old('name') }}" />
                        </div>
                        @error('name')
                            <p class="text-error font-body-sm text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface-variant block" for="email">Email Address</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">mail</span>
                            <input class="w-full h-10 pl-11 pr-md bg-surface border border-outline-variant rounded-lg focus-ring font-body-sm text-body-sm transition-all duration-200"
                                id="email" name="email" placeholder="name@company.com" required type="email" value="{{ old('email') }}" />
                        </div>
                        @error('email')
                            <p class="text-error font-body-sm text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface-variant block" for="password">Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">lock</span>
                            <input class="w-full h-10 pl-11 pr-md bg-surface border border-outline-variant rounded-lg focus-ring font-body-sm text-body-sm transition-all duration-200"
                                id="password" name="password" placeholder="••••••••" required type="password" />
                        </div>
                        <p class="font-label-md text-[10px] text-outline px-sm">Minimum 8 characters with a mix of letters and numbers.</p>
                        @error('password')
                            <p class="text-error font-body-sm text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface-variant block" for="password_confirmation">Confirm Password</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-md top-1/2 -translate-y-1/2 text-outline">verified_user</span>
                            <input class="w-full h-10 pl-11 pr-md bg-surface border border-outline-variant rounded-lg focus-ring font-body-sm text-body-sm transition-all duration-200"
                                id="password_confirmation" name="password_confirmation" placeholder="••••••••" required type="password" />
                        </div>
                    </div>

                    <div class="flex items-start gap-sm py-xs">
                        <input class="mt-1 w-4 h-4 rounded border-outline-variant text-primary focus:ring-primary-container"
                            id="terms" name="terms" required type="checkbox" />
                        <label class="font-body-sm text-body-sm text-on-surface-variant" for="terms">
                            I agree to the <a class="text-primary hover:underline" href="#">Terms of Service</a> and <a class="text-primary hover:underline" href="#">Privacy Policy</a>.
                        </label>
                    </div>

                    <button class="w-full h-12 bg-primary text-on-primary rounded-lg font-label-md text-body-md font-bold hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-sm mt-md" type="submit">
                        Create Account
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>

                <div class="mt-xl pt-lg border-t border-outline-variant/30 text-center">
                    <p class="font-body-sm text-body-sm text-on-surface-variant">
                        Already have an account?
                        <a class="text-primary font-bold hover:underline transition-all" href="{{ route('login') }}">Sign In</a>
                    </p>
                </div>
            </div>

            <div class="mt-lg flex justify-between px-sm opacity-60">
                <span class="font-label-md text-[10px] text-on-surface-variant uppercase tracking-widest">© 2024 TaskFlow Pro</span>
                <div class="flex gap-md">
                    <a class="font-label-md text-[10px] text-on-surface-variant hover:text-primary" href="#">Help</a>
                    <a class="font-label-md text-[10px] text-on-surface-variant hover:text-primary" href="#">Status</a>
                </div>
            </div>
        </div>
    </main>

    <div class="fixed bottom-margin-desktop left-margin-desktop hidden lg:block animate-bounce" style="animation-duration: 4s;">
        <div class="bg-surface-container-high/60 backdrop-blur-md p-md rounded-xl border border-white/20 shadow-lg flex items-center gap-md">
            <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container">
                <span class="material-symbols-outlined">task_alt</span>
            </div>
            <div>
                <p class="font-label-md text-label-md text-on-surface">Automate tasks</p>
                <p class="font-body-sm text-[10px] text-on-surface-variant">Save 2 hours daily.</p>
            </div>
        </div>
    </div>

    <footer class="w-full py-xl px-margin-desktop flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto border-t border-outline-variant dark:border-outline">
        <div class="font-label-md text-label-md font-bold text-on-surface-variant dark:text-outline-variant mb-md md:mb-0">
            TaskFlow Pro
        </div>
        <div class="flex gap-lg font-body-sm text-body-sm text-on-surface-variant dark:text-outline-variant">
            <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="hover:text-primary transition-colors" href="#">Security</a>
        </div>
        <div class="mt-md md:mt-0 font-body-sm text-body-sm text-on-surface-variant dark:text-outline-variant">
            © 2024 TaskFlow Pro. All rights reserved.
        </div>
    </footer>

    <script>
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                const icon = input.parentElement.querySelector('.material-symbols-outlined');
                if (icon) icon.style.color = '#3525cd';
            });
            input.addEventListener('blur', () => {
                const icon = input.parentElement.querySelector('.material-symbols-outlined');
                if (icon) icon.style.color = '#777587';
            });
        });

        const form = document.querySelector('form');
        form.addEventListener('submit', (e) => {
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;

            if (pass !== confirm) {
                e.preventDefault();
                alert('Passwords do not match. Please check and try again.');
            }
        });
    </script>
</body>

</html>
