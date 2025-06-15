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
  const nama = card.closest(".card-fteam").getAttribute("data-nama");
  const judul = card.closest(".card-fteam").getAttribute("data-judul");
  const instansi = card.closest(".card-fteam").getAttribute("data-instansi");
  const syarat = card.closest(".card-fteam").getAttribute("data-syarat");
  const cekKTM = card.closest(".card-fteam").getAttribute("data-cekktm");

  // Populate the pop-up with the data from the clicked card
  document.getElementById("pop-up-title").textContent = nama;
  document.getElementById("pop-up-lomba").textContent = judul;
  document.getElementById("pop-up-univ").textContent = instansi;

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
