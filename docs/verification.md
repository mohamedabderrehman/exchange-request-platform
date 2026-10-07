# Current release verification

Recorded on 2026-10-06 using disposable local data. Historical deployment and these development checks are recorded separately.

## Passed locally

PHP syntax and HTTP checks passed: synthetic intake without a proof image, invalid/zero/non-finite amount rejection, unsupported currency rejection, and rejection of forged image MIME/content. TLS verification is enabled in source. Live provider delivery and financial execution are not claimed.

## Checks and commands

```sh
php -S 127.0.0.1:8085
# Open /Exchange.html; separate terminal:
python tools/check-syntax.py
python tools/check-demo.py
```

## CI status

The configured GitHub Actions workflows are registered, but the initial runs ended with startup_failure before any jobs or check annotations were created. Local results above are independent of CI. No passing CI badge is shown; the service supplied no further diagnostic message through the available API.

## Remaining platform and coverage limits

The receipt identifies request intake, not completed financial execution. Public tracking is historical presentation and does not expose a live transaction ledger. Valid proof/provider-failure cases need further checks before collecting real requests.

PHP checks used PHP 8.4.26; Node builds used Node 24.19; Python checks used Python 3.12.10 where applicable. This record does not claim production hardening, paid provider verification or tests on every platform.
