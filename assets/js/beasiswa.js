// Menangani klik tombol dan link Beasiswa
document.querySelectorAll(".beasiswa-list a").forEach((element) => {
  element.addEventListener("click", function (event) {
    const type = this.getAttribute("data-category"); // Ambil data dari tombol
    if (type) {
      localStorage.setItem("selectedType", type); // Simpan kategori di localStorage

      // Jika elemen adalah <a>, navigasikan tanpa preventDefault
      if (this.tagName.toLowerCase() === "a") {
        return; // Biarkan <a> berjalan normal tanpa mengubah window.location
      }

      // Jika bukan <a>, navigasikan ke detailBeasiswa.html secara manual
      window.location.href = "detailBeasiswa.html";
    }
  });
});

// Menampilkan section yang sesuai saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
  const selectedType = localStorage.getItem("selectedType"); // Ambil type tersimpan

  if (selectedType) {
    // Sembunyikan semua section
    document.querySelectorAll(".beasiswa-section").forEach((section) => {
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
