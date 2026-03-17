# Tenwek Hospital CTC Website — Information Architecture & Navigation

**Version:** 1.0  
**Purpose:** Clean, structured, professional, patient-friendly IA for patients, doctors, donors, and students.

---

## 1. Navigation Hierarchy

### Main navigation (8–9 items, dropdowns where needed)

| # | Label | Type | Children |
|---|--------|------|----------|
| 1 | **Home** | Single link | — |
| 2 | **About** | Dropdown | About Tenwek, Mission/Vision, Leadership, History, Partnerships, The Cardiothoracic Centre |
| 3 | **Cardiothoracic Centre** | Mega menu | Overview, Clinical Services, Clinics, Facilities, Training |
| 4 | **Clinical Services** | Mega menu | Outpatient & Clinics, Surgical Services, Specialized Departments |
| 5 | **Training & Education** | Dropdown | Residency, Fellowship, College links (external) |
| 6 | **Community & Mission** | Dropdown | Spiritual Ministry, Outreach, Partnerships, Patient Stories |
| 7 | **News & Updates** | Dropdown | Hospital News, Announcements, Events |
| 8 | **Careers** | Dropdown | Open Positions, Work at Tenwek, Internships |
| 9 | **Contact** | Dropdown | Contact Details, Location Map, Visiting Hours |

**CTA buttons (always visible in header):** Donate | Refer Patient

---

## 2. Sitemap Tree Structure

```
/
├── / (Home)
│
├── /about/
│   ├── /about/tenwek-hospital
│   ├── /about/mission-vision-values
│   ├── /about/leadership
│   ├── /about/history
│   ├── /about/partnerships
│   └── /about/cardiothoracic-centre/
│       ├── /about/cardiothoracic-centre (Overview)
│       └── /about/cardiothoracic-centre/tenwek-ctc (Tenwek Hospital CTC page)
│
├── /cardiothoracic-centre/  ← FLAGSHIP
│   ├── /cardiothoracic-centre (Overview — About the CTC)
│   ├── /cardiothoracic-centre/clinical-services/
│   │   ├── adult-cardiac-surgery
│   │   ├── pediatric-cardiac-surgery
│   │   └── cardiothoracic-surgery
│   ├── /cardiothoracic-centre/clinics/
│   │   ├── cardiac-clinic
│   │   ├── pre-operative-assessment
│   │   └── follow-up-care
│   ├── /cardiothoracic-centre/facilities/
│   │   ├── cardiac-icu
│   │   ├── operating-theatres
│   │   └── diagnostic-support
│   └── /cardiothoracic-centre/training/
│       └── cardiothoracic-surgery-fellowship
│
├── /clinical-services/
│   ├── /clinical-services (Overview / landing)
│   ├── /clinical-services/outpatient-clinics/
│   │   ├── general-outpatient
│   │   ├── chest-clinic
│   │   ├── orthopedic-clinic
│   │   ├── oncology-clinic
│   │   ├── endoscopy-clinic
│   │   ├── cardiac-clinic
│   │   ├── fast-track-clinic
│   │   └── palliative-care-unit
│   ├── /clinical-services/surgical-services/
│   │   ├── surgical-services (Overview)
│   │   ├── ob-gyn-surgeries
│   │   ├── orthopedic-surgeries
│   │   └── cardiothoracic-surgeries
│   └── /clinical-services/specialized/
│       ├── eye-services
│       ├── dental-services
│       ├── diagnostic-services
│       └── casualty-emergency
│
├── /training/
│   ├── /training (Overview)
│   ├── /training/residency-programmes
│   ├── /training/cardiothoracic-fellowship
│   ├── [External] Tenwek Hospital College – School of Health Sciences
│   └── [External] Tenwek Hospital College – School of Chaplaincy
│
├── /community/
│   ├── /community/spiritual-ministry
│   ├── /community/outreach
│   ├── /community/global-health-partnerships
│   └── /community/patient-stories
│
├── /news/
│   ├── /news (Hospital News listing)
│   ├── /news/announcements
│   └── /news/events
│
├── /careers/
│   ├── /careers (Overview / Work at Tenwek)
│   ├── /careers/positions
│   └── /careers/internships
│
└── /contact/
    ├── /contact (Contact Details)
    ├── /contact/location-map
    └── /contact/visiting-hours
```

---

## 3. Mega Menu Layout

### About (dropdown — single column)

