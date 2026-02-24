# Foodpanda App - SSO Client

Food delivery platform with Single Sign-On (SSO) authentication. Part of the Multi-Login System.

## 🏗️ Architecture

```
┌─────────────────┐     ┌─────────────────┐
│  Foodpanda App  │◄───►│   Auth Server   │
│  (This App)     │     │  (Port 8000)    │
└─────────────────┘     └─────────────────┘
```

## ✨ Features

- SSO Authentication (login once, access all apps)
- Restaurant listings
- Food menu browsing
- Order management
- User dashboard

## 📋 Requirements

- PHP 8.2+
- Composer
- MySQL or SQLite

## 🚀 Installation

### Step 1: Clone Repository
```bash
git clone <repository-url>
cd foodpanda-app
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Configure `.env`

#### For Local Development:
```env
APP_NAME="Foodpanda App"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8002

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foodpanda_app
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database

# SSO Configuration (MUST match Auth Server!)
SSO_AUTH_SERVER_URL=http://localhost:8000
SSO_CLIENT_ID=foodpanda
SSO_CLIENT_SECRET=foodpanda-secret-key
SSO_JWT_SECRET=sso-super-secret-key-change-in-production-2024
```

#### For Production:
```env
APP_NAME="Foodpanda App"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-foodpanda-app.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

SESSION_DRIVER=database
SESSION_SECURE_COOKIE=true

# SSO Configuration (IMPORTANT - Point to LIVE Auth Server!)
SSO_AUTH_SERVER_URL=https://your-auth-server.com
SSO_CLIENT_ID=foodpanda
SSO_CLIENT_SECRET=foodpanda-secret-key
SSO_JWT_SECRET=same-secret-as-auth-server
```

### Step 5: Run Migrations
```bash
php artisan migrate
```

### Step 6: Start Server
```bash
php artisan serve --port=8002
```

## 🔄 SSO Flow

1. User clicks "Login with SSO"
2. Redirects to Auth Server
3. If already logged in (from Ecommerce), auto-authenticates!
4. Returns JWT token to this app
5. App validates token & logs user in

## 📡 Routes

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Home page |
| GET | `/restaurants` | Restaurant listing |
| GET | `/login` | Redirect to SSO |
| GET | `/sso/callback` | Handle SSO callback |
| POST | `/logout` | Logout |
| GET | `/dashboard` | User dashboard (protected) |
| GET | `/menu/{id}` | Restaurant menu (protected) |
| GET | `/orders` | User orders (protected) |

## 📁 File Structure

```
foodpanda-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── SsoController.php
│   │   │   └── FoodpandaController.php
│   │   └── Middleware/SsoAuthenticate.php
│   ├── Models/User.php
│   └── Services/SsoService.php
├── config/sso.php
├── routes/web.php
└── resources/views/
```

## 🔧 Troubleshooting

### Clear Cache (after .env changes)
```bash
php artisan config:clear
php artisan cache:clear
```

### Common Issues

| Issue | Solution |
|-------|----------|
| "No token received" | Check `SSO_AUTH_SERVER_URL` points to correct auth server |
| "Invalid token" | Ensure `SSO_JWT_SECRET` matches auth server |
| Auto-login not working | Make sure you're using same browser (cookies) |

## ⚠️ Important Notes

1. **SSO_AUTH_SERVER_URL** must point to your Auth Server
   - Local: `http://localhost:8000`
   - Production: `https://your-auth-server.com`

2. **SSO_JWT_SECRET** must be IDENTICAL on all 3 apps

3. Run `php artisan config:clear` after changing `.env`

## 🧪 Testing SSO

1. Start all 3 servers (Auth: 8000, Ecommerce: 8001, Foodpanda: 8002)
2. Go to `http://localhost:8001` (Ecommerce)
3. Click "Login with SSO" → Login with demo credentials
4. Go to `http://localhost:8002` (Foodpanda)
5. Click "Login with SSO" → Should auto-login without password!

## 📄 License

MIT License
