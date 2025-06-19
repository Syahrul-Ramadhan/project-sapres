document.addEventListener("DOMContentLoaded", function () {
  //add pop-up
  const addBtn = document.querySelector(".btn-add");
  addBtn.addEventListener("click", () => {
    document.querySelector(".add-pop-up").style.display = "flex";
  });
  document
    .getElementById("add-closeBtn")
    .addEventListener("click", function () {
      document.querySelector(".add-pop-up").style.display = "none";
    });

  // Event listener untuk tombol Edit (menggunakan editPopUp)
  const editBtns = document.querySelectorAll(".editbtn");
  editBtns.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      event.stopPropagation(); // Menghentikan event agar pop-up detail tidak terbuka
      editPopUp(this);
    });
  });

  const deleteBtns = document.querySelectorAll(".deletebtn");
  deleteBtns.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      event.stopPropagation(); // Menghentikan event agar pop-up detail tidak terbuka
    });
  });

  // Function to open the pop-up and populate data based on the clicked card
  function editPopUp(card) {
    // Get the data attributes from the clicked card
    const id = card.closest(".table-content").getAttribute("data-id");
    const judul = card.closest(".table-content").getAttribute("data-judul");
    const jenjang = card.closest(".table-content").getAttribute("data-jenjang");
    const mulai = card.closest(".table-content").getAttribute("data-mulai");
    const tutup = card.closest(".table-content").getAttribute("data-penutupan");
    const pemberi = card.closest(".table-content").getAttribute("data-pemberi");
    const asal = card.closest(".table-content").getAttribute("data-asal");
    const tipe = card.closest(".table-content").getAttribute("data-tipe");
    const benefit = card.closest(".table-content").getAttribute("data-benefit");
    const syarat = card.closest(".table-content").getAttribute("data-syarat");
    const booklet = card.closest(".table-content").getAttribute("data-booklet");
    const lokasi = card.closest(".table-content").getAttribute("data-lokasi");
    const link = card.closest(".table-content").getAttribute("data-link");

    // Fill form fields
    document.querySelector("input[name='edit-beasiswa_id']").value = id;
    document.querySelector("input[name='edit-judul_beasiswa']").value = judul;
    document.querySelector("input[name='edit-mulai_beasiswa']").value = mulai;
    document.querySelector("input[name='edit-penutupan_beasiswa']").value =
      tutup;
    document.querySelector("input[name='edit-pemberi_beasiswa']").value =
      pemberi;
    document.querySelector("input[name='edit-asal_instansi']").value = asal;

    // Set dropdown untuk tipe pendanaan
    document.querySelector("select[name='edit-tipe_pendanaan']").value = tipe;

    // Set checkboxes for Jenjang
    const jenjangList = jenjang.split(",");
    document
      .querySelectorAll("input[name='edit-jenjang_beasiswa[]']")
      .forEach((checkbox) => {
        checkbox.checked = jenjangList.includes(checkbox.value);
      });

    // Set benefit dan syarat
    document.querySelector("textarea[name='edit-benefit_beasiswa']").value =
      benefit;
    document.querySelector("textarea[name='edit-syarat_beasiswa']").value =
      syarat;
    document.querySelector("input[name='edit-booklet_beasiswa']").value =
      booklet;
    document.querySelector("input[name='edit-lokasi_beasiswa']").value = lokasi;
    document.querySelector("input[name='edit-link_pendaftaran']").value = link;

    // Show the pop-up
    document.querySelector(".edit-pop-up").style.display = "flex";
  }

  // Close the pop-up when the close button is clicked
  document
    .getElementById("edit-closeBtn")
    .addEventListener("click", function () {
      document.querySelector(".edit-pop-up").style.display = "none";
    });

  // show pop-up detail
  const detailBtns = document.querySelectorAll(".table-content");
  detailBtns.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      event.stopPropagation(); // Menghentikan event agar pop-up edit tidak terbuka
      openPopUp(this);
    });
  });

  // Function to open the pop-up and populate data based on the clicked card
  function openPopUp(card) {
    const judul = card.closest(".table-content").getAttribute("data-judul");
    const jenjang = card.closest(".table-content").getAttribute("data-jenjang");
    const mulai = card.closest(".table-content").getAttribute("data-mulai");
    const tutup = card.closest(".table-content").getAttribute("data-penutupan");
    const pemberi = card.closest(".table-content").getAttribute("data-pemberi");
    const asal = card.closest(".table-content").getAttribute("data-asal");
    const tipe = card.closest(".table-content").getAttribute("data-tipe");
    const benefit = card.closest(".table-content").getAttribute("data-benefit");
    const syarat = card.closest(".table-content").getAttribute("data-syarat");
    const booklet = card.closest(".table-content").getAttribute("data-booklet");
    const lokasi = card.closest(".table-content").getAttribute("data-lokasi");
    const link = card.closest(".table-content").getAttribute("data-link");
    // Populate the pop-up with the data from the clicked card
    document.querySelector(".detail-judul").textContent = judul;
    document.querySelector(".detail-jenjang").textContent = jenjang;
    document.querySelector(".detail-pendaftaran").textContent = mulai;
    document.querySelector(".detail-penutupan").textContent = tutup;
    document.querySelector(".detail-pemberi").textContent = pemberi;
    document.querySelector(".detail-asal-instansi").textContent = asal;
    document.querySelector(".detail-tipe").textContent = tipe;
    document.querySelector(".detail-benefit").textContent = benefit;
    document.querySelector(".detail-syarat").textContent = syarat;
    document.querySelector(".detail-booklet").textContent = booklet;
    document.querySelector(".detail-lokasi").textContent = lokasi;
    document.querySelector(".detail-link").textContent = link;
    // Show the pop-up
    document.querySelector(".detail-pop-up").style.display = "flex";
  }

  // Close the pop-up when the close button is clicked
  document
    .getElementById("detail-closeBtn")
    .addEventListener("click", function () {
      document.querySelector(".detail-pop-up").style.display = "none";
    });
});

// fitur search
function searchBeasiswa() {
  const searchInput = document
    .getElementById("searchBeasiswa")
    .value.toLowerCase();
  const rows = document.querySelectorAll(".beasiswa-table tbody tr");

  rows.forEach((row) => {
    const cells = row.getElementsByTagName("td");
    const idCell = cells[0]; // Id Beasiswa
    const nameCell = cells[1]; // Nama Beasiswa
    const giverCell = cells[5]; // Pemberi Beasiswa

    if (nameCell && idCell && giverCell) {
      const name = nameCell.textContent || nameCell.innerText;
      const id = idCell.textContent || idCell.innerText;
      const giver = giverCell.textContent || giverCell.innerText;

      // Check if the search term is in the Id or Name
      if (
        name.toLowerCase().includes(searchInput) ||
        id.includes(searchInput) ||
        giver.toLowerCase().includes(searchInput)
      ) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    }
  });
}
