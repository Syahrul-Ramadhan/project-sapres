document.addEventListener("DOMContentLoaded", function () {
  // Mengatur interaksi untuk dashboard links
  const dashboardLinks = document.querySelectorAll(".dashboard-links a");
  dashboardLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      // event.preventDefault();
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

  //Mengatur interaksi untuk mengganti status dan memfilter tim yang sesuai
  const teamList = document.getElementById("team-list");

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Menghapus kelas active dari semua li
      sidebarItems.forEach((i) => i.classList.remove("active"));

      // Menambahkan kelas active pada item yang dipilih
      this.classList.add("active");

      // Ambil status yang dipilih
      const status = this.getAttribute("data-status");

      // Perbarui URL dengan status yang dipilih (tanpa reload)
      const currentUrl = new URL(window.location.href);
      currentUrl.searchParams.set("status", status);
      window.history.pushState({}, "", currentUrl);

      // Panggil fungsi untuk memuat ulang data tim berdasarkan status
      loadTimData(status);
    });
  });

  // Memuat data tim pada awalnya dengan status default (misalnya 'semua')
  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get("status") || "semua"; // default ke 'semua'
  loadTimData(status);

  document.querySelectorAll(".btn-accept, .btn-reject").forEach((btn) => {
    btn.addEventListener("click", function (event) {
      // event.preventDefault();

      const tim_id = this.getAttribute("data-tim-id");
      const user_id = this.getAttribute("data-user-id");
      const aksi = this.classList.contains("btn-accept") ? "terima" : "tolak";

      // Kirim permintaan AJAX ke server untuk menerima/tolak
      fetch(
        `proses/proses_respon_gabung.php?tim_id=${tim_id}&user_id=${user_id}&aksi=${aksi}`
      )
        .then((response) => response.text())
        .then((data) => {
          // Setelah aksi selesai, perbarui tampilan notifikasi
          if (data === "Aksi berhasil") {
            // Misalnya, hapus notifikasi yang sudah diproses dari halaman
            this.closest(".notif-item").remove();
          }
        });
    });
  });
});

function openPopUp(timId) {
  // Ambil elemen modal
  var modal = document.getElementById("popup-modal");

  // Ambil data tim berdasarkan ID
  var timElement = document.querySelector('[data-id="' + timId + '"]');
  var namaTim = timElement.getAttribute("data-nama");
  var instansi = timElement.getAttribute("data-instansi");
  var link = timElement.getAttribute("data-link");
  var status = timElement.getAttribute("data-status");
  var created = timElement.getAttribute("data-created");

  // Mengisi data ke dalam modal
  document.getElementById("modal-title").textContent = namaTim;
  document.getElementById("modal-instansi").textContent = instansi;
  document.getElementById("modal-link").textContent = link;
  document.getElementById("modal-status").textContent = status;
  document.getElementById("modal-created").textContent = created;

  // Menangani link berdasarkan status
  var linkElement = document.getElementById("modal-link");
  if (status === "ditolak" || status === "menunggu") {
    // Sembunyikan link jika status ditolak
    linkElement.style.display = "none";
  } else {
    // Tampilkan link jika status bukan ditolak
    linkElement.style.display = "block";
    linkElement.textContent = link ? link : "Link tidak tersedia";
    linkElement.setAttribute("href", link); // Menambahkan link ke elemen anchor
  }

  // Menampilkan modal
  modal.style.display = "flex";
}

function closePopUp() {
  var modal = document.getElementById("popup-modal");
  modal.style.display = "none"; // Menyembunyikan modal
}
