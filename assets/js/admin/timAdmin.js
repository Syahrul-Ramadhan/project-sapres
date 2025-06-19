// fitur search
function searchTim() {
  const searchInput = document.getElementById("searchTim").value.toLowerCase();
  const rows = document.querySelectorAll(".tim-table tbody tr");

  rows.forEach((row) => {
    const cells = row.getElementsByTagName("td");
    const idCell = cells[0]; // Id Tim
    const nameCell = cells[1]; // Nama Tim
    const tipeCell = cells[4];
    const tittleCell = cells[5];
    const instansiCell = cells[6];

    if (nameCell && idCell && tipeCell && tittleCell && instansiCell) {
      const name = nameCell.textContent || nameCell.innerText;
      const id = idCell.textContent || idCell.innerText;
      const kategori = tipeCell.textContent || tipeCell.innerText;
      const tittle = tittleCell.textContent || tittleCell.innerText;
      const instansi = instansiCell.textContent || instansiCell.innerText;

      // Check if the search term is in the Id or Name
      if (
        name.toLowerCase().includes(searchInput) ||
        id.includes(searchInput) ||
        kategori.toLowerCase().includes(searchInput) ||
        tittle.toLowerCase().includes(searchInput) ||
        instansi.toLowerCase().includes(searchInput)
      ) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    }
  });
}

// delete btn
const deleteBtns = document.querySelectorAll(".deletebtn");
deleteBtns.forEach((btn) => {
  btn.addEventListener("click", function (event) {
    event.stopPropagation(); // Menghentikan event agar pop-up detail tidak terbuka
  });
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
  const nama = card.closest(".table-content").getAttribute("data-nama");
  const jumlah = card.closest(".table-content").getAttribute("data-anggota");
  const jenjang = card.closest(".table-content").getAttribute("data-jenjang");
  const kategori = card.closest(".table-content").getAttribute("data-kategori");
  const judul = card.closest(".table-content").getAttribute("data-judul");
  const asal = card.closest(".table-content").getAttribute("data-asal");
  const deskripsi = card
    .closest(".table-content")
    .getAttribute("data-deskripsi");
  const syarat = card.closest(".table-content").getAttribute("data-syarat");
  const ktm = card.closest(".table-content").getAttribute("data-ktm");
  const tanggal = card.closest(".table-content").getAttribute("data-tanggal");

  // Populate the pop-up with the data from the clicked card
  document.querySelector(".detail-nama").textContent = nama;
  document.querySelector(".detail-jumlah").textContent = jumlah;
  document.querySelector(".detail-jenjang").textContent = jenjang;
  document.querySelector(".detail-kategori").textContent = kategori;
  document.querySelector(".detail-judul").textContent = judul;
  document.querySelector(".detail-asal-instansi").textContent = asal;
  document.querySelector(".detail-deskripsi").textContent = deskripsi;
  document.querySelector(".detail-syarat").textContent = syarat;
  document.querySelector(".detail-ktm").textContent = ktm;
  document.querySelector(".detail-tanggal").textContent = tanggal;
  // Show the pop-up
  document.querySelector(".detail-pop-up").style.display = "flex";
}

// Close the pop-up when the close button is clicked
document
  .getElementById("detail-closeBtn")
  .addEventListener("click", function () {
    document.querySelector(".detail-pop-up").style.display = "none";
  });
