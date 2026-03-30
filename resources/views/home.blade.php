@extends('layouts.app')
@section('title', 'Tenwek Hospital — We Treat, Jesus Heals')
@section('content')

{{-- ================================================================ HERO ================================================================ --}}
<section class="relative overflow-hidden" style="background:#100f57;min-height:92vh;display:flex;align-items:center;">
    <div class="absolute inset-0 overflow-hidden">
        <iframe class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"
            style="width:100vw;height:56.25vw;min-height:100%;min-width:177.78vh;"
            src="https://www.youtube.com/embed/cVFq8mHfWXk?autoplay=1&mute=1&loop=1&playlist=cVFq8mHfWXk&controls=0&showinfo=0&rel=0&playsinline=1"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        {{-- cinematic gradient --}}
        <div class="absolute inset-0" style="background:linear-gradient(to bottom, rgba(16,15,87,.65) 0%, rgba(16,15,87,.15) 35%, rgba(16,15,87,.25) 55%, rgba(16,15,87,.85) 85%, rgba(16,15,87,.97) 100%);"></div>
        {{-- left anchor shadow --}}
        <div class="absolute inset-y-0 left-0 w-3/5" style="background:linear-gradient(to right,rgba(16,15,87,.5),transparent);"></div>
    </div>

    {{-- Content — vertically centred, left-aligned --}}
    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-10" style="padding-top:6rem;padding-bottom:6rem;">

        {{-- Simple eyebrow (no pill) --}}
        <p class="animate-fade-in" style="font-family:'Lexend',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase;color:rgba(228,195,115,.8);margin-bottom:1.25rem;">
            Est. 1937 &nbsp;·&nbsp; Level 5 Teaching &amp; Referral &nbsp;·&nbsp; Bomet, Kenya
        </p>

        {{-- Headline --}}
        <h1 class="font-headline font-extrabold text-white animate-float-up"
            style="font-size:clamp(2.4rem,5vw,4rem);letter-spacing:-.035em;line-height:1.05;max-width:22rem;margin-bottom:1.25rem;">
            We Treat,<br>
            <span style="background:linear-gradient(135deg,#e4c373,#f5e0a0,#e4c373);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Jesus Heals.</span>
        </h1>

        {{-- Sub-headline --}}
        <p class="font-sans text-white animate-float-up"
           style="font-size:.92rem;opacity:.75;font-weight:300;max-width:28rem;margin-bottom:2.25rem;animation-delay:.12s;line-height:1.7;">
            Pioneering compassionate, world-class healthcare in Kenya and beyond — a ministry of the Africa Gospel Church.
        </p>

        {{-- CTAs --}}
        <div class="flex flex-wrap items-center gap-3 animate-float-up" style="animation-delay:.25s;">
            <a href="{{ route('book-appointment') }}"
               class="cta-gold inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg"
               style="padding:.9rem 2rem;font-size:.63rem;letter-spacing:.18em;">
                Book Appointment
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            <a href="{{ route('about.tenwek') }}"
               class="inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg"
               style="padding:.9rem 2rem;font-size:.63rem;letter-spacing:.18em;background:rgba(255,255,255,.10);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.2);color:white;"
               onmouseover="this.style.background='rgba(255,255,255,.18)'" onmouseout="this.style.background='rgba(255,255,255,.10)'">
                About Tenwek
            </a>
            <a href="tel:+254700499699" class="font-sans" style="font-size:.82rem;color:rgba(255,255,255,.5);margin-left:.5rem;">
                Emergency: <span style="color:rgba(255,255,255,.85);font-weight:600;">0700 499 699</span>
            </a>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="animate-hero-bounce absolute bottom-8 right-8" style="display:flex;flex-direction:column;align-items:center;gap:.35rem;color:rgba(255,255,255,.3);">
        <span class="font-headline" style="font-size:.52rem;letter-spacing:.25em;text-transform:uppercase;">Scroll</span>
        <svg style="width:.9rem;height:.9rem;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>


