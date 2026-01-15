// Import all CSS files - Vite will watch and HMR these automatically
// Always import base CSS files for HMR to work properly
import "../css/variables.css";
import "../css/base.css";
import "../css/layout.css";
import "../css/header.css";
import "../css/footer.css";
// Import all page-specific CSS files
// Vite will tree-shake unused CSS in production, but we import all for HMR
import "../css/front-page.css";

// Main JavaScript code
console.log("Vite is working with HMR!");

/**
 * Fieldcraft Digital Theme
 * Vanilla JavaScript
 */

(function () {
  "use strict";

  // ========================================
  // HEADER SCROLL BEHAVIOR
  // ========================================

  function initHeader() {
    const header = document.querySelector(".site-header");
    if (!header) return;

    let ticking = false;

    function updateHeader() {
      if (window.scrollY > 50) {
        header.classList.add("is-scrolled");
      } else {
        header.classList.remove("is-scrolled");
      }
      ticking = false;
    }

    window.addEventListener("scroll", function () {
      if (!ticking) {
        requestAnimationFrame(updateHeader);
        ticking = true;
      }
    });
  }

  // ========================================
  // MOBILE MENU
  // ========================================

  function initMobileMenu() {
    const toggle = document.querySelector(".menu-toggle");
    const nav = document.querySelector(".nav-mobile");

    if (!toggle || !nav) return;

    const navLinks = nav.querySelectorAll("a");

    function closeMenu() {
      toggle.classList.remove("is-active");
      nav.classList.remove("is-open");
      document.body.classList.remove("menu-open");
      toggle.setAttribute("aria-expanded", "false");
    }

    function toggleMenu() {
      const isOpen = nav.classList.contains("is-open");

      if (isOpen) {
        closeMenu();
      } else {
        toggle.classList.add("is-active");
        nav.classList.add("is-open");
        document.body.classList.add("menu-open");
        toggle.setAttribute("aria-expanded", "true");
      }
    }

    toggle.addEventListener("click", toggleMenu);

    navLinks.forEach(function (link) {
      link.addEventListener("click", closeMenu);
    });

    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && nav.classList.contains("is-open")) {
        closeMenu();
      }
    });

    window.addEventListener("resize", function () {
      if (window.innerWidth >= 1024 && nav.classList.contains("is-open")) {
        closeMenu();
      }
    });
  }

  // ========================================
  // SCROLL REVEAL ANIMATIONS
  // ========================================

  function initReveal() {
    const reveals = document.querySelectorAll(".reveal");
    if (!reveals.length) return;

    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      },
    );

    reveals.forEach(function (el) {
      observer.observe(el);
    });
  }

  // ========================================
  // FAQ ACCORDION
  // ========================================

  function initFaqAccordion() {
    const faqItems = document.querySelectorAll(".faq-item");
    if (!faqItems.length) return;

    faqItems.forEach(function (item) {
      const question = item.querySelector(".faq-question");

      question.addEventListener("click", function () {
        const isOpen = item.classList.contains("is-open");

        // Close all other items
        faqItems.forEach(function (otherItem) {
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
  // SMOOTH SCROLL
  // ========================================

  function initSmoothScroll() {
    const anchors = document.querySelectorAll('a[href^="#"]');

    anchors.forEach(function (anchor) {
      anchor.addEventListener("click", function (e) {
        const targetId = this.getAttribute("href");
        if (targetId === "#") return;

        const target = document.querySelector(targetId);
        if (target) {
          e.preventDefault();
          const offset = 100;
          const position =
            target.getBoundingClientRect().top + window.scrollY - offset;

          window.scrollTo({
            top: position,
            behavior: "smooth",
          });
        }
      });
    });
  }

  // ========================================
  // FORM VALIDATION
  // ========================================

  function initContactForm() {
    const form = document.querySelector(".contact-form");
    if (!form) return;

    form.addEventListener("submit", function (e) {
      let isValid = true;
      const required = form.querySelectorAll("[required]");

      required.forEach(function (field) {
        const value = field.value.trim();
        const errorEl = field.parentElement.querySelector(".form-error");

        if (!value) {
          isValid = false;
          field.classList.add("is-error");
          if (errorEl) errorEl.style.display = "block";
        } else {
          field.classList.remove("is-error");
          if (errorEl) errorEl.style.display = "none";
        }

        // Email validation
        if (field.type === "email" && value) {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(value)) {
            isValid = false;
            field.classList.add("is-error");
            if (errorEl) {
              errorEl.textContent = "Please enter a valid email";
              errorEl.style.display = "block";
            }
          }
        }
      });

      if (!isValid) {
        e.preventDefault();
        const firstError = form.querySelector(".is-error");
        if (firstError) firstError.focus();
      }
    });
  }

  // ========================================
  // INIT
  // ========================================

  function init() {
    initHeader();
    initMobileMenu();
    initReveal();
    initFaqAccordion();
    initSmoothScroll();
    initContactForm();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
