# Laws, Biases & Other Things

**Version:** 0.2
**Status:** Canonical project brief
**Deployment path:** `/laws-biases-other/`

This document is the source of truth for the project.

Where implementation choices conflict with this document, this document wins unless the decision is explicitly changed by Jon.

---

## 1. What we're making

**Laws, Biases & Other Things** is a small, self-contained microsite collecting cognitive biases, psychological effects, principles, laws, theories and related ideas that are interesting or useful through the lens of UX, design and product.

It exists because the subject matter is interesting and because it is fun to make.

It does not need to establish a new framework, become the definitive resource, compete with similar collections, or justify its existence.

Working title:

> **Laws, Biases & Other Things**

Canonical deployment path:

> `/laws-biases-other/`

Individual entries should have permanent fragment URLs, for example:

> `/laws-biases-other/#peak-end-rule`

---

## 2. Audience

Primarily people working in:

- UX and design
- Product
- Technology
- Startups and digital businesses

Entries should remain understandable without specialist knowledge.

---

## 3. Core principles

### Simple

This is a small website, not a platform.

Avoid unnecessary architecture, features and dependencies.

### Visual

The collection should have a strong visual identity derived from Jon's existing LinkedIn work.

The visual experience is an important part of the project rather than decoration applied afterwards.

### Browsable

The site should reward wandering and accidental discovery rather than requiring a particular reading order.

### Concise

Provide enough information to understand each concept properly without turning entries into essays.

### Accurate

Established concepts should be researched and verified rather than copied from existing UX collections or repeated from popular shorthand.

### Useful

The relevance to UX, design and product should be apparent, but relevance should not be forced where it does not naturally exist.

### Curated, not comprehensive

Inclusion means "interesting enough to belong here".

The project does not attempt to catalogue every cognitive bias or design principle.

### No feature creep

Every feature needs a reason to exist.

The default answer to additional functionality is not automatically yes.

---

## 4. Separation of content and presentation

This is a core architectural principle, inspired by **CSS Zen Garden**.

The underlying HTML describes the content and its semantic structure.

CSS owns presentation.

JavaScript owns behaviour only where behaviour is required.

### Requirements

- HTML must remain meaningful and readable with CSS disabled.
- Content must remain accessible if JavaScript fails or is disabled.
- No inline styles.
- Avoid unnecessary presentational markup.
- Do not encode visual decisions into individual entries.
- Classes should describe meaningful roles rather than visual appearance.
- The visual system should be capable of substantial redesign without rewriting the content.
- JavaScript should progressively enhance the document rather than create the document.
- Content architecture must not be distorted purely to achieve a visual effect.

In principle, `site.css` should be replaceable with a radically different stylesheet while the underlying content remains intact.

**Content ≠ presentation ≠ behaviour.**

Keep those boundaries clean.

---

## 5. Maintainability

Future maintenance is a hard requirement.

The site should remain easy to understand and update months or years after launch, whether changes are made by Jon, Codex, another developer, or someone following the README.

Avoid abstractions that make a tiny static website harder to understand.

### Entry 46 test

> **Entry 46 must look intentional without Jon having to design entry 46.**

Adding a new entry should require only:

1. adding its semantic content;
2. assigning a unique fragment ID.

It should **not** require choosing colours, layout, gradients or typography; editing CSS or JavaScript; creating imagery or thumbnails; or manually updating the A–Z index or previous/next navigation.

The visual and behavioural systems should derive everything else automatically.

---

## 6. Editorial model

Each entry uses the following canonical content model:

### Title
The commonly recognised name.

### Type
For example: Law, Bias, Effect, Principle, Theory, Heuristic, Finding, Observation or Adage. Do not imply equivalent scientific status between these types.

### Definition
A concise, standalone explanation of what the concept actually means. This should work independently as the short description used in the Wander experience.

### Why it matters
A short explanation of why somebody working in UX, design or product might find the concept relevant.

### In practice
Concrete manifestations, implications or applications.