{{-- ================================================================ QUICK ACTIONS ================================================================ --}}
<section id="quick-actions" style="background:#f6f3f2;padding-bottom:5rem;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="grid sm:grid-cols-3 gap-6" style="margin-top:-4.5rem;position:relative;z-index:20;">
            @php $actions = [
                ['href'=> route('book-appointment'),       'bg'=>'rgba(228,195,115,.18)', 'ic'=>'#100f57', 'title'=>'Book Appointment',       'body'=>'Schedule with our panel of specialist doctors today.',            'cta'=>'Book Now', 'path'=>'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5'],
                ['href'=> url('/clinical-services/specialized/emergency'), 'bg'=>'rgba(21,104,116,.12)', 'ic'=>'#156874', 'title'=>'Accident &amp; Emergency', 'body'=>'24/7 critical care response teams always on standby.',               'cta'=>'Know More', 'path'=>'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z'],
                ['href'=> route('clinical-services.outpatient'),           'bg'=>'rgba(16,15,87,.08)',  'ic'=>'#100f57', 'title'=>'Health Checkups',          'body'=>'Comprehensive health screening for all age groups.',             'cta'=>'Know More', 'path'=>'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
            ]; @endphp
            @foreach($actions as $a)
            <a href="{{ $a['href'] }}" class="qa-card rounded-2xl flex flex-col items-center text-center group" style="padding:2.25rem 2rem;">
                <div class="rounded-xl flex items-center justify-center mb-6 transition-all group-hover:scale-110" style="width:3.5rem;height:3.5rem;background:{{ $a['bg'] }};">
                    <svg class="w-7 h-7" style="color:{{ $a['ic'] }};" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $a['path'] }}"/></svg>
                </div>
                <h3 class="font-headline font-bold mb-2" style="font-size:.95rem;color:#100f57;letter-spacing:-.02em;">{!! $a['title'] !!}</h3>
                <p class="font-sans leading-relaxed mb-6" style="font-size:.82rem;color:#464650;">{{ $a['body'] }}</p>
                <span class="font-headline font-bold uppercase border-b pb-0.5" style="font-size:.65rem;letter-spacing:.18em;color:#156874;border-color:#156874;">{{ $a['cta'] }} →</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ================================================================ WHO WE ARE ================================================================ --}}
<section id="about-overview" style="padding:7rem 0;background:white;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;">
            <div>
                <div class="gold-bar" style="margin-bottom:1.5rem;"></div>
                <p class="eyebrow mb-4">About Tenwek Hospital</p>
                <h2 class="font-headline font-bold mb-6" style="font-size:clamp(1.5rem,3vw,2.25rem);letter-spacing:-.04em;color:#100f57;line-height:1.08;">A Christian Community<br>Committed to Excellence.</h2>
                <p class="font-sans leading-relaxed mb-5" style="font-size:.88rem;color:#464650;line-height:1.8;">
                    Established in 1937 and located in Bomet County, Tenwek Hospital is the Medical Ministry of the Africa Gospel Church in collaboration with the World Gospel Mission. We are a 400-bed, Level 5, Teaching and Referral Mission Hospital serving the South West region of Kenya and beyond.
                </p>
                <p class="font-sans leading-relaxed mb-8" style="font-size:.88rem;color:#464650;line-height:1.8;">
                    We provide compassionate and affordable healthcare centred on quality and Christ-mindedness. We Treat — but Jesus ultimately Heals.
                </p>
                <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                    <a href="{{ route('about.tenwek') }}" class="cta-gold inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg" style="padding:.85rem 1.75rem;font-size:.65rem;letter-spacing:.18em;">About Us</a>
                    <a href="{{ route('about.mission') }}" class="inline-flex items-center gap-2 font-headline font-bold uppercase border-b pb-0.5 self-center transition-all hover:gap-3" style="font-size:.65rem;letter-spacing:.18em;color:#156874;border-color:#156874;">Mission &amp; Vision →</a>
                </div>
            </div>
            <div style="position:relative;">
                <div class="shadow-ambient-primary" style="border-radius:1.25rem;overflow:hidden;aspect-ratio:4/5;">
                    <img alt="Tenwek Hospital Campus"
                         src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=900&q=80"
                         style="width:100%;height:100%;object-fit:cover;">
                </div>
                {{-- Floating stat --}}
                <div class="glass-float" style="position:absolute;bottom:-2rem;left:-3rem;padding:1.5rem 2rem;border-radius:1.25rem;min-width:14rem;">
                    <p class="stat-number font-headline font-extrabold" style="font-size:1.9rem;line-height:1;margin-bottom:.25rem;">400</p>
                    <p class="font-headline font-bold uppercase" style="font-size:.55rem;letter-spacing:.18em;color:#100f57;margin-bottom:.75rem;">Bed Capacity</p>
                    <div style="display:flex;gap:1.5rem;">
                        <div><p class="font-headline font-bold" style="font-size:.95rem;color:#100f57;">87+</p><p style="font-size:.58rem;color:#464650;text-transform:uppercase;letter-spacing:.1em;">Years</p></div>
                        <div><p class="font-headline font-bold" style="font-size:.95rem;color:#100f57;">Level 5</p><p style="font-size:.58rem;color:#464650;text-transform:uppercase;letter-spacing:.1em;">Teaching</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================ CLINICAL EXCELLENCE BENTO ================================================================ --}}
