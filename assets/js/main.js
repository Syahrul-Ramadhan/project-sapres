// Hamburger Menu dan side Navbar
const burgerMenu = document.querySelector(".burger-menu");
const sideNav = document.querySelector(".menu-responsive");
const close = document.querySelector(".close-nav");

// Buka Side Navbar
burgerMenu.addEventListener("click", () => {
  sideNav.classList.add("active");
  close.classList.add("active");
});

// Tutup Side Navbar dengan Klik di Luar
close.addEventListener("click", () => {
  sideNav.classList.remove("active");
  close.classList.remove("active");
});

// Search button ketika lebar layar kurang dari 1080
const searchIcon = document.querySelector(".search-icon");
const searchContainer = document.querySelector(".search-container");

// Fungsi untuk mengontrol tampilan search bar
function toggleSearchBar() {
  if (window.innerWidth <= 1080) {
    // Jika layar kecil, toggle search bar bisa muncul/menghilang saat search icon diklik
    if (
      searchContainer.style.display === "none" ||
      searchContainer.style.display === ""
    ) {
      searchContainer.style.display = "flex";
    } else {
      searchContainer.style.display = "none";
    }
  }
}

// Event listener saat ikon pencarian diklik
searchIcon.addEventListener("click", toggleSearchBar);

// Event listener saat ukuran layar berubah
window.addEventListener("resize", () => {
  if (window.innerWidth > 1080) {
    searchContainer.style.display = "flex"; // Selalu tampil di layar besar
  } else {
    searchContainer.style.display = "none"; // Sembunyikan saat layar kecil
  }
});

// Panggil event sekali saat halaman dimuat untuk menyesuaikan kondisi awal
window.dispatchEvent(new Event("resize"));

document.addEventListener("DOMContentLoaded", function () {
  const profileContainer = document.getElementById("profile-section");
  const authBtn = document.querySelector(".auth-buttons");
  const logoutBtn = document.getElementById("logout");
  const authResp = document.querySelectorAll(".auth-resp");
  const dropdownMenu = document.querySelector(".dropdown-profile");
  const profileBtn = document.querySelector(".profile-btn");

  const isLoggedIn = localStorage.getItem("status");

  if (isLoggedIn === "true") {
    // Tampilkan profil jika sudah login
    if (profileContainer) profileContainer.style.display = "block";
    if (authBtn) authBtn.style.display = "none";
    authResp.forEach((el) => (el.style.display = "none"));
  }

  // Dropdown menu profile
  if (profileBtn && dropdownMenu) {
    profileBtn.addEventListener("click", function () {
      dropdownMenu.classList.toggle("show"); // Gunakan toggle class agar bisa ditutup
    });
  }

  // Klik di luar dropdown untuk menutupnya
  document.addEventListener("click", function (e) {
    if (
      dropdownMenu &&
      !profileBtn.contains(e.target) &&
      !dropdownMenu.contains(e.target)
    ) {
      dropdownMenu.classList.remove("show");
    }
  });

  // Logout function
  logoutBtn.addEventListener("click", function () {
    localStorage.setItem("status", "false");

    // Redirect ke login
    setTimeout(() => {
      window.location.href = "login.html";
    }, 500);
  });
});
