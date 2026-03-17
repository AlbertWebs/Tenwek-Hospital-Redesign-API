<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tenwek Hospital') — Cardiothoracic Centre</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
    <style>
        html { scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }
        .nav-dropdown:hover .nav-dropdown-panel { opacity: 1; visibility: visible; }
        .nav-mega:hover .nav-mega-panel { opacity: 1; visibility: visible; }
        .nav-main a, .nav-main button { white-space: nowrap; }
        .nav-main > * { flex-shrink: 0; }
        .nav-mega-panel { min-width: 0; max-width: min(90vw, 800px); }
        .nav-mega-panel.nav-mega-panel--ctc { width: 700px; }
        .nav-mega-panel.nav-mega-panel--services { width: 580px; }
        .nav-mega-panel .mega-grid { display: grid; gap: 1rem 1.5rem; }
        .nav-mega-panel .mega-grid.cols-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        .nav-mega-panel .mega-grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .nav-mega-panel .mega-col { min-width: 0; }
        .nav-mega-panel .mega-col a { display: block; white-space: normal; overflow-wrap: break-word; word-break: break-word; padding: 0.25rem 0; }
    </style>
    @stack('styles')
</head>
<body id="top" class="min-h-screen flex flex-col bg-slate-50 text-slate-800 font-sans antialiased">
    {{-- Back to top: fixed to viewport so always visible --}}
    <a href="#top" class="fixed bottom-6 right-6 z-[100] flex items-center justify-center w-12 h-12 rounded-lg bg-teal-600 text-white shadow-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors" style="position: fixed;" aria-label="Back to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </a>
    {{-- Top bar: Ambulance booking --}}
    <div class="bg-teal-700 text-white text-center py-2 px-4 text-sm">
        <span>To book our ambulance, contact the Tenwek Hospital Coverage team on</span>
        <a href="tel:+254727033725" class="font-semibold hover:underline ml-1 whitespace-nowrap">0727 033 725</a>.
    </div>
    {{-- Header: two-row approach (logo row + main nav row), Donate & Contact in upper row --}}
    <header class="sticky top-0 z-50 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Upper row: social (left), logo (center), Donate & Contact (right) --}}
            <div class="hidden lg:flex items-center justify-between py-3 border-b border-slate-100">
                <div class="flex items-center gap-4 w-1/3 justify-start">
                    <a href="https://twitter.com/tenwekhospital" target="_blank" rel="noopener noreferrer" class="text-slate-600 hover:text-teal-600" aria-label="Twitter"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg></a>
                    <a href="https://www.facebook.com/tenwekhospital" target="_blank" rel="noopener noreferrer" class="text-slate-600 hover:text-teal-600" aria-label="Facebook"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                    <a href="https://www.youtube.com/tenwekhospital" target="_blank" rel="noopener noreferrer" class="text-slate-600 hover:text-teal-600" aria-label="YouTube"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>
                    <a href="https://www.instagram.com/tenwekhospital" target="_blank" rel="noopener noreferrer" class="text-slate-600 hover:text-teal-600" aria-label="Instagram"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.766 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.766-2.618 6.98-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg></a>
                </div>
                <a href="{{ route('home') }}" class="flex flex-col items-center w-1/3 shrink-0">
                    <span class="text-xl font-semibold text-teal-700 tracking-tight">Tenwek Hospital</span>
                    <span class="text-xs text-slate-500 mt-0.5">We Treat ~ Jesus Heals</span>
                </a>
                <div class="flex items-center gap-6 w-1/3 justify-end text-sm font-medium text-slate-700">
                    <a href="{{ route('contact.index') }}#donate" class="hover:text-teal-600">Donate</a>
                    <a href="{{ route('volunteers') }}" class="hover:text-teal-600">Volunteers</a>
                    <a href="{{ route('community.index') }}#spiritual" class="hover:text-teal-600">Spiritual Ministry</a>
                    <a href="{{ route('contact.index') }}" class="hover:text-teal-600">Contacts</a>
                </div>
            </div>
            {{-- Lower row: main nav centered (desktop); mobile logo left, hamburger right --}}
            <div class="flex items-center h-14 lg:h-12">
                <div class="flex-1 flex items-center lg:min-w-0">
                    <a href="{{ route('home') }}" class="lg:hidden flex items-center gap-2 shrink-0">
                        <span class="text-lg font-semibold text-teal-700">Tenwek Hospital</span>
                    </a>
                </div>

                {{-- Desktop nav: centered, items stay on one line --}}
                <nav class="nav-main hidden lg:flex items-center justify-center gap-2 flex-1 flex-nowrap min-w-0">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded">Home</a>

                    {{-- About dropdown --}}
                    <div class="nav-dropdown relative">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded inline-flex items-center gap-1">
                            About <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="nav-dropdown-panel absolute left-0 top-full pt-1 w-56 opacity-0 invisible transition-all duration-200">
                            <div class="bg-white rounded-lg shadow-lg border border-slate-200 py-2">
                                <a href="{{ route('about.tenwek') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">About Tenwek Hospital</a>
                                <a href="{{ route('about.mission') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Mission, Vision & Values</a>
                                <a href="{{ route('about.leadership') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Leadership</a>
                                <a href="{{ route('about.history') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">History</a>
                                <a href="{{ route('about.partnerships') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Partnerships</a>
                                <div class="border-t border-slate-100 mt-2 pt-2">
                                    <a href="{{ route('ctc.overview') }}" class="block px-4 py-2 text-sm text-teal-700 font-medium hover:bg-slate-50">The Cardiothoracic Centre</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CTC mega menu --}}
                    <div class="nav-mega relative">
                        <a href="{{ route('ctc.overview') }}" class="px-4 py-2 text-sm font-medium text-teal-700 hover:text-teal-800 rounded inline-flex items-center gap-1">
                            Cardiothoracic Centre <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div class="nav-mega-panel nav-mega-panel--ctc absolute left-1/2 -translate-x-1/2 top-full pt-1 opacity-0 invisible transition-all duration-200">
                            <div class="bg-white rounded-lg shadow-lg border border-slate-200 p-4 mega-grid cols-5">
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Overview</p>
                                    <a href="{{ route('ctc.overview') }}" class="text-sm text-slate-700 hover:text-teal-600">About the CTC</a>
                                </div>
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Clinical Services</p>
                                    <a href="{{ url('/cardiothoracic-centre/clinical-services/adult-cardiac') }}" class="text-sm text-slate-700 hover:text-teal-600">Adult Cardiac Surgery</a>
                                    <a href="{{ url('/cardiothoracic-centre/clinical-services/pediatric-cardiac') }}" class="text-sm text-slate-700 hover:text-teal-600">Pediatric Cardiac Surgery</a>
                                    <a href="{{ url('/cardiothoracic-centre/clinical-services/cardiothoracic') }}" class="text-sm text-slate-700 hover:text-teal-600">Cardiothoracic Surgery</a>
                                </div>
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Clinics</p>
                                    <a href="{{ url('/cardiothoracic-centre/clinics/cardiac') }}" class="text-sm text-slate-700 hover:text-teal-600">Cardiac Clinic</a>
                                    <a href="{{ url('/cardiothoracic-centre/clinics/pre-op') }}" class="text-sm text-slate-700 hover:text-teal-600">Pre-operative Assessment</a>
                                    <a href="{{ url('/cardiothoracic-centre/clinics/follow-up') }}" class="text-sm text-slate-700 hover:text-teal-600">Follow-up Care</a>
                                </div>
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Facilities</p>
                                    <a href="{{ url('/cardiothoracic-centre/facilities/cardiac-icu') }}" class="text-sm text-slate-700 hover:text-teal-600">Cardiac ICU</a>
                                    <a href="{{ url('/cardiothoracic-centre/facilities/operating-theatres') }}" class="text-sm text-slate-700 hover:text-teal-600">Operating Theatres</a>
                                    <a href="{{ url('/cardiothoracic-centre/facilities/diagnostic') }}" class="text-sm text-slate-700 hover:text-teal-600">Diagnostic Support</a>
                                </div>
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Training</p>
                                    <a href="{{ route('training.fellowship') }}" class="text-sm text-slate-700 hover:text-teal-600">Cardiothoracic Fellowship</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Clinical Services mega --}}
                    <div class="nav-mega relative">
                        <a href="{{ route('clinical-services.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded inline-flex items-center gap-1">
                            Clinical Services <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div class="nav-mega-panel nav-mega-panel--services absolute left-1/2 -translate-x-1/2 top-full pt-1 opacity-0 invisible transition-all duration-200">
                            <div class="bg-white rounded-lg shadow-lg border border-slate-200 p-4 mega-grid cols-3">
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Outpatient & Clinics</p>
                                    <a href="{{ route('clinical-services.outpatient') }}" class="text-sm text-slate-700 hover:text-teal-600">General Outpatient</a>
                                    <a href="{{ url('/clinical-services/outpatient-clinics/chest') }}" class="text-sm text-slate-700 hover:text-teal-600">Chest Clinic</a>
                                    <a href="{{ url('/clinical-services/outpatient-clinics/cardiac') }}" class="text-sm text-slate-700 hover:text-teal-600">Cardiac Clinic</a>
                                    <a href="{{ url('/clinical-services/outpatient-clinics/oncology') }}" class="text-sm text-slate-700 hover:text-teal-600">Oncology Clinic</a>
                                    <a href="{{ url('/clinical-services/specialized/emergency') }}" class="text-sm text-slate-700 hover:text-teal-600">Casualty / A&E</a>
                                </div>
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Surgical Services</p>
                                    <a href="{{ route('clinical-services.surgical') }}" class="text-sm text-slate-700 hover:text-teal-600">Surgical Services</a>
                                    <a href="{{ url('/clinical-services/surgical-services/ob-gyn') }}" class="text-sm text-slate-700 hover:text-teal-600">OB/GYN Surgeries</a>
                                    <a href="{{ url('/clinical-services/surgical-services/orthopedic') }}" class="text-sm text-slate-700 hover:text-teal-600">Orthopedic Surgeries</a>
                                    <a href="{{ url('/clinical-services/surgical-services/cardiothoracic') }}" class="text-sm text-slate-700 hover:text-teal-600">Cardiothoracic Surgeries</a>
                                </div>
                                <div class="mega-col">
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Specialized</p>
                                    <a href="{{ url('/clinical-services/specialized/eye') }}" class="text-sm text-slate-700 hover:text-teal-600">Eye Services</a>
                                    <a href="{{ url('/clinical-services/specialized/dental') }}" class="text-sm text-slate-700 hover:text-teal-600">Dental Services</a>
                                    <a href="{{ url('/clinical-services/specialized/diagnostic') }}" class="text-sm text-slate-700 hover:text-teal-600">Diagnostic Services</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Training dropdown --}}
                    <div class="nav-dropdown relative">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded inline-flex items-center gap-1">
                            Training & Education <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="nav-dropdown-panel absolute left-0 top-full pt-1 w-64 opacity-0 invisible transition-all duration-200">
                            <div class="bg-white rounded-lg shadow-lg border border-slate-200 py-2">
                                <a href="{{ route('training.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Residency Programmes</a>
                                <a href="{{ route('training.fellowship') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Cardiothoracic Fellowship</a>
                                <div class="border-t border-slate-100 mt-2 pt-2">
                                    <a href="#" target="_blank" rel="noopener noreferrer" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50">School of Health Sciences <span class="text-slate-400 text-xs">(External)</span></a>
                                    <a href="#" target="_blank" rel="noopener noreferrer" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50">School of Chaplaincy <span class="text-slate-400 text-xs">(External)</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('community.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:text-teal-600 rounded">Community & Mission</a>
                </nav>

                {{-- Right: hamburger (mobile only) --}}
                <div class="flex-1 flex items-center justify-end lg:min-w-0">
                    <button type="button" class="lg:hidden p-2 text-slate-600 hover:bg-slate-100 rounded" id="mobile-menu-btn" aria-label="Menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile menu --}}
        <div class="lg:hidden hidden border-t border-slate-200 bg-white" id="mobile-menu">
            <div class="max-w-7xl mx-auto px-4 py-4 space-y-2 text-sm">
                <a href="{{ route('home') }}" class="block py-2 text-slate-700">Home</a>
                <a href="{{ route('about.tenwek') }}" class="block py-2 text-slate-700">About</a>
                <a href="{{ route('ctc.overview') }}" class="block py-2 text-teal-700 font-medium">Cardiothoracic Centre</a>
                <a href="{{ route('clinical-services.index') }}" class="block py-2 text-slate-700">Clinical Services</a>
                <a href="{{ route('training.index') }}" class="block py-2 text-slate-700">Training & Education</a>
                <a href="{{ route('community.index') }}" class="block py-2 text-slate-700">Community & Mission</a>
                <a href="{{ route('contact.index') }}" class="block py-2 text-slate-700">Contact</a>
                <a href="{{ route('contact.index') }}#donate" class="block py-2 text-teal-600 font-medium">Donate</a>
                <a href="{{ route('contact.index') }}#refer" class="block py-2 text-teal-600 font-medium">Refer Patient</a>
            </div>
        </div>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer: includes all links from live header audit (missing items moved here) --}}
    <footer class="bg-slate-800 text-slate-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                {{-- About --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">About</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('about.tenwek') }}" class="hover:text-white">About Tenwek</a></li>
                        <li><a href="{{ route('about.mission') }}" class="hover:text-white">Mission & Vision</a></li>
                        <li><a href="{{ route('about.leadership') }}" class="hover:text-white">Leadership</a></li>
                        <li><a href="{{ route('about.tenwek') }}#governance" class="hover:text-white">Governance</a></li>
                        <li><a href="{{ route('about.history') }}" class="hover:text-white">History</a></li>
                        <li><a href="{{ route('about.partnerships') }}" class="hover:text-white">Partnerships</a></li>
                    </ul>
                </div>
                {{-- Featured Centres --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Cardiothoracic Centre</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('ctc.overview') }}" class="hover:text-white">CTC Overview</a></li>
                        <li><a href="{{ url('/cardiothoracic-centre/clinical-services/adult-cardiac') }}" class="hover:text-white">Cardiac Surgery</a></li>
                        <li><a href="{{ url('/cardiothoracic-centre/clinics/cardiac') }}" class="hover:text-white">Cardiac Clinic</a></li>
                        <li><a href="{{ route('training.fellowship') }}" class="hover:text-white">Fellowship Program</a></li>
                    </ul>
                </div>
                {{-- Clinical Services --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Clinical Services</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('clinical-services.index') }}" class="hover:text-white">Clinical Services</a></li>
                        <li><a href="{{ url('/clinical-services/specialized/emergency') }}" class="hover:text-white">Casualty &amp; A&amp;E</a></li>
                        <li><a href="{{ route('clinical-services.outpatient') }}" class="hover:text-white">Outpatient Clinics</a></li>
                        <li><a href="{{ route('clinical-services.surgical') }}" class="hover:text-white">Surgical Services</a></li>
                        <li><a href="{{ url('/clinical-services/specialized/diagnostic') }}" class="hover:text-white">Diagnostics</a></li>
                        <li><a href="{{ url('/clinical-services/specialized/eye') }}" class="hover:text-white">Eye Services</a></li>
                        <li><a href="{{ url('/clinical-services/specialized/dental') }}" class="hover:text-white">Dental Services</a></li>
                        <li><a href="{{ url('/clinical-services/outpatient-clinics/maternity') }}" class="hover:text-white">Maternity Services</a></li>
                        <li><a href="{{ url('/clinical-services/outpatient-clinics/paediatric') }}" class="hover:text-white">Paediatric Services</a></li>
                        <li><a href="{{ url('/clinical-services/specialized/icu') }}" class="hover:text-white">ICU</a></li>
                        <li><a href="{{ url('/clinical-services/surgical-services/neurosurgical') }}" class="hover:text-white">Neurosurgical Services</a></li>
                    </ul>
                </div>
                {{-- Training & Education --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Training &amp; Education</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('training.index') }}" class="hover:text-white">Residency Programmes</a></li>
                        <li><a href="{{ route('training.fellowship') }}" class="hover:text-white">Fellowship Training</a></li>
                        <li><a href="{{ route('careers.index') }}#internships" class="hover:text-white">Internships</a></li>
                        <li><a href="https://tenwekhosp.org/training/" target="_blank" rel="noopener noreferrer" class="hover:text-white">College of Health Sciences <span class="text-slate-500">↗</span></a></li>
                        <li><a href="https://tenwekhosp.org/training/" target="_blank" rel="noopener noreferrer" class="hover:text-white">School of Chaplaincy <span class="text-slate-500">↗</span></a></li>
                    </ul>
                </div>
                {{-- Medical Outreach & Community --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Outreach &amp; Community</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('community.index') }}" class="hover:text-white">Community Outreach</a></li>
                        <li><a href="{{ route('community.index') }}#satellite" class="hover:text-white">Satellite Health Facilities</a></li>
                        <li><a href="{{ route('community.index') }}#community-health" class="hover:text-white">Community Health &amp; Development</a></li>
                        <li><a href="{{ route('community.index') }}#spiritual" class="hover:text-white">Spiritual Ministry</a></li>
                        <li><a href="{{ route('community.index') }}" class="hover:text-white">Mission Work</a></li>
                    </ul>
                </div>
                {{-- Research --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Research</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('research.index') }}" class="hover:text-white">Research</a></li>
                        <li><a href="{{ route('research.ethics') }}" class="hover:text-white">Ethics Review Committee</a></li>
                    </ul>
                </div>
                {{-- Support & Quick Links --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('book-appointment') }}" class="hover:text-white">Book Appointment</a></li>
                        <li><a href="{{ route('tenders') }}" class="hover:text-white">Tenders</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-white">Blog &amp; News</a></li>
                        <li><a href="{{ route('careers.index') }}" class="hover:text-white">Careers</a></li>
                        <li><a href="{{ route('careers.index') }}#positions" class="hover:text-white">Open Positions</a></li>
                        <li><a href="{{ route('volunteers') }}" class="hover:text-white">Volunteers</a></li>
                        <li><a href="{{ route('contact.index') }}#donate" class="hover:text-white">Donate</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-white">Contact</a></li>
                        <li><a href="{{ route('contact.visiting') }}" class="hover:text-white">Visiting Hours</a></li>
                    </ul>
                </div>
                {{-- News & Updates --}}
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">News &amp; Updates</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('news.index') }}" class="hover:text-white">Hospital News</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-white">Announcements</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-white">Events</a></li>
                    </ul>
                </div>
            </div>
            {{-- Contact strip: customer service & ambulance (from live header) --}}
            <div class="mt-10 pt-8 border-t border-slate-700 flex flex-wrap items-center justify-center gap-x-8 gap-y-2 text-sm">
                <span>Customer service: <a href="tel:+254700499699" class="font-semibold text-white hover:underline">0700 499 699</a></span>
                <span>Ambulance / Coverage: <a href="tel:+254727033725" class="font-semibold text-white hover:underline">0727 033 725</a></span>
            </div>
            <div class="mt-6 pt-6 border-t border-slate-700 text-center text-sm text-slate-500">
                &copy; {{ date('Y') }} Tenwek Hospital. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
    @stack('scripts')
</body>
</html>
