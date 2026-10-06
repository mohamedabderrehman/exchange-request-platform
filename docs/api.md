# API and execution paths

This index is extracted from the current source. Router-local paths require their mount prefix from the server entry point. PHP endpoint paths map directly to files unless Apache rewrites them. Controllers and auth middleware are authoritative for request bodies and permissions.

See the source entry points below; this project does not declare Express/Flask router paths.

## Source entry points

- [Exchange.html](../Exchange.html)
- [post.php](../post.php)
- [currency-options.json](../currency-options.json)

## الاستخدام

المسارات المذكورة محلية للموجه وتحتاج بادئة الربط في الخادم. ملفات PHP هي مرجع المسارات ما لم تُعَد كتابتها. استخدم بيانات اصطناعية وفحوص الصلاحيات الموجودة في الشيفرة.


## Representative usage

POST uses form fields amount, fromCurrencyText, toCurrencyText, walletAddress, cardCode and optional uploadedImage. Currency labels must exactly match currency-options.json. Actual file content is checked; changing browser MIME does not permit an arbitrary file. The operation number is an intake receipt only.

```sh
python tools/check-demo.py
# Open http://localhost:8085/Exchange.html for the maintained request form.
# POST /post.php accepts multipart/form-data for genuine proof images.
# 200 status=success is demo acceptance/provider confirmation; 422 rejects input.
```