### Origin
Enough provenance to explain where the idea came from and, where relevant, who established or popularised it.

### Sources
Reliable references used to verify the entry.

### Optional: Not
Use only where a particularly widespread interpretation materially misrepresents the underlying concept. Do not manufacture a myth-busting angle for every entry.

---

## 7. Editorial approach

Target roughly 100–150 words per expanded entry where appropriate, but the idea dictates the length rather than an arbitrary word count.

The writing should be plain English, concise, clear rather than academic, interesting without being breathless, free of unnecessary UX jargon, and factual rather than opinion-led.

Jon's authorship should primarily be visible through curation, presentation, visual design, writing quality and overall craft.

This is **not** an opinion project.

Research should distinguish between:

1. what the original research/source actually establishes;
2. the plain-English editorial explanation;
3. its relevance to UX/design/product.

Do not present later UX interpretations as though they were part of the original research.

Miller's Law is the reference example: do not turn Miller's 1956 work into a rule that interfaces should contain seven items.

---

## 8. V1 collection

V1 contains **45 approved concepts**.

### Original seed collection

1. Barnum Effect
2. Peak-End Rule
3. Serial Position Effect
4. Von Restorff Effect
5. Zeigarnik Effect
6. Doherty Threshold
7. Hick-Hyman Law
8. Miller's Law
9. Occam's Razor
10. Pareto Principle
11. Fitts's Law
12. Gestalt Principles
13. Hofstadter's Law
14. Survivorship Bias
15. Confirmation Bias
16. Fundamental Attribution Error
17. Conway's Law
18. Parkinson's Law
19. The Innovator's Dilemma

### Additional approved concepts

20. Aesthetic-Usability Effect
21. Jakob's Law
22. Tesler's Law
23. Goal-Gradient Effect
24. Anchoring Bias
25. Framing Effect
26. Default Effect
27. Loss Aversion
28. Endowment Effect
29. Availability Heuristic
30. Priming
31. Picture-Superiority Effect
32. Recognition over Recall
33. Cognitive Load
34. Chunking
35. Progressive Disclosure
36. Mere-Exposure Effect
37. Halo Effect
38. Negativity Bias
39. Status Quo Bias
40. Sunk-Cost Effect
41. Curse of Knowledge
42. False-Consensus Effect
43. Social Proof
44. Choice Overload
45. IKEA Effect

The content schema has been validated using representative entries.

Do not require another editorial approval round before implementing the remaining content.

If research reveals a concept or attribution to be genuinely questionable, flag it rather than quietly publishing dubious material.

---

## 9. Semantic architecture

Current agreed architecture:

- one canonical `index.html`;
- all entries represented as independent semantic `<article>` elements;
- every article has a unique fragment ID;
- no database;
- no CMS;
- no JSON content datastore;
- no templating system;
- no build process.

Do not use visual classes such as `.purple-text`, `.big-title`, `.card` or `.modal-content`.

The HTML should not know how it will ultimately be presented.

---

## 10. Technical architecture

Expected structure:

```text
/laws-biases-other/
├── index.html
├── README.md
├── PROJECT.md
├── css/
│   └── site.css
└── js/
    └── site.js
```

Requirements:

- static site;
- HTML;
- CSS;
- minimal vanilla JavaScript;
- no CMS;
- no database;
- no framework;
- no build system unless a genuine future requirement emerges;
- self-contained;
- deployable as a subfolder;
- responsive;
- accessible;
- performant;
- minimal external dependencies;
- progressive enhancement.

The HTML document is the single source of truth.

JavaScript should derive behavioural features from the existing articles rather than maintaining duplicate content structures.

---

## 11. Navigation and discovery

V1 has three complementary discovery modes.

### Wander
The default experience. Wander is expressive, visual and exploratory. Users scroll through the collection as a typographic/editorial landscape rather than browsing a conventional grid of cards.

