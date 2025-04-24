# 🔐 Laravel Stealth Auth

**Token-based one-time authentication for Laravel** — built for secure, link-based logins without passwords. Ideal for email magic links, temporary access, impersonation features, or custom admin access flows.

> Built with 🔥 by [Md Saifullah](https://iamthesaifullah.com)  
> Connect on [LinkedIn](https://linkedin.com/in/iamthesaifullah)

---

## 🚀 Features

- 🔐 One-time or limited-use token authentication
- ⏱ Expiry-based access control (e.g. valid for 15 minutes)
- 🧠 Optional user auto-login with `Auth::login()`
- 📦 Plug & play with middleware
- 🗂️ Configurable storage, TTL, encryption, usage limits

---

## 📦 Installation

```bash
composer require yourvendor/laravel-stealth-auth
```

### 📂 Publish Config (optional)

```bash
php artisan vendor:publish --tag=stealth-auth-config
```

This will publish:

- `config/stealth-auth.php`

---

## ⚙️ Configuration

In `config/stealth-auth.php`, you can control:

```php
return [
    'token_lifetime' => 15,         // in minutes
    'storage_driver' => 'database',
    'encryption' => true,           // encrypt token in DB
    'audit_logging' => true,        // enable/disable logs
    'max_uses' => 1,                // max token usage
];
```

---

## 🧪 Usage

### 🔐 Generating a Token

```php
use App\Models\User;
use StealthAuth\Facades\StealthAuth;

$user = User::find(1);

$token = StealthAuth::forUser($user); // returns token string

$link = url('/stealth-login?token=' . $token);
```

### 🔁 Auto-Login Route

```php
// routes/web.php
Route::get('/stealth-login', function () {
    return redirect('/dashboard');
})->middleware('stealth.auth');
```

This route will check the token, and if valid:
- ✅ Log the user in (if user_id is attached)
- 🚫 Block expired or overused tokens

---

## 🧪 Example Test

```php
test('can generate and use token', function () {
    $user = \App\Models\User::factory()->create();
    $token = app(\StealthAuth\Services\StealthAuthManager::class)->forUser($user);

    $this->get('/stealth-login?token=' . $token)
         ->assertRedirect('/dashboard');
});
```

---

## 🛠️ How It Works

1. A token is generated for a user and stored in the DB
2. User clicks a magic link like:  
   `https://your-app.com/stealth-login?token=abc123`
3. Middleware checks:
   - token exists
   - not expired
   - not overused
4. If valid, auto-login via `Auth::loginUsingId`

---

## 📚 Advanced

- 🧾 Tokens can be set to expire
- 🕵️ Token use is limited (`max_uses`)
- 🔒 Token can be encrypted via Laravel's `Crypt`
- 🧱 Extendable service, ready for custom drivers or logic

---

## 👨‍💻 Author

**Md Saifullah**  
🌐 [iamthesaifullah.com](https://iamthesaifullah.com)  
💼 [LinkedIn](https://linkedin.com/in/iamthesaifullah)  
🐱 GitHub: [@iamthesaifullah](https://github.com/iamthesaifullah)  
📧 contact@iamthesaifullah.com

---

## 📄 License

MIT — free to use, fork, extend, build something dope.
https://github.com/iamthesaifullah/Laravel-Stealth-Auth/blob/main/LICENSE
---

## 💡 Want more?

- Add logging for token usage events
- Build a Nova tool or Filament widget to manage tokens
- Create artisan commands like `stealth:token user@example.com`

---

> If this helped you, drop a ⭐ on GitHub and let me know on LinkedIn 🙌
```
