# Current release verification

Historical status: Transaction-request interface with PHP and Telegram processing. It does not perform an automated exchange or provide live market data.

Current acceptance checks are in progress. No CI badge or passing integration claim is made yet.

## Checks required

- [ ] PHP syntax
- [ ] Amount/currency/request tampering rejection
- [ ] Proof content and size validation
- [ ] TLS and Telegram escaping; response operation ID

## External dependencies and limits

Requests are for operator review; no automatic execution or authoritative tracking API. Retries after uncertain live delivery require reconciliation. Do not expose original logs.
