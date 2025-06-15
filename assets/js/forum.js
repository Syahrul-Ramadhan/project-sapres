document.addEventListener('DOMContentLoaded', function () {

  // --- KATEGORI KLIK DI HALAMAN forum.php ---
  document.querySelectorAll(".category-content a").forEach((element) => {
    element.addEventListener("click", function (event) {
      event.preventDefault();
      const category = this.getAttribute("data-category");
      if (category) {
        localStorage.setItem("selectedCategory", category);
        window.location.href = "detailForum.php";
      }
    });
  });

  // --- TAMPILKAN SECTION SESUAI KATEGORI DI detailForum.php ---
  if (window.location.pathname.includes('detailForum.php')) {
    const selectedCategory = localStorage.getItem("selectedCategory");
    if (selectedCategory) {
      document.querySelectorAll(".section-content").forEach((section) => {
        section.style.display = "none";
      });
      const activeSection = document.querySelector(`.section-content[data-category="${selectedCategory}"]`);
      if (activeSection) {
        activeSection.style.display = "block";
      }
    }
  }

  // --- HANDLE KLIK TOPIK & TOMBOL \"CARA MENGGUNAKAN FORUM\" ---
  document.querySelectorAll('.question-items, .question-content, .how-to-btn').forEach(row => {
    row.style.cursor = 'pointer';
    row.addEventListener('click', function () {
      const topicIdentifier = this.getAttribute('data-topic-id');
      if (topicIdentifier) {
        localStorage.setItem('selectedTopic', topicIdentifier);
        window.location.href = 'forum-chat.php';
      }
    });
    row.addEventListener('mouseenter', () => row.style.backgroundColor = '#205781');
    row.addEventListener('mouseleave', () => row.style.backgroundColor = '');
  });

  // --- MODAL AJUKAN PERTANYAAN ---
  document.querySelectorAll(".openModalBtn").forEach(button => {
    button.addEventListener("click", function () {
      const kategori = this.getAttribute("data-kategori");
      const selectKategori = document.getElementById("kategori");
      if (kategori && selectKategori) {
        selectKategori.value = kategori;
      }
      document.getElementById("ajukanModal").style.display = "flex";
    });
  });

  const closeBtn = document.getElementById("closeModalBtn");
  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      document.getElementById("ajukanModal").style.display = "none";
    });
  }

  window.addEventListener("click", function (e) {
    const modal = document.getElementById("ajukanModal");
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });

  const formAjukan = document.getElementById("formAjukan");
  if (formAjukan) {
    formAjukan.addEventListener("submit", function (e) {
      e.preventDefault();
      const kategori = document.getElementById("kategori").value;
      const pesan = document.getElementById("pesan").value;
      fetch("ajukan_pertanyaan.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `kategori=${encodeURIComponent(kategori)}&pesan=${encodeURIComponent(pesan)}`
      })
        .then(async response => {
          const text = await response.text();
          if (!response.ok) throw new Error(text);
          alert("✅ " + text);
          formAjukan.reset();
          document.getElementById("ajukanModal").style.display = "none";
          location.reload();
        })
        .catch(error => {
          alert("❌ " + error.message);
        });
    });
  }

  // --- REDIRECT KE forum-chat.php?topic=... ---
  if (window.location.pathname.includes("forum-chat.php")) {
    const topicId = localStorage.getItem("selectedTopic");
    if (topicId && !window.location.search.includes("topic=")) {
      window.location.href = `forum-chat.php?topic=${topicId}`;
    }
  }

  // --- KIRIM KOMENTAR DI forum-chat.php TANPA RELOAD HISTORY ---
  const formKomentar = document.getElementById("formKomentar");
  if (formKomentar) {
    formKomentar.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData(formKomentar);
      const data = new URLSearchParams(formData);

      fetch("kirim_komentar.php", {
        method: "POST",
        body: data
      })
        .then(res => res.text())
        .then(response => {
          // Setelah sukses, refresh halaman agar komentar baru muncul
          formKomentar.reset();
          location.reload();
        })
        .catch(err => {
          alert("❌ Gagal mengirim komentar: " + err.message);
        });
    });
  }


});