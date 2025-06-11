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

document.addEventListener("DOMContentLoaded", function () {
  // Bookmark functionality
  const bookmarkButtons = document.querySelectorAll(".bookmark-btn");
  if (bookmarkButtons.length > 0) {
    bookmarkButtons.forEach((btn) => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        this.classList.toggle("bookmarked");
        if (this.classList.contains("bookmarked")) {
          this.querySelector("i").classList.replace("far", "fas");
        } else {
          this.querySelector("i").classList.replace("fas", "far");
        }
      });
    });
  }

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
