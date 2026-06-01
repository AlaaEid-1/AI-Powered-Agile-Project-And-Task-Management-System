<!DOCTYPE html>
<html class="light" lang="en" style="">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>TaskFlow - Create New Task</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
                        "on-primary-fixed-variant": "#5b00c5",
                        "surface-variant": "#dce2f3",
                        "outline-variant": "#ccc3d7",
                        "surface-container-low": "#f0f3ff",
                        "primary-fixed": "#ebddff",
                        "primary": "#5300b7",
                        "tertiary-fixed": "#e3e1ed",
                        "secondary-fixed-dim": "#c8c2e9",
                        "on-error": "#ffffff",
                        "surface-container": "#e7eefe",
                        "on-primary-container": "#dac5ff",
                        "surface": "#f9f9ff",
                        "background": "#f9f9ff",
                        "surface-bright": "#f9f9ff",
                        "surface-container-high": "#e2e8f8",
                        "tertiary": "#3f4049",
                        "on-secondary-container": "#605b7d",
                        "secondary-fixed": "#e5deff",
                        "outline": "#7b7486",
                        "on-primary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-primary-fixed": "#250059",
                        "on-tertiary-container": "#cfcdd9",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#dcd5fd",
                        "on-surface": "#151c27",
                        "tertiary-container": "#575761",
                        "inverse-on-surface": "#ebf1ff",
                        "on-error-container": "#93000a",
                        "surface-dim": "#d3daea",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#7331df",
                        "tertiary-fixed-dim": "#c7c5d1",
                        "inverse-primary": "#d3bbff",
                        "secondary": "#5f5a7c",
                        "on-surface-variant": "#4a4455",
                        "inverse-surface": "#2a313d",
                        "error": "#ba1a1a",
                        "on-secondary-fixed-variant": "#474363",
                        "surface-container-highest": "#dce2f3",
                        "on-tertiary": "#ffffff",
                        "primary-container": "#6d28d9",
                        "on-secondary-fixed": "#1b1735",
                        "on-tertiary-fixed": "#1a1b23",
                        "primary-fixed-dim": "#d3bbff",
                        "on-background": "#151c27",
                        "on-tertiary-fixed-variant": "#46464f"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "base": "8px",
                        "sm": "12px",
                        "xl": "64px",
                        "md": "24px",
                        "lg": "48px",
                        "gutter": "24px",
                        "xs": "4px",
                        "container-max": "1200px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "headline-xl": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-md": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "headline-xl": ["36px", {
                            "lineHeight": "44px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "label-sm": ["12px", {
                            "lineHeight": "16px",
                            "fontWeight": "600"
                        }],
                        "label-md": ["14px", {
                            "lineHeight": "20px",
                            "letterSpacing": "0.01em",
                            "fontWeight": "500"
                        }],
                        "headline-lg": ["28px", {
                            "lineHeight": "36px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-sm": ["14px", {
                            "lineHeight": "20px",
                            "fontWeight": "400"
                        }],
                        "headline-md": ["20px", {
                            "lineHeight": "28px",
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

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #6d28d9 !important;
            box-shadow: 0 0 0 2px rgba(109, 40, 217, 0.1);
        }

        .custom-shadow-low {
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col md:flex-row">
    <!-- SideNavBar -->
    <aside
        class="hidden lg:flex flex-col h-screen p-md gap-base bg-surface-container-low border-r border-outline-variant w-64 sticky top-0">
        <div class="flex items-center gap-sm mb-lg">
            <div
                class="w-10 h-10 bg-primary-container rounded-xl flex items-center justify-center text-on-primary-container">
                <span class="material-symbols-outlined" data-icon="task_alt">task_alt</span>
            </div>
            <div>
                <h1 class="font-headline-md text-headline-md text-primary">TaskFlow</h1>
                <p class="font-label-md text-label-md text-on-surface-variant">Productivity Suite</p>
            </div>
        </div>
        <nav class="flex flex-col gap-xs flex-grow">
            <a class="flex items-center gap-sm px-base py-sm text-on-surface-variant hover:bg-surface-variant rounded-xl transition-all font-label-md text-label-md"
                href="#">
                <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                Dashboard
            </a>
            <a class="flex items-center gap-sm px-base py-sm bg-secondary-container text-on-secondary-container rounded-xl font-bold font-label-md text-label-md"
                href="#">
                <span class="material-symbols-outlined" data-icon="checklist">checklist</span>
                My Tasks
            </a>
            <a class="flex items-center gap-sm px-base py-sm text-on-surface-variant hover:bg-surface-variant rounded-xl transition-all font-label-md text-label-md"
                href="#">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
                Settings
            </a>
        </nav>
        <a href="{{ route('dashboard.tasks.create') }}"
            class="bg-primary text-on-primary rounded-xl py-sm px-md font-bold mb-lg flex items-center justify-center gap-sm hover:opacity-90 active:scale-95 transition-all">
            <span class="material-symbols-outlined" data-icon="add">add</span>
            Create Task
    </a>
        <div class="mt-auto flex flex-col gap-xs">
            <a class="flex items-center gap-sm px-base py-sm text-on-surface-variant hover:bg-surface-variant rounded-xl transition-all font-label-md text-label-md"
                href="#">
                <span class="material-symbols-outlined" data-icon="help">help</span>
                Help
            </a>
            <a class="flex items-center gap-sm px-base py-sm text-on-surface-variant hover:bg-surface-variant rounded-xl transition-all font-label-md text-label-md"
                href="#">
                <span class="material-symbols-outlined" data-icon="logout">logout</span>
                Logout
            </a>
        </div>
    </aside>
    <div class="flex-grow flex flex-col min-w-0">
        <!-- TopNavBar -->
        <header
            class="sticky top-0 z-50 bg-surface-container-lowest border-b border-outline-variant/30 px-md md:px-lg h-16 flex items-center justify-between">
            <div class="flex items-center gap-md">
                <button class="lg:hidden p-sm hover:bg-surface-variant rounded-full transition-colors">
                    <span class="material-symbols-outlined" data-icon="menu">menu</span>
                </button>
                <div class="flex items-center gap-sm">
                    <div
                        class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-on-primary md:hidden">
                        <span class="material-symbols-outlined text-[20px]" data-icon="task_alt">task_alt</span>
                    </div>
                    <span class="font-headline-md text-headline-md text-primary hidden md:block">TaskFlow</span>
                </div>
                <div class="hidden md:flex relative ml-lg">
                    <span
                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]"
                        data-icon="search">search</span>
                    <input
                        class="pl-10 pr-4 py-2 bg-surface-container-low rounded-full border border-outline-variant/50 w-64 lg:w-96 text-body-sm focus:ring-2 focus:ring-primary/20 transition-all"
                        placeholder="Search tasks, projects, or team members..." type="text">
                </div>
            </div>
            <div class="flex items-center gap-base md:gap-md">
                <div class="flex items-center border-r border-outline-variant/30 pr-base md:pr-md mr-base md:mr-md">
                    <button
                        class="p-sm text-on-surface-variant hover:bg-surface-variant rounded-full transition-all relative">
                        <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                        <span
                            class="absolute top-2 right-2 w-2 h-2 bg-error rounded-full border-2 border-surface-container-lowest"></span>
                    </button>
                    <button class="p-sm text-on-surface-variant hover:bg-surface-variant rounded-full transition-all">
                        <span class="material-symbols-outlined" data-icon="help">help</span>
                    </button>
                </div>
                <div
                    class="flex items-center gap-sm cursor-pointer hover:bg-surface-variant p-1 rounded-full transition-all group">
                    <div
                        class="w-8 h-8 rounded-full overflow-hidden border-2 border-primary/20 group-hover:border-primary/40 transition-all">
                        <img alt="User avatar" class="w-full h-full object-cover"
                            data-alt="A professional headshot of a person with a friendly expression, set against a soft, out-of-focus modern office background. The lighting is warm and natural, following a bright, light-mode minimalist aesthetic. The image is clean and high-resolution, evoking a sense of corporate competence and approachable professionalism."
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDb8a2GsGI9KejE7n0ExTgQXE2W7l0wYzKIPX2wnoKtd98Vqcg-cP816dzhpPv2FOHo0JJSat_cU0sHk0Kvr_TfZ290swpbpbtdI93tavrAPW51HrtbT3Ph8yutSSEoj3CU0jsxJWovKyt-JqlLBxfg57IxnmNmCXaIVL-LcG3F4FPLG3MzM8-h4T_rZUV9akB0l_teObiBI2vMFjeu35g3tk3J4niMfy2-ItRfEroroTbhDG0RvQp4m3F1XoBBJCsU1hvyAtNKZ8U">
                    </div>
                    <span class="material-symbols-outlined text-outline hidden sm:block"
                        data-icon="keyboard_arrow_down">keyboard_arrow_down</span>
                </div>
            </div>
        </header>
        <!-- Main Content Canvas -->
        <main class="flex-grow p-base md:p-md lg:p-lg max-w-container-max mx-auto w-full">
           {{ $slot }}
        </main>
    </div>
    <!-- BottomNavBar (Mobile Only) -->
    <nav
        class="lg:hidden fixed bottom-0 left-0 w-full z-50 flex justify-around items-center px-base py-sm bg-surface shadow-lg border-t border-outline-variant">
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-1" href="#">
            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
            <span class="font-label-sm text-label-sm">Dashboard</span>
        </a>
        <a class="flex flex-col items-center justify-center bg-primary-container text-on-primary-container rounded-xl px-4 py-1"
            href="#">
            <span class="material-symbols-outlined" data-icon="task_alt">task_alt</span>
            <span class="font-label-sm text-label-sm">Tasks</span>
        </a>
        <a class="flex flex-col items-center justify-center text-on-surface-variant px-4 py-1" href="#">
            <span class="material-symbols-outlined" data-icon="settings">settings</span>
            <span class="font-label-sm text-label-sm">Settings</span>
        </a>
    </nav>
    <script>
        // Simple micro-interactions
        document.querySelectorAll('button, a').forEach(el => {
            el.addEventListener('mousedown', () => el.classList.add('opacity-80'));
            el.addEventListener('mouseup', () => el.classList.remove('opacity-80'));
            el.addEventListener('mouseleave', () => el.classList.remove('opacity-80'));
        });

        // Simple priority selector logic
        const priorityLabels = document.querySelectorAll('input[name="priority"]');
        priorityLabels.forEach(input => {
            input.addEventListener('change', (e) => {
                console.log('Priority changed to:', e.target.nextElementSibling.innerText);
            });
        });
    </script>
</body>
</html>
