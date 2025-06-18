// pop up cari tim
const popUp = document.querySelector(".pop-up-container");
const bgOverlay = document.querySelector(".background-pop-up");
const closeBtn = document.querySelector(".close-pop-up-btn");
const openBtn = document.querySelectorAll(".card-btn");
const confirmBtn = document.querySelector(".confirm-btn");
const notification = document.querySelector(".custom-notification");

// Event listener untuk semua tombol card-btn
openBtn.forEach((btn) => {
  btn.addEventListener("click", () => {
    popUp.classList.add("active");
    bgOverlay.classList.add("active");
  });
});

// Event listener untuk tombol close
closeBtn.addEventListener("click", () => {
  popUp.classList.remove("active");
  bgOverlay.classList.remove("active");
});

// Event listener untuk tombol confirm-btn
confirmBtn.addEventListener("click", () => {
  notification.classList.add("show");
  // Hilangkan notifikasi setelah 3 detik
  setTimeout(() => {
    notification.classList.remove("show");
  }, 3000);
  popUp.classList.remove("active");
  bgOverlay.classList.remove("active");
});

// Upload KTM
const ktmUpload = document.getElementById("ktm-upload");
const fileNameDisplay = document.getElementById("file-name");

ktmUpload.addEventListener("change", function () {
  if (this.files.length > 0) {
    fileNameDisplay.textContent = this.files[0].name;
  } else {
    fileNameDisplay.textContent = "Tidak ada file dipilih";
  }
});

// Function to open the pop-up and populate data based on the clicked card
function openPopUp(card) {
  // Get the data attributes from the clicked card
  const timId = card.closest(".card-fteam").getAttribute("data-id");
  const nama = card.closest(".card-fteam").getAttribute("data-nama");
  const judul = card.closest(".card-fteam").getAttribute("data-judul");
  const instansi = card.closest(".card-fteam").getAttribute("data-instansi");
  const syarat = card.closest(".card-fteam").getAttribute("data-syarat");
  const cekKTM = card.closest(".card-fteam").getAttribute("data-cekktm");

  // Populate the pop-up with the data from the clicked card
  document.getElementById("pop-up-title").textContent = nama;
  document.getElementById("pop-up-lomba").textContent = judul;
  document.getElementById("pop-up-univ").textContent = instansi;
  document.getElementById("tim_id_input").value = timId;

  // Display the syarat and ketentuan dynamically in the pop-up
  const syaratList = document.getElementById("pop-up-syarat");
  syaratList.innerHTML = ""; // Clear existing syarat
  const syaratItems = syarat.split("|");
  syaratItems.forEach(function (item) {
    const li = document.createElement("li");
    li.textContent = item;
    syaratList.appendChild(li);
  });

  // Check if 'cek_ktm' is 'tidak_perlu_ktm' and hide the .file-up section if true
  const fileUpSection = document.querySelector(".file-up");
  if (cekKTM === "tidak_perlu_ktm") {
    fileUpSection.style.display = "none"; // Hide the file upload section
  } else {
    fileUpSection.style.display = "block"; // Show the file upload section
  }

  // Show the pop-up
  document.querySelector(".pop-up-container").style.display = "flex";
}

// Close the pop-up when the close button is clicked
document
  .querySelector(".close-pop-up-btn")
  .addEventListener("click", function () {
    document.querySelector(".pop-up-container").style.display = "none";
  });

// Show pop-up create team
const createBtn = document.querySelector(".buat-tim");
createBtn.addEventListener("click", () => {
  document.querySelector(".create-team-container").style.display = "flex";
});
document
  .querySelector(".close-create-team-btn")
  .addEventListener("click", function () {
    document.querySelector(".create-team-container").style.display = "none";
  });

document.getElementById("applyFilter").addEventListener("click", function () {
  const jenjang = [
    ...document.querySelectorAll(".filter-jenjang input:checked"),
  ].map((cb) => cb.value);
  const kategori = document.getElementById("filter-kategori").value;
  const univ = document.getElementById("filter-univ").value;
  const search = document.getElementById("searchTim").value;

  const params = new URLSearchParams();
  if (jenjang.length) params.append("jenjang", jenjang.join(","));
  if (kategori) params.append("kategori", kategori);
  if (univ) params.append("univ", univ);
  if (search) params.append("search", search);

  window.location.href = `cariTim.php?${params.toString()}`;
});

document
  .querySelector(".btn-clear-filter")
  .addEventListener("click", function () {
    // Hapus semua checkbox yang diceklis
    document
      .querySelectorAll('.checkbox-filter input[type="checkbox"]')
      .forEach((cb) => (cb.checked = false));

    // Kosongkan input negara dan universitas
    document.getElementById("filter-kategori").value = "";
    document.getElementById("filter-univ").value = "";

    // Kosongkan search bar jika ingin sekalian
    const searchBar = document.getElementById("searchTim");
    if (searchBar) searchBar.value = "";

    // Redirect ke halaman tanpa filter (reset URL)
    const baseUrl = window.location.pathname; // ex: beasiswa.php
    window.location.href = baseUrl;
  });

document.querySelector(".search-btn").addEventListener("click", function () {
  const keyword = document.getElementById("searchTim").value;
  const params = new URLSearchParams(window.location.search);

  params.set("search", keyword);
  params.set("page", 1); // reset ke halaman pertama

  window.location.href = window.location.pathname + "?" + params.toString();
});

document.getElementById("searchTim").addEventListener("keypress", function (e) {
  if (e.key === "Enter") {
    document.querySelector(".search-btn").click();
  }
});
