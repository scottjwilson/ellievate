/**
 * Ellievated Beauty
 * Main JavaScript
 */

(function () {
  "use strict";

  // ═══ HEADER SCROLL ═══
  const header = document.getElementById("header");
  window.addEventListener(
    "scroll",
    () => {
      header?.classList.toggle("scrolled", window.scrollY > 40);
    },
    { passive: true },
  );

  // ═══ MOBILE MENU ═══
  const mobileToggle = document.getElementById("mobileToggle");
  const navLinks = document.getElementById("navLinks");

  mobileToggle?.addEventListener("click", () => {
    mobileToggle.classList.toggle("active");
    navLinks?.classList.toggle("open");
    document.body.classList.toggle("menu-open");
  });

  navLinks?.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => {
      mobileToggle?.classList.remove("active");
      navLinks.classList.remove("open");
      document.body.classList.remove("menu-open");
    });
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      mobileToggle?.classList.remove("active");
      navLinks?.classList.remove("open");
      document.body.classList.remove("menu-open");
    }
  });

  // ═══ SCROLL REVEAL ═══
  const revealElements = document.querySelectorAll(".reveal, .reveal-stagger");
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    },
    { threshold: 0.15 },
  );
  revealElements.forEach((el) => observer.observe(el));

  // ═══ SMOOTH SCROLL ═══
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
        window.scrollTo({ top: targetPosition, behavior: "smooth" });
      }
    });
  });

  // ═══ SERVICE PICKER (Book Now page) ═══
  const serviceCards = document.querySelectorAll(".service-select-card");
  const serviceInput = document.getElementById("selected-service");
  const serviceDisplay = document.getElementById("service-display");
  const serviceDisplayName = document.getElementById("service-display-name");
  const serviceChange = document.getElementById("service-change");

  serviceCards.forEach((card) => {
    card.addEventListener("click", () => {
      serviceCards.forEach((c) => c.classList.remove("selected"));
      card.classList.add("selected");
      const slug = card.dataset.slug;
      const name = card.dataset.name;
      if (serviceInput) serviceInput.value = slug;
      if (serviceDisplayName) serviceDisplayName.textContent = name;
      if (serviceDisplay) serviceDisplay.classList.add("has-service");
    });
  });

  serviceChange?.addEventListener("click", () => {
    const picker = document.getElementById("pick-service");
    if (picker) {
      const headerHeight = header?.offsetHeight || 0;
      const top =
        picker.getBoundingClientRect().top +
        window.pageYOffset -
        headerHeight -
        20;
      window.scrollTo({ top, behavior: "smooth" });
    }
  });

  // ═══ FAQ ACCORDION ═══
  document.querySelectorAll(".faq-item").forEach((item) => {
    const question = item.querySelector(".faq-question");
    question?.addEventListener("click", () => {
      const isOpen = item.classList.contains("is-open");
      document.querySelectorAll(".faq-item").forEach((other) => {
        if (other !== item) other.classList.remove("is-open");
      });
      item.classList.toggle("is-open", !isOpen);
    });
  });
})();