### Index
The utility layer. A compact A–Z index for users who know what they are looking for. It should feel closer to a book index than a filtering UI. The Index must be generated automatically from the semantic articles.

### Random
A serendipitous discovery mechanism. Working concept: **Show me something**. Random selects an existing entry automatically.

### Entry detail
Selecting an entry creates a focused reading experience. Detail should provide full entry content, previous, next, close/back and a permanent fragment URL. Returning from an entry should preserve the user's previous position in Wander where practical.

---

## 12. Categories

Categories are explicitly **out of scope for v1**.

Do not introduce taxonomy, category navigation or filtering unless a later version demonstrates a genuine need.

The current discovery model is:

> Wander / Index / Random

---

## 13. Wander visual direction

The original LinkedIn work is the visual starting point.

Key characteristics:

- oversized condensed display typography;
- dark aubergine primary typography;
- vivid/electric purple accents;
- soft blurred gradients;
- pink, orange, blue and purple colour fields;
- strong contrast between huge titles and tiny supporting typography;
- generous whitespace;
- editorial/poster-like composition;
- typography doing most of the visual work.

The website should **translate** this visual language rather than reproduce LinkedIn slides literally.

No imagery is currently required.

---

## 14. Display typography

Canonical display typeface:

> **New Title by Indian Type Foundry**

Do not substitute another condensed face and treat it as equivalent.

During development, a sensible fallback may be used if the licensed webfont is unavailable.

Do **not** bundle, redistribute or otherwise provide New Title font files. Jon will provide/configure appropriately licensed webfont files separately.

Typography should use extremely strong scale contrast, tight display leading, deliberate tracking, aggressive but controlled responsive sizing, deliberate wrapping, very large titles, and substantially quieter metadata and supporting text.

Typography should feel designed rather than simply "large".

---

## 15. Continuous canvas

The initial prototype's sharp visual divisions between articles were rejected.

Do **not** present Wander as stacked full-width cards, obvious viewport-sized panels, a carousel, or visually discrete sections with hard boundaries.

Instead, Wander should feel like **one continuous editorial canvas**.

Desired characteristics:

- no obvious visible boundary between adjacent `<article>` elements;
- gradients may bleed and overlap between concepts;
- irregular vertical rhythm;
- varied amounts of whitespace;
- titles positioned with controlled variation;
- one concept may occupy considerably more vertical space than another;
- visual fields may begin before the previous concept appears to have fully ended.

A useful visual test:

> **If you squint at the page, you should not be able to tell where one `<article>` ends and another begins.**

The semantic boundaries remain clear in the HTML. The visual boundaries should not.

---

## 16. Automated visual grammar

Wander should appear art-directed without requiring individual art direction.

Create a small reusable visual grammar, approximately 6–8 compositional behaviours.

These may vary alignment, title scale, title position, available width, whitespace, gradient position, gradient scale and vertical rhythm.

Variation should be deterministic and derive automatically from document structure, for example using structural CSS selectors.

Do not add visual configuration metadata to individual articles merely to achieve variety.

Reordering or adding articles should naturally produce a new but coherent visual rhythm.

---

## 17. Motion

Motion should be restrained.

Possible uses include subtle gradient drift, slight changes in title position/scale during scrolling, and restrained transitions into focused detail.

Avoid gratuitous parallax, portfolio-demo effects, animation that competes with the typography, and interaction for interaction's sake.

Respect `prefers-reduced-motion`.

---

## 18. Detail experience

Detail should **not** appear as a conventional small white modal box.

Selecting an entry should feel like the poster transforms into a focused reading state or full-viewport editorial takeover.

The enormous title remains part of the visual language while the composition adapts to accommodate definition, why it matters, in practice, origin, sources and optional clarification.

The implementation may use overlay/dialog-like behaviour, but that is a presentation/interaction decision rather than part of the content model.

Direct fragment URLs must continue to work.

---

## 19. Index visual direction

Index should deliberately contrast with Wander.

It should be dense, alphabetical, typographic, restrained and highly usable.