<section style="padding:7rem 0;background:#fbf9f8;overflow:hidden;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
            <div>
                <div class="gold-bar" style="margin-bottom:1.25rem;"></div>
                <p class="eyebrow mb-3">Our Specializations</p>
                <h2 class="font-headline font-bold leading-none" style="font-size:clamp(1.5rem,3vw,2.25rem);letter-spacing:-.04em;color:#100f57;">Clinical Excellence.</h2>
            </div>
            <p class="font-sans leading-relaxed max-w-md" style="font-size:.88rem;color:#464650;">Merging advanced medical technology with the profound empathy of mission-driven care.</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(12,1fr);gap:1.25rem;height:700px;">
            <a href="{{ route('ctc.overview') }}" class="bento-card shadow-ambient-primary" style="grid-column:span 7;display:block;">
                <img alt="Cardiothoracic" src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=1400&q=80" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(16,15,87,.92) 0%,rgba(16,15,87,.25) 45%,transparent 70%);"></div>
                <div style="position:absolute;bottom:0;left:0;padding:2.5rem;">
                    <span style="font-family:'Lexend',sans-serif;font-size:.6rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:#e4c373;display:block;margin-bottom:.6rem;">Centre of Excellence</span>
                    <h3 class="font-headline font-bold text-white mb-2" style="font-size:1.35rem;letter-spacing:-.03em;">Cardiothoracic</h3>
                    <p class="font-sans" style="font-size:.78rem;color:rgba(255,255,255,.65);">Pioneering heart surgery in East Africa with world-class facilities.</p>
                </div>
            </a>
            <div style="grid-column:span 5;display:grid;grid-template-rows:1fr 1fr;gap:1.25rem;">
                <a href="{{ route('clinical-services.surgical') }}" class="bento-card" style="display:block;">
                    <img alt="General Surgery" src="https://images.unsplash.com/photo-1551190822-a9333d879b1f?auto=format&fit=crop&w=900&q=80" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                    <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(16,15,87,.88),transparent 55%);"></div>
                    <div style="position:absolute;bottom:0;left:0;padding:1.75rem;">
                        <h3 class="font-headline font-bold text-white mb-1" style="font-size:1.1rem;letter-spacing:-.02em;">General Surgery</h3>
                        <p class="font-sans text-xs" style="color:rgba(255,255,255,.65);">Precision care for complex surgical needs.</p>
                    </div>
                </a>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                    <a href="{{ url('/clinical-services/outpatient-clinics/paediatric') }}" class="bento-card" style="display:block;">
                        <img alt="Paediatrics" src="https://images.unsplash.com/photo-1588776814546-1ffedbe47add?auto=format&fit=crop&w=600&q=80" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(16,15,87,.88),transparent 60%);"></div>
                        <div style="position:absolute;bottom:0;left:0;padding:1.25rem;">
                            <h3 class="font-headline font-bold text-white" style="font-size:1rem;letter-spacing:-.02em;">Paediatrics</h3>
                        </div>
                    </a>
                    <a href="{{ url('/clinical-services/specialized/emergency') }}" class="bento-card" style="display:block;">
                        <img alt="Emergency" src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(16,15,87,.88),transparent 60%);"></div>
                        <div style="position:absolute;bottom:0;left:0;padding:1.25rem;">
                            <h3 class="font-headline font-bold text-white" style="font-size:1rem;letter-spacing:-.02em;">24/7 Emergency</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-10 text-center">
            <a href="{{ route('clinical-services.index') }}" class="inline-flex items-center gap-2 font-headline font-bold uppercase border-b pb-0.5 transition-all hover:gap-4" style="font-size:.65rem;letter-spacing:.2em;color:#156874;border-color:#156874;">View All Clinical Services →</a>
        </div>
    </div>
</section>

