# Synthetic demonstration

Select a supported pair → view a fixed estimate → enter synthetic recipient details → attach optional proof → PHP validates → demo accepts or provider confirms → show the server operation number.

## Walkthrough

1. Submit synthetic input without a proof image.
2. Submit a harmless generated image and inspect demo response.
3. Reject invalid amount, unsupported currencies and fake image MIME/content.
4. Verify a provider failure produces an error instead of success.

## Acceptance checklist

- [ ] PHP syntax
- [ ] Amount/currency/request tampering rejection
- [ ] Proof content and size validation
- [ ] TLS and Telegram escaping; response operation ID

## Evidence discipline

Screenshots must come from the running application with synthetic records. Record the component, viewport and configuration. A storyboard is not a recorded walkthrough. Benchmark only generated data and include hardware, input size, configuration, elapsed time and cache conditions.

Requests are for operator review; no automatic execution or authoritative tracking API. Retries after uncertain live delivery require reconciliation. Do not expose original logs.
