/**
 * Fieldcraft Digital 2.0
 * Main JavaScript
 */

(function () {
  "use strict";

  // ========================================
  // HEADER SCROLL BEHAVIOR
  // ========================================
  const header = document.querySelector(".site-header");

  function handleHeaderScroll() {
    if (window.scrollY > 50) {
      header?.classList.add("is-scrolled");
    } else {
      header?.classList.remove("is-scrolled");
    }
  }

  // ========================================
  // MOBILE MENU
  // ========================================
  const menuToggle = document.querySelector(".menu-toggle");
  const mobileNav = document.querySelector(".nav-mobile");

  function toggleMobileMenu() {
    const isOpen = menuToggle?.getAttribute("aria-expanded") === "true";

    menuToggle?.setAttribute("aria-expanded", !isOpen);
    mobileNav?.classList.toggle("is-open");
    mobileNav?.setAttribute("aria-hidden", isOpen);
    document.body.classList.toggle("menu-open");
  }

  function closeMobileMenu() {
    menuToggle?.setAttribute("aria-expanded", "false");
    mobileNav?.classList.remove("is-open");
    mobileNav?.setAttribute("aria-hidden", "true");
    document.body.classList.remove("menu-open");
  }

  // ========================================
  // REVEAL ANIMATIONS (INTERSECTION OBSERVER)
  // ========================================
  function initRevealAnimations() {
    const revealElements = document.querySelectorAll(".reveal");

    if (!revealElements.length) return;

    const observerOptions = {
      root: null,
      rootMargin: "0px 0px -10% 0px",
      threshold: 0.1,
    };

    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
          // Optionally unobserve after revealing
          // revealObserver.unobserve(entry.target);
        }
      });
    }, observerOptions);

    revealElements.forEach((el) => {
      revealObserver.observe(el);
    });
  }

  // ========================================
  // STAGGER CHILDREN ANIMATIONS
  // ========================================
  function initStaggerAnimations() {
    const staggerContainers = document.querySelectorAll(".stagger-children");

    if (!staggerContainers.length) return;

    const observerOptions = {
      root: null,
      rootMargin: "0px 0px -10% 0px",
      threshold: 0.1,
    };

    const staggerObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("is-visible");
        }
      });
    }, observerOptions);

    staggerContainers.forEach((el) => {
      staggerObserver.observe(el);
    });
  }

  // ========================================
  // SMOOTH SCROLL FOR ANCHOR LINKS
  // ========================================
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        const href = this.getAttribute("href");

        if (href === "#") return;

        const target = document.querySelector(href);
        if (target) {
          e.preventDefault();
          const headerHeight = header?.offsetHeight || 0;
          const targetPosition =
            target.getBoundingClientRect().top +
            window.pageYOffset -
            headerHeight -
            20;

          window.scrollTo({
            top: targetPosition,
            behavior: "smooth",
          });

          // Close mobile menu if open
          closeMobileMenu();
        }
      });
    });
  }

  // ========================================
  // COUNTER ANIMATION
  // ========================================
  function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        element.textContent = target;
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(current);
      }
    }, 16);
  }

  function initCounterAnimations() {
    const counters = document.querySelectorAll("[data-counter]");

    if (!counters.length) return;

    const observerOptions = {
      root: null,
      rootMargin: "0px",
      threshold: 0.5,
    };

    const counterObserver = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const target = parseInt(entry.target.dataset.counter, 10);
          animateCounter(entry.target, target);
          counterObserver.unobserve(entry.target);
        }
      });
    }, observerOptions);

    counters.forEach((el) => {
      counterObserver.observe(el);
    });
  }

  // ========================================
  // FAQ ACCORDION
  // ========================================
  function initFaqAccordion() {
    const faqItems = document.querySelectorAll(".faq-item");

    faqItems.forEach((item) => {
      const question = item.querySelector(".faq-question");

      question?.addEventListener("click", () => {
        const isOpen = item.classList.contains("is-open");

        // Close all other items
        faqItems.forEach((otherItem) => {
          if (otherItem !== item) {
            otherItem.classList.remove("is-open");
          }
        });

        // Toggle current item
        item.classList.toggle("is-open", !isOpen);
      });
    });
  }

  // ========================================
  // FORM VALIDATION
  // ========================================
  function initFormValidation() {
    const forms = document.querySelectorAll("form[data-validate]");

    forms.forEach((form) => {
      form.addEventListener("submit", (e) => {
        const emailInput = form.querySelector('input[type="email"]');

        if (emailInput && !isValidEmail(emailInput.value)) {
          e.preventDefault();
          form.classList.add("is-error");
          form.classList.remove("is-success");
          emailInput.focus();
        } else {
          form.classList.remove("is-error");
          form.classList.add("is-success");
        }
      });
    });
  }

  function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }

  // ========================================
  // PARALLAX EFFECT (OPTIONAL)
  // ========================================
  function initParallax() {
    const parallaxElements = document.querySelectorAll("[data-parallax]");

    if (!parallaxElements.length) return;

    function handleParallax() {
      const scrollY = window.pageYOffset;

      parallaxElements.forEach((el) => {
        const speed = parseFloat(el.dataset.parallax) || 0.5;
        const yPos = -(scrollY * speed);
        el.style.transform = `translate3d(0, ${yPos}px, 0)`;
      });
    }

    window.addEventListener("scroll", handleParallax, { passive: true });
  }

  // ========================================
  // LAZY LOADING IMAGES
  // ========================================
  function initLazyLoad() {
    const lazyImages = document.querySelectorAll("img[data-src]");

    if (!lazyImages.length) return;

    if ("IntersectionObserver" in window) {
      const imageObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              const img = entry.target;
              img.src = img.dataset.src;
              img.removeAttribute("data-src");
              imageObserver.unobserve(img);
            }
          });
        },
        {
          rootMargin: "50px 0px",
        },
      );

      lazyImages.forEach((img) => {
        imageObserver.observe(img);
      });
    } else {
      // Fallback for older browsers
      lazyImages.forEach((img) => {
        img.src = img.dataset.src;
        img.removeAttribute("data-src");
      });
    }
  }

  // ========================================
  // CURRENT YEAR (FOOTER)
  // ========================================
  function setCurrentYear() {
    const yearElements = document.querySelectorAll("[data-year]");
    const currentYear = new Date().getFullYear();

    yearElements.forEach((el) => {
      el.textContent = currentYear;
    });
  }

  // ========================================
  // INITIALIZE
  // ========================================
  function init() {
    // Event listeners
    window.addEventListener("scroll", handleHeaderScroll, { passive: true });
    menuToggle?.addEventListener("click", toggleMobileMenu);

    // Close mobile menu on nav link click
    mobileNav?.querySelectorAll(".nav-link").forEach((link) => {
      link.addEventListener("click", closeMobileMenu);
    });

    // Close mobile menu on escape key
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        closeMobileMenu();
      }
    });

    // Initialize features
    handleHeaderScroll(); // Set initial state
    initRevealAnimations();
    initStaggerAnimations();
    initSmoothScroll();
    initCounterAnimations();
    initFaqAccordion();
    initFormValidation();
    initLazyLoad();
    setCurrentYear();

    // Optional features
    // initParallax();
  }

  // Run on DOM ready
  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
