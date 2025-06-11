document.querySelectorAll(".category-content a").forEach((element) => {
  element.addEventListener("click", function () {
    const category = this.getAttribute("data-category"); // Ambil kategori dari tombol
    localStorage.setItem("selectedCategory", category); // Simpan di localStorage
    window.location.href = "detailForum.html"; // Ganti dengan halaman forum
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Ambil kategori yang tersimpan di localStorage
  const selectedCategory = localStorage.getItem("selectedCategory");

  if (selectedCategory) {
    // Sembunyikan semua section
    document.querySelectorAll(".section-content").forEach((section) => {
      section.style.display = "none";
    });

    // Tampilkan section yang sesuai dengan kategori
    const activeSection = document.querySelector(
      `[data-category="${selectedCategory}"]`
    );
    if (activeSection) {
      activeSection.style.display = "block";
    }
  }
});

// Menangani klik tombol dan link forum
document.querySelectorAll(".btn-chat-forum").forEach((element) => {
  element.addEventListener("click", function (event) {
    const type = this.getAttribute("data-category"); // Ambil kategori dari tombol
    if (type) {
      localStorage.setItem("selectedType", type); // Simpan kategori di localStorage

      // Jika elemen adalah <a>, navigasikan tanpa preventDefault
      if (this.tagName.toLowerCase() === "a") {
        return; // Biarkan <a> berjalan normal tanpa mengubah window.location
      }

      // Jika bukan <a>, navigasikan ke forum-chat.html secara manual
      window.location.href = "forum-chat.html";
    }
  });
});

// Menampilkan section yang sesuai saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
  const selectedType = localStorage.getItem("selectedType"); // Ambil kategori tersimpan

  if (selectedType) {
    // Sembunyikan semua section
    document.querySelectorAll(".post-section").forEach((section) => {
      section.style.display = "none";
    });

    // Tampilkan section yang sesuai dengan data-type
    const activeSection = document.querySelector(
      `[data-type="${selectedType}"]`
    );
    if (activeSection) {
      activeSection.style.display = "block";
    }

    // Bersihkan localStorage setelah digunakan (opsional)
    localStorage.removeItem("selectedType");
  }
});
