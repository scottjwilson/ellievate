/**
 * Ellievated Beauty
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

          closeMobileMenu();
        }
      });
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
          emailInput.focus();
        }
      });
    });
  }

  function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
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
      lazyImages.forEach((img) => {
        img.src = img.dataset.src;
        img.removeAttribute("data-src");
      });
    }
  }

  // ========================================
  // INITIALIZE
  // ========================================
  function init() {
    window.addEventListener("scroll", handleHeaderScroll, { passive: true });
    menuToggle?.addEventListener("click", toggleMobileMenu);

    mobileNav?.querySelectorAll(".nav-link").forEach((link) => {
      link.addEventListener("click", closeMobileMenu);
    });

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        closeMobileMenu();
      }
    });

    handleHeaderScroll();
    initRevealAnimations();
    initStaggerAnimations();
    initSmoothScroll();
    initFaqAccordion();
    initFormValidation();
    initLazyLoad();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
