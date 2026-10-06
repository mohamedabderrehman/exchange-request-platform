# الإعداد

استخدم PHP 8.1 مع fileinfo ودوال الصورة وcURL للإرسال الفعلي. شغّل php -S 127.0.0.1:8085؛ العرض مفعّل افتراضياً. صدّر متغيرات البيئة لتفعيل المزود. لا تدخل معلومات مالية حقيقية في العرض. الأسعار والنشاط التسويقي أمثلة فقط.

## التفاصيل والأوامر

Use PHP 8.1+ with fileinfo, image functions and cURL for live mode. Run `php -S 127.0.0.1:8085`; demo mode defaults to enabled. Export environment variables to enable live provider delivery. Do not use real financial details in the public demo. The static conversion display is illustrative and generated marketing activity is not transaction evidence.

## متغيرات تقرأها الشيفرة

| Variable | Source consumer | Configuration rule |
|---|---|---|
| `DEMO_MODE` | `post.php` | Use the local example/source default; adapt to your disposable environment. |
| `TELEGRAM_BOT_TOKEN` | `post.php` | Supply privately when enabling its integration; no secret default. |
| `TELEGRAM_CHAT_ID` | `post.php` | Use the local example/source default; adapt to your disposable environment. |

لا تُحمَّل ملفات الأمثلة تلقائياً. تستخدم وحدات dotenv الملف حيث تكون مهيأة، ويستخدم PHP بيئة العملية أو الاستضافة. افصل المزودين عن العرض وأنشئ أسراراً جديدة واحفظها خارج المستودع.

## أوامر المكونات
