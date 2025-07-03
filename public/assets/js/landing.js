document.addEventListener('DOMContentLoaded', () => {
  // --- 1. SELEKTOR & STATE ---
  const navLinks = document.querySelectorAll('.nav-link');
  const navbarBrand = document.querySelector('.navbar-brand');
  const scrollToTopBtn = document.getElementById('scrollToTop'); // Asumsi ada tombol ini di HTML
  const allButtons = document.querySelectorAll('.btn-primary-custom, .btn-outline-custom');
  const heroTitle = document.querySelector('.hero-title');
  
  let isClickScrolling = false;

  // --- 2. INISIALISASI ---
  function init() {
      initAOS();
      initEventListeners();
      initTypewriter();
  }

  function initAOS() {
      AOS.init({
          duration: 800,
          easing: 'ease-in-out',
          once: true,
          offset: 100,
      });
  }

  // --- 3. EVENT LISTENERS ---
  function initEventListeners() {
      navLinks.forEach(link => link.addEventListener('click', handleNavClick));
      window.addEventListener('scroll', handleWindowScroll);
      navbarBrand.addEventListener('click', (e) => scrollToTop(e));
      if (scrollToTopBtn) {
          scrollToTopBtn.addEventListener('click', (e) => scrollToTop(e));
      }
      allButtons.forEach(btn => btn.addEventListener('click', handleRippleEffect));
  }

  // --- 4. HANDLER FUNCTIONS ---
  function handleNavClick(e) {
      e.preventDefault();
      
      isClickScrolling = true;

      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);

      if (targetElement) {
          updateActiveLink(this);
          
          targetElement.scrollIntoView({
              behavior: 'smooth',
              block: 'start',
          });
      }
      
      setTimeout(() => {
          isClickScrolling = false;
      }, 1000); // 1 detik
  }
  
  function handleWindowScroll() {
      if (scrollToTopBtn) {
          window.scrollY > 200 ? scrollToTopBtn.classList.add('show') : scrollToTopBtn.classList.remove('show');
      }

      if (isClickScrolling) {
          return;
      }
      updateActiveNavOnScroll();
  }
  
  function updateActiveNavOnScroll() {
      let currentSectionId = '';
      
      navLinks.forEach(link => {
          const section = document.querySelector(link.getAttribute('href'));
          if (section) {
              const sectionTop = section.offsetTop - 80; // Sesuaikan offset
              if (window.scrollY >= sectionTop) {
                  currentSectionId = link.getAttribute('href');
              }
          }
      });

      const activeLink = document.querySelector(`.nav-link[href="${currentSectionId}"]`);
      if (activeLink) {
          updateActiveLink(activeLink);
      }
  }

  function updateActiveLink(activeLink) {
      navLinks.forEach(l => l.classList.remove('active'));
      activeLink.classList.add('active');
  }

  function scrollToTop(e) {
      if (e) e.preventDefault();
      window.scrollTo({
          top: 0,
          behavior: 'smooth',
      });
  }

  function handleRippleEffect(e) {
      const btn = this;
      const ripple = document.createElement("span");
      const rect = btn.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const x = e.clientX - rect.left - size / 2;
      const y = e.clientY - rect.top - size / 2;

      ripple.style.width = ripple.style.height = `${size}px`;
      ripple.style.left = `${x}px`;
      ripple.style.top = `${y}px`;
      ripple.classList.add("ripple");

      btn.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
  }
  
  function initTypewriter() {
      if (!heroTitle) return;

      const text = heroTitle.textContent;
      let i = 0;
      heroTitle.innerHTML = '';
      
      function type() {
          if (i < text.length) {
              heroTitle.innerHTML += text.charAt(i);
              i++;
              setTimeout(type, 150);
          }
      }
      type();
  }

  init();
});