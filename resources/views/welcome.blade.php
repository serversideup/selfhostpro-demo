<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Self-Hosted Demo - Self-Host Pro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/github-dark.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Check for saved preference or system preference
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.remove('light');
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        }
    </script>
</head>
<body class="antialiased" style="background-color: var(--ui-bg); color: var(--ui-text);">

    <!-- Sticky Header -->
    <header id="site-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="https://selfhostpro.com" target="_blank" class="flex items-center gap-2">
                    <!-- Light logo (shown when header is over hero OR in dark mode) -->
                    <img
                        id="logo-light"
                        src="/logo-light.svg"
                        alt="Self-Host Pro"
                        class="h-7 w-auto"
                    >
                    <!-- Dark logo (shown on light backgrounds) -->
                    <img
                        id="logo-dark"
                        src="/logo.svg"
                        alt="Self-Host Pro"
                        class="h-7 w-auto hidden"
                    >
                </a>

                <!-- Right side: theme toggle + CTA -->
                <div class="flex items-center gap-3">
                    <!-- Dark mode toggle -->
                    <button
                        id="theme-toggle"
                        class="p-2 rounded-lg transition-colors"
                        aria-label="Toggle dark mode"
                    >
                        <!-- Sun icon (shown in light mode - indicating current sunny state) -->
                        <svg id="icon-sun" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <!-- Moon icon (shown in dark mode - indicating current night state) -->
                        <svg id="icon-moon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- CTA Button -->
                    <a
                        id="header-cta"
                        href="https://app.selfhostpro.com"
                        target="_blank"
                        class="inline-flex items-center rounded-lg px-4 py-2 text-sm font-semibold transition-all active:scale-[0.98]"
                    >
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section (always dark) -->
    <section class="relative overflow-hidden min-h-[640px] md:min-h-[720px] flex items-center justify-center pt-16" style="background-color: #101828;">
        <!-- Canvas animation layer -->
        <canvas id="globe-canvas" class="absolute inset-0 w-full h-full z-0"></canvas>

        <!-- Dot grid overlay -->
        <div
            class="absolute inset-0 z-1 opacity-[0.04]"
            style="background-image: radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1px); background-size: 24px 24px;"
        ></div>

        <!-- Content -->
        <div class="relative z-10 px-6 md:px-8 lg:px-12 xl:px-16 py-12 flex flex-col items-center justify-center gap-8 text-center max-w-4xl mx-auto">
            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-4 py-1.5 text-sm" style="color: rgba(255,251,245,0.6);">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Live Demo Instance
            </div>

            <h1
                class="text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight leading-tight"
                style="color: #fffbf5; letter-spacing: -0.03em;"
            >
                Your Self-Hosted Demo is Live
            </h1>

            <p class="text-lg lg:text-xl max-w-xl leading-relaxed" style="color: rgba(255,251,245,0.55);">
                This app was deployed via Self-Host Pro. It demonstrates database persistence across container restarts.
            </p>

            <div class="flex flex-wrap justify-center gap-3 pt-2">
                <a
                    href="https://app.selfhostpro.com"
                    target="_blank"
                    class="inline-flex items-center gap-2 rounded-lg px-7 py-3 text-sm font-semibold shadow-sm transition-all hover:opacity-90 active:scale-[0.98]"
                    style="background-color: #fffbf5; color: #101828;"
                >
                    Start with Self-Host Pro
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a
                    href="#terminal"
                    class="inline-flex items-center gap-2 rounded-lg border px-7 py-3 text-sm font-semibold transition-all hover:bg-white/10 active:scale-[0.98]"
                    style="border-color: rgba(255,255,255,0.2); color: rgba(255,251,245,0.8);"
                >
                    See How It Works
                </a>
            </div>
        </div>
    </section>

    <!-- What This Demonstrates Section -->
    <section class="py-16 md:py-24 px-6" style="background-color: var(--ui-bg);">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4" style="color: var(--ui-text);">
                    What This Demonstrates
                </h2>
                <p style="color: var(--ui-text-muted);">
                    Key self-hosting patterns powered by Self-Host Pro
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Database Persistence -->
                <div class="rounded-xl p-6 border" style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4 border" style="background-color: var(--ui-bg); border-color: var(--ui-border);">
                        <svg class="w-5 h-5" style="color: var(--ui-text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--ui-text);">Database Persistence</h3>
                    <p class="text-sm leading-relaxed" style="color: var(--ui-text-muted);">
                        Data stored in SQLite survives container restarts. Your customers' data stays safe without complex database setup.
                    </p>
                </div>

                <!-- Environment Configuration -->
                <div class="rounded-xl p-6 border" style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4 border" style="background-color: var(--ui-bg); border-color: var(--ui-border);">
                        <svg class="w-5 h-5" style="color: var(--ui-text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--ui-text);">Environment Configuration</h3>
                    <p class="text-sm leading-relaxed" style="color: var(--ui-text-muted);">
                        App version, settings, and configuration managed through environment variables for easy customization.
                    </p>
                </div>

                <!-- Docker-Ready -->
                <div class="rounded-xl p-6 border" style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4 border" style="background-color: var(--ui-bg); border-color: var(--ui-border);">
                        <svg class="w-5 h-5" style="color: var(--ui-text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2" style="color: var(--ui-text);">Docker-Ready</h3>
                    <p class="text-sm leading-relaxed" style="color: var(--ui-text-muted);">
                        Production-ready patterns for containerized deployment. Works on any server with Docker installed.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Terminal Section -->
    <section id="terminal" class="py-16 md:py-24 px-6" style="background-color: var(--ui-bg);">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4" style="color: var(--ui-text);">
                    Database Persistence
                </h2>
                <p style="color: var(--ui-text-muted);">
                    The data below is stored in SQLite and persists across container restarts.
                </p>
            </div>

            <!-- Terminal mockup -->
            <div class="rounded-xl overflow-hidden border shadow-2xl" style="background: #101828; border-color: rgba(255,255,255,0.1);">
                <!-- Title bar with traffic lights -->
                <div class="flex items-center gap-2 px-4 py-3 border-b" style="border-color: rgba(255,255,255,0.1);">
                    <span class="w-3 h-3 rounded-full" style="background-color: #ef4444;"></span>
                    <span class="w-3 h-3 rounded-full" style="background-color: #fbbf24;"></span>
                    <span class="w-3 h-3 rounded-full" style="background-color: #22c55e;"></span>
                    <span class="ml-4 text-xs font-mono" style="color: rgba(255,255,255,0.4);">terminal</span>
                </div>

                <!-- Terminal content -->
                <div class="p-5 font-mono text-sm leading-relaxed overflow-x-auto">
                    <!-- Command -->
                    <div style="color: rgba(255,255,255,0.7);">
                        <span style="color: rgba(255,255,255,0.4);">$</span> php artisan initialize --force
                    </div>

                    @if($missions->count() > 0)
                    <!-- Output header -->
                    <div class="mt-4" style="color: rgba(255,255,255,0.45);">
                        Seeded {{ $missions->count() }} space missions:
                    </div>

                    <!-- Mission table -->
                    <div class="mt-3 overflow-x-auto">
                        <table class="w-full text-left" style="color: rgba(255,255,255,0.6);">
                            <thead>
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                    <th class="pb-2 pr-6 font-medium" style="color: rgba(255,255,255,0.8);">Mission</th>
                                    <th class="pb-2 pr-6 font-medium" style="color: rgba(255,255,255,0.8);">Destination</th>
                                    <th class="pb-2 pr-6 font-medium" style="color: rgba(255,255,255,0.8);">Year</th>
                                    <th class="pb-2 pr-6 font-medium" style="color: rgba(255,255,255,0.8);">Status</th>
                                    <th class="pb-2 font-medium" style="color: rgba(255,255,255,0.8);">Agency</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($missions as $mission)
                                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                    <td class="py-1.5 pr-6">{{ $mission->mission_name }}</td>
                                    <td class="py-1.5 pr-6">{{ $mission->destination }}</td>
                                    <td class="py-1.5 pr-6">{{ $mission->launch_year }}</td>
                                    <td class="py-1.5 pr-6">
                                        <span class="inline-flex items-center gap-1.5">
                                            @if($mission->status === 'active')
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                            @elseif($mission->status === 'completed')
                                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                            @else
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                            @endif
                                            {{ $mission->status }}
                                        </span>
                                    </td>
                                    <td class="py-1.5">{{ $mission->agency }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Timestamp -->
                    <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.35);">
                        Logged at: {{ $missions->first()->logged_at->format('Y-m-d H:i:s T') }}
                    </div>
                    @else
                    <div class="mt-4" style="color: rgba(255,255,255,0.45);">
                        No missions seeded yet. Run: <span style="color: rgba(255,255,255,0.7);">php artisan initialize --force</span>
                    </div>
                    @endif

                    <!-- Persistence message -->
                    <div class="mt-4 flex items-center gap-2" style="color: #22c55e;">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        Restart the container - your data will still be here
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CI/CD Pipeline Section -->
    <section id="cicd" class="py-16 md:py-24 px-6" style="background-color: var(--ui-bg);">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4" style="color: var(--ui-text);">
                    Automated Image Builds with GitHub Actions
                </h2>
                <p class="max-w-2xl mx-auto" style="color: var(--ui-text-muted);">
                    Three simple workflow files trigger one reusable build pipeline. Push to main, create a prerelease, or publish a release — your Docker image is automatically built and pushed to Self-Host Pro.
                </p>
            </div>

            <!-- Release Strategy Cards -->
            <div class="grid md:grid-cols-3 gap-4 mb-10">
                <!-- Stable -->
                <button
                    onclick="showWorkflow('stable')"
                    id="btn-stable"
                    class="workflow-btn text-left rounded-xl p-5 border transition-all hover:border-orange-500/50"
                    style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);"
                >
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(59, 130, 246, 0.1);">
                            <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold" style="color: var(--ui-text);">Stable</h3>
                    </div>
                    <p class="text-sm mb-3" style="color: var(--ui-text-muted);">
                        Builds on GitHub release
                    </p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="px-2 py-0.5 rounded text-xs font-mono" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">latest</span>
                        <span class="px-2 py-0.5 rounded text-xs font-mono" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">1.2.0</span>
                        <span class="px-2 py-0.5 rounded text-xs font-mono" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">1</span>
                    </div>
                </button>

                <!-- Pre-release -->
                <button
                    onclick="showWorkflow('prerelease')"
                    id="btn-prerelease"
                    class="workflow-btn text-left rounded-xl p-5 border transition-all hover:border-orange-500/50"
                    style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);"
                >
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(251, 191, 36, 0.1);">
                            <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold" style="color: var(--ui-text);">Pre-release</h3>
                    </div>
                    <p class="text-sm mb-3" style="color: var(--ui-text-muted);">
                        Builds on GitHub prerelease
                    </p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="px-2 py-0.5 rounded text-xs font-mono" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">prerelease</span>
                        <span class="px-2 py-0.5 rounded text-xs font-mono" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">prerelease-v1.0.0-beta</span>
                    </div>
                </button>

                <!-- Edge -->
                <button
                    onclick="showWorkflow('edge')"
                    id="btn-edge"
                    class="workflow-btn text-left rounded-xl p-5 border transition-all hover:border-orange-500/50"
                    style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);"
                >
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(34, 197, 94, 0.1);">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="font-semibold" style="color: var(--ui-text);">Edge</h3>
                    </div>
                    <p class="text-sm mb-3" style="color: var(--ui-text-muted);">
                        Builds on every push to <code class="px-1.5 py-0.5 rounded text-xs" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">main</code>
                    </p>
                    <div class="flex flex-wrap gap-1.5">
                        <span class="px-2 py-0.5 rounded text-xs font-mono" style="background-color: var(--ui-bg); color: var(--ui-text-dimmed);">edge-main</span>
                    </div>
                </button>
            </div>

            <!-- Code Preview with Tabs -->
            <div class="rounded-xl overflow-hidden border" style="background: #0d1117; border-color: var(--ui-border);">
                <!-- Tab bar -->
                <div class="flex items-center border-b" style="border-color: rgba(255,255,255,0.1);">
                    <button
                        id="tab-trigger"
                        onclick="showTab('trigger')"
                        class="code-tab px-4 py-2.5 text-xs font-medium transition-colors border-b-2"
                        style="color: #CA6C33; border-color: #CA6C33; background-color: rgba(202, 108, 51, 0.1);"
                    >
                        <span id="tab-trigger-label">action_stable-release.yml</span>
                    </button>
                    <button
                        id="tab-build"
                        onclick="showTab('build')"
                        class="code-tab px-4 py-2.5 text-xs font-medium transition-colors border-b-2"
                        style="color: rgba(255,255,255,0.5); border-color: transparent;"
                    >
                        service_docker-build-and-publish.yml
                    </button>
                </div>

                <!-- Code content - Trigger -->
                <div id="code-trigger" class="overflow-x-auto">
                    <pre class="!m-0 !p-5 !bg-transparent text-sm"><code id="workflow-code" class="language-yaml">{{ file_get_contents(base_path('.github/workflows/action_stable-release.yml')) }}</code></pre>
                </div>

                <!-- Code content - Build Pipeline (hidden by default) -->
                <div id="code-build" class="overflow-x-auto hidden">
                    <pre class="!m-0 !p-5 !bg-transparent text-sm"><code id="build-code" class="language-yaml">{{ file_get_contents(base_path('.github/workflows/service_docker-build-and-publish.yml')) }}</code></pre>
                </div>
            </div>

            <!-- Key insight -->
            <div class="mt-6 flex items-start gap-3 p-4 rounded-lg border" style="background-color: var(--ui-bg-elevated); border-color: var(--ui-border);">
                <svg class="w-5 h-5 mt-0.5 shrink-0" style="color: #CA6C33;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm" style="color: var(--ui-text-muted);">
                    <strong style="color: var(--ui-text);">One reusable workflow, three triggers.</strong>
                    Each release strategy is just ~20 lines that pass different tags to the shared build logic. Add version gating, beta channels, or custom environments by copying a trigger file.
                </p>
            </div>
        </div>
    </section>

    <!-- Final CTA Section (always dark) -->
    <section class="relative overflow-hidden py-20 md:py-28 px-6" style="background-color: #101828;">
        <!-- Dot grid overlay -->
        <div
            class="absolute inset-0 z-0 opacity-[0.04]"
            style="background-image: radial-gradient(circle, rgba(255,255,255,0.9) 1px, transparent 1px); background-size: 24px 24px;"
        ></div>

        <div class="relative z-10 max-w-3xl mx-auto text-center">
            <h2
                class="text-3xl md:text-4xl font-semibold mb-6 tracking-tight"
                style="color: #fffbf5; letter-spacing: -0.02em;"
            >
                Ready to sell your own self-hosted software?
            </h2>

            <p class="text-lg mb-8 max-w-xl mx-auto" style="color: rgba(255,251,245,0.55);">
                Push your Docker image, connect Stripe, and let your customers install with a single command.
            </p>

            <div class="flex flex-wrap justify-center gap-4">
                <a
                    href="https://app.selfhostpro.com"
                    target="_blank"
                    class="inline-flex items-center gap-2 rounded-lg px-8 py-3.5 text-sm font-semibold shadow-sm transition-all hover:opacity-90 active:scale-[0.98]"
                    style="background-color: #fffbf5; color: #101828;"
                >
                    Get Started with Self-Host Pro
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a
                    href="https://github.com/selfhostpro/demo-app"
                    target="_blank"
                    class="inline-flex items-center gap-2 rounded-lg border px-8 py-3.5 text-sm font-semibold transition-all hover:bg-white/10 active:scale-[0.98]"
                    style="border-color: rgba(255,255,255,0.2); color: rgba(255,251,245,0.8);"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                    View this app on GitHub
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 px-6 border-t" style="background-color: var(--ui-bg); border-color: var(--ui-border);">
        <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-sm" style="color: var(--ui-text-muted);">
            <p>
                Powered by <a href="https://selfhostpro.com" target="_blank" class="hover:underline" style="color: #CA6C33;">Self-Host Pro</a>
            </p>
            <p>
                Version {{ $systemInfo['version'] }} &middot; PHP {{ $systemInfo['php_version'] }}
            </p>
        </div>
    </footer>

    <!-- Highlight.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/yaml.min.js"></script>

    <script>
        // ─────────────────────────────────────────────────────────────
        // Header scroll behavior & theme management
        // ─────────────────────────────────────────────────────────────
        const header = document.getElementById('site-header');
        const logoLight = document.getElementById('logo-light');
        const logoDark = document.getElementById('logo-dark');
        const themeToggle = document.getElementById('theme-toggle');
        const iconSun = document.getElementById('icon-sun');
        const iconMoon = document.getElementById('icon-moon');
        const headerCta = document.getElementById('header-cta');

        let isOverHero = true;
        let scrolled = false;

        function updateHeaderStyle() {
            const isDark = document.documentElement.classList.contains('dark');

            if (isOverHero) {
                // Over hero section - always transparent with light text
                header.style.backgroundColor = 'transparent';
                header.style.borderBottom = '1px solid transparent';
                logoLight.classList.remove('hidden');
                logoDark.classList.add('hidden');
                themeToggle.style.color = 'rgba(255,255,255,0.7)';
                headerCta.style.backgroundColor = '#fffbf5';
                headerCta.style.color = '#101828';
            } else {
                // Scrolled past hero - solid background
                if (isDark) {
                    header.style.backgroundColor = 'var(--ui-bg)';
                    header.style.borderBottom = '1px solid var(--ui-border)';
                    logoLight.classList.remove('hidden');
                    logoDark.classList.add('hidden');
                    themeToggle.style.color = 'var(--ui-text-muted)';
                    headerCta.style.backgroundColor = '#F0F1F1';
                    headerCta.style.color = '#0C111D';
                } else {
                    header.style.backgroundColor = 'var(--ui-bg)';
                    header.style.borderBottom = '1px solid var(--ui-border)';
                    logoLight.classList.add('hidden');
                    logoDark.classList.remove('hidden');
                    themeToggle.style.color = 'var(--ui-text-muted)';
                    headerCta.style.backgroundColor = '#101828';
                    headerCta.style.color = '#fffbf5';
                }
            }
        }

        function updateThemeIcons() {
            const isDark = document.documentElement.classList.contains('dark');
            if (isDark) {
                iconSun.classList.add('hidden');
                iconMoon.classList.remove('hidden');
            } else {
                iconSun.classList.remove('hidden');
                iconMoon.classList.add('hidden');
            }
        }

        // Scroll handler
        function onScroll() {
            const heroHeight = document.querySelector('section').offsetHeight;
            isOverHero = window.scrollY < heroHeight - 64;
            scrolled = window.scrollY > 10;
            updateHeaderStyle();
        }

        window.addEventListener('scroll', onScroll, { passive: true });

        // Theme toggle
        themeToggle.addEventListener('click', function() {
            const html = document.documentElement;
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                html.classList.add('light');
                localStorage.theme = 'light';
            } else {
                html.classList.remove('light');
                html.classList.add('dark');
                localStorage.theme = 'dark';
            }
            updateThemeIcons();
            updateHeaderStyle();
        });

        // ─────────────────────────────────────────────────────────────
        // Workflow code viewer
        // ─────────────────────────────────────────────────────────────
        const workflows = {
            edge: {
                filename: 'action_edge.yml',
                content: @json(file_get_contents(base_path('.github/workflows/action_edge.yml')))
            },
            prerelease: {
                filename: 'action_prerelease.yml',
                content: @json(file_get_contents(base_path('.github/workflows/action_prerelease.yml')))
            },
            stable: {
                filename: 'action_stable-release.yml',
                content: @json(file_get_contents(base_path('.github/workflows/action_stable-release.yml')))
            }
        };

        let activeWorkflow = 'stable';
        let activeTab = 'trigger';

        function showWorkflow(type) {
            activeWorkflow = type;
            const workflow = workflows[type];

            const codeEl = document.getElementById('workflow-code');
            codeEl.textContent = workflow.content;
            codeEl.removeAttribute('data-highlighted');
            hljs.highlightElement(codeEl);

            document.getElementById('tab-trigger-label').textContent = workflow.filename;

            document.querySelectorAll('.workflow-btn').forEach(btn => {
                btn.style.borderColor = 'var(--ui-border)';
            });
            document.getElementById('btn-' + type).style.borderColor = '#CA6C33';

            showTab('trigger');
        }

        function showTab(tab) {
            activeTab = tab;

            const triggerTab = document.getElementById('tab-trigger');
            const buildTab = document.getElementById('tab-build');
            const triggerCode = document.getElementById('code-trigger');
            const buildCode = document.getElementById('code-build');

            if (tab === 'trigger') {
                triggerTab.style.color = '#CA6C33';
                triggerTab.style.borderColor = '#CA6C33';
                triggerTab.style.backgroundColor = 'rgba(202, 108, 51, 0.1)';
                buildTab.style.color = 'rgba(255,255,255,0.5)';
                buildTab.style.borderColor = 'transparent';
                buildTab.style.backgroundColor = 'transparent';
                triggerCode.classList.remove('hidden');
                buildCode.classList.add('hidden');
            } else {
                buildTab.style.color = '#CA6C33';
                buildTab.style.borderColor = '#CA6C33';
                buildTab.style.backgroundColor = 'rgba(202, 108, 51, 0.1)';
                triggerTab.style.color = 'rgba(255,255,255,0.5)';
                triggerTab.style.borderColor = 'transparent';
                triggerTab.style.backgroundColor = 'transparent';
                triggerCode.classList.add('hidden');
                buildCode.classList.remove('hidden');
            }
        }

        // ─────────────────────────────────────────────────────────────
        // Initialize
        // ─────────────────────────────────────────────────────────────
        document.addEventListener('DOMContentLoaded', function() {
            hljs.highlightAll();
            showWorkflow('stable');
            updateThemeIcons();
            updateHeaderStyle();
            onScroll();
        });
    </script>

</body>
</html>
