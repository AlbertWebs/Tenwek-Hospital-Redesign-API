<?php

use App\Http\Controllers\CareersController;
use App\Http\Controllers\OutstationsController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', fn () => view('home'))->name('home');

// About
Route::get('/about/tenwek-hospital', fn () => view('about.tenwek'))->name('about.tenwek');
Route::get('/about/mission-vision-values', fn () => view('about.mission'))->name('about.mission');
Route::get('/about/leadership', fn () => view('about.leadership'))->name('about.leadership');
Route::get('/about/history', fn () => view('about.history'))->name('about.history');
Route::get('/about/partnerships', fn () => view('about.partnerships'))->name('about.partnerships');

// Cardiothoracic Centre
Route::get('/cardiothoracic-centre', fn () => view('ctc.overview'))->name('ctc.overview');
Route::get('/cardiothoracic-centre/clinical-services/{slug}', function (string $slug) {
    $titles = [
        'adult-cardiac' => 'Adult Cardiac Surgery',
        'pediatric-cardiac' => 'Pediatric Cardiac Surgery',
        'cardiothoracic' => 'Cardiothoracic Surgery',
    ];
    $title = $titles[$slug] ?? str_replace('-', ' ', ucwords($slug));
    return view('section', [
        'title' => $title,
        'breadcrumbs' => ['Cardiothoracic Centre' => route('ctc.overview'), 'Clinical Services' => null, $title => null],
        'content' => '<p>Content for ' . e($title) . '.</p>',
    ]);
});
Route::get('/cardiothoracic-centre/clinics/{slug}', function (string $slug) {
    $titles = ['cardiac' => 'Cardiac Clinic', 'pre-op' => 'Pre-operative Assessment', 'follow-up' => 'Follow-up Care'];
    $title = $titles[$slug] ?? str_replace('-', ' ', ucwords($slug));
    return view('section', [
        'title' => $title,
        'breadcrumbs' => ['Cardiothoracic Centre' => route('ctc.overview'), 'Clinics' => null, $title => null],
        'content' => '<p>Content for ' . e($title) . '.</p>',
    ]);
});
Route::get('/cardiothoracic-centre/facilities/{slug}', function (string $slug) {
    $titles = ['cardiac-icu' => 'Cardiac ICU', 'operating-theatres' => 'Operating Theatres', 'diagnostic' => 'Diagnostic Support'];
    $title = $titles[$slug] ?? str_replace('-', ' ', ucwords($slug));
    return view('section', [
        'title' => $title,
        'breadcrumbs' => ['Cardiothoracic Centre' => route('ctc.overview'), 'Facilities' => null, $title => null],
        'content' => '<p>Content for ' . e($title) . '.</p>',
    ]);
});

// Clinical Services
Route::get('/clinical-services', fn () => view('clinical-services.index'))->name('clinical-services.index');
Route::get('/clinical-services/outpatient-clinics', fn () => view('clinical-services.outpatient'))->name('clinical-services.outpatient');
Route::get('/clinical-services/surgical-services', fn () => view('clinical-services.surgical'))->name('clinical-services.surgical');
Route::get('/clinical-services/outpatient-clinics/{slug}', function (string $slug) {
    $title = str_replace('-', ' ', ucwords($slug)) . ' Clinic';
    return view('section', [
        'title' => $title,
        'breadcrumbs' => ['Clinical Services' => route('clinical-services.index'), 'Outpatient Clinics' => route('clinical-services.outpatient'), $title => null],
        'content' => '<p>Content for ' . e($title) . '.</p>',
    ]);
});
Route::get('/clinical-services/surgical-services/{slug}', function (string $slug) {
    $titles = ['ob-gyn' => 'OB/GYN Surgeries', 'orthopedic' => 'Orthopedic Surgeries', 'cardiothoracic' => 'Cardiothoracic Surgeries', 'neurosurgical' => 'Neurosurgical Services'];
    $title = $titles[$slug] ?? str_replace('-', ' ', ucwords($slug));
    return view('section', [
        'title' => $title,
        'breadcrumbs' => ['Clinical Services' => route('clinical-services.index'), 'Surgical Services' => route('clinical-services.surgical'), $title => null],
        'content' => '<p>Content for ' . e($title) . '.</p>',
    ]);
});
Route::get('/clinical-services/specialized/{slug}', function (string $slug) {
    $titles = ['eye' => 'Eye Services', 'dental' => 'Dental Services', 'diagnostic' => 'Diagnostic Services', 'emergency' => 'Casualty / Accident & Emergency', 'icu' => 'ICU', 'inpatient' => 'Inpatient Medical Services'];
    $title = $titles[$slug] ?? str_replace('-', ' ', ucwords($slug));
    return view('section', [
        'title' => $title,
        'breadcrumbs' => ['Clinical Services' => route('clinical-services.index'), 'Specialized' => null, $title => null],
        'content' => '<p>Content for ' . e($title) . '.</p>',
    ]);
});

// Training
Route::get('/training', fn () => view('training.index'))->name('training.index');
Route::get('/training/cardiothoracic-fellowship', fn () => view('training.fellowship'))->name('training.fellowship');

// Community
Route::get('/community', fn () => view('community.index'))->name('community.index');

// Outstations (satellite facilities; managed in admin)
Route::get('/outstations', [OutstationsController::class, 'index'])->name('outstations.index');
Route::get('/outstations/{outstation}', [OutstationsController::class, 'show'])->name('outstations.show');

// News
Route::get('/news', fn () => view('news.index'))->name('news.index');

// Careers (lists job opportunities from database)
Route::get('/careers', [CareersController::class, 'index'])->name('careers.index');

// Contact
Route::get('/contact', fn () => view('contact.index'))->name('contact.index');
Route::get('/contact/visiting-hours', fn () => view('contact.visiting'))->name('contact.visiting');

// Support / Quick links (from live header audit)
Route::get('/book-appointment', fn () => view('section', ['title' => 'Book Appointment', 'breadcrumbs' => ['Book Appointment' => null], 'content' => '<p>Schedule an appointment with our panel of doctors. Content placeholder.</p>']))->name('book-appointment');
Route::get('/tenders', fn () => view('section', ['title' => 'Tenders', 'breadcrumbs' => ['Tenders' => null], 'content' => '<p>Current procurement and tenders. Content placeholder.</p>']))->name('tenders');
Route::get('/volunteers', fn () => view('section', ['title' => 'Volunteers', 'breadcrumbs' => ['Volunteers' => null], 'content' => '<p>Volunteer with Tenwek Hospital. Content placeholder.</p>']))->name('volunteers');
Route::get('/patient-guide', fn () => view('section', ['title' => 'Patient Guide', 'breadcrumbs' => ['Patient Guide' => null], 'content' => '<p>Information for patients. Content placeholder.</p>']))->name('patient-guide');

// Research (from live header audit)
Route::get('/research', fn () => view('section', ['title' => 'Research', 'breadcrumbs' => ['Research' => null], 'content' => '<p>Research at Tenwek Hospital. Content placeholder.</p>']))->name('research.index');
Route::get('/research/ethics', fn () => view('section', ['title' => 'Institutional Ethics Review Committee', 'breadcrumbs' => ['Research' => route('research.index'), 'Ethics Committee' => null], 'content' => '<p>Institutional Ethics Review Committee. Content placeholder.</p>']))->name('research.ethics');

require __DIR__ . '/admin.php';
