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

  // ═══ BOOKING FLOW (Book Now page) ═══
  const bookingForm = document.getElementById("bookingForm");
  if (bookingForm) {
    const steps = document.querySelectorAll(".booking-step");
    const indicators = document.querySelectorAll(".step-item");
    const serviceCards = document.querySelectorAll(".service-select-card");

    // State
    let currentStep = 1;
    let selectedService = {
      slug: "",
      name: "",
      price: "",
      duration: "",
      icon: "",
      productId: "",
    };
    let selectedDate = null;
    let selectedDateStr = "";
    let selectedTime = "";
    let calDate = new Date();

    // Time slots
    const timeSlots = [
      "9:00 AM",
      "9:30 AM",
      "10:00 AM",
      "10:30 AM",
      "11:00 AM",
      "11:30 AM",
      "12:00 PM",
      "12:30 PM",
      "1:00 PM",
      "1:30 PM",
      "2:00 PM",
      "2:30 PM",
      "3:00 PM",
      "3:30 PM",
      "4:00 PM",
      "4:30 PM",
      "5:00 PM",
    ];

    // Service card click
    serviceCards.forEach((card) => {
      card.addEventListener("click", () => {
        serviceCards.forEach((c) => c.classList.remove("selected"));
        card.classList.add("selected");
        selectedService = {
          slug: card.dataset.slug,
          name: card.dataset.name,
          price: card.dataset.price,
          duration: card.dataset.duration,
          icon: card.dataset.icon,
          productId: card.dataset.productId,
        };
      });
    });

    // Step navigation
    function goToStep(step) {
      currentStep = step;
      steps.forEach((s) => {
        s.classList.toggle("step-active", parseInt(s.dataset.step) === step);
      });
      indicators.forEach((ind) => {
        const s = parseInt(ind.dataset.step);
        ind.classList.toggle("active", s === step);
        ind.classList.toggle("completed", s < step);
        const num = ind.querySelector(".step-num");
        if (num) num.textContent = s < step ? "✓" : s;
      });
      if (step === 2) renderCalendar();
      if (step === 3) updateSummary();
      // Scroll to top of steps
      const hero = document.querySelector(".book-hero");
      if (hero) {
        const headerHeight = header?.offsetHeight || 0;
        const top =
          hero.getBoundingClientRect().bottom +
          window.pageYOffset -
          headerHeight;
        window.scrollTo({ top, behavior: "smooth" });
      }
    }

    // Step 1 → 2
    document.getElementById("toStep2")?.addEventListener("click", () => {
      if (!selectedService.slug) {
        alert("Please select a service.");
        return;
      }
      goToStep(2);
    });

    // Step 2 → 3
    document.getElementById("toStep3")?.addEventListener("click", () => {
      if (!selectedDate) {
        alert("Please select a date.");
        return;
      }
      if (!selectedTime) {
        alert("Please select a time.");
        return;
      }
      goToStep(3);
    });

    // Back buttons
    document
      .getElementById("backToStep1")
      ?.addEventListener("click", () => goToStep(1));
    document
      .getElementById("backToStep2")
      ?.addEventListener("click", () => goToStep(2));

    // ── Calendar ──
    const calGrid = document.getElementById("calGrid");
    const calTitle = document.getElementById("calTitle");
    const calPrev = document.getElementById("calPrev");
    const calNext = document.getElementById("calNext");
    const timeSlotsSection = document.getElementById("timeSlotsSection");
    const timeSlotsGrid = document.getElementById("timeSlotsGrid");

    const monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    const dayNames = ["S", "M", "T", "W", "T", "F", "S"];

    // Flip the prev arrow (it reuses arrow-right icon)
    if (calPrev)
      calPrev
        .querySelector("svg")
        ?.setAttribute("style", "transform:rotate(180deg)");

    calPrev?.addEventListener("click", () => {
      calDate.setMonth(calDate.getMonth() - 1);
      renderCalendar();
    });

    calNext?.addEventListener("click", () => {
      calDate.setMonth(calDate.getMonth() + 1);
      renderCalendar();
    });

    function renderCalendar() {
      if (!calGrid || !calTitle) return;
      const year = calDate.getFullYear();
      const month = calDate.getMonth();
      const today = new Date();
      today.setHours(0, 0, 0, 0);

      calTitle.textContent = monthNames[month] + " " + year;

      // Don't allow navigating to past months
      const isCurrentMonth =
        year === today.getFullYear() && month === today.getMonth();
      if (calPrev)
        calPrev.style.visibility = isCurrentMonth ? "hidden" : "visible";

      let html = "";
      // Day name headers
      dayNames.forEach((d) => {
        html += '<div class="cal-day-name">' + d + "</div>";
      });

      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      // Empty cells before first day
      for (let i = 0; i < firstDay; i++) {
        html += '<div class="cal-day cal-empty"></div>';
      }

      // Day cells
      for (let d = 1; d <= daysInMonth; d++) {
        const date = new Date(year, month, d);
        const isPast = date < today;
        const isSunday = date.getDay() === 0;
        const isToday = date.getTime() === today.getTime();
        const isSelected =
          selectedDate && date.getTime() === selectedDate.getTime();

        let cls = "cal-day";
        if (isPast || isSunday) cls += " cal-disabled";
        if (isToday) cls += " cal-today";
        if (isSelected) cls += " cal-selected";

        html +=
          '<div class="' +
          cls +
          '" data-date="' +
          year +
          "-" +
          String(month + 1).padStart(2, "0") +
          "-" +
          String(d).padStart(2, "0") +
          '">' +
          d +
          "</div>";
      }

      calGrid.innerHTML = html;

      // Day click handlers
      calGrid
        .querySelectorAll(".cal-day:not(.cal-disabled):not(.cal-empty)")
        .forEach((cell) => {
          cell.addEventListener("click", () => {
            calGrid
              .querySelectorAll(".cal-day")
              .forEach((c) => c.classList.remove("cal-selected"));
            cell.classList.add("cal-selected");
            const parts = cell.dataset.date.split("-");
            selectedDate = new Date(
              parseInt(parts[0]),
              parseInt(parts[1]) - 1,
              parseInt(parts[2]),
            );
            selectedDateStr = cell.dataset.date;
            renderTimeSlots();
          });
        });
    }

    function renderTimeSlots() {
      if (!timeSlotsSection || !timeSlotsGrid) return;
      selectedTime = "";
      timeSlotsSection.style.display = "block";
      timeSlotsGrid.innerHTML =
        '<div class="time-slots-loading">Checking availability&hellip;</div>';

      // Fetch booked times, then render
      fetchBookedTimes(selectedDateStr).then((booked) => {
        let html = "";
        timeSlots.forEach((slot) => {
          const isBooked = booked.includes(slot);
          html +=
            '<div class="time-slot' +
            (isBooked ? " booked" : "") +
            '" data-time="' +
            slot +
            '">' +
            slot +
            "</div>";
        });
        timeSlotsGrid.innerHTML = html;

        timeSlotsGrid
          .querySelectorAll(".time-slot:not(.booked)")
          .forEach((slot) => {
            slot.addEventListener("click", () => {
              timeSlotsGrid
                .querySelectorAll(".time-slot")
                .forEach((s) => s.classList.remove("selected"));
              slot.classList.add("selected");
              selectedTime = slot.dataset.time;
            });
          });
      });
    }

    /**
     * Fetch booked time slots for a date via AJAX.
     * Returns an array of time strings, or empty array on failure.
     */
    async function fetchBookedTimes(date) {
      if (!date || !window.ellievatedBooking) return [];
      try {
        const body = new FormData();
        body.append("action", "ellievated_check_availability");
        body.append("nonce", window.ellievatedBooking.nonce);
        body.append("date", date);

        const res = await fetch(window.ellievatedBooking.ajaxUrl, {
          method: "POST",
          body,
        });
        const json = await res.json();
        return json.success ? json.data.booked : [];
      } catch {
        return [];
      }
    }

    // ── Summary ──
    function updateSummary() {
      const el = (id) => document.getElementById(id);
      const icon = el("summaryIcon");
      const name = el("summaryName");
      const dur = el("summaryDuration");
      const date = el("summaryDate");
      const time = el("summaryTime");
      const price = el("summaryPrice");

      if (icon) icon.innerHTML = selectedService.icon || "";
      if (name) name.textContent = selectedService.name || "—";
      if (dur) dur.textContent = selectedService.duration || "";
      if (price)
        price.textContent = selectedService.price
          ? "$" + selectedService.price
          : "—";

      if (date && selectedDate) {
        const opts = {
          weekday: "long",
          month: "long",
          day: "numeric",
          year: "numeric",
        };
        date.textContent = selectedDate.toLocaleDateString("en-US", opts);
      }
      if (time) time.textContent = selectedTime || "—";
    }

    // ── Preselected service (from ?service=slug) ──
    const preselectedCard = document.querySelector(
      ".service-select-card.selected",
    );
    if (preselectedCard) {
      selectedService = {
        slug: preselectedCard.dataset.slug,
        name: preselectedCard.dataset.name,
        price: preselectedCard.dataset.price,
        duration: preselectedCard.dataset.duration,
        icon: preselectedCard.dataset.icon,
        productId: preselectedCard.dataset.productId,
      };
      goToStep(2);
    }

    // ── Proceed to Checkout ──
    const checkoutBtn = document.getElementById("proceedToCheckout");
    const checkoutError = document.getElementById("checkoutError");

    checkoutBtn?.addEventListener("click", async () => {
      if (!window.ellievatedBooking) return;

      checkoutBtn.disabled = true;
      checkoutBtn.textContent = "Processing…";
      if (checkoutError) checkoutError.style.display = "none";

      try {
        const body = new FormData();
        body.append("action", "ellievated_add_to_cart");
        body.append("nonce", window.ellievatedBooking.nonce);
        body.append("product_id", selectedService.productId);
        body.append("booking_date", selectedDateStr);
        body.append("booking_time", selectedTime);

        const res = await fetch(window.ellievatedBooking.ajaxUrl, {
          method: "POST",
          body,
        });
        const json = await res.json();

        if (json.success && json.data?.redirect) {
          window.location.href = json.data.redirect;
        } else {
          const msg =
            json.data?.message || json.data || "Something went wrong.";
          if (checkoutError) {
            checkoutError.textContent = msg;
            checkoutError.style.display = "block";
          }
          checkoutBtn.disabled = false;
          checkoutBtn.textContent = "Proceed to Checkout";
        }
      } catch {
        if (checkoutError) {
          checkoutError.textContent = "Unable to connect. Please try again.";
          checkoutError.style.display = "block";
        }
        checkoutBtn.disabled = false;
        checkoutBtn.textContent = "Proceed to Checkout";
      }
    });
  }

  // ═══ FAQ ACCORDION ═══
  document.querySelectorAll(".faq-item").forEach((item) => {
    const question = item.querySelector(".faq-question");
    question?.addEventListener("click", () => {
      const isOpen = item.classList.contains("is-open");
      document.querySelectorAll(".faq-item").forEach((other) => {
        if (other !== item) {
          other.classList.remove("is-open");
          other
            .querySelector(".faq-question")
            ?.setAttribute("aria-expanded", "false");
        }
      });
      item.classList.toggle("is-open", !isOpen);
      question.setAttribute("aria-expanded", String(!isOpen));
    });
  });
})();
