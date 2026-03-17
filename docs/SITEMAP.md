# Sitemap Documentation

This document describes the URL structure of the Tenwek Hospital website: **public pages** (main focus) and the **admin dashboard**.

---

## Public pages (website)

Public URLs are defined in `routes/web.php` and listed in `config/public-pages.php`. The site is organized into sections below.

### Main

| URL | Route name | Purpose |
|-----|------------|---------|
| `/` | `home` | Homepage. |

---

### About

| URL | Route name | Purpose |
|-----|------------|---------|
| `/about/tenwek-hospital` | `about.tenwek` | About Tenwek Hospital. |
| `/about/mission-vision-values` | `about.mission` | Mission, vision and values. |
| `/about/leadership` | `about.leadership` | Leadership team. |
| `/about/history` | `about.history` | Hospital history. |
| `/about/partnerships` | `about.partnerships` | Partnerships. |

---

### Cardiothoracic Centre (CTC)

**Note:** A dedicated, separate CTC website is planned. On this main Tenwek Hospital site we only have a **summary** page that introduces the Cardiothoracic Centre and can link out to the new CTC site for full content.

| URL | Route name | Purpose |
|-----|------------|---------|
| `/cardiothoracic-centre` | `ctc.overview` | CTC **summary** page — overview and link to the dedicated CTC website. |

The following slug-based routes exist in code but are **not part of the main sitemap** for the new direction; detailed CTC content will live on the fresh CTC website. They may be removed or kept as redirects when the CTC site launches:

- `/cardiothoracic-centre/clinical-services/{slug}` — e.g. `adult-cardiac`, `pediatric-cardiac`, `cardiothoracic`
- `/cardiothoracic-centre/clinics/{slug}` — e.g. `cardiac`, `pre-op`, `follow-up`
- `/cardiothoracic-centre/facilities/{slug}` — e.g. `cardiac-icu`, `operating-theatres`, `diagnostic`

---

### Clinical services

| URL | Route name | Purpose |
|-----|------------|---------|
| `/clinical-services` | `clinical-services.index` | Clinical services index. |
| `/clinical-services/outpatient-clinics` | `clinical-services.outpatient` | Outpatient clinics listing. |
| `/clinical-services/surgical-services` | `clinical-services.surgical` | Surgical services listing. |

**Dynamic sub-pages** (slug-based):

- **Outpatient clinic** — `/clinical-services/outpatient-clinics/{slug}`  
  Any slug; title is derived as `{Slug} Clinic`.

- **Surgical service** — `/clinical-services/surgical-services/{slug}`  
  Known slugs: `ob-gyn`, `orthopedic`, `cardiothoracic`, `neurosurgical`.

- **Specialized** — `/clinical-services/specialized/{slug}`  
  Known slugs: `eye`, `dental`, `diagnostic`, `emergency`, `icu`, `inpatient`.

---

### Training & education

| URL | Route name | Purpose |
|-----|------------|---------|
| `/training` | `training.index` | Training & education index. |
| `/training/cardiothoracic-fellowship` | `training.fellowship` | Cardiothoracic fellowship programme. |

---

### Community

| URL | Route name | Purpose |
|-----|------------|---------|
| `/community` | `community.index` | Community & mission. |

---

### News

| URL | Route name | Purpose |
|-----|------------|---------|
| `/news` | `news.index` | News and updates listing. |

---

### Careers

| URL | Route name | Purpose |
|-----|------------|---------|
| `/careers` | `careers.index` | Job opportunities (data from database). |

---

### Contact

| URL | Route name | Purpose |
|-----|------------|---------|
| `/contact` | `contact.index` | Contact page. |
| `/contact/visiting-hours` | `contact.visiting` | Visiting hours. |

---

### Quick links / support

| URL | Route name | Purpose |
|-----|------------|---------|
| `/book-appointment` | `book-appointment` | Book an appointment. |
| `/tenders` | `tenders` | Procurement and tenders. |
| `/volunteers` | `volunteers` | Volunteer information. |
| `/patient-guide` | `patient-guide` | Patient guide. |

---

### Research

| URL | Route name | Purpose |
|-----|------------|---------|
| `/research` | `research.index` | Research overview. |
| `/research/ethics` | `research.ethics` | Institutional Ethics Review Committee. |

---

## Navigation & dropdowns (public header)

The public header uses **dropdowns** and **mega menus** to group links. On desktop they appear on hover; on mobile a single flat menu is shown. Implemented in `resources/views/layouts/app.blade.php`.

### Desktop: dropdown vs mega menu

- **Dropdown** — Single column panel (e.g. ~14rem wide). Used for About and Training.
- **Mega menu** — Multi-column panel (wider). Used for Cardiothoracic Centre and Clinical Services so many links fit in one panel.

### About (dropdown)

Trigger: **About**. Simple list:

- About Tenwek Hospital → `about.tenwek`
- Mission, Vision & Values → `about.mission`
- Leadership → `about.leadership`
- History → `about.history`
- Partnerships → `about.partnerships`
- *(divider)* The Cardiothoracic Centre → `ctc.overview`

### Cardiothoracic Centre (mega menu)

Trigger: **Cardiothoracic Centre** (link + caret). Five columns:

