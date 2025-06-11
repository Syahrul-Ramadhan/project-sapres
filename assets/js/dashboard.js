document.addEventListener("DOMContentLoaded", function () {
  // Mengatur interaksi untuk dashboard links
  const dashboardLinks = document.querySelectorAll(".dashboard-links a");
  dashboardLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      dashboardLinks.forEach((item) => item.classList.remove("active"));
      this.classList.add("active");
    });
  });

  // Mengatur interaksi untuk sidebar kategori (Beasiswa, Lomba, Tim)

  const contentSections = document.querySelectorAll(".content-section");

  dashboardLinks.forEach((item) => {
    item.addEventListener("click", function () {
      // Menghapus kelas 'active' dari semua sidebar item
      dashboardLinks.forEach((el) => el.classList.remove("active"));
      this.classList.add("active");

      // Mengambil data kategori dari atribut data-category
      const category = this.getAttribute("data-category");

      // Menampilkan hanya card dalam kategori yang dipilih
      contentSections.forEach((section) => {
        if (section.getAttribute("data-category") === category) {
          section.style.display = "flex";
          const cards = section.querySelectorAll(".beasiswa-card");
          cards.forEach((card) => (card.style.display = "flex"));
        } else {
          section.style.display = "none";
        }
      });
    });
  });
  const sidebarItems = document.querySelectorAll(".dashboard-sidebar ul li");

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Menghapus kelas 'active' dari semua sidebar item
      sidebarItems.forEach((el) => el.classList.remove("active"));
      this.classList.add("active");
    });
  });
});
