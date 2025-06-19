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

  // Share (Salin Link) button functionality
  const shareBtn = document.getElementById("shareBtn");
  shareBtn.addEventListener("click", function () {
    // Salin link halaman saat ini ke clipboard
    const currentUrl = window.location.href;

    // Gunakan Clipboard API untuk menyalin
    navigator.clipboard
      .writeText(currentUrl)
      .then(function () {
        alert("Link berhasil disalin!");
      })
      .catch(function (err) {
        console.error("Gagal menyalin: ", err);
      });
  });
});

// Ambil elemen tahun dari teks h1
let currentYear = parseInt(
  document.getElementById("selected-year").textContent
);
let currentMonth =
  parseInt(
    document.querySelector(".month-item.active")?.getAttribute("data-month")
  ) || new Date().getMonth() + 1;

function changeYear(diff) {
  currentYear += diff;
  redirectToFilter();
}

function changeMonth(month) {
  currentMonth = month;
  redirectToFilter();
}

function redirectToFilter() {
  const url = new URL(window.location.href);
  url.searchParams.set("year", currentYear);
  url.searchParams.set("month", currentMonth);
  url.searchParams.delete("page"); // Reset ke halaman 1 saat filter berubah
  window.location.href = url.toString();
}

// Event untuk tombol tahun
document
  .querySelector(".prev-btn")
  ?.addEventListener("click", () => changeYear(-1));
document
  .querySelector(".next-btn")
  ?.addEventListener("click", () => changeYear(1));

// Event untuk bulan
document.querySelectorAll(".month-item").forEach((item) => {
  item.addEventListener("click", () => {
    changeMonth(parseInt(item.getAttribute("data-month")));
  });
});

document.getElementById("applyFilter").addEventListener("click", function () {
  const jenjang = [
    ...document.querySelectorAll(".filter-jenjang input:checked"),
  ].map((cb) => cb.value);
  const tipe = [...document.querySelectorAll(".filter-tipe input:checked")].map(
    (cb) => cb.value
  );
  const negara = document.getElementById("filter-negara").value;
  const univ = document.getElementById("filter-univ").value;
  const search = document.getElementById("searchBeasiswa").value;

  const params = new URLSearchParams();
  if (jenjang.length) params.append("jenjang", jenjang.join(","));
  if (tipe.length) params.append("tipe", tipe.join(","));
  if (negara) params.append("negara", negara);
  if (univ) params.append("univ", univ);
  if (search) params.append("search", search);

  // Tambahkan bulan dan tahun agar tetap terbaca
  const currentUrl = new URL(window.location.href);
  if (currentUrl.searchParams.get("month"))
    params.append("month", currentUrl.searchParams.get("month"));
  if (currentUrl.searchParams.get("year"))
    params.append("year", currentUrl.searchParams.get("year"));

  window.location.href = `beasiswa.php?${params.toString()}`;
});

document
  .querySelector(".btn-clear-filter")
  .addEventListener("click", function () {
    // Hapus semua checkbox yang diceklis
    document
      .querySelectorAll('.checkbox-filter input[type="checkbox"]')
      .forEach((cb) => (cb.checked = false));

    // Kosongkan input negara dan universitas
    document.getElementById("filter-negara").value = "";
    document.getElementById("filter-univ").value = "";

    // Kosongkan search bar jika ingin sekalian
    const searchBar = document.getElementById("searchBeasiswa");
    if (searchBar) searchBar.value = "";

    // Redirect ke halaman tanpa filter (reset URL)
    const baseUrl = window.location.pathname; // ex: beasiswa.php
    window.location.href = baseUrl;
  });

document.querySelector(".search-btn").addEventListener("click", function () {
  const keyword = document.getElementById("searchBeasiswa").value;
  const params = new URLSearchParams(window.location.search);

  params.set("search", keyword);
  params.set("page", 1); // reset ke halaman pertama

  window.location.href = window.location.pathname + "?" + params.toString();
});

document
  .getElementById("searchBeasiswa")
  .addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
      document.querySelector(".search-btn").click();
    }
  });

document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".btn-detail-beasiswa");

  // Ambil semua ID beasiswa dari href
  const ids = Array.from(cards)
    .map((el) => el.getAttribute("href")?.split("id=")[1])
    .filter(Boolean);

  // Ambil status bookmark dari server
  fetch("php/bookmark_handler.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      action: "get_status",
      item_type: "beasiswa",
      item_ids: ids,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.success) {
        const bookmarkedIds = new Set(
          data.bookmarks.map((b) => b.item_id.toString())
        );
        cards.forEach((card) => {
          const id = card.getAttribute("href").split("id=")[1];
          const btn = card.querySelector(".bookmark-btn");
          if (bookmarkedIds.has(id) && btn) {
            btn.classList.add("bookmarked");
          }
        });
      }
    });

  // Toggle bookmark saat diklik
  document.querySelectorAll(".bookmark-btn").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();

      const card = e.target.closest(".btn-detail-beasiswa");
      const btnTarget = e.currentTarget;
      const id = card?.getAttribute("href")?.split("id=")[1];
      if (!id) return;

      const isBookmarked = btnTarget.classList.contains("bookmarked");
      const action = isBookmarked ? "remove" : "add";

      btnTarget.classList.toggle("bookmarked");

      fetch("php/bookmark_handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          action,
          item_type: "beasiswa",
          item_id: id,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            btn.classList.toggle("bookmarked");
            alert(
              action === "add"
                ? "Beasiswa ditambahkan ke bookmark!"
                : "Bookmark dihapus!"
            );
            location.reload();
          } else {
            alert(data.message || "Gagal memproses bookmark.");
          }
        });
    });
  });
});

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