{{-- ================================================================ ALL SERVICES GRID ================================================================ --}}
<section style="padding:5rem 0;background:#f6f3f2;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-12">
            <h2 class="font-headline font-bold" style="font-size:clamp(1.3rem,2.5vw,1.9rem);letter-spacing:-.03em;color:#100f57;">We provide compassionate and affordable healthcare.</h2>
            <p class="font-sans mt-3 max-w-2xl mx-auto" style="font-size:.85rem;color:#464650;">From outpatient clinics to specialised surgery and emergency care — a full range of hospital services.</p>
        </div>
        @php
        $services = [
            ['label'=>'Casualty A&amp;E Unit',          'href'=> url('/clinical-services/specialized/emergency')],
            ['label'=>'General Outpatient Clinic',        'href'=> route('clinical-services.outpatient')],
            ['label'=>'Diagnostic Services',              'href'=> url('/clinical-services/specialized/diagnostic')],
            ['label'=>'Eye Services',                     'href'=> url('/clinical-services/specialized/eye')],
            ['label'=>'Dental Services',                  'href'=> url('/clinical-services/specialized/dental')],
            ['label'=>'Maternity Services',               'href'=> url('/clinical-services/outpatient-clinics/maternity')],
            ['label'=>'Paediatric Services',              'href'=> url('/clinical-services/outpatient-clinics/paediatric')],
            ['label'=>'Neurosurgical Services',           'href'=> url('/clinical-services/surgical-services/neurosurgical')],
            ['label'=>'Inpatient Medical Services',       'href'=> url('/clinical-services/specialized/inpatient')],
            ['label'=>'Surgical Services',                'href'=> route('clinical-services.surgical')],
            ['label'=>'Intensive Care Unit (ICU)',        'href'=> url('/clinical-services/specialized/icu')],
            ['label'=>'OB/GYN Surgery',                  'href'=> url('/clinical-services/surgical-services/ob-gyn')],
            ['label'=>'Orthopedic Surgery',               'href'=> url('/clinical-services/surgical-services/orthopedic')],
        ];
        @endphp
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;">
            @foreach($services as $s)
            <a href="{{ $s['href'] }}"
               class="group"
               style="display:block;padding:1.25rem 1.5rem;background:white;border-radius:.875rem;border:1px solid rgba(199,197,210,.3);box-shadow:0 1px 3px rgba(16,15,87,.04),0 4px 12px rgba(16,15,87,.05);transition:all .25s ease;"
               onmouseover="this.style.borderColor='rgba(21,104,116,.4)';this.style.boxShadow='0 4px 16px rgba(16,15,87,.10)';this.style.transform='translateY(-2px)'"
               onmouseout="this.style.borderColor='rgba(199,197,210,.3)';this.style.boxShadow='0 1px 3px rgba(16,15,87,.04),0 4px 12px rgba(16,15,87,.05)';this.style.transform='translateY(0)'">
                <div style="width:2rem;height:2px;background:#e4c373;border-radius:2px;margin-bottom:.75rem;"></div>
                <h3 class="font-headline font-semibold" style="font-size:.9rem;letter-spacing:-.01em;color:#100f57;line-height:1.35;">{!! $s['label'] !!}</h3>
                <span class="font-headline font-bold" style="display:inline-block;margin-top:.6rem;font-size:.58rem;letter-spacing:.18em;text-transform:uppercase;color:#156874;">Read More →</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ================================================================ CTC FEATURE ================================================================ --}}
<section style="position:relative;padding:8rem 0;background:#100f57;overflow:hidden;">
    <div style="position:absolute;top:0;right:0;width:38%;height:100%;background:rgba(21,104,116,.08);transform:skewX(-12deg) translateX(5rem);pointer-events:none;"></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-10" style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;">
        <div style="position:relative;">
            <div class="shadow-ambient-primary" style="aspect-ratio:4/5;border-radius:1.25rem;overflow:hidden;">
                <img alt="Cardiothoracic surgical team" src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=900&q=80" style="width:100%;height:100%;object-fit:cover;">
            </div>
            <div class="glass-float" style="position:absolute;bottom:-2.5rem;right:-3rem;padding:2rem 2.25rem;border-radius:1.25rem;max-width:16rem;">
                <div class="stat-number font-headline font-extrabold" style="font-size:2rem;line-height:1;margin-bottom:.25rem;">500+</div>
                <div class="font-headline font-bold uppercase" style="font-size:.58rem;letter-spacing:.18em;color:#100f57;margin-bottom:.85rem;">Annual Heart Surgeries</div>
                <div style="width:2.5rem;height:2px;background:linear-gradient(90deg,#e4c373,#f0d68a);margin-bottom:.85rem;border-radius:2px;"></div>
                <p class="font-sans" style="font-size:.78rem;color:#464650;font-style:italic;line-height:1.65;">"We are restoring futures for families across the continent."</p>
                <p class="font-headline font-bold" style="font-size:.6rem;color:#100f57;margin-top:.75rem;">— Chief Surgeon, CTC</p>
            </div>
        </div>
        <div style="color:white;">
            <div class="gold-bar" style="margin-bottom:1.5rem;"></div>
            <p style="font-family:'Lexend',sans-serif;font-size:.65rem;font-weight:700;letter-spacing:.2em;text-transform:uppercase;color:#e4c373;margin-bottom:1rem;">Premier Heart Center</p>
            <h2 class="font-headline font-extrabold" style="font-size:clamp(1.5rem,3vw,2.25rem);letter-spacing:-.04em;line-height:1.05;color:white;margin-bottom:1.75rem;">The Heart of<br>East Africa.</h2>
            <p class="font-sans" style="font-size:.88rem;line-height:1.8;color:rgba(255,255,255,.78);margin-bottom:2.5rem;">
                Tenwek Hospital's Cardiothoracic Centre stands as a beacon of hope, providing world-class cardiothoracic surgical care to thousands who previously had no access to these life-saving procedures in the region.
            </p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:2rem;margin-bottom:3rem;">
                <div><p style="font-size:.6rem;font-family:'Lexend',sans-serif;font-weight:600;letter-spacing:.18em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:.4rem;">Facility</p><p class="font-headline font-bold" style="color:white;">Advanced Cardiac ICU</p></div>
                <div><p style="font-size:.6rem;font-family:'Lexend',sans-serif;font-weight:600;letter-spacing:.18em;text-transform:uppercase;color:rgba(255,255,255,.4);margin-bottom:.4rem;">Reach</p><p class="font-headline font-bold" style="color:white;">10+ Nations Served</p></div>
            </div>
            <a href="{{ route('ctc.overview') }}" class="inline-flex items-center gap-3 font-headline font-bold uppercase hover:gap-5 transition-all group" style="font-size:.68rem;letter-spacing:.18em;color:#e4c373;">
                Explore the CTC
                <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ================================================================ MISSIONS BEYOND WALLS ================================================================ --}}