| Column | Links |
|--------|--------|
| **Overview** | About the CTC → `ctc.overview` |
| **Clinical Services** | Adult Cardiac Surgery, Pediatric Cardiac Surgery, Cardiothoracic Surgery (slug URLs under `/cardiothoracic-centre/clinical-services/...`) |
| **Clinics** | Cardiac Clinic, Pre-operative Assessment, Follow-up Care (slug URLs under `/cardiothoracic-centre/clinics/...`) |
| **Facilities** | Cardiac ICU, Operating Theatres, Diagnostic Support (slug URLs under `/cardiothoracic-centre/facilities/...`) |
| **Training** | Cardiothoracic Fellowship → `training.fellowship` |

*Note: With the CTC moving to a dedicated website, this mega menu may later show only the CTC summary link and an external link to the new CTC site.*

### Clinical Services (mega menu)

Trigger: **Clinical Services** (link + caret). Three columns:

| Column | Links |
|--------|--------|
| **Outpatient & Clinics** | General Outpatient → `clinical-services.outpatient`, Chest Clinic, Cardiac Clinic, Oncology Clinic (outpatient-clinics slugs), Casualty / A&E (specialized/emergency) |
| **Surgical Services** | Surgical Services → `clinical-services.surgical`, OB/GYN, Orthopedic, Cardiothoracic Surgeries (surgical-services slugs) |
| **Specialized** | Eye Services, Dental Services, Diagnostic Services (specialized slugs) |

### Training & Education (dropdown)

Trigger: **Training & Education**. Simple list:

- Residency Programmes → `training.index`
- Cardiothoracic Fellowship → `training.fellowship`
- *(divider)* School of Health Sciences (External), School of Chaplaincy (External) — placeholder `#` links.

### Top-level links (no dropdown)

- **Home** → `home`
- **Community & Mission** → `community.index`

(Contact, Donate, Refer Patient, etc. are in the upper bar or footer, not in the main nav row.)

### Mobile menu

Single flat list (no nested dropdowns): Home, About, Cardiothoracic Centre, Clinical Services, Training & Education, Community & Mission, Contact, Donate, Refer Patient. Sub-pages (e.g. About sub-items, CTC/Clinical Services mega items) are not repeated here; users go to the parent page or use footer links.

### Footer link groups

The footer repeats many of the same destinations in grouped columns: About, Cardiothoracic Centre, Clinical Services, Training & Education, Outreach & Community, Research, Quick Links, News & Updates. These are not dropdowns but static link blocks.

---

### Public page types (config)

In `config/public-pages.php`, each public page has a **type**:

- **`managed`** — Content edited via the admin page builder (Pages).
- **`listing`** — CMS-style listing; content is managed elsewhere (e.g. Careers → admin Careers, News → admin Posts). The config includes `admin_route` and `admin_label` for the “Manage content” link in admin.

---

## Admin dashboard

Admin routes live in `routes/admin.php`, under the `/admin` prefix. Authentication is required except for login.

### Auth (no auth required)

| URL | Method | Purpose |
|-----|--------|---------|
| `/admin/login` | GET | Login form. |
| `/admin/login` | POST | Process login. |
| `/admin/logout` | POST | Logout (auth required). |

### Authenticated admin (`/admin`)

| URL | Purpose |
|-----|---------|
| `/admin` | Dashboard. |

**Pages (page builder)**

| URL | Purpose |
|-----|---------|
| `/admin/pages` | List pages (index). |
| `/admin/pages/create` | Create page. |
| `/admin/pages/{page}/edit` | Edit page. |
| POST `/admin/pages/sync` | Sync pages from config. |
| POST `/admin/pages/{page}/sections` | Add section to page. |
| PUT `/admin/pages/{page}/sections/{section}` | Update section. |
| DELETE `/admin/pages/{page}/sections/{section}` | Delete section. |
| POST `/admin/pages/{page}/sections/reorder` | Reorder sections. |
| POST `/admin/pages/{page}/sections/{section}/move/{direction}` | Move section up/down. |

**Media**

| URL | Purpose |
|-----|---------|
| `/admin/media` | Media library (list). |
| POST `/admin/media` | Upload media. |

**Posts (news)**

| URL | Purpose |
|-----|---------|
| `/admin/posts` | Manage posts (news). |

**Menus**

| URL | Purpose |
|-----|---------|
| `/admin/menus` | Manage menu items (reorder, add, edit, delete, duplicate). |
| POST `/admin/menus/items` | Create menu item. |
| PUT `/admin/menus/items/{item}` | Update menu item. |
| DELETE `/admin/menus/items/{item}` | Delete menu item. |
| POST `/admin/menus/items/{item}/duplicate` | Duplicate menu item. |
| POST `/admin/menus/reorder` | Reorder menu items. |

**Settings**

| URL | Purpose |
|-----|---------|
| `/admin/settings` | Site settings. |

**Careers**

| URL | Purpose |
|-----|---------|
| `/admin/careers` | List job postings. |
| `/admin/careers/create` | Create job. |
| `/admin/careers/{career}/edit` | Edit job. |
| DELETE `/admin/careers/{career}` | Delete job. |

**CTC (Cardiothoracic Centre)**

| URL | Purpose |
|-----|---------|
| `/admin/ctc/services` | CTC clinical services. |
| `/admin/ctc/clinics` | CTC clinics. |
| `/admin/ctc/facilities` | CTC facilities. |

---

## Reference

- **Public routes:** `routes/web.php`
- **Admin routes:** `routes/admin.php` (included from `web.php`)
- **Canonical public page list:** `config/public-pages.php`
- **Public layout:** `resources/views/layouts/app.blade.php`
- **Admin layout:** `resources/views/admin/layouts/app.blade.php`