```
About
├── About Tenwek Hospital
├── Mission, Vision & Core Values
├── Leadership
├── History
├── Partnerships
└── The Cardiothoracic Centre
    ├── Overview
    └── Tenwek Hospital CTC
```

### Cardiothoracic Centre (mega menu — 4 columns)

| Overview | Clinical Services | Clinics | Facilities | Training |
|----------|-------------------|---------|------------|----------|
| About the Cardiothoracic Centre | Adult Cardiac Surgery | Cardiac Clinic | Cardiac ICU | Cardiothoracic Surgery Fellowship |
| | Pediatric Cardiac Surgery | Pre-operative Assessment | Operating Theatres | |
| | Cardiothoracic Surgery | Follow-up Care | Diagnostic Support | |

*Optional: short descriptor line under “Cardiothoracic Centre” in the mega menu header.*

### Clinical Services (mega menu — 3 columns)

| Outpatient & Clinics | Surgical Services | Specialized Departments |
|----------------------|-------------------|--------------------------|
| General Outpatient | Surgical Services (Overview) | Eye Services |
| Chest Clinic | OB/GYN Surgeries | Dental Services |
| Orthopedic Clinic | Orthopedic Surgeries | Diagnostic Services |
| Oncology Clinic | Cardiothoracic Surgeries | Casualty / A&E |
| Endoscopy Clinic | | |
| Cardiac Clinic | | |
| Fast Track Clinic | | |
| Palliative Care Unit | | |

### Training & Education (dropdown)

```
Training & Education
├── Residency Programmes
├── Cardiothoracic Surgery Fellowship
├── Tenwek Hospital College – School of Health Sciences ↗
└── Tenwek Hospital College – School of Chaplaincy ↗
```
*↗ = opens in new tab, with “(External)” or icon in UI.*

### Community & Mission (dropdown)

```
Community & Mission
├── Spiritual Ministry
├── Community Outreach
├── Global Health Partnerships
└── Patient Stories
```

### News & Updates (dropdown)

```
News & Updates
├── Hospital News
├── Announcements
└── Events
```

### Careers (dropdown)

```
Careers
├── Open Positions
├── Work at Tenwek
└── Internship Opportunities
```

### Contact (dropdown)

```
Contact
├── Contact Details
├── Location Map
└── Visiting Hours
```

---

## 4. Recommended URL Structure

| Section | Pattern | Example |
|---------|---------|---------|
| Root | `/` | `/` |
| About | `/about/{slug}` | `/about/leadership` |
| CTC (flagship) | `/cardiothoracic-centre` + `/…` | `/cardiothoracic-centre/facilities/cardiac-icu` |
| Clinical Services | `/clinical-services/{category}/{slug}` | `/clinical-services/outpatient-clinics/chest-clinic` |
| Training | `/training/{slug}` | `/training/residency-programmes` |
| Community | `/community/{slug}` | `/community/patient-stories` |
| News | `/news/{slug}` or `/news/{type}` | `/news/events`, `/news/announcements` |
| Careers | `/careers/{slug}` | `/careers/positions` |
| Contact | `/contact` or `/contact/{slug}` | `/contact/visiting-hours` |

**Conventions:**
- Lowercase, hyphen-separated slugs.
- No trailing slash for canonical URLs (or enforce one style site-wide).
- External college links: config-driven URLs, open in new tab, `rel="noopener noreferrer"`.

---

## 5. Page Component Suggestions by Section

### Home
- **Hero:** Headline, subheadline, primary CTA (Donate / Refer Patient), optional background image or video.
- **About Tenwek overview:** 2–3 sentences + “Learn more” → `/about/tenwek-hospital`.
- **CTC highlight:** Card or banner with short copy + link to `/cardiothoracic-centre`.
- **Clinical services overview:** Grid of 4–6 service cards linking to `/clinical-services` and key sub-pages.
- **Latest news / updates:** 3–4 items (title, date, excerpt) → `/news`.
- **Final CTA block:** Donate, Refer Patient, Contact.

### About
- **Shared:** Breadcrumb, page title, optional sidebar for “About” sub-nav.
- **About Tenwek Hospital:** Rich text, key stats, image(s).
- **Mission, Vision & Core Values:** Three clear blocks (Mission, Vision, Values list).
- **Leadership:** Grid of leaders (photo, name, role, short bio).
- **History:** Timeline or narrative with dates and milestones.
- **Partnerships:** Logos + short descriptions, optional filter by type.
- **The Cardiothoracic Centre (Overview):** Intro copy + link to full CTC section; **Tenwek Hospital CTC:** Deeper narrative and visuals.

