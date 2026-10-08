# Arlo landing page

`/arlo` uses its own Kirby template and loads only its own stylesheets. The homepage feed title, product badge and date live in `content/8-arlo/arlo.md`.

The landing content and original styling are maintained in the Arlo project at `docs/landing-content/index.html` and `docs/landing-content/styles.css`. Refresh the deployable exports from this site's root after changing those files:

```sh
php scripts/sync-arlo-landing.php
```

For a different source location, pass the landing-content directory as the first argument. Deploy `content/8-arlo`, `site/templates/arlo.php`, `assets/css/arlo-source.css` and `assets/css/arlo.css` with the site. The published site reads the exported files and does not need access to the Arlo checkout.

The template adds return links to the homepage feed, the site's metadata, a skip link and the real contact destination. Site-specific responsive adjustments live in `assets/css/arlo.css`; keep edits to the original design in the Arlo source, then refresh the exports.
