# Setup and configuration

Use PHP 8.1+ with fileinfo, image functions and cURL for live mode. Run `php -S 127.0.0.1:8085`; demo mode defaults to enabled. Export environment variables to enable live provider delivery. Do not use real financial details in the public demo. The static conversion display is illustrative and generated marketing activity is not transaction evidence.

## Environment variables read by source

| Variable | Source consumer | Configuration rule |
|---|---|---|
| `DEMO_MODE` | `post.php` | Use the local example/source default; adapt to your disposable environment. |
| `TELEGRAM_BOT_TOKEN` | `post.php` | Supply privately when enabling its integration; no secret default. |
| `TELEGRAM_CHAT_ID` | `post.php` | Use the local example/source default; adapt to your disposable environment. |

Environment examples do not load themselves. Node dotenv modules read local `.env` where configured; PHP uses its process/hosting environment. Keep provider integrations disconnected for demos. Generate a new secret with `node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"` or equivalent, then store it privately.

## Declared component commands



## Source boundaries

| Component | Responsibility |
|---|---|
| `Home.html` | Public presentation and historical tracking interface |
| `Exchange.html` | Request interface and compression |
| `post.php` | Validated request/provider boundary |
| `currency-options.json` | Actual supported selector labels and codes |
| `logos/` | Existing provider imagery |