### Cardiothoracic Centre (flagship)
- **Overview:** Hero, “Why CTC,” key numbers, links to Clinical Services / Clinics / Facilities / Training.
- **Clinical Services (Adult / Pediatric / Cardiothoracic Surgery):** Service name, description, what to expect, referral/contact CTA.
- **Clinics (Cardiac, Pre-op, Follow-up):** Same pattern: description, process, CTA.
- **Facilities (ICU, Theatres, Diagnostic):** Description, photos, capacity/equipment highlights.
- **Training (Fellowship):** Programme description, eligibility, application link, key faculty.

### Clinical Services
- **Section landing:** Intro + three columns (Outpatient, Surgical, Specialized) with links.
- **Outpatient / Surgical / Specialized pages:** Consistent template: service name, description, who it’s for, how to access (e.g. referral, walk-in), contact or “Book/Refer” CTA.

### Training & Education
- **Landing:** Intro + cards for Residency, Fellowship, and two external colleges (clearly labeled “External” and “Opens in new tab”).
- **Residency / Fellowship:** Programme overview, structure, eligibility, how to apply.

### Community & Mission
- **Spiritual Ministry / Outreach / Global Health:** Narrative + images; optional quotes or stats.
- **Patient Stories:** List/grid of stories with featured image, title, excerpt; single story: full narrative, optional video or quote.

### News & Updates
- **Hospital News / Announcements / Events:** List layout (date, title, excerpt); filters if needed. Single item: full content, date, categories/tags.

### Careers
- **Work at Tenwek:** Culture, benefits, why Tenwek.
- **Open Positions:** List (role, department, type) with link to apply or external ATS.
- **Internships:** Programme description + application or contact.

### Contact
- **Contact Details:** Address, phone(s), email(s), hours.
- **Location Map:** Embedded map + address.
- **Visiting Hours:** Table or list by area/ward if applicable.

---

## 6. Footer Navigation (Grouped)

| Column 1 — About | Column 2 — Cardiothoracic Centre | Column 3 — Clinical Services |
|------------------|----------------------------------|------------------------------|
| About Tenwek | CTC Overview | Outpatient Clinics |
| Mission & Vision | Cardiac Surgery | Surgical Services |
| Leadership | Cardiac Clinic | Diagnostics |
| Partnerships | Fellowship Program | Emergency Care |

| Column 4 — Training | Column 5 — Quick Links |
|---------------------|------------------------|
| Residency Programmes | Careers |
| Fellowship Training | News |
| College of Health Sciences ↗ | Contact |
| School of Chaplaincy ↗ | Visiting Hours |

| Column 5 (continued) — Community |
|-----------------------------------|
| Outreach |
| Mission Work |
| Support the Hospital |

*↗ = external, new tab.*

---

## 7. Structure Rules (Checklist)

- [ ] **CTC as flagship:** Cardiothoracic Centre is a top-level nav item with its own mega menu and clear hierarchy.
- [ ] **Clinical services grouped:** All under `/clinical-services` with sub-groups (Outpatient, Surgical, Specialized).
- [ ] **Training separate:** Under `/training`, distinct from clinical service pages; external colleges clearly marked.
- [ ] **External links:** New tab, `rel="noopener noreferrer"`, “(External)” or icon in label.
- [ ] **Main nav count:** 9 items (Home, About, CTC, Clinical Services, Training, Community, News, Careers, Contact).
- [ ] **Dropdowns:** About, Training, Community, News, Careers, Contact; **Mega menus:** CTC, Clinical Services.
- [ ] **Scalable:** URL and nav patterns allow new departments or services without breaking IA.

---

## 8. Optional: Route/Controller Mapping (for Laravel)

For the Laravel API/front-end, consider aligning route names with this IA:

- `home` → `/`
- `about.*` → `/about/*`
- `cardiothoracic-centre.*` or `ctc.*` → `/cardiothoracic-centre/*`
- `clinical-services.*` → `/clinical-services/*`
- `training.*` → `/training/*`
- `community.*` → `/community/*`
- `news.*` → `/news/*`
- `careers.*` → `/careers/*`
- `contact.*` → `/contact/*`

This document can be used by both the API (e.g. for sitemap or menu endpoints) and the front-end (for routing and navigation components).
