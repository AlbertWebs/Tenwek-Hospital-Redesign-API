@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Hero: YouTube background video + overlay + text from brand --}}
    <style>
        .hero-video-section { position: relative; height: calc(100vh - 7rem); min-height: 320px; max-height: calc(100vh - 7rem); display: flex; align-items: center; overflow: hidden; }
        .hero-video-wrap { position: absolute; inset: 0; }
        .hero-video-wrap iframe {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100vw;
            height: 56.25vw;
            min-height: 100%;
            min-width: 177.78vh;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }
        .hero-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0.5); }
        .hero-content { position: relative; z-index: 10; width: 100%; max-width: 80rem; margin-left: auto; margin-right: auto; padding: 4rem 1rem; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        @media (min-width: 640px) { .hero-content { padding-left: 1.5rem; padding-right: 1.5rem; } }
        @media (min-width: 1024px) { .hero-content { padding: 6rem 2rem; padding-left: 2rem; padding-right: 2rem; } }
        .hero-title { font-family: 'Playfair Display', ui-serif, Georgia, serif; }
        .hero-scroll-arrow { position: absolute; bottom: 6rem; left: 50%; margin-left: -24px; z-index: 20; color: white; opacity: 0.95; animation: hero-arrow-bounce 2s ease-in-out infinite; width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; }
        @media (min-height: 900px) { .hero-scroll-arrow { bottom: 3rem; } }
        .hero-scroll-arrow:hover { opacity: 1; color: white; }
        @keyframes hero-arrow-bounce { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(6px); } }
    </style>
    <section class="hero-video-section text-white">
        <div class="hero-video-wrap">
            <iframe
                src="https://www.youtube.com/embed/cVFq8mHfWXk?autoplay=1&mute=1&loop=1&playlist=cVFq8mHfWXk&controls=0&showinfo=0&rel=0&playsinline=1"
                title="Tenwek Hospital"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
            ></iframe>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="max-w-2xl flex flex-col items-center">
                <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight text-white">Tenwek Hospital</h1>
                <p class="hero-title mt-3 text-lg sm:text-xl text-white/95">(A Ministry of Africa Gospel Church)</p>
                <p class="hero-title mt-4 text-xl sm:text-2xl text-white/90">We Treat ~ Jesus Heals</p>
                <a href="{{ route('about.tenwek') }}" class="mt-8 inline-flex items-center px-8 py-3.5 text-base font-medium text-white rounded-full border-2 border-amber-400 bg-black/40 hover:bg-black/60 transition-colors">
                    Learn more
                </a>
                <a href="tel:+254700499699" class="mt-4 inline-flex items-center text-sm text-white/90 hover:text-white">Talk to our customer service team 0700 499 699</a>
            </div>
        </div>
        <a href="#about-overview" class="hero-scroll-arrow" aria-label="Scroll to content">
            <svg class="w-10 h-10 sm:w-12 sm:h-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </a>
    </section>

    {{-- Quick actions: Book Appointment, A&E, Health Checkups (from tenwekhosp.org) --}}
    <section class="py-12 lg:py-16 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-3 gap-6">
                <a href="{{ route('book-appointment') }}" class="group block p-8 rounded-xl bg-teal-50 border border-teal-100 hover:border-teal-200 hover:shadow-md transition-all text-center">
                    <h2 class="text-2xl font-bold text-slate-900 group-hover:text-teal-700">Book</h2>
                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-teal-700 mt-1">Appointment</h3>
                    <p class="mt-3 text-slate-600 text-sm">Schedule an appointment with our panel of doctors today!</p>
                    <span class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-teal-600 group-hover:bg-teal-700 rounded-lg">Book Now</span>
                </a>
                <a href="{{ url('/clinical-services/specialized/emergency') }}" class="group block p-8 rounded-xl bg-slate-50 border border-slate-200 hover:border-teal-200 hover:shadow-md transition-all text-center">
                    <h2 class="text-2xl font-bold text-slate-900">Accident and</h2>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">Emergency</h3>
                    <p class="mt-3 text-slate-600 text-sm">We have a long track record of wide-reaching effects.</p>
                    <span class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-teal-600 bg-white border border-teal-200 rounded-lg group-hover:bg-teal-50">Know More</span>
                </a>
                <a href="{{ route('clinical-services.outpatient') }}" class="group block p-8 rounded-xl bg-slate-50 border border-slate-200 hover:border-teal-200 hover:shadow-md transition-all text-center">
                    <h2 class="text-2xl font-bold text-slate-900">Health</h2>
                    <h3 class="text-2xl font-bold text-slate-900 mt-1">Checkups</h3>
                    <p class="mt-3 text-slate-600 text-sm">Comprehensive health check for different age groups.</p>
                    <span class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-teal-600 bg-white border border-teal-200 rounded-lg group-hover:bg-teal-50">Know More</span>
                </a>
            </div>
        </div>
    </section>

    {{-- Who We Are (from tenwekhosp.org) --}}
    <section id="about-overview" class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900">Who We Are</h2>
                    <p class="mt-4 text-slate-600 leading-relaxed">Established in 1937 and located in Bomet County, Tenwek Hospital is the Medical Ministry of the Africa Gospel Church in collaboration with the World Gospel Mission. We are a 400 bed capacity, Level 5, Teaching and Referral Mission Hospital which serves the needs of the vast South West region of Kenya and the country at large.</p>
                    <p class="mt-4 text-slate-600 leading-relaxed">Tenwek Hospital is a Christian community that seeks to exemplify Christ in all aspects of what we do and we strongly believe that We Treat but Jesus ultimately Heals! We provide compassionate and affordable health care services centered on quality and Christ mindedness.</p>
                    <a href="{{ route('about.tenwek') }}" class="mt-6 inline-flex items-center text-teal-600 font-medium hover:text-teal-700">About Us →</a>
                </div>
                <div class="bg-slate-100 rounded-xl aspect-video flex items-center justify-center text-slate-400">
                    <span class="text-sm">[ Image: Tenwek Hospital ]</span>
                </div>
            </div>
        </div>
    </section>

    {{-- CTC highlight --}}
    <section class="py-16 lg:py-20 bg-teal-50 border-y border-teal-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-sm font-semibold text-teal-600 uppercase tracking-wider">Flagship programme</span>
                <h2 class="mt-2 text-3xl font-bold text-slate-900">The Cardiothoracic Centre</h2>
                <p class="mt-4 text-slate-600">Our Cardiothoracic Centre is a regional centre of excellence for adult and paediatric cardiac surgery, offering life-saving procedures, dedicated clinics, and fellowship training.</p>
                <a href="{{ route('ctc.overview') }}" class="mt-6 inline-flex items-center px-6 py-3 text-base font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg">Explore the CTC</a>
            </div>
        </div>
    </section>

    {{-- We Treat ~ Jesus Heals (from tenwekhosp.org) --}}
    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900">We Treat ~ Jesus Heals</h2>
            <p class="mt-3 text-slate-600 max-w-2xl mx-auto">We serve our stakeholders as guided by Biblical principles of service.</p>
            <div class="mt-10 grid sm:grid-cols-3 gap-6 max-w-4xl mx-auto">
                <a href="https://www.youtube.com/watch?v=cVFq8mHfWXk" target="_blank" rel="noopener noreferrer" class="block p-4 rounded-xl border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all text-left">
                    <span class="text-sm text-slate-500">Play Video</span>
                    <h3 class="mt-1 font-semibold text-slate-900">Tenwek Hospital World Kidney Day 5:29</h3>
                </a>
                <a href="https://www.youtube.com/watch?v=cVFq8mHfWXk" target="_blank" rel="noopener noreferrer" class="block p-4 rounded-xl border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all text-left">
                    <span class="text-sm text-slate-500">Play Video</span>
                    <h3 class="mt-1 font-semibold text-slate-900">Tenwek Hospital has been Nominated for Hospital of the Year 3:20</h3>
                </a>
                <a href="https://www.youtube.com/watch?v=cVFq8mHfWXk" target="_blank" rel="noopener noreferrer" class="block p-4 rounded-xl border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all text-left">
                    <span class="text-sm text-slate-500">Play Video</span>
                    <h3 class="mt-1 font-semibold text-slate-900">Hope for Life: Heart Surgery in Kenya 6:45</h3>
                </a>
            </div>
        </div>
    </section>

    {{-- Our Partners (from tenwekhosp.org) --}}
    <section class="py-16 lg:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900">Our Partners</h2>
            <p class="mt-3 text-slate-600 max-w-2xl mx-auto">We appreciate every partnership opportunity and friendship cultivated through Christ our Lord!</p>
            <p class="mt-6">
                <a href="{{ route('news.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-teal-600 bg-white hover:bg-teal-50 rounded-lg border border-teal-200">Stay Updated</a>
            </p>
        </div>
    </section>

    {{-- We provide compassionate... + full clinical services grid (11 services from tenwekhosp.org) --}}
    <section class="py-16 lg:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-slate-900">We provide compassionate and affordable health care services</h2>
            <p class="mt-2 text-slate-600 max-w-2xl">From outpatient clinics to specialised surgery and emergency care, we offer a full range of hospital services.</p>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                <a href="{{ url('/clinical-services/specialized/emergency') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Casualty Accident &amp; Emergency Unit</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ route('clinical-services.outpatient') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">General Outpatient Clinic</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/specialized/diagnostic') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Diagnostic Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/specialized/eye') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Eye Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/specialized/dental') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Dental Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/outpatient-clinics/maternity') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Maternity Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/outpatient-clinics/paediatric') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Paediatric Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/surgical-services/neurosurgical') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Neurosurgical Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/specialized/inpatient') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Inpatient Medical Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ route('clinical-services.surgical') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Surgical Services</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
                <a href="{{ url('/clinical-services/specialized/icu') }}" class="block p-5 rounded-xl bg-white border border-slate-200 hover:border-teal-300 hover:shadow-md transition-all">
                    <h3 class="font-semibold text-slate-900">Intensive Care Unit (ICU)</h3>
                    <span class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read More</span>
                </a>
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('clinical-services.index') }}" class="text-teal-600 font-medium hover:text-teal-700">View all clinical services →</a>
            </div>
        </div>
    </section>

    {{-- Mission, Vision, Core Values (from tenwekhosp.org) --}}
    <section class="py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-10">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Mission</h2>
                    <p class="mt-3 text-slate-600">Tenwek Hospital is a Christian community committed to excellence in compassionate healthcare, spiritual ministry, and training for service to the glory of God.</p>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Vision</h2>
                    <p class="mt-3 text-slate-600">Christ-Transformed Health, Lives and World</p>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Core Values</h2>
                    <ul class="mt-3 space-y-2 text-slate-600 text-sm">
                        <li><strong class="text-slate-800">Professionalism</strong> — We are competent and skilled in the medical profession.</li>
                        <li><strong class="text-slate-800">Excellence</strong> — We believe in providing outstanding care to our patients.</li>
                        <li><strong class="text-slate-800">Integrity</strong> — We are honest and have strong moral principles.</li>
                        <li><strong class="text-slate-800">Biblical Authority &amp; Values</strong> — We serve our stakeholders as guided by Biblical principles of service.</li>
                        <li><strong class="text-slate-800">Servanthood</strong> — We choose to serve completely as guided by Biblical principles of service.</li>
                        <li><strong class="text-slate-800">Accountability</strong> — We take responsibility and give satisfactory reason for our actions.</li>
                        <li><strong class="text-slate-800">Diversity</strong> — We are a single unit composed of many elements.</li>
                    </ul>
                    <a href="{{ route('about.mission') }}" class="mt-4 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Full Mission &amp; Vision →</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Latest news --}}
    <section class="py-16 lg:py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-slate-900">Latest News & Updates</h2>
            <p class="mt-2 text-slate-600">Stay informed about hospital news, announcements, and events.</p>
            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-40 bg-slate-200 flex items-center justify-center text-slate-500 text-sm">[ Image ]</div>
                    <div class="p-5">
                        <time class="text-sm text-slate-500">15 Mar 2025</time>
                        <h3 class="mt-2 font-semibold text-slate-900">CTC fellowship intake 2025</h3>
                        <p class="mt-2 text-sm text-slate-600">Applications are open for the Cardiothoracic Surgery Fellowship programme.</p>
                        <a href="{{ route('news.index') }}" class="mt-3 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read more →</a>
                    </div>
                </article>
                <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-40 bg-slate-200 flex items-center justify-center text-slate-500 text-sm">[ Image ]</div>
                    <div class="p-5">
                        <time class="text-sm text-slate-500">10 Mar 2025</time>
                        <h3 class="mt-2 font-semibold text-slate-900">New cardiac ICU expansion</h3>
                        <p class="mt-2 text-sm text-slate-600">Our Cardiac ICU has been expanded to serve more critically ill patients.</p>
                        <a href="{{ route('news.index') }}" class="mt-3 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Read more →</a>
                    </div>
                </article>
                <article class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="h-40 bg-slate-200 flex items-center justify-center text-slate-500 text-sm">[ Image ]</div>
                    <div class="p-5">
                        <time class="text-sm text-slate-500">1 Mar 2025</time>
                        <h3 class="mt-2 font-semibold text-slate-900">Visiting hours update</h3>
                        <p class="mt-2 text-sm text-slate-600">Updated visiting hours and guidelines for families and visitors.</p>
                        <a href="{{ route('contact.visiting') }}" class="mt-3 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">View visiting hours →</a>
                    </div>
                </article>
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('news.index') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-teal-600 bg-teal-50 hover:bg-teal-100 rounded-lg border border-teal-200">All news & events</a>
            </div>
        </div>
    </section>

    {{-- CTA block --}}
    <section class="py-16 lg:py-20 bg-teal-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold">Support our mission</h2>
            <p class="mt-2 text-teal-100 max-w-xl mx-auto">Donate to Tenwek Hospital or refer a patient for expert cardiac and general care.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact.index') }}#donate" class="inline-flex items-center px-6 py-3 text-base font-medium text-teal-800 bg-white hover:bg-teal-50 rounded-lg">Donate</a>
                <a href="{{ route('contact.index') }}#refer" class="inline-flex items-center px-6 py-3 text-base font-medium text-white border-2 border-white hover:bg-white/10 rounded-lg">Refer a Patient</a>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center px-6 py-3 text-base font-medium text-teal-200 hover:text-white">Contact us</a>
            </div>
        </div>
    </section>

    {{-- Contact strip: Visiting Hours, Address, Talk to us (from tenwekhosp.org) --}}
    <section class="py-12 lg:py-16 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-900 text-center mb-10">More than medicine. It's personal.</h2>
            <p class="text-center text-slate-600 mb-10"><a href="{{ route('contact.index') }}" class="text-teal-600 font-medium hover:text-teal-700">Reach out now</a></p>
            <div class="grid sm:grid-cols-3 gap-8 text-center">
                <div>
                    <h3 class="font-semibold text-slate-900">Visiting Hours</h3>
                    <p class="mt-2 text-slate-600 text-sm">Morning: 6:00 – 6:45 am<br>Lunch Hour: 1:00 – 2:00 pm<br>Evening: 4:00 – 5:00 pm</p>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900">Visit Our Hospital</h3>
                    <p class="mt-2 text-slate-600 text-sm">Bomet County, Kenya<br>P.O Box 39-20400 Bomet, Kenya</p>
                </div>
                <div>
                    <h3 class="font-semibold text-slate-900">Talk to us</h3>
                    <p class="mt-2 text-slate-600 text-sm">0700499699 / 0740346537 / 0728091900<br><a href="mailto:customer.experience@tenwekhosp.org" class="text-teal-600 hover:text-teal-700">customer.experience@tenwekhosp.org</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
