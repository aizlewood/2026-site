(() => {
  document.body.classList.add("enhanced");

  const articles = [...document.querySelectorAll("#collection > article")];
  const reader = document.querySelector("#reader");
  const content = reader.querySelector(".reader-content");
  const indexDialog = document.querySelector("#index");
  const indexList = document.querySelector("[data-index-list]");
  const root = document.documentElement;
  const palettes = [
    [[255, 86, 183], [255, 220, 82], [75, 230, 217], [124, 116, 255]],
    [[255, 94, 188], [255, 182, 80], [101, 167, 255], [209, 93, 240]],
    [[255, 202, 77], [255, 126, 165], [240, 79, 203], [115, 102, 255]],
    [[73, 228, 220], [217, 239, 76], [255, 228, 90], [142, 124, 255]],
    [[233, 80, 220], [88, 223, 240], [255, 207, 101], [122, 112, 255]],
    [[255, 98, 173], [255, 174, 66], [87, 225, 189], [164, 92, 255]]
  ];
  const colorNames = ["--blob-a", "--blob-b", "--blob-c", "--blob-d"];

  let current = -1;
  let wanderIndex = 0;
  let scrollY = 0;

  const title = article => article.querySelector("h2").textContent.trim();

  function setAtmosphere(index) {
    const palette = palettes[((index % palettes.length) + palettes.length) % palettes.length];
    colorNames.forEach((name, colorIndex) => {
      root.style.setProperty(name, `rgb(${palette[colorIndex].join(" ")})`);
    });
  }

  function syncAtmosphereToScroll() {
    if (reader.open || indexDialog.open) return;
    const viewportCenter = window.innerHeight / 2;
    let closestDistance = Infinity;

    articles.forEach((article, index) => {
      const rect = article.getBoundingClientRect();
      const distance = Math.abs(rect.top + rect.height / 2 - viewportCenter);
      if (distance < closestDistance) {
        closestDistance = distance;
        wanderIndex = index;
      }
    });

    setAtmosphere(wanderIndex);
  }

  function openArticle(article, push = true) {
    current = articles.indexOf(article);
    if (current < 0) return;
    scrollY = window.scrollY;
    content.replaceChildren(article.cloneNode(true));
    setAtmosphere(current);
    reader.showModal();
    if (push && location.hash !== `#${article.id}`) {
      history.pushState({ entry: article.id }, "", `#${article.id}`);
    }
  }

  function closeReader(update = true) {
    if (reader.open) reader.close();
    content.replaceChildren();
    if (update && location.hash) {
      history.pushState({}, "", location.pathname + location.search);
    }
    requestAnimationFrame(() => {
      window.scrollTo(0, scrollY);
      requestAnimationFrame(syncAtmosphereToScroll);
    });
  }

  document.querySelectorAll(".entry-link").forEach(link => {
    link.addEventListener("click", event => {
      event.preventDefault();
      openArticle(link.closest("article"));
    });
  });

  reader.querySelector(".reader-close").addEventListener("click", () => closeReader());
  reader.addEventListener("cancel", event => {
    event.preventDefault();
    closeReader();
  });
  reader.querySelector("[data-previous]").addEventListener("click", () => {
    if (current < 0) return;
    openArticle(articles[(current - 1 + articles.length) % articles.length]);
  });
  reader.querySelector("[data-next]").addEventListener("click", () => {
    if (current < 0) return;
    openArticle(articles[(current + 1) % articles.length]);
  });
  document.querySelector("[data-random]").addEventListener("click", () => {
    let next = Math.floor(Math.random() * articles.length);
    if (articles.length > 1 && next === current) next = (next + 1) % articles.length;
    openArticle(articles[next]);
  });

  const groups = new Map();
  [...articles]
    .sort((a, b) => title(a).localeCompare(title(b)))
    .forEach(article => {
      const letter = title(article).charAt(0).toUpperCase();
      if (!groups.has(letter)) groups.set(letter, []);
      groups.get(letter).push(article);
    });

  groups.forEach((items, letter) => {
    const section = document.createElement("section");
    section.className = "index-group";
    const heading = document.createElement("h3");
    heading.textContent = letter;
    const links = document.createElement("div");

    items.forEach(article => {
      const link = document.createElement("a");
      link.href = `#${article.id}`;
      link.textContent = title(article);
      link.addEventListener("click", event => {
        event.preventDefault();
        indexDialog.close();
        openArticle(article);
      });
      links.append(link);
    });

    section.append(heading, links);
    indexList.append(section);
  });

  document.querySelector("[data-index-open]").addEventListener("click", () => indexDialog.showModal());
  document.querySelector("[data-index-close]").addEventListener("click", () => indexDialog.close());
  indexDialog.addEventListener("cancel", event => {
    event.preventDefault();
    indexDialog.close();
  });

  const atmosphereObserver = new IntersectionObserver(entries => {
    if (reader.open || indexDialog.open) return;
    const visible = entries.filter(entry => entry.isIntersecting);
    if (!visible.length) return;

    const viewportCenter = window.innerHeight / 2;
    const nearest = visible.reduce((best, entry) => {
      const rect = entry.boundingClientRect;
      const distance = Math.abs(rect.top + rect.height / 2 - viewportCenter);
      return !best || distance < best.distance ? { entry, distance } : best;
    }, null);

    wanderIndex = articles.indexOf(nearest.entry.target);
    setAtmosphere(wanderIndex);
  }, { rootMargin: "-42% 0px -42% 0px" });

  articles.forEach(article => atmosphereObserver.observe(article));

  window.addEventListener("popstate", () => {
    const id = location.hash.slice(1);
    const article = articles.find(item => item.id === id);
    if (article) openArticle(article, false);
    else closeReader(false);
  });

  const initial = articles.find(article => `#${article.id}` === location.hash);
  if (initial) openArticle(initial, false);
  else syncAtmosphereToScroll();
})();
