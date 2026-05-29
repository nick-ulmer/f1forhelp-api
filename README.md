> ⚠️ **AI-Assisted Project** — This project was built with the help of AI tooling and is actively in progress. Features, structure, and documentation may change frequently.

# f1forhelp-api

Backend REST API for [f1forhelp.dev](https://f1forhelp.dev) — a personal portfolio site. Built with Laravel, hosted on Railway, and connected to a React + Vite frontend.

---

## Tech Stack

- **PHP 8.2** + **Laravel 11**
- **MySQL** (Railway-hosted)
- **FrankenPHP** (production server via Railway)
- **L5-Swagger** (OpenAPI documentation)
- **Eloquent ORM**

---

## Live API

**Base URL:** `https://f1forhelp-api-production.up.railway.app`

API documentation (Swagger UI): `/api/documentation`

---

## Endpoints

### Contact

| Method | Route | Description |
|--------|-------|-------------|
| POST | `/api/contact` | Submit a contact message |

**Request body:**
```json
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "message": "Hey, loved your portfolio!",
  "website": ""
}
```

> `website` is a honeypot field — leave empty. Bot submissions with this field populated are silently rejected.

**Responses:**
- `201` — Message received
- `422` — Validation error (field-level errors returned)
- `429` — Rate limit exceeded (5 requests/min per IP)

---

### Counter

| Method | Route | Description |
|--------|-------|-------------|
| GET | `/api/counter` | Get current count |
| POST | `/api/counter/increment` | Increment the counter |

---

## Security

- **Rate limiting** — public POST routes are throttled via Laravel's built-in `throttle` middleware
- **Honeypot** — contact form includes a hidden `website` field to catch bots
- **IP hashing** — visitor IPs are hashed with SHA-256 + a secret salt before storage, never stored raw
- **SQL injection** — all queries use Eloquent ORM with parameterized statements
- **CORS** — restricted to `https://f1forhelp.dev` in production

---

## Local Setup

**Requirements:** PHP 8.2, Composer, MySQL

```bash
git clone https://github.com/nick-ulmer/f1forhelp-api
cd f1forhelp-api
composer install
cp .env.example .env
php artisan key:generate
```

Configure your `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
IP_SALT=your_random_salt
```

Then run migrations and start the server:
```bash
php artisan migrate
php artisan serve
```

Swagger UI will be available at `http://localhost:8000/api/documentation`.

---

## Planned Features

- Analytics / page view tracking
- Game leaderboards
- Project reactions
- Devlog / changelog API

---

## Related

- **Frontend:** [nick-ulmer.github.io](https://github.com/nick-ulmer/nick-ulmer.github.io) — React 19 + Vite portfolio site
