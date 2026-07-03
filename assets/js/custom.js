document.addEventListener('DOMContentLoaded', function () {

  // -----------------
  // Menu toggle: visível e acessível apenas em mobile
  // Em desktop o menu já está expandido — o botão não deve aparecer
  // para leitores de tela nem receber foco via Tab.
  // -----------------
  const menuToggle = document.querySelector('.menu-toggle');
  const navMenu = document.getElementById('main-menu');

  const searchToggle = document.querySelector('.search-toggle');
  const searchWrap = document.getElementById('header-search');

  function updateMenuToggleAccessibility() {
    if (!menuToggle) return;
    const isMobile = window.innerWidth <= 768;
    if (isMobile) {
      menuToggle.removeAttribute('aria-hidden');
      menuToggle.removeAttribute('tabindex');
    } else {
      menuToggle.setAttribute('aria-hidden', 'true');
      menuToggle.setAttribute('tabindex', '-1');
    }
  }

  updateMenuToggleAccessibility();
  window.addEventListener('resize', updateMenuToggleAccessibility);

  // search-toggle: visível e acessível apenas em mobile
  function updateSearchToggleAccessibility() {
    if (!searchToggle) return;
    const isMobile = window.innerWidth <= 768;
    if (isMobile) {
      searchToggle.removeAttribute('aria-hidden');
      searchToggle.removeAttribute('tabindex');
    } else {
      searchToggle.setAttribute('aria-hidden', 'true');
      searchToggle.setAttribute('tabindex', '-1');
    }
  }

  updateSearchToggleAccessibility();
  window.addEventListener('resize', updateSearchToggleAccessibility);

  // -----------------
  // Menu (mobile)
  // -----------------
  if (menuToggle && navMenu) {
    const getFocusableLinks = () => Array.from(navMenu.querySelectorAll('a')).filter(a => !a.hasAttribute('disabled'));

    const openMenu = () => {
      navMenu.classList.add('active');
      menuToggle.setAttribute('aria-expanded', 'true');
      menuToggle.setAttribute('aria-label', menuToggle.dataset.labelClose || 'Fechar menu de navegação');
      const links = getFocusableLinks();
      if (links.length) links[0].focus();
    };

    const closeMenu = () => {
      navMenu.classList.remove('active');
      menuToggle.setAttribute('aria-expanded', 'false');
      menuToggle.setAttribute('aria-label', menuToggle.dataset.labelOpen || 'Abrir menu de navegação');
      menuToggle.focus();
    };

    const toggleMenu = () => {
      const isOpen = navMenu.classList.contains('active');
      if (isOpen) closeMenu();
      else openMenu();
    };

    menuToggle.addEventListener('click', toggleMenu);

    menuToggle.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleMenu();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && navMenu.classList.contains('active')) {
        e.preventDefault();
        closeMenu();
      }
    });

    document.addEventListener('click', function (e) {
      if (!navMenu.classList.contains('active')) return;
      const target = e.target;
      if (!(target instanceof Element)) return;
      if (!navMenu.contains(target) && target !== menuToggle && !menuToggle.contains(target)) {
        closeMenu();
      }
    });
  }

  // -----------------
  // Search (mobile)
  // -----------------
  if (searchToggle && searchWrap) {
    const getFirstFocusable = () => {
      const input = searchWrap.querySelector('input, textarea, select, button');
      return input || null;
    };

    const openSearch = () => {
      searchWrap.classList.add('is-open');
      searchToggle.setAttribute('aria-expanded', 'true');
      searchToggle.setAttribute('aria-label', searchToggle.dataset.labelClose || 'Fechar campo de busca');
      const focusEl = getFirstFocusable();
      if (focusEl) focusEl.focus();
    };

    const closeSearch = () => {
      searchWrap.classList.remove('is-open');
      searchToggle.setAttribute('aria-expanded', 'false');
      searchToggle.setAttribute('aria-label', searchToggle.dataset.labelOpen || 'Abrir campo de busca');
      searchToggle.focus();
    };

    const toggleSearch = () => {
      const isOpen = searchWrap.classList.contains('is-open');
      if (isOpen) closeSearch();
      else openSearch();
    };

    searchToggle.addEventListener('click', toggleSearch);

    searchToggle.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggleSearch();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && searchWrap.classList.contains('is-open')) {
        e.preventDefault();
        closeSearch();
      }
    });

    document.addEventListener('click', function (e) {
      if (!searchWrap.classList.contains('is-open')) return;
      const target = e.target;
      if (!(target instanceof Element)) return;
      if (!searchWrap.contains(target) && target !== searchToggle && !searchToggle.contains(target)) {
        closeSearch();
      }
    });
  }
});