<section style="padding:7rem 0;background:#f6f3f2;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-16">
            <div class="gold-bar mx-auto mb-6"></div>
            <h2 class="font-headline font-bold" style="font-size:clamp(2rem,4vw,3rem);letter-spacing:-.04em;color:#100f57;margin-bottom:0;">Missions Beyond Walls.</h2>
            <div style="width:5rem;height:2px;background:#156874;margin:1.25rem auto 0;border-radius:2px;"></div>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;">
            @php $pillars = [
                ['icon'=>'M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5', 'title'=>'Medical Education &amp; Training', 'body'=>'Training the next generation through residency programmes, cardiothoracic fellowship, and Tenwek Hospital College — building Africa\'s surgical capacity.', 'route'=>'training.index', 'label'=>'View Programs'],
                ['icon'=>'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',              'title'=>'Community &amp; Mission',           'body'=>'Mobile clinics, maternal support, spiritual chaplaincy, and preventative care outreach in Bomet County — bringing healing to those who cannot travel.', 'route'=>'community.index', 'label'=>'Explore Community'],
                ['icon'=>'M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1 1 .28 2.716-1.407 2.928l-1.96.245A48.506 48.506 0 0112 20.25a48.506 48.506 0 01-6.835-.575l-1.96-.245c-1.687-.212-2.407-1.928-1.407-2.928L5 14.5', 'title'=>'Clinical Research',                 'body'=>'Advancing medical knowledge through rigorous scientific study via ISERC, focused on regional healthcare challenges including tropical and cardiac disease.', 'route'=>'research.index', 'label'=>'Read Studies'],
            ]; @endphp
            @foreach($pillars as $p)
            <div style="background:white;border-radius:1.25rem;padding:2.5rem;box-shadow:0 2px 4px rgba(16,15,87,.04),0 8px 24px rgba(16,15,87,.06);transition:all .3s ease;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 8px 16px rgba(16,15,87,.08),0 24px 48px rgba(16,15,87,.12)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 4px rgba(16,15,87,.04),0 8px 24px rgba(16,15,87,.06)'">
                <div style="width:3.5rem;height:3.5rem;border-radius:.75rem;background:rgba(21,104,116,.08);display:flex;align-items:center;justify-content:center;margin-bottom:1.75rem;">
                    <svg class="w-7 h-7" style="color:#156874;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $p['icon'] }}"/></svg>
                </div>
                <h3 class="font-headline font-bold mb-4" style="font-size:1.25rem;letter-spacing:-.03em;color:#100f57;">{!! $p['title'] !!}</h3>
                <p class="font-sans leading-relaxed mb-8" style="font-size:.92rem;color:#464650;line-height:1.75;">{{ $p['body'] }}</p>
                <a href="{{ route($p['route']) }}" class="inline-flex items-center gap-1 font-headline font-bold uppercase border-b pb-0.5 transition-all hover:gap-3" style="font-size:.62rem;letter-spacing:.2em;color:#156874;border-color:#156874;">{{ $p['label'] }} →</a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ================================================================ MISSION · VISION · VALUES ================================================================ --}}
<section style="padding:7rem 0;background:white;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div style="margin-bottom:4.5rem;"><div class="gold-bar" style="margin-bottom:1.5rem;"></div><h2 class="font-headline font-bold" style="font-size:clamp(2.2rem,4vw,3.25rem);letter-spacing:-.04em;color:#100f57;">Our Foundation.</h2></div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:3.5rem;">
            <div style="border-left:3px solid #156874;padding-left:2rem;">
                <p class="eyebrow mb-4">Mission</p>
                <h3 class="font-headline font-bold mb-5" style="font-size:1.2rem;letter-spacing:-.03em;color:#100f57;line-height:1.35;">Clinical Excellence.<br>Christlike Care.</h3>
                <p class="font-sans" style="font-size:.9rem;color:#464650;line-height:1.8;">Tenwek Hospital is a Christian community committed to excellence in compassionate healthcare, spiritual ministry, and training for service to the glory of God.</p>
            </div>
            <div style="border-left:3px solid #e4c373;padding-left:2rem;">
                <p style="font-family:'Lexend',sans-serif;font-weight:700;font-size:.62rem;letter-spacing:.2em;text-transform:uppercase;color:#e4c373;margin-bottom:1rem;">Vision</p>
                <h3 class="font-headline font-bold mb-5" style="font-size:1.2rem;letter-spacing:-.03em;color:#100f57;line-height:1.35;">Christ-Transformed Health,<br>Lives &amp; World.</h3>
                <p class="font-sans" style="font-size:.9rem;color:#464650;line-height:1.8;">Communities across East Africa experiencing the fullness of life — physically, spiritually, and socially — through the transforming power of Christ.</p>
            </div>
            <div style="border-left:3px solid rgba(16,15,87,.12);padding-left:2rem;">
                <p style="font-family:'Lexend',sans-serif;font-weight:700;font-size:.62rem;letter-spacing:.2em;text-transform:uppercase;color:rgba(16,15,87,.4);margin-bottom:1rem;">Core Values</p>
                <ul style="display:flex;flex-direction:column;gap:.75rem;margin-bottom:2rem;">
                    @foreach(['Professionalism','Excellence','Integrity','Biblical Authority &amp; Values','Servanthood','Accountability','Diversity'] as $v)
                    <li class="font-sans" style="font-size:.85rem;color:#464650;line-height:1.5;"><strong class="font-headline font-bold" style="color:#100f57;">{!! $v !!}</strong></li>
                    @endforeach
                </ul>
                <a href="{{ route('about.mission') }}" class="inline-flex items-center gap-1 font-headline font-bold uppercase border-b pb-0.5 hover:gap-3 transition-all" style="font-size:.62rem;letter-spacing:.2em;color:#156874;border-color:#156874;">Full Mission &amp; Vision →</a>
            </div>
        </div>
    </div>
</section>

{{-- ================================================================ LATEST NEWS ================================================================ --}}
<section style="padding:7rem 0;background:#f6f3f2;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;margin-bottom:3.5rem;gap:2rem;">
            <div><div class="gold-bar" style="margin-bottom:1.25rem;"></div><h2 class="font-headline font-bold" style="font-size:clamp(1.8rem,3vw,2.5rem);letter-spacing:-.04em;color:#100f57;">Latest from Tenwek.</h2></div>
            <a href="{{ route('news.index') }}" class="flex-shrink-0 font-headline font-bold uppercase transition-colors" style="font-size:.62rem;letter-spacing:.2em;padding:.7rem 1.4rem;background:#e4e2e1;color:#100f57;border-radius:.5rem;">View All Updates</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;">
            @php $news = [
                ['cat'=>'Fellowship',     'date'=>'15 Mar 2026','title'=>'CTC Fellowship Intake 2026 — Applications Now Open',   'img'=>'https://images.unsplash.com/photo-1582719471384-894fbb16e074?auto=format&fit=crop&w=600&q=80','href'=> route('news.index')],
                ['cat'=>'Infrastructure', 'date'=>'10 Mar 2026','title'=>'New Cardiac ICU Extension Completed',                   'img'=>'https://images.unsplash.com/photo-1504813184591-01572f98c85f?auto=format&fit=crop&w=600&q=80','href'=> route('news.index')],
                ['cat'=>'Community',      'date'=>'28 Feb 2026','title'=>'Mobile Clinic Reaches Remote Villages in Bomet County', 'img'=>'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80','href'=> route('news.index')],
            ]; @endphp
            @foreach($news as $n)
            <a href="{{ $n['href'] }}" class="news-card flex flex-col gap-3 group">
                <div style="aspect-ratio:16/9;overflow:hidden;border-radius:.875rem;background:#e4e2e1;">
                    <img alt="{{ $n['title'] }}" src="{{ $n['img'] }}" style="width:100%;height:100%;object-fit:cover;transition:transform .6s cubic-bezier(.25,.46,.45,.94);" onmouseover="this.style.transform='scale(1.07)'" onmouseout="this.style.transform='scale(1)'">
                </div>
                <div style="display:flex;align-items:center;gap:.6rem;">
                    <span class="font-headline font-bold uppercase" style="font-size:.6rem;letter-spacing:.18em;color:#156874;">{{ $n['cat'] }}</span>
                    <span style="width:.2rem;height:.2rem;border-radius:50%;background:#c7c5d2;display:inline-block;"></span>
                    <span class="font-sans" style="font-size:.7rem;color:rgba(70,70,80,.55);">{{ $n['date'] }}</span>
                </div>
                <h4 class="font-headline font-bold transition-colors group-hover:text-secondary" style="font-size:1rem;letter-spacing:-.02em;line-height:1.35;color:#100f57;">{{ $n['title'] }}</h4>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ================================================================ QUICK LINKS (Careers / Patient Guide / Tenders / Volunteers) ================================================================ --}}
<section style="padding:5rem 0;background:white;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="text-center mb-12">
            <div class="gold-bar mx-auto mb-5"></div>
            <h2 class="font-headline font-bold" style="font-size:clamp(1.6rem,3vw,2.25rem);letter-spacing:-.03em;color:#100f57;">How Can We Help You?</h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.25rem;">
            @php $links = [
                ['label'=>'Careers',       'desc'=>'Join our team and serve with purpose.',       'href'=> route('careers.index'),     'accent'=>'#e4c373'],
                ['label'=>'Patient Guide', 'desc'=>'Everything you need for your hospital visit.','href'=> route('patient-guide'),     'accent'=>'#156874'],
                ['label'=>'Tenders',       'desc'=>'Procurement and supplier opportunities.',     'href'=> route('tenders'),           'accent'=>'#100f57'],
                ['label'=>'Volunteers',    'desc'=>'Make an impact — give your time and skills.', 'href'=> route('volunteers'),        'accent'=>'#156874'],
            ]; @endphp
            @foreach($links as $l)
            <a href="{{ $l['href'] }}"
               style="display:block;padding:2rem 1.75rem;background:white;border-radius:1rem;border:1px solid rgba(199,197,210,.35);box-shadow:0 2px 8px rgba(16,15,87,.05);transition:all .25s ease;"
               onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(16,15,87,.10)';this.style.borderColor='rgba(21,104,116,.35)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 2px 8px rgba(16,15,87,.05)';this.style.borderColor='rgba(199,197,210,.35)'">
                <div style="width:2.5rem;height:3px;background:{{ $l['accent'] }};border-radius:2px;margin-bottom:1.25rem;"></div>
                <h3 class="font-headline font-bold mb-2" style="font-size:1.05rem;letter-spacing:-.02em;color:#100f57;">{{ $l['label'] }}</h3>
                <p class="font-sans" style="font-size:.85rem;color:#464650;line-height:1.6;margin-bottom:1rem;">{{ $l['desc'] }}</p>
                <span class="font-headline font-bold uppercase" style="font-size:.58rem;letter-spacing:.18em;color:#156874;">Learn More →</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ================================================================ CTA ================================================================ --}}
