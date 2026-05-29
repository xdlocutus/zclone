# Nebula Command

A production-oriented PHP 8.3 realtime browser MMO space strategy platform inspired by classic empire games and redesigned with a modern SaaS/game-dashboard UX.

## Included systems

- Custom PSR-4 MVC framework: DI container, router, middleware, environment config, PDO database layer, repositories, services, events, Redis queues, tick daemon, and WebSocket server entrypoint.
- Authentication: registration, login, secure password hashing, CSRF protection, sessions, roles, JWT API token helper, profile/avatar-ready columns, email verification and remember-token fields.
- Game systems: multiple universes, galaxy/system/slot coordinates, planet resources with offline accumulation, buildings and queues, research definitions, fleet dispatch, combat simulator, alliances, marketplace, messages, notifications, achievements, premium QOL transactions.
- Realtime: Redis-backed event dispatch and queue worker publishing `ResourceUpdated`, `FleetDeparted`, `BuildingFinished`, and other game events; Ratchet-compatible WebSocket server.
- UI: mobile-first Tailwind/Alpine dashboard with glassmorphism, live resource header, queue cards, sci-fi landing page, PWA manifest, and responsive game modules.
- Deployment: Docker, Docker Compose, Nginx config, PostgreSQL schema, seed data, and Replit-compatible PHP server command.

## Quick start

```bash
cp .env.example .env
composer install
docker compose up -d postgres redis
php database/migrate.php
php database/seed.php
php -S 0.0.0.0:8080 -t public
```

Run workers separately:

```bash
php app/jobs/tick.php
php app/jobs/worker.php
php app/websockets/server.php
```

Seed login: `admin@nebula.test` / `password`.

## Production hardening

Set strong `APP_KEY` and `JWT_SECRET`, enable HTTPS and secure cookies, run workers under supervisor/systemd, keep Redis private, run migrations in CI/CD, and terminate WebSockets behind TLS at Nginx.
