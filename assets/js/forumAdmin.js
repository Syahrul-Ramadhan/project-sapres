document.addEventListener("DOMContentLoaded", function () {
    const adminId = 1; // Ganti dengan ID admin dari session PHP jika perlu

    // --- (CREATE) Logika untuk Pop-up Pengumuman ---
    const pengumumanPopup = document.getElementById("pengumuman-pop-up");
    document.getElementById("buatPengumumanBtn").addEventListener("click", () => {
        pengumumanPopup.style.display = "flex";
    });
    document.getElementById("pengumuman-closeBtn").addEventListener("click", () => {
        pengumumanPopup.style.display = "none";
    });

    document.getElementById("pengumumanForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'create_announcement');
        
        fetch('prosesForumAdmin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                location.reload();
            }
        });
    });

    // --- (READ) Logika untuk melihat detail diskusi ---
    const detailPopup = document.getElementById("detail-diskusi-pop-up");
    const detailContent = document.getElementById("discussion-detail-content");

    document.querySelectorAll(".table-content").forEach(row => {
        row.addEventListener("click", function() {
            const topicId = this.getAttribute('data-id');
            
            // Set parent_id untuk form balasan
            document.querySelector("#adminReplyForm input[name='parent_id']").value = topicId;

            // Ambil data diskusi
            fetch(`prosesForumAdmin.php?action=get_discussion&topic_id=${topicId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let html = '';
                    // Tampilkan post utama
                    const main = data.main_post;
                    html += `
                        <div class="main-post" data-message-id="${main.forum_id}">
                            <div class="post-header">${main.username} <span class="delete-message-btn" data-id="${main.forum_id}">Hapus</span></div>
                            <div class="post-meta">${new Date(main.waktu_postingan).toLocaleString('id-ID')}</div>
                            <div class="post-body">${main.pesan}</div>
                        </div>
                    `;

                    // Tampilkan semua balasan
                    data.replies.forEach(reply => {
                        html += `
                            <div class="reply-post" data-message-id="${reply.forum_id}">
                                <div class="post-header">${reply.username} <span class="delete-message-btn" data-id="${reply.forum_id}">Hapus</span></div>
                                <div class="post-meta">${new Date(reply.waktu_postingan).toLocaleString('id-ID')}</div>
                                <div class="post-body">${reply.pesan}</div>
                            </div>
                        `;
                    });
                    detailContent.innerHTML = html;
                    detailPopup.style.display = 'flex';
                } else {
                    alert('Gagal memuat diskusi.');
                }
            });
        });
    });

    document.getElementById("detail-closeBtn").addEventListener("click", () => {
        detailPopup.style.display = "none";
    });

    // --- Logika untuk Membalas Diskusi ---
    document.getElementById("adminReplyForm").addEventListener("submit", function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'reply_discussion');
        
        fetch('prosesForumAdmin.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                // Refresh detail view atau reload halaman
                location.reload(); 
            }
        });
    });


    // --- (DELETE) Logika untuk menghapus ---

    // Hapus seluruh diskusi dari tabel utama
    document.querySelectorAll('.delete-discussion-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah event klik baris terpicu
            const topicId = this.getAttribute('data-id');
            if (confirm('Yakin ingin menghapus seluruh diskusi ini (termasuk semua balasannya)?')) {
                const formData = new FormData();
                formData.append('action', 'delete_discussion');
                formData.append('topic_id', topicId);
                
                fetch('prosesForumAdmin.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        });
    });

    // Hapus pesan individual di dalam pop-up detail (event delegation)
    detailContent.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-message-btn')) {
            const messageId = e.target.getAttribute('data-id');
            if (confirm('Yakin ingin menghapus pesan ini? Jika ini pesan utama, seluruh diskusi akan terhapus.')) {
                const formData = new FormData();
                formData.append('action', 'delete_message');
                formData.append('message_id', messageId);
                
                fetch('prosesForumAdmin.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        // Hapus elemen dari DOM atau reload
                        location.reload();
                    }
                });
            }
        }
    });
});

// ... (seluruh kode di dalam DOMContentLoaded Anda tetap di atas) ...

// Fitur Search untuk Forum
function searchForum() {
  const searchInput = document.getElementById("searchForum").value.toLowerCase();
  const rows = document.querySelectorAll(".beasiswa-table tbody tr");

  rows.forEach((row) => {
    // Ambil sel yang relevan untuk pencarian
    const idCell = row.cells[0];      // ID Topik
    const pesanCell = row.cells[1];   // Isi Pesan
    const kategoriCell = row.cells[2]; // Kategori
    const pengirimCell = row.cells[3]; // Pengirim

    if (idCell && pesanCell && kategoriCell && pengirimCell) {
      const id = idCell.textContent || idCell.innerText;
      const pesan = pesanCell.textContent || pesanCell.innerText;
      const kategori = kategoriCell.textContent || kategoriCell.innerText;
      const pengirim = pengirimCell.textContent || pengirimCell.innerText;

      // Cek apakah input pencarian cocok dengan salah satu data sel
      if (
        id.toLowerCase().includes(searchInput) ||
        pesan.toLowerCase().includes(searchInput) ||
        kategori.toLowerCase().includes(searchInput) ||
        pengirim.toLowerCase().includes(searchInput)
      ) {
        row.style.display = ""; // Tampilkan baris jika cocok
      } else {
        row.style.display = "none"; // Sembunyikan baris jika tidak cocok
      }
    }
  });
}