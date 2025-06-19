document.addEventListener("DOMContentLoaded", () => {
  const bookmarkBtn = document.querySelector(".beasiswa-section .bookmark-btn");
  const shareBtn = document.getElementById("shareBtn");
  const itemId = window.location.search.split("id=")[1]; // Ambil ID beasiswa dari URL

  // Menambahkan event listener untuk tombol Bookmark
  bookmarkBtn.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();

    const isBookmarked = bookmarkBtn.classList.contains("bookmarked");
    const action = isBookmarked ? "remove" : "add";

    // Toggle bookmark state
    bookmarkBtn.classList.toggle("bookmarked");

    // Kirim status bookmark ke server
    fetch("php/bookmark_handler.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        action,
        item_type: "beasiswa",
        item_id: itemId,
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          if (data.is_bookmarked) {
            bookmarkBtn.classList.add("bookmarked"); // Menambahkan class 'bookmarked' pada tombol jika sudah dibookmark
          }
          alert(
            action === "add"
              ? "Beasiswa ditambahkan ke bookmark!"
              : "Bookmark dihapus!"
          );
          location.reload(); // Memuat ulang halaman untuk update status bookmark
        } else {
          alert(data.message || "Gagal memproses bookmark.");
        }
      });
  });

  // Menambahkan event listener untuk tombol Salin Link
  shareBtn.addEventListener("click", (e) => {
    e.preventDefault();
    e.stopPropagation();

    const link = window.location.href; // Ambil link URL halaman ini

    // Salin link ke clipboard
    navigator.clipboard
      .writeText(link)
      .then(() => {
        alert("Link berhasil disalin ke clipboard!");
      })
      .catch((err) => {
        alert("Gagal menyalin link: " + err);
      });
  });
});
