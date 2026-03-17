@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <x-page title="Contact" :breadcrumbs="['Contact' => null]">
        <p class="text-lg text-slate-600">Get in touch with Tenwek Hospital for general enquiries, referrals, donations, or support. We're here to help.</p>

        {{-- Contact strip: Talk to us, Visit, Visiting hours --}}
        <div class="mt-10 not-prose grid sm:grid-cols-3 gap-6">
            <div class="p-6 rounded-xl bg-slate-50 border border-slate-100">
                <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Talk to us</h2>
                <p class="mt-2 text-slate-900 font-medium">0700499699 / 0740346537 / 0728091900</p>
                <a href="mailto:customer.experience@tenwekhosp.org" class="mt-1 inline-block text-teal-600 hover:text-teal-700 font-medium">customer.experience@tenwekhosp.org</a>
            </div>
            <div class="p-6 rounded-xl bg-slate-50 border border-slate-100">
                <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Visit our hospital</h2>
                <p class="mt-2 text-slate-700">Bomet County, Kenya</p>
                <p class="text-slate-600">P.O Box 39-20400 Bomet, Kenya</p>
            </div>
            <div class="p-6 rounded-xl bg-slate-50 border border-slate-100">
                <h2 class="text-sm font-semibold text-slate-500 uppercase tracking-wider">Visiting hours</h2>
                <p class="mt-2 text-slate-700 text-sm">Morning: 6:00 – 6:45 am</p>
                <p class="text-slate-600 text-sm">Lunch: 1:00 – 2:00 pm · Evening: 4:00 – 5:00 pm</p>
                <a href="{{ route('contact.visiting') }}" class="mt-2 inline-block text-sm font-medium text-teal-600 hover:text-teal-700">Full visiting hours →</a>
            </div>
        </div>

        {{-- Donate section (#donate) --}}
        <div id="donate" class="mt-16 not-prose scroll-mt-24">
            <div class="p-8 lg:p-10 rounded-2xl bg-teal-50 border border-teal-100">
                <h2 class="text-2xl font-bold text-slate-900">Donate</h2>
                <p class="mt-3 text-slate-600 max-w-2xl">Your gift helps Tenwek Hospital provide compassionate, affordable healthcare and training. Every donation supports our mission: excellence in compassionate healthcare, spiritual ministry, and training for service to the glory of God.</p>
                <div class="mt-6 flex flex-wrap gap-4">
                    <a href="#" class="inline-flex items-center px-6 py-3 text-base font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg shadow-sm">Donate online</a>
                    <span class="inline-flex items-center px-4 py-2 text-sm text-slate-600 bg-white border border-slate-200 rounded-lg">Or give via M-Pesa / bank (details on request)</span>
                </div>
                <p class="mt-4 text-sm text-slate-500">For large or designated gifts, please contact us at <a href="mailto:customer.experience@tenwekhosp.org" class="text-teal-600 hover:text-teal-700">customer.experience@tenwekhosp.org</a> or call 0700 499 699.</p>
            </div>
        </div>

        {{-- Refer a patient (#refer) --}}
        <div id="refer" class="mt-16 not-prose scroll-mt-24">
            <div class="p-8 lg:p-10 rounded-2xl bg-white border border-slate-200">
                <h2 class="text-2xl font-bold text-slate-900">Refer a patient</h2>
                <p class="mt-3 text-slate-600 max-w-2xl">Referring clinicians and facilities can contact us to refer patients for specialist care, including cardiothoracic and general surgical services. We work with referring doctors to coordinate transfer and initial assessment.</p>
                <ul class="mt-4 space-y-2 text-slate-600">
                    <li><strong class="text-slate-800">Phone:</strong> <a href="tel:+254700499699" class="text-teal-600 hover:text-teal-700">0700 499 699</a> / <a href="tel:+254740346537" class="text-teal-600 hover:text-teal-700">0740 346 537</a></li>
                    <li><strong class="text-slate-800">Email:</strong> <a href="mailto:customer.experience@tenwekhosp.org" class="text-teal-600 hover:text-teal-700">customer.experience@tenwekhosp.org</a></li>
                </ul>
                <a href="tel:+254700499699" class="mt-6 inline-flex items-center px-6 py-3 text-base font-medium text-white bg-teal-600 hover:bg-teal-700 rounded-lg">Call to refer</a>
            </div>
        </div>

        {{-- Ambulance --}}
        <div class="mt-10 not-prose">
            <div class="p-6 rounded-xl bg-amber-50 border border-amber-100">
                <h2 class="text-lg font-semibold text-slate-900">Ambulance</h2>
                <p class="mt-1 text-slate-600">To book our ambulance, contact the Tenwek Hospital Coverage team on <a href="tel:+254727033725" class="font-medium text-teal-600 hover:text-teal-700">0727 033 725</a>.</p>
            </div>
        </div>

        {{-- Location map --}}
        <div class="mt-12 not-prose">
            <h2 class="text-lg font-semibold text-slate-900 mb-3">Location map</h2>
            <div class="h-72 bg-slate-200 rounded-xl flex items-center justify-center text-slate-500 border border-slate-200">Map placeholder — Tenwek Hospital, Bomet County, Kenya</div>
        </div>
    </x-page>
@endsection
