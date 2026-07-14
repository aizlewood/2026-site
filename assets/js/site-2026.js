(function () {
  var btn = document.querySelector('.hamburger-menu');
  var nav = document.querySelector('.offcanvas-nav');
  if (!btn || !nav) return;

  btn.addEventListener('click', function () {
    var open = btn.getAttribute('aria-expanded') === 'true';
    btn.setAttribute('aria-expanded', open ? 'false' : 'true');
    nav.classList.toggle('is-open', !open);
  });
})();

(function () {
  var list = document.querySelector('[data-feed-list]');
  var button = document.querySelector('[data-feed-load-more]');
  if (!list || !button) return;

  var pageSize = parseInt(button.getAttribute('data-page-size') || '50', 10);

  function hiddenItems() {
    return Array.prototype.slice.call(list.querySelectorAll('[data-feed-hidden][hidden]'));
  }

  button.addEventListener('click', function () {
    hiddenItems().slice(0, pageSize).forEach(function (item) {
      item.hidden = false;
      item.removeAttribute('data-feed-hidden');
    });

    if (hiddenItems().length === 0) {
      button.hidden = true;
    }
  });
})();

(function () {
  var carousels = document.querySelectorAll('[data-card-carousel]');
  if (!carousels.length) return;

  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

  Array.prototype.forEach.call(carousels, function (carousel) {
    var track = carousel.querySelector('[data-carousel-track]');
    var controls = carousel.querySelector('[data-carousel-controls]');
    var previous = carousel.querySelector('[data-carousel-previous]');
    var next = carousel.querySelector('[data-carousel-next]');
    var frame = null;

    if (!track || !controls || !previous || !next) return;

    function hasOverflow() {
      return track.scrollWidth > track.clientWidth + 1;
    }

    function updateControls() {
      frame = null;
      var overflow = hasOverflow();
      controls.hidden = !overflow;
      previous.disabled = !overflow || track.scrollLeft <= 1;
      next.disabled = !overflow || track.scrollLeft + track.clientWidth >= track.scrollWidth - 1;
    }

    function requestControlUpdate() {
      if (frame !== null) return;
      frame = window.requestAnimationFrame(updateControls);
    }

    function cardStep() {
      var cards = track.children;
      if (cards.length > 1) {
        return cards[1].offsetLeft - cards[0].offsetLeft;
      }

      return cards.length ? cards[0].getBoundingClientRect().width : track.clientWidth;
    }

    function move(direction) {
      track.scrollBy({
        left: direction * cardStep(),
        behavior: reducedMotion.matches ? 'auto' : 'smooth'
      });
    }

    previous.addEventListener('click', function () {
      move(-1);
    });

    next.addEventListener('click', function () {
      move(1);
    });

    track.addEventListener('scroll', requestControlUpdate, { passive: true });
    window.addEventListener('resize', requestControlUpdate, { passive: true });

    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(requestControlUpdate);
    }

    updateControls();
  });
})();
