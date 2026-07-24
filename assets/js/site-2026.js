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

(function () {
  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (reducedMotion.matches) return;

  var logos = Array.prototype.slice.call(document.querySelectorAll('.hero__logo, .header-logo, .cta__logo'));
  if (!logos.length) return;

  function setLogoVars(logo, x, y, active) {
    logo.style.setProperty('--logo-x', x.toFixed(2) + 'px');
    logo.style.setProperty('--logo-y', y.toFixed(2) + 'px');
    logo.style.setProperty('--logo-tilt', (x * 0.28).toFixed(2) + 'deg');
    logo.style.setProperty('--logo-fill-x', (x * 0.16).toFixed(2) + 'px');
    logo.style.setProperty('--logo-fill-y', (y * 0.16).toFixed(2) + 'px');
    logo.style.setProperty('--logo-outline-x', (x * -0.13).toFixed(2) + 'px');
    logo.style.setProperty('--logo-outline-y', (y * -0.13).toFixed(2) + 'px');
    logo.classList.toggle('is-magnetic', active);
  }

  function resetLogo(logo) {
    setLogoVars(logo, 0, 0, false);
  }

  logos.forEach(function (logo) {
    logo.classList.add('magnetic-logo');

    logo.addEventListener('pointermove', function (event) {
      if (event.pointerType && event.pointerType !== 'mouse') return;

      var rect = logo.getBoundingClientRect();
      var halfWidth = rect.width / 2;
      var halfHeight = rect.height / 2;
      var x = ((event.clientX - rect.left) - halfWidth) / halfWidth;
      var y = ((event.clientY - rect.top) - halfHeight) / halfHeight;

      setLogoVars(logo, x * 5, y * 6, true);
    });

    logo.addEventListener('pointerleave', function () {
      resetLogo(logo);
    });

    logo.addEventListener('blur', function () {
      resetLogo(logo);
    });

    logo.addEventListener('focus', function () {
      logo.classList.add('is-magnetic');
    });
  });
})();

(function () {
  var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  if (reducedMotion.matches) return;

  var target = { x: 72, y: 18 };
  var current = { x: target.x, y: target.y };
  var frame = null;

  function tick() {
    current.x += (target.x - current.x) * 0.08;
    current.y += (target.y - current.y) * 0.08;

    document.documentElement.style.setProperty('--ambient-x', current.x.toFixed(2) + '%');
    document.documentElement.style.setProperty('--ambient-y', current.y.toFixed(2) + '%');

    if (Math.abs(target.x - current.x) > 0.02 || Math.abs(target.y - current.y) > 0.02) {
      frame = window.requestAnimationFrame(tick);
    } else {
      frame = null;
    }
  }

  function requestAmbientUpdate() {
    if (frame !== null) return;
    frame = window.requestAnimationFrame(tick);
  }

  window.addEventListener('pointermove', function (event) {
    if (event.pointerType && event.pointerType !== 'mouse') return;

    target.x = (event.clientX / Math.max(window.innerWidth, 1)) * 100;
    target.y = (event.clientY / Math.max(window.innerHeight, 1)) * 100;
    requestAmbientUpdate();
  }, { passive: true });
})();
