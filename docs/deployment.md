# Deployment and troubleshooting

## Historical status

Transaction-request interface with PHP and Telegram processing. It does not perform an automated exchange or provide live market data.

واجهة استقبال طلبات بخادم PHP وTelegram. لا تنفذ تحويلاً آلياً ولا تقدم بيانات سوق مباشرة.

## Local release environment

Use fresh configuration, a disposable database/corpus and independently installed dependencies. This release never needs retired production services. Keep credentials, uploaded files, sessions, caches and signing material outside the public source. Credential removal does not revoke a provider key.

## Troubleshooting

### Proof rejected

Use genuine JPEG/PNG/WebP under 5 MB; browser MIME declarations do not override content checks.

### Amount rejected

Use a positive finite supported amount and account for fixed demonstration fees.

### Telegram fails

Keep TLS enabled; configure credentials privately and verify provider availability.

### Operation not tracked

The operation ID is a receipt for intake, not confirmation of financial execution.

## Current limits

Requests are for operator review; no automatic execution or authoritative tracking API. Retries after uncertain live delivery require reconciliation. Do not expose original logs.

الطلبات لمراجعة المشغل ولا تنفذ تحويلات آلية أو تتبعاً رسمياً. يلزم التحقق قبل إعادة الإرسال بعد نتيجة غير مؤكدة. لا تُنشر السجلات الأصلية.
