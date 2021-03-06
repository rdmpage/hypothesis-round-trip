# Hypothes.is round trip

Explore creating annotations on PDFs using hypothesis.is API and displaying them. Goal is to be able to take a PDF and programmatically add annotations which can be correctly displayed by hypothesis.is.

To view local PDF http://localhost/~rpage/hypothesis-round-trip/pdf.js-hypothes.is/viewer/web/viewer.html?file=../../../ZK_article_71171_en_1.pdf

## Approach

1. Start with a PDF
2. Extract fingerprint to uniquely identify PDF
3. Extract text and add annotations using text position and quote anchors
4. Add annotations to hypothes.is database
5. View annotations on PDFs using PDF.js + hypothesis.is
6. Consider tools to add annotations natively to PDF

## Hypothes.is API 

Documentation https://h.readthedocs.io/en/latest/api-reference/v1/

Note that the API doesn’t seem to return all the details for the `document` field, such as DOI, etc.

Web URL https://hypothes.is/a/X77zqjsVEeynpYdCSxwsag
API URL https://api.hypothes.is/api/annotations/X77zqjsVEeynpYdCSxwsag


## Annotating a PDF

It looks like having text location, both as character positions in PDF text stream, and using quote selector with 32 character prefix and suffix is enough for hypothes.is to locate the annotation. Hence we can create an annotation using the API and have it display in the hypothes.is version of PDF.js.

```json
"target": [
    {
      "source": "urn:x-pdf:2a25e5f056859b4186c28a4b67e87d49",
      "selector": [
        {
          "type": "TextQuoteSelector",
          "exact": "Nanhaipotamon longhaiense sp. nov.",
          "prefix": ", 1896 Nanhaipotamon Bott, 1968 ",
          "suffix": " http://zoobank.org/E25133A7-AB4A"
        },
        {
          "end": 7958,
          "type": "TextPositionSelector",
          "start": 7924
        }
      ]
    }
  ],
```

## PDF fingerprint

Use `mutool show` to extract fingerprint of PDF and use that as URI of annotation (with `urn:x-pdf:` prefix), e.g. `urn:x-pdf:2a25e5f056859b4186c28a4b67e87d49`.

## Background

### Examples in the wild

Gigascience, e.g. https://academic.oup.com/gigascience/article/9/5/giaa037/5827190

Journals that have hypothes.is: Pensoft, Gigascience

### Locating anchors

[Fuzzy Anchoring](https://web.hypothes.is/blog/fuzzy-anchoring/)
[Robust Anchoring](https://web.hypothes.is/robust-anchoring/)

### Useful code

PHP version of [Diff-Match-Patch](https://github.com/yetanotherape/diff-match-patch}

[dom-anchor-text-quote](https://github.com/tilgovi/dom-anchor-text-quote) via https://twitter.com/judell/status/1253737039574396928


