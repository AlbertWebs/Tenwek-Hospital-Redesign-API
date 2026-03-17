<?php

return [
    /*
    | All public website pages. Shown in admin "All Pages".
    | path = URL path (no leading slash). route = route name for "View" link.
    | type = 'managed' (page builder) or 'listing' (CMS: careers, news).
    | For listing: admin_route + admin_label for "Manage Content" link.
    */
    'pages' => [
        ['title' => 'Home', 'path' => '', 'route' => 'home', 'group' => 'Main', 'type' => 'managed', 'order' => 0],
        ['title' => 'About Tenwek Hospital', 'path' => 'about/tenwek-hospital', 'route' => 'about.tenwek', 'group' => 'About', 'type' => 'managed'],
        ['title' => 'Book Appointment', 'path' => 'book-appointment', 'route' => 'book-appointment', 'group' => 'Quick Links', 'type' => 'managed'],
        ['title' => 'Cardiothoracic Centre', 'path' => 'cardiothoracic-centre', 'route' => 'ctc.overview', 'group' => 'CTC', 'type' => 'managed'],
        ['title' => 'Cardiothoracic Fellowship', 'path' => 'training/cardiothoracic-fellowship', 'route' => 'training.fellowship', 'group' => 'Training', 'type' => 'managed'],
        ['title' => 'Careers', 'path' => 'careers', 'route' => 'careers.index', 'group' => 'Careers', 'type' => 'listing', 'listing_type' => 'careers', 'admin_route' => 'admin.careers.index', 'admin_label' => 'Manage Jobs'],
        ['title' => 'Clinical Services', 'path' => 'clinical-services', 'route' => 'clinical-services.index', 'group' => 'Clinical Services', 'type' => 'managed'],
        ['title' => 'Community & Mission', 'path' => 'community', 'route' => 'community.index', 'group' => 'Community', 'type' => 'managed'],
        ['title' => 'Contact', 'path' => 'contact', 'route' => 'contact.index', 'group' => 'Contact', 'type' => 'managed'],
        ['title' => 'History', 'path' => 'about/history', 'route' => 'about.history', 'group' => 'About', 'type' => 'managed'],
        ['title' => 'Leadership', 'path' => 'about/leadership', 'route' => 'about.leadership', 'group' => 'About', 'type' => 'managed'],
        ['title' => 'Mission, Vision & Values', 'path' => 'about/mission-vision-values', 'route' => 'about.mission', 'group' => 'About', 'type' => 'managed'],
        ['title' => 'News & Updates', 'path' => 'news', 'route' => 'news.index', 'group' => 'News', 'type' => 'listing', 'listing_type' => 'news', 'admin_route' => 'admin.posts.index', 'admin_label' => 'Manage Posts'],
        ['title' => 'Outpatient Clinics', 'path' => 'clinical-services/outpatient-clinics', 'route' => 'clinical-services.outpatient', 'group' => 'Clinical Services', 'type' => 'managed'],
        ['title' => 'Partnerships', 'path' => 'about/partnerships', 'route' => 'about.partnerships', 'group' => 'About', 'type' => 'managed'],
        ['title' => 'Patient Guide', 'path' => 'patient-guide', 'route' => 'patient-guide', 'group' => 'Quick Links', 'type' => 'managed'],
        ['title' => 'Research', 'path' => 'research', 'route' => 'research.index', 'group' => 'Research', 'type' => 'managed'],
        ['title' => 'Research Ethics Committee', 'path' => 'research/ethics', 'route' => 'research.ethics', 'group' => 'Research', 'type' => 'managed'],
        ['title' => 'Surgical Services', 'path' => 'clinical-services/surgical-services', 'route' => 'clinical-services.surgical', 'group' => 'Clinical Services', 'type' => 'managed'],
        ['title' => 'Tenders', 'path' => 'tenders', 'route' => 'tenders', 'group' => 'Quick Links', 'type' => 'managed'],
        ['title' => 'Training & Education', 'path' => 'training', 'route' => 'training.index', 'group' => 'Training', 'type' => 'managed'],
        ['title' => 'Visiting Hours', 'path' => 'contact/visiting-hours', 'route' => 'contact.visiting', 'group' => 'Contact', 'type' => 'managed'],
        ['title' => 'Volunteers', 'path' => 'volunteers', 'route' => 'volunteers', 'group' => 'Quick Links', 'type' => 'managed'],
    ],
];
