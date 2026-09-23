# Laws, Biases & Other Things

A dependency-free static microsite prototype.

## Run it
Open `index.html` directly in a browser, or serve this folder with any simple static web server. Deploy the complete folder as `/laws-biases-other/`.

## Files
- `index.html` — canonical semantic content.
- `css/site.css` — all presentation and automated visual variation.
- `js/site.js` — progressive enhancement: detail view, generated A–Z index, Random, previous/next and URL state.
- `PROJECT.md` — project principles and decisions.

## Add an entry
1. Open `index.html`.
2. Copy an existing `<article>` inside `<main id="collection">`.
3. Give it a unique, readable `id`, e.g. `id="confirmation-bias"`.
4. Replace the title, type, definition and detail content.
5. Make the Explore link point to the same fragment ID.
6. Save.

That is all. Do not add entry-specific CSS or JavaScript. The visual composition, A–Z index, Random and previous/next navigation are automatic.

## Content structure
Each article should contain:
- Type
- Title
- Definition
- Why it matters
- In practice
- Origin
- Optional clarification only when genuinely useful

## Design rule
Entry 46 should look intentional without anyone having to design entry 46.
