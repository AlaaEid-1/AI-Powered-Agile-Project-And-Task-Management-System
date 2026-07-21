<!DOCTYPE html>
<html class="light h-full bg-slate-50 text-slate-800" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title ?? 'TaskFlow - Modern Project & Task Management' }}</title>

    <!-- Tailwind CDN + Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

    <!-- Pusher JS SDK -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- Fonts: Inter & Material Symbols -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            900: '#312e81',
                        }
                    },
                    boxShadow: {
                        'soft-xs': '0 1px 2px 0 rgba(0, 0, 0, 0.03)',
                        'soft-sm': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05)',
                        'soft-md': '0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -2px rgba(0, 0, 0, 0.04)',
                        'soft-lg': '0 10px 15px -3px rgba(0, 0, 0, 0.07), 0 4px 6px -4px rgba(0, 0, 0, 0.04)',
                        'glow': '0 0 15px rgba(79, 70, 229, 0.15)',
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Custom Scrollbar for Kanban Columns & Backlog */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        /* Drag & Drop Effects */
        .dragging {
            opacity: 0.4 !important;
            transform: scale(0.98);
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
        }
        .drop-target-active {
            background-color: rgba(238, 242, 255, 0.6) !important;
            border-style: dashed !important;
            border-color: #6366f1 !important;
            box-shadow: inset 0 0 12px rgba(99, 102, 241, 0.08);
        }
        .drop-target-over {
            background-color: rgba(224, 231, 255, 0.8) !important;
            border-color: #4f46e5 !important;
            transform: scale(1.002);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased min-h-screen flex flex-col lg:flex-row">

    <!-- Mobile Navigation Drawer Overlay -->
    <div id="mobile-sidebar-backdrop" onclick="toggleMobileSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-40 hidden lg:hidden transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed lg:sticky top-0 left-0 z-50 h-screen w-64 bg-white border-r border-slate-200/80 flex flex-col justify-between p-4 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out">
        <div class="flex flex-col gap-6">
            <!-- App Logo Header -->
            <div class="flex items-center justify-between px-2 pt-1">
                <a href="{{ route('dashboard.projects.index') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 bg-gradient-to-tr from-brand-600 to-indigo-500 rounded-xl flex items-center justify-center text-white shadow-md shadow-brand-500/20 group-hover:scale-105 transition-transform">
                        <span class="material-symbols-outlined text-[22px]">auto_awesome_motion</span>
                    </div>
                    <div>
                        <span class="font-bold text-lg tracking-tight text-slate-900 group-hover:text-brand-600 transition-colors">TaskFlow</span>
                        <span class="block text-[11px] font-medium text-slate-400 -mt-1 tracking-wider uppercase">Linear Agile</span>
                    </div>
                </a>
                <button onclick="toggleMobileSidebar()" class="lg:hidden p-1 text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Workspace Selector Badge -->
            @isset($project)
                <div class="bg-slate-50 border border-slate-200/70 rounded-xl p-2.5 flex items-center justify-between">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-7 h-7 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center shrink-0 font-bold text-xs">
                            {{ strtoupper(substr($project->title, 0, 2)) }}
                        </div>
                        <div class="truncate">
                            <p class="text-xs font-semibold text-slate-800 truncate">{{ $project->title }}</p>
                            <p class="text-[10px] text-slate-400">Active Project</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.projects.index') }}" class="text-slate-400 hover:text-slate-600" title="Switch Project">
                        <span class="material-symbols-outlined text-[18px]">unfold_more</span>
                    </a>
                </div>
            @endisset

            <!-- Quick Action: Create Task -->
            @isset($project)
                <a href="{{ route('dashboard.projects.tasks.create', $project) }}"
                    class="w-full bg-brand-600 hover:bg-brand-700 text-white font-medium rounded-xl py-2.5 px-4 shadow-sm shadow-brand-500/20 hover:shadow-md hover:shadow-brand-500/30 flex items-center justify-center gap-2 transition-all active:scale-[0.98]">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    <span class="text-sm">Create Task</span>
                </a>
            @endisset

            <!-- Main Navigation Links -->
            <nav class="flex flex-col gap-1">
                <div class="px-3 text-[11px] font-semibold tracking-wider text-slate-400 uppercase mb-1">Navigation</div>

                <a class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard.projects.index') ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                    href="{{ route('dashboard.projects.index') }}">
                    <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('dashboard.projects.index') ? 'filled text-brand-600' : '' }}">folder_open</span>
                    Projects
                </a>

                @isset($project)
                    <a class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard.projects.show') ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                        href="{{ route('dashboard.projects.show', $project) }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('dashboard.projects.show') ? 'filled text-brand-600' : '' }}">view_kanban</span>
                        Project Board
                    </a>

                    <a class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard.projects.sprints.*') ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                        href="{{ route('dashboard.projects.sprints.index', $project) }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('dashboard.projects.sprints.*') ? 'filled text-brand-600' : '' }}">bolt</span>
                        Sprints & Backlog
                    </a>

                    <a class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('dashboard.projects.tasks.*') ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}"
                        href="{{ route('dashboard.projects.tasks.index', $project) }}">
                        <span class="material-symbols-outlined text-[20px] {{ request()->routeIs('dashboard.projects.tasks.*') ? 'filled text-brand-600' : '' }}">format_list_bulleted</span>
                        All Tasks
                    </a>
                @endisset
            </nav>
        </div>

        <!-- Sidebar Bottom Footer -->
        <div class="pt-4 border-t border-slate-100 flex flex-col gap-1">
            <div class="px-3 py-2 flex items-center gap-3 text-xs text-slate-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="font-medium">TaskFlow Live v2.5</span>
            </div>
        </div>
    </aside>

    <!-- Main Right Content Wrap -->
    <div class="flex-grow flex flex-col min-w-0">

        <!-- Top Header Navigation Bar -->
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-slate-200/80 px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <button onclick="toggleMobileSidebar()" class="lg:hidden p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-[22px]">menu</span>
                </button>

                <!-- Breadcrumbs -->
                <div class="flex items-center gap-2 text-sm text-slate-500 truncate">
                    <a href="{{ route('dashboard.projects.index') }}" class="hover:text-brand-600 transition-colors font-medium">Dashboard</a>
                    @isset($project)
                        <span class="material-symbols-outlined text-[16px] text-slate-300">chevron_right</span>
                        <a href="{{ route('dashboard.projects.show', $project) }}" class="hover:text-brand-600 transition-colors font-medium truncate max-w-[150px] sm:max-w-none">
                            {{ $project->title }}
                        </a>
                    @endisset
                </div>
            </div>

            <!-- Header Right: Search & User Profile -->
            <div class="flex items-center gap-3">
                <!-- Search Box -->
                <div class="relative hidden sm:block">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-[18px]">search</span>
                    <input id="task-search-input"
                           class="pl-9 pr-8 py-1.5 bg-slate-100/80 hover:bg-slate-100 focus:bg-white border border-slate-200 focus:border-brand-500 rounded-xl w-48 lg:w-72 text-xs transition-all focus:outline-none focus:ring-2 focus:ring-brand-500/20"
                           placeholder="Search tasks..." type="text" autocomplete="off">
                    <kbd class="absolute right-2.5 top-1/2 -translate-y-1/2 px-1.5 py-0.5 text-[10px] font-mono font-medium text-slate-400 bg-white border border-slate-200 rounded shadow-xs">⌘K</kbd>

                    <!-- Search Results Dropdown -->
                    <div id="task-search-results"
                         class="hidden absolute left-0 right-0 mt-2 bg-white rounded-2xl shadow-soft-lg border border-slate-200/90 z-50 overflow-hidden max-h-80 overflow-y-auto custom-scrollbar">
                    </div>
                </div>

                <!-- Notification Bell & Interactive Dropdown -->
                @auth
                    @php
                        $unreadNotificationsCount = auth()->user()->unreadNotifications->count();
                        $recentNotifications = auth()->user()->notifications()->take(8)->get();
                    @endphp
                    <div class="relative">
                        <button onclick="toggleNotificationDropdown()"
                                class="p-2 text-slate-500 hover:text-slate-800 hover:bg-slate-100 rounded-xl transition-all relative focus:outline-none"
                                title="Notifications">
                            <span class="material-symbols-outlined text-[20px]">notifications</span>
                            <span id="notification-badge" class="absolute top-1 right-1 px-1.5 py-0.5 text-[10px] font-bold bg-brand-600 text-white rounded-full leading-none shadow-sm {{ $unreadNotificationsCount > 0 ? '' : 'hidden' }}">
                                <span id="unread-count-text">{{ $unreadNotificationsCount > 9 ? '9+' : ($unreadNotificationsCount ?: '0') }}</span>
                            </span>
                        </button>

                        <div id="notification-dropdown"
                             class="hidden absolute right-0 mt-2 w-80 sm:w-96 bg-white rounded-2xl shadow-soft-lg border border-slate-200/90 z-50 overflow-hidden">
                            <div class="p-3 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="font-bold text-xs text-slate-800 uppercase tracking-wider">Notifications</span>
                                    <span id="header-unread-label" class="px-2 py-0.5 text-[10px] font-bold bg-brand-100 text-brand-700 rounded-full {{ $unreadNotificationsCount > 0 ? '' : 'hidden' }}">
                                        {{ $unreadNotificationsCount }} unread
                                    </span>
                                </div>
                                @if($unreadNotificationsCount > 0)
                                    <form action="{{ route('dashboard.notifications.readAll') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-[11px] font-semibold text-brand-600 hover:text-brand-700">
                                            Mark all read
                                        </button>
                                    </form>
                                @endif
                            </div>

                            <div id="notifications-list-container" class="max-h-80 overflow-y-auto custom-scrollbar divide-y divide-slate-100">
                                @forelse($recentNotifications as $notif)
                                    <div class="p-3 hover:bg-slate-50 transition-colors flex items-start justify-between gap-3 {{ is_null($notif->read_at) ? 'bg-brand-50/30' : '' }}">
                                        <div class="flex-grow min-w-0">
                                            <p class="text-xs font-semibold text-slate-800 truncate">
                                                {{ $notif->data['title'] ?? 'Notification' }}
                                            </p>
                                            <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                                                {{ $notif->data['message'] ?? '' }}
                                            </p>
                                            <span class="text-[10px] text-slate-400 mt-1 block">
                                                {{ $notif->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        @if(is_null($notif->read_at))
                                            <form action="{{ route('dashboard.notifications.read', $notif->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-slate-400 hover:text-brand-600 p-1" title="Mark as read">
                                                    <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @empty
                                    <div id="notifications-empty-state" class="p-6 text-center text-slate-400">
                                        <span class="material-symbols-outlined text-2xl text-slate-300 mb-1">notifications_off</span>
                                        <p class="text-xs font-medium">No notifications yet</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endauth

                <div class="h-6 w-[1px] bg-slate-200 mx-1"></div>

                <!-- User Menu Blade Component -->
                <div class="flex items-center">
                    <x-user-menu />
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-grow p-4 sm:p-6 lg:p-8 max-w-[1600px] w-full mx-auto">
            {{ $slot }}
        </main>
    </div>

    <!-- Floating Toast Notification Container -->
    <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

    <!-- Mobile Bottom Navigation Bar -->
    <nav class="lg:hidden sticky bottom-0 left-0 w-full z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 flex justify-around items-center px-2 py-2 shadow-lg">
        <a class="flex flex-col items-center justify-center p-1 text-xs font-medium {{ request()->routeIs('dashboard.projects.index') ? 'text-brand-600' : 'text-slate-500' }}"
            href="{{ route('dashboard.projects.index') }}">
            <span class="material-symbols-outlined text-[22px]">folder_open</span>
            <span>Projects</span>
        </a>
        @isset($project)
            <a class="flex flex-col items-center justify-center p-1 text-xs font-medium {{ request()->routeIs('dashboard.projects.show') ? 'text-brand-600' : 'text-slate-500' }}"
                href="{{ route('dashboard.projects.show', $project) }}">
                <span class="material-symbols-outlined text-[22px]">view_kanban</span>
                <span>Board</span>
            </a>
            <a class="flex flex-col items-center justify-center p-1 text-xs font-medium {{ request()->routeIs('dashboard.projects.sprints.*') ? 'text-brand-600' : 'text-slate-500' }}"
                href="{{ route('dashboard.projects.sprints.index', $project) }}">
                <span class="material-symbols-outlined text-[22px]">bolt</span>
                <span>Sprints</span>
            </a>
        @endisset
    </nav>

    <!-- Global Helper Scripts (Mobile sidebar, Toast system, Search & Pusher Live Notifications) -->
    <script>
        function toggleNotificationDropdown() {
            const dropdown = document.getElementById('notification-dropdown');
            if (dropdown) dropdown.classList.toggle('hidden');
        }

        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-xl shadow-soft-lg text-xs font-medium transition-all duration-300 transform translate-y-4 opacity-0 ${
                type === 'success'
                    ? 'bg-slate-900 text-white border border-slate-800'
                    : 'bg-rose-900 text-white border border-rose-800'
            }`;

            const icon = type === 'success' ? 'check_circle' : 'error';
            const iconColor = type === 'success' ? 'text-emerald-400' : 'text-rose-400';

            toast.innerHTML = `
                <span class="material-symbols-outlined text-[18px] ${iconColor}">${icon}</span>
                <span>${message}</span>
            `;

            container.appendChild(toast);

            // Animate in
            requestAnimationFrame(() => {
                toast.classList.remove('translate-y-4', 'opacity-0');
            });

            // Auto dismiss after 3 seconds
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // --- Task Search JavaScript ---
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('task-search-input');
            const searchResults = document.getElementById('task-search-results');
            let searchDebounceTimer = null;

            if (searchInput && searchResults) {
                searchInput.addEventListener('input', function () {
                    const query = this.value.trim();
                    clearTimeout(searchDebounceTimer);

                    if (query.length < 2) {
                        searchResults.classList.add('hidden');
                        searchResults.innerHTML = '';
                        return;
                    }

                    searchDebounceTimer = setTimeout(() => {
                        fetch(`{{ route('dashboard.search.tasks') }}?q=${encodeURIComponent(query)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(tasks => {
                            searchResults.innerHTML = '';

                            if (!tasks || tasks.length === 0) {
                                searchResults.innerHTML = `
                                    <div class="p-4 text-center text-slate-400 text-xs">
                                        No tasks found matching "${query}"
                                    </div>
                                `;
                            } else {
                                const list = document.createElement('div');
                                list.className = 'divide-y divide-slate-100';

                                tasks.forEach(task => {
                                    const item = document.createElement('a');
                                    item.href = task.url;
                                    item.className = 'p-3 hover:bg-slate-50 transition-colors flex items-center justify-between gap-3 block';

                                    const statusColors = {
                                        'todo': 'bg-slate-100 text-slate-700',
                                        'in_progress': 'bg-blue-100 text-blue-700',
                                        'done': 'bg-emerald-100 text-emerald-700'
                                    };
                                    const statusClass = statusColors[task.status] || 'bg-slate-100 text-slate-700';

                                    item.innerHTML = `
                                        <div class="min-w-0 flex-grow">
                                            <div class="text-xs font-semibold text-slate-800 truncate">${task.title}</div>
                                            <div class="text-[10px] text-slate-400 mt-0.5 flex items-center gap-1.5">
                                                <span>${task.project_title}</span>
                                            </div>
                                        </div>
                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full ${statusClass} uppercase shrink-0">
                                            ${task.status.replace('_', ' ')}
                                        </span>
                                    `;
                                    list.appendChild(item);
                                });

                                searchResults.appendChild(list);
                            }
                            searchResults.classList.remove('hidden');
                        })
                        .catch(err => {
                            console.error('Search error:', err);
                        });
                    }, 250);
                });

                // Close search dropdown on click outside or Escape key
                document.addEventListener('click', function (e) {
                    if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                        searchResults.classList.add('hidden');
                    }
                });

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        searchResults.classList.add('hidden');
                    }
                    if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
                        e.preventDefault();
                        searchInput.focus();
                    }
                });
            }
        });

        // --- Real-time Pusher Live Notifications ---
        @auth
            @php
                $userAccessibleProjects = auth()->user()->ownedProjects->pluck('id')
                    ->merge(auth()->user()->projects->pluck('id'))
                    ->unique()
                    ->values();
            @endphp

            const pusherAppKey = "{{ config('broadcasting.connections.pusher.key') }}";
            const pusherCluster = "{{ config('broadcasting.connections.pusher.options.cluster', 'mt1') }}";
            const userProjects = @json($userAccessibleProjects);
            const currentUserId = {{ auth()->id() }};

            if (pusherAppKey && window.Pusher && userProjects.length > 0) {
                const pusher = new Pusher(pusherAppKey, {
                    cluster: pusherCluster,
                    authEndpoint: '/broadcasting/auth',
                    auth: {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }
                });

                function handleIncomingNotification(data) {
                    // Show real-time Toast Notification
                    showToast(data.message, 'success');

                    // Update navbar notification badge
                    const badge = document.getElementById('notification-badge');
                    const badgeText = document.getElementById('unread-count-text');
                    const headerUnreadLabel = document.getElementById('header-unread-label');

                    if (badgeText) {
                        let currentCount = parseInt(badgeText.innerText) || 0;
                        currentCount++;
                        badgeText.innerText = currentCount > 9 ? '9+' : currentCount;
                        if (headerUnreadLabel) {
                            headerUnreadLabel.innerText = `${currentCount} unread`;
                            headerUnreadLabel.classList.remove('hidden');
                        }
                    }

                    if (badge) {
                        badge.classList.remove('hidden');
                    }

                    // Add to notification dropdown list
                    const notifContainer = document.getElementById('notifications-list-container');
                    const emptyState = document.getElementById('notifications-empty-state');
                    if (emptyState) emptyState.remove();

                    if (notifContainer) {
                        const newItem = document.createElement('div');
                        newItem.className = 'p-3 hover:bg-slate-50 transition-colors flex items-start justify-between gap-3 bg-brand-50/40';
                        newItem.innerHTML = `
                            <div class="flex-grow min-w-0">
                                <p class="text-xs font-semibold text-slate-800 truncate">
                                    ${data.title || 'Notification'}
                                </p>
                                <p class="text-[11px] text-slate-600 mt-0.5 leading-relaxed">
                                    ${data.message || ''}
                                </p>
                                <span class="text-[10px] text-brand-600 font-medium mt-1 block">
                                    Just now
                                </span>
                            </div>
                        `;
                        notifContainer.prepend(newItem);
                    }

                    // Dispatch global event for other components (e.g. Kanban board) to update DOM dynamically
                    const eventName = data.action_type === 'created' ? 'task:created' : 'task:updated';
                    window.dispatchEvent(new CustomEvent(eventName, { detail: data }));
                }

                userProjects.forEach(projectId => {
                    const channel = pusher.subscribe('private-project.' + projectId);

                    const listener = function(data) {
                        if (data.actor_id != currentUserId) {
                            handleIncomingNotification(data);
                        }
                    };

                    channel.bind('TaskCreated', listener);
                    channel.bind('.TaskCreated', listener);
                    channel.bind('TaskUpdated', listener);
                    channel.bind('.TaskUpdated', listener);
                });
            }
        @endauth
    </script>
</body>
</html>
