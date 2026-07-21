<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Reset Password | TaskFlow Pro</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&amp;family=JetBrains+Mono&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
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
            box-shadow: 0 1px 3px rgba(226, 232, 240, 0.05), 0 4px 6px rgba(226, 232, 240, 0.07);
        }

        .focus-ring:focus {
            outline: none;
            border-color: #3525cd;
            box-shadow: 0 0 0 3px rgba(53, 37, 205, 0.1);
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
    </style>
</head>

<body class="bg-surface font-body-md text-on-surface min-h-screen flex flex-col">
    <!-- Top Navigation Anchor (Shared Component) -->
    <header
        class="bg-surface dark:bg-on-background flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 fixed top-0 z-50">
        <div class="text-headline-md font-headline-md font-bold text-primary dark:text-primary-fixed">
            TaskFlow Pro
        </div>
        <div class="hidden md:flex gap-xl">
            <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-label-md text-label-md"
                href="#">Features</a>
            <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-label-md text-label-md"
                href="#">Solutions</a>
            <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed transition-colors font-label-md text-label-md"
                href="#">Pricing</a>
        </div>
        <div class="flex items-center gap-md">
            <button class="text-primary font-label-md text-label-md hover:opacity-80 transition-opacity">Login</button>
        </div>
    </header>
    <!-- Main Content Canvas -->
    <main class="flex-grow flex items-center justify-center px-margin-mobile pt-3xl pb-2xl">
        <div class="w-full max-w-[440px] animate-in fade-in slide-in-from-bottom-4 duration-700">
            <!-- Branding/Identity -->
            <div class="text-center mb-xl">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-primary-container text-on-primary mb-md">
                    <span class="material-symbols-outlined text-[32px]">lock_reset</span>
                </div>
                <h1 class="font-headline-lg text-headline-lg text-on-background mb-xs">Reset password</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">Please enter your new credentials to regain
                    access.</p>
            </div>
            <!-- Auth Card -->
            <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-lg ambient-shadow">
                <form action="{{ route('password.update') }}" class="space-y-lg" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">
                    <!-- Email Read-Only Field -->
                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface-variant" for="email">Email
                            Address</label>
                        <div class="relative">
                            <span
                                class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline">alternate_email</span>
                            <input
                                class="w-full h-[48px] pl-3xl pr-md bg-surface-container-low border border-outline-variant rounded-lg font-body-md text-on-surface-variant cursor-not-allowed"
                                id="email" name="email" readonly="" type="email"
                                value="{{ old('email', request()->email) }}">
                        </div>
                        @error('email')
                            <p class="text-error font-body-sm text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- New Password Field -->
                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="new_password">New
                            Password</label>
                        <div class="relative group">
                            <span
                                class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline group-focus-within:text-primary">lock</span>
                            <input
                                class="w-full h-[48px] pl-3xl pr-md bg-white border border-outline-variant rounded-lg font-body-md focus-ring transition-all"
                                id="new_password" name="password" placeholder="••••••••" required=""
                                type="password">
                            <button
                                class="absolute right-md top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
                                onclick="togglePassword('new_password')" type="button">
                                <span class="material-symbols-outlined" id="new_password_icon">visibility</span>
                            </button>
                        </div>
                        <p class="text-[11px] text-on-surface-variant mt-1 px-1">Must be at least 8 characters with one
                            special symbol.</p>
                        @error('password')
                            <p class="text-error font-body-sm text-[12px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Confirm Password Field -->
                    <div class="space-y-xs">
                        <label class="font-label-md text-label-md text-on-surface" for="confirm_password">Confirm New
                            Password</label>
                        <div class="relative group">
                            <span
                                class="absolute left-md top-1/2 -translate-y-1/2 material-symbols-outlined text-outline group-focus-within:text-primary">verified_user</span>
                            <input
                                class="w-full h-[48px] pl-3xl pr-md bg-white border border-outline-variant rounded-lg font-body-md focus-ring transition-all"
                                id="confirm_password" name="password_confirmation" placeholder="••••••••" required=""
                                type="password">
                            <button
                                class="absolute right-md top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
                                onclick="togglePassword('confirm_password')" type="button">
                                <span class="material-symbols-outlined" id="confirm_password_icon">visibility</span>
                            </button>
                        </div>
                    </div>
                    <!-- Primary Action -->
                    <button
                        class="w-full h-[48px] bg-primary text-on-primary font-label-md text-label-md rounded-lg ambient-shadow hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-sm"
                        type="submit">
                        <span>Reset Password</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </button>
                </form>
            </div>
            <!-- Secondary Actions -->
            <div class="mt-lg text-center">
                <a class="inline-flex items-center gap-xs font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors"
                    href="{{ route('login') }}">
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                    Back to login
                </a>
            </div>
        </div>
    </main>
    <!-- Footer (Shared Component) -->
    <footer class="bg-surface dark:bg-on-background border-t border-outline-variant dark:border-outline">
        <div
            class="w-full py-xl px-margin-desktop flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto space-y-md md:space-y-0">
            <div class="font-label-md text-label-md font-bold text-on-surface-variant dark:text-outline-variant">
                TaskFlow Pro
            </div>
            <div
                class="font-body-sm text-body-sm text-on-surface-variant dark:text-outline-variant text-center md:text-left">
                © 2024 TaskFlow Pro. All rights reserved.
            </div>
            <div class="flex gap-lg">
                <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed font-body-sm text-body-sm"
                    href="#">Privacy Policy</a>
                <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed font-body-sm text-body-sm"
                    href="#">Terms of Service</a>
                <a class="text-on-surface-variant dark:text-outline-variant hover:text-primary dark:hover:text-primary-fixed font-body-sm text-body-sm"
                    href="#">Security</a>
            </div>
        </div>
    </footer>
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const icon = document.getElementById(id + '_icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = 'visibility_off';
            } else {
                input.type = 'password';
                icon.textContent = 'visibility';
            }
        }

        // Simple validation visual feedback
        const form = document.querySelector('form');
        const pass = document.getElementById('new_password');
        const confirm = document.getElementById('confirm_password');

        form.addEventListener('submit', (e) => {
            if (pass.value !== confirm.value) {
                e.preventDefault();
                confirm.classList.add('border-error');
                alert('Passwords do not match.');
            }
        });

        confirm.addEventListener('input', () => {
            if (confirm.value === pass.value && pass.value !== '') {
                confirm.classList.remove('border-error');
                confirm.classList.add('border-primary');
            } else {
                confirm.classList.remove('border-primary');
            }
        });
    </script>
</body>

</html>
