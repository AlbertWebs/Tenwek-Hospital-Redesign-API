# Tenwek Hospital — Admin Dashboard

## Access

- **URL:** `http://localhost:8000/admin` (or your app URL + `/admin`)
- **Login:** `http://localhost:8000/admin/login`
- **Default credentials (after seeding):**
  - Email: `admin@tenwekhosp.org`
  - Password: `password`

Run the seeder if you haven’t: `php artisan db:seed`

## Structure

- **Layout:** `resources/views/admin/layouts/app.blade.php` — fixed sidebar (collapsible), sticky header, main content.
- **Components:** `resources/views/components/admin/` — card, button, input, modal, table, breadcrumb.
- **Routes:** `routes/admin.php` — all admin routes under `auth` middleware; login route named `login` for Laravel’s auth redirect.

## Features Implemented

1. **Dashboard** — Stats (pages, published, posts, media), recent pages and posts.
2. **Page management** — List, create, edit, delete pages; slug, template, status, meta title/description; placeholder section builder on edit.
3. **Media library** — List view (upload and grid to be wired).
4. **News & posts** — List view (CRUD to be wired).
5. **CTC** — Cardiac Services list; Clinics and Facilities placeholder pages.
6. **Menu management** — List menus and items (drag-and-drop to be wired).
7. **Settings** — Placeholder (form to be wired to `Setting` model).

## Database

- **Migrations:** `pages`, `page_sections`, `media`, `posts`, `post_categories`, `menus`, `menu_items`, `settings`, `ctc_services`, `ctc_clinics`, `ctc_facilities`, `ctc_training_programs`.
- **Models:** `Page`, `PageSection`, `Media`, `Post`, `PostCategory`, `Menu`, `MenuItem`, `Setting`, `CtcService`.

## Tech

- **Laravel** (Blade), **Tailwind CSS**, **Alpine.js** (sidebar, dropdowns, modals).
- Design: clean, spacious, rounded-2xl cards, teal primary, Stripe/Linear-style.

## Next Steps (optional)

- Page section builder: drag-and-drop, hero/text/image/CTA blocks, WYSIWYG (e.g. TipTap/Quill).
- Menu management: drag-and-drop reorder, add/edit/delete items.
- Media: upload handler, store in `storage`, link to pages/posts.
- Posts: full CRUD, categories, featured image, publish/draft.
- CTC: full CRUD for services, clinics, facilities, training programs.
- SEO: per-page and global meta/OG; wire to `Setting` and page meta fields.
- Roles & permissions: `roles`/`permissions` tables and middleware.
