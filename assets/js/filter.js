// filter
const filterWrap = document.querySelector(".filter-wrap-responsive");
const filterBtn = document.querySelector(".filter-btn");
const closeFilter = document.querySelector(".close-filter");
// Buka Side Filter
filterBtn.addEventListener("click", () => {
  filterWrap.classList.add("active");
  closeFilter.classList.add("active");
});

// Tutup Side Filter dengan Klik di Luar
closeFilter.addEventListener("click", () => {
  filterWrap.classList.remove("active");
  closeFilter.classList.remove("active");
});

// filter.js
document.addEventListener("DOMContentLoaded", function () {
  const cards = document.querySelectorAll(".beasiswa-card");

  const jenjangCheckboxes = document.querySelectorAll(".filter-jenjang");
  const tipeCheckboxes = document.querySelectorAll(
    ".filter-tipe input[type='checkbox']"
  );
  const negaraInput = document.getElementById("filter-negara");
  const univInput = document.getElementById("filter-univ");

  const filterElements = [
    ...jenjangCheckboxes,
    ...tipeCheckboxes,
    negaraInput,
    univInput,
  ];

  filterElements.forEach((el) => el.addEventListener("input", applyFilters));
  filterElements.forEach((el) => el.addEventListener("change", applyFilters));

  function applyFilters() {
    const selectedJenjang = Array.from(jenjangCheckboxes)
      .filter((cb) => cb.checked)
      .map((cb) => cb.value);

    const selectedTipe = Array.from(tipeCheckboxes)
      .filter((cb) => cb.checked)
      .map((cb) => cb.value);

    const negaraFilter = negaraInput.value.trim().toLowerCase();
    const univFilter = univInput.value.trim().toLowerCase();

    cards.forEach((card) => {
      const jenjang = card.dataset.jenjang;
      const tipe = card.dataset.tipe;
      const negara = card.dataset.negara.toLowerCase();
      const univ = card.dataset.univ.toLowerCase();

      const matchJenjang =
        selectedJenjang.length === 0 || selectedJenjang.includes(jenjang);
      const matchTipe =
        selectedTipe.length === 0 || selectedTipe.includes(tipe);
      const matchNegara = negara.includes(negaraFilter);
      const matchUniv = univ.includes(univFilter);

      const show = matchJenjang && matchTipe && matchNegara && matchUniv;
      card.style.display = show ? "block" : "none";
    });
  }
});

document.addEventListener("DOMContentLoaded", function () {
  // Month selector
  const monthButtons = document.querySelectorAll(".month-button");
  if (monthButtons.length > 0) {
    monthButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        document
          .querySelectorAll(".month-button")
          .forEach((b) => b.classList.remove("active"));
        this.classList.add("active");
      });
    });
  }

  // Pagination functionality
  const paginationButtons = document.querySelectorAll(".pagination-btn");
  const nextPageButton = document.querySelector(".pagination-btn.next");
  let currentPage = 1;

  // Function to simulate loading different pages
  function loadPage(pageNumber) {
    // Update active state of pagination buttons
    paginationButtons.forEach((btn) => {
      if (parseInt(btn.textContent) === pageNumber) {
        btn.classList.add("active");
      } else if (!isNaN(parseInt(btn.textContent))) {
        btn.classList.remove("active");
      }
    });

    // Update current page
    currentPage = pageNumber;

    // Scroll to top of competition container
    document
      .querySelector(".beasiswa-container")
      .scrollIntoView({ behavior: "smooth" });

    // Simulate loading new content with animation
    const cards = document.querySelectorAll(".card-content");
    cards.forEach((card) => {
      card.style.opacity = "0";
      setTimeout(() => {
        card.style.opacity = "1";
      }, 300);
    });

    // Update section title to show current page
    document.querySelector(
      ".competition-header .section-title"
    ).textContent = `Lomba Bulan Maret (Halaman ${pageNumber})`;
  }

  // Add click event to pagination buttons
  if (paginationButtons.length > 0) {
    paginationButtons.forEach((btn) => {
      if (!isNaN(parseInt(btn.textContent))) {
        btn.addEventListener("click", function () {
          loadPage(parseInt(this.textContent));
        });
      }
    });
  }

  // Add click event to next button
  if (nextPageButton) {
    nextPageButton.addEventListener("click", function () {
      if (currentPage < 3) {
        loadPage(currentPage + 1);
      }
    });
  }
});
