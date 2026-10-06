# Arabic transaction intake with proof images

## From the problem to the implementation

Collect a structured exchange request and optional proof image for an operator, with clear submission feedback.

Select a supported pair → view a fixed estimate → enter synthetic recipient details → attach optional proof → PHP validates → demo accepts or provider confirms → show the server operation number.

## Decisions and tradeoffs

Server conversion uses the same fixed presentation rate/fees rather than trusting a browser-submitted total. It is not a trading quote.

finfo and image decoding validate actual upload content; browser MIME is not trusted. The server caps proof images at 5 MB.

Telegram HTML fields are escaped, TLS verification is enabled and raw request/provider logs are removed.

A server-issued operation ID replaces the client-generated success number. No public recipient/financial log is published.

## What the publication preparation established

PHP syntax and HTTP checks passed: synthetic intake without a proof image, invalid/zero/non-finite amount rejection, unsupported currency rejection, and rejection of forged image MIME/content. TLS verification is enabled in source. Live provider delivery and financial execution are not claimed.

## Deployment experience and evidence limits

Transaction-request interface with PHP and Telegram processing. It does not perform an automated exchange or provide live market data.

The receipt identifies request intake, not completed financial execution. Public tracking is historical presentation and does not expose a live transaction ledger. Valid proof/provider-failure cases need further checks before collecting real requests.

## Next steps

Complete the uncovered checks above, record the results, and update the demonstration. Retain the existing architecture and add reproducible synthetic cases before claiming performance improvements or another provider integration.