<section style="position:relative;padding:6rem 0;background:#100f57;overflow:hidden;">
    <div style="position:absolute;inset:0;opacity:.04;pointer-events:none;"><svg width="100%" height="100%" preserveAspectRatio="none" viewBox="0 0 100 100"><path d="M0 100 Q 50 0 100 100" fill="none" stroke="white" stroke-width=".2"/><path d="M0 75 Q 50 -25 100 75" fill="none" stroke="white" stroke-width=".12"/></svg></div>
    <div class="relative max-w-7xl mx-auto px-6 lg:px-10 text-center">
        <div class="gold-bar mx-auto" style="margin-bottom:2rem;"></div>
        <h2 class="font-headline font-extrabold" style="font-size:clamp(2rem,5vw,3.25rem);letter-spacing:-.04em;color:white;margin-bottom:1.25rem;">Be a Part of the Miracle.</h2>
        <p class="font-sans" style="font-size:1.05rem;line-height:1.75;color:rgba(255,255,255,.72);max-width:30rem;margin:0 auto 4rem;">Your support enables us to keep the mobile clinics running, the medicine stocked, and the gospel spreading.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-bottom:3.5rem;">
            @foreach([['150,000+','Lives Touched Annually'],['87+','Years of Mission'],['150,000+','Outpatient Visits/Year']] as $s)
            <div style="padding:1.75rem 1.5rem;border-radius:1rem;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.08);">
                <p class="font-headline font-extrabold" style="font-size:2.5rem;line-height:1;letter-spacing:-.04em;color:#e4c373;margin-bottom:.4rem;">{{ $s[0] }}</p>
                <p class="font-headline font-bold uppercase" style="font-size:.58rem;letter-spacing:.18em;color:rgba(255,255,255,.5);">{{ $s[1] }}</p>
            </div>
            @endforeach
        </div>
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:1rem;">
            <a href="{{ route('contact.index') }}#donate" class="cta-gold inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg" style="padding:1rem 2.25rem;font-size:.68rem;letter-spacing:.18em;">Donate to Tenwek</a>
            <a href="{{ route('contact.index') }}#refer" class="inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg transition-all hover:bg-white hover:text-primary" style="padding:1rem 2.25rem;font-size:.68rem;letter-spacing:.18em;background:rgba(255,255,255,.10);color:white;border:1px solid rgba(255,255,255,.18);backdrop-filter:blur(8px);">Refer a Patient</a>
            <a href="{{ route('volunteers') }}" class="inline-flex items-center gap-2 font-headline font-bold uppercase rounded-lg" style="padding:1rem 2.25rem;font-size:.68rem;letter-spacing:.18em;color:rgba(255,255,255,.6);transition:color .2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,.6)'">Volunteer</a>
        </div>
    </div>
</section>

{{-- ================================================================ CONTACT STRIP ================================================================ --}}
<section style="padding:5rem 0;background:white;border-top:3px solid #e4c373;">
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="text-center" style="margin-bottom:3.5rem;">
            <h2 class="font-headline font-bold" style="font-size:clamp(1.6rem,3vw,2.25rem);letter-spacing:-.03em;color:#100f57;margin-bottom:.5rem;">More than medicine. <span style="color:#156874;">It's personal.</span></h2>
            <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-1 font-headline font-bold uppercase border-b pb-0.5" style="font-size:.62rem;letter-spacing:.2em;color:#156874;border-color:#156874;margin-top:.75rem;">Reach Out Now →</a>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:3rem;text-align:center;">
            <div>
                <div style="width:3.25rem;height:3.25rem;border-radius:.875rem;background:rgba(228,195,115,.12);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                    <svg class="w-6 h-6" style="color:#e4c373;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-headline font-bold mb-3" style="font-size:1rem;color:#100f57;">Visiting Hours</h3>
                <p class="font-sans" style="font-size:.85rem;color:#464650;line-height:1.75;">Morning: 6:00 – 6:45 am<br>Lunch: 1:00 – 2:00 pm<br>Evening: 4:00 – 5:00 pm</p>
                <a href="{{ route('contact.visiting') }}" class="inline-block mt-4 font-headline font-bold uppercase border-b pb-0.5" style="font-size:.6rem;letter-spacing:.18em;color:#156874;border-color:#156874;">Full Details</a>
            </div>
            <div>
                <div style="width:3.25rem;height:3.25rem;border-radius:.875rem;background:rgba(21,104,116,.08);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                    <svg class="w-6 h-6" style="color:#156874;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                </div>
                <h3 class="font-headline font-bold mb-3" style="font-size:1rem;color:#100f57;">Visit Our Hospital</h3>
                <p class="font-sans" style="font-size:.85rem;color:#464650;line-height:1.75;">Bomet County, Kenya<br>P.O Box 39-20400 Bomet, Kenya</p>
            </div>
            <div>
                <div style="width:3.25rem;height:3.25rem;border-radius:.875rem;background:rgba(16,15,87,.07);display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                    <svg class="w-6 h-6" style="color:#100f57;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
                </div>
                <h3 class="font-headline font-bold mb-3" style="font-size:1rem;color:#100f57;">Talk to Us</h3>
                <p class="font-sans" style="font-size:.85rem;color:#464650;line-height:1.75;">
                    <a href="tel:+254700499699" style="color:#156874;">0700 499 699</a> &nbsp;·&nbsp; <a href="tel:+254740346537" style="color:#156874;">0740 346 537</a><br>
                    <a href="mailto:customer.experience@tenwekhosp.org" style="color:#156874;font-size:.78rem;">customer.experience@tenwekhosp.org</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