Avoid turning it into cards, category filters, search results or another expressive poster wall.

Think **book index**, not product filtering UI.

---

## 20. Responsive behaviour

Mobile must remain recognisably the same design.

Do not collapse the experience into generic cards simply because the viewport is narrow.

Preserve oversized typography, gradients, editorial composition, strong scale contrast and Wander's exploratory character.

Reduce spatial complexity where necessary without removing the visual identity.

---

## 21. Persistent interface

Keep persistent navigation minimal.

Current working model:

- site name;
- Index;
- Random.

Do not introduce hamburger navigation, category chips, large navigation systems, search by default or unnecessary footer navigation.

---

## 22. Explicit non-goals

V1 is not an academic database, exhaustive catalogue, blog, opinion project, UX methodology, SaaS product, community platform, CMS project, showcase for unnecessary JavaScript, excuse to introduce a framework, or manually art-directed collection of 45 bespoke pages.

Search, filtering, favourites, accounts, sharing tools and similar functionality are not requirements unless future usage demonstrates a genuine need.

---

## 23. Working relationship

Jon directs the project.

Codex may research, draft, implement, critique, identify issues and propose options.

A Codex proposal is **not automatically a project decision**.

Meaningful product, content or visual decisions that have not been made should remain explicitly TBD rather than being silently resolved during implementation.

Do not expand scope merely because an implementation makes additional functionality possible.

---

## 24. Decision log

### 22 September 2026

- Project established as a static microsite.
- Existing LinkedIn visual language selected as the starting point.
- Resource is factual rather than opinion-led.
- Entries require useful context beyond a definition.
- Research and first-pass editorial work can be delegated to Codex.
- Jon retains editorial and creative direction.
- No CMS.
- Long-term human maintainability established as a core requirement.
- CSS Zen Garden-style separation of content, presentation and behaviour established as a core architectural principle.
- V1 candidate collection approved at 45 entries.
- Canonical editorial schema established: Title → Type → Definition → Why it matters → In practice → Origin → Sources.
- Optional "Not" clarification permitted only where useful.
- Single semantic HTML document selected as the content architecture.
- Independent `<article>` elements with permanent fragment IDs selected.
- Wander / Index / Random selected as the v1 discovery model.
- Categories explicitly excluded from v1.
- A–Z Index, Random and previous/next navigation should derive automatically from article content.
- Zero per-entry art direction established as a hard requirement.
- "Entry 46 must look intentional without Jon designing entry 46" established as a design test.
- Working title confirmed as **Laws, Biases & Other Things**.
- Canonical deployment folder confirmed as `/laws-biases-other/`.
- Initial prototype's hard visual divisions between entries rejected.
- Wander changed to a continuous editorial canvas.
- **New Title by Indian Type Foundry** confirmed as the canonical display typeface.
- Typography identified as a primary focus for the next visual iteration.

---

## 25. Current state / next task

A first six-entry prototype exists but its Wander presentation should **not** be treated as the approved visual direction.

The underlying semantic architecture and interaction concepts remain useful.

### Immediate next task: Visual prototype v2

Revise the prototype with:

1. New Title as the canonical display face.
2. No hard visual boundaries between entries.
3. One continuous Wander canvas.
4. Significantly sharper typography.
5. Tighter display leading and stronger scale contrast.
6. More deliberate title wrapping and positioning.
7. Overlapping/bleeding gradient fields.
8. Irregular vertical rhythm.
9. Automated visual variation requiring no per-entry art direction.
10. Existing semantic architecture preserved.
11. Wander / Index / Random preserved.
12. No new features.

The purpose of v2 is to evaluate the visual system, not expand functionality or complete all 45 entries.

---

## 26. Governing test

When uncertain about an implementation decision, ask:

> Does this keep the site simple, semantic, visually distinctive and easy to maintain?

And:

> Could Jon add entry 46 without needing to understand or modify the visual system?

If not, reconsider the implementation.
