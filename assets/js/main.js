// Hamburger Menu dan side Navbar
const burgerMenu = document.querySelector(".burger-menu");
const sideNav = document.querySelector(".menu-responsive");
const close = document.querySelector(".close-nav");

// Buka Side Navbar
if (burgerMenu && sideNav && close) {
  burgerMenu.addEventListener("click", () => {
    sideNav.classList.add("active");
    close.classList.add("active");
  });

  // Tutup Side Navbar dengan Klik di Luar
  close.addEventListener("click", () => {
    sideNav.classList.remove("active");
    close.classList.remove("active");
  });
}

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
if (searchIcon) {
  searchIcon.addEventListener("click", toggleSearchBar);
}

// Event listener saat ukuran layar berubah
window.addEventListener("resize", () => {
  if (window.innerWidth > 1080) {
    if (searchContainer) {
      searchContainer.style.display = "flex"; // Selalu tampil di layar besar
    }
  } else {
    if (searchContainer) {
      searchContainer.style.display = "none"; // Sembunyikan saat layar kecil
    }
  }
});

// Panggil event sekali saat halaman dimuat untuk menyesuaikan kondisi awal
window.dispatchEvent(new Event("resize"));

// DOM Content Loaded Event
document.addEventListener("DOMContentLoaded", function () {
  const profileContainer = document.getElementById("profile-section");
  const authBtn = document.querySelector(".auth-buttons");
  const logoutBtn = document.getElementById("logout");
  const authResp = document.querySelectorAll(".auth-resp");
  const dropdownMenu = document.querySelector(".dropdown-profile");
  const profileBtn = document.querySelector(".profile-btn");

  // Check login status using session (not localStorage)
  // Note: This will be set by PHP in the actual page
  let isLoggedIn = false;

  // Try to get login status from a global variable set by PHP
  if (typeof window.userLoggedIn !== "undefined") {
    isLoggedIn = window.userLoggedIn;
  }

  // Show/hide elements based on login status
  if (isLoggedIn) {
    // Tampilkan profil jika sudah login
    if (profileContainer) {
      profileContainer.style.display = "block";
    }
    if (authBtn) {
      authBtn.style.display = "none";
    }
    authResp.forEach((el) => {
      el.style.display = "none";
    });
  } else {
    // Tampilkan auth buttons jika belum login
    if (profileContainer) {
      profileContainer.style.display = "none";
    }
    if (authBtn) {
      authBtn.style.display = "flex";
    }
    authResp.forEach((el) => {
      el.style.display = "block";
    });
  }

  // Dropdown menu profile
  if (profileBtn && dropdownMenu) {
    profileBtn.addEventListener("click", function (e) {
      e.preventDefault();
      e.stopPropagation();

      console.log("Profile button clicked"); // Debug log

      // Toggle dropdown visibility
      dropdownMenu.classList.toggle("show");
    });
  }

  // Klik di luar dropdown untuk menutupnya
  document.addEventListener("click", function (e) {
    if (dropdownMenu && profileContainer) {
      if (!profileContainer.contains(e.target)) {
        dropdownMenu.classList.remove("show");
      }
    }
  });

  // Logout function
  if (logoutBtn) {
    logoutBtn.addEventListener("click", function (e) {
      e.preventDefault();

      console.log("Logout button clicked"); // Debug log

      if (confirm("Apakah Anda yakin ingin keluar?")) {
        // Hapus status dari session dan logout di server
        fetch("php/auth_handler.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: new URLSearchParams({
            action: "logout",
          }),
        })
          .then((response) => {
            console.log("Logout response received"); // Debug log
            return response.json();
          })
          .then((data) => {
            console.log("Logout response data:", data); // Debug log
            if (data.success) {
              // Redirect to login page
              window.location.href = data.redirect || "login.php";
            } else {
              alert("Logout gagal: " + (data.message || "Unknown error"));
            }
          })
          .catch((error) => {
            console.error("Logout error:", error);
            alert("Terjadi kesalahan saat logout. Silakan coba lagi.");
            // Fallback redirect
            window.location.href = data.redirect || "login.php";
          });
      }
    });
  }
});

// Utility function to check if user is logged in
function checkLoginStatus() {
  // This function can be called to dynamically check login status
  const profileContainer = document.getElementById("profile-section");
  const authButtons = document.querySelector(".auth-buttons");

  if (profileContainer && profileContainer.style.display !== "none") {
    return true;
  }
  return false;
}

// Function to update UI based on login status
function updateUIForLoginStatus(isLoggedIn) {
  const profileContainer = document.getElementById("profile-section");
  const authBtn = document.querySelector(".auth-buttons");
  const authResp = document.querySelectorAll(".auth-resp");

  if (isLoggedIn) {
    if (profileContainer) profileContainer.style.display = "block";
    if (authBtn) authBtn.style.display = "none";
    authResp.forEach((el) => (el.style.display = "none"));
  } else {
    if (profileContainer) profileContainer.style.display = "none";
    if (authBtn) authBtn.style.display = "flex";
    authResp.forEach((el) => (el.style.display = "block"));
  }
}

// Export functions for use in other scripts
window.SAPRES = {
  checkLoginStatus: checkLoginStatus,
  updateUIForLoginStatus: updateUIForLoginStatus,
  toggleSearchBar: toggleSearchBar,
};
