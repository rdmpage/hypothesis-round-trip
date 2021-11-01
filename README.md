# Hypothes.is round trip

Explore creating annotations on PDFs using hypothesis.is API and displaying them. Goal is to be able to take a PDF and programmatically add annotations which can be correctly displayed by hypothesis.is.

To view local PDF http://localhost/~rpage/hypothesis-round-trip/pdf.js-hypothes.is/viewer/web/viewer.html?file=../../../ZK_article_71171_en_1.pdf

## Hypothes.is API 

Documentation https://h.readthedocs.io/en/latest/api-reference/v1/

Note that the API doesn’t seem to return all the details for the `document` field, such as DOI, etc.

Web URL https://hypothes.is/a/X77zqjsVEeynpYdCSxwsag
API URL https://api.hypothes.is/api/annotations/X77zqjsVEeynpYdCSxwsag


## Annotating a PDF

It looks like having text location, both as character positions in PDF text stream, and using quote selector with 32 character prefix and suffix is enough for hypothes.is to locate the annotation. Hence we can create an annotation using the API and have it display in the hypothes.is version of PDF.js.

## PDF fingerprint

Use `mutool show` to extract fingerprint of PDF and use that as URI of annotation (with `urn:x-pdf:` prefix), e.g. `urn:x-pdf:2a25e5f056859b4186c28a4b67e87d49`.


