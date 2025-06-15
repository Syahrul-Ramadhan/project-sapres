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
