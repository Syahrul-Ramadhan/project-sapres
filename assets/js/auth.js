// Register

// Toggle password visibility
document.querySelectorAll(".toggle-password").forEach((icon) => {
  icon.addEventListener("click", function () {
    const input = this.previousElementSibling;
    if (input.type === "password") {
      input.type = "text";
      this.classList.replace("fa-eye-slash", "fa-eye");
    } else {
      input.type = "password";
      this.classList.replace("fa-eye", "fa-eye-slash");
    }
  });
});

// Toggle password visibility
document
  .querySelector(".toggle-password")
  .addEventListener("click", function () {
    const input = this.previousElementSibling;
    if (input.type === "password") {
      input.type = "text";
      this.classList.replace("fa-eye-slash", "fa-eye");
    } else {
      input.type = "password";
      this.classList.replace("fa-eye", "fa-eye-slash");
    }
  });

document.addEventListener("DOMContentLoaded", function () {
  const registerForm = document.getElementById("register-form");
  if (!registerForm) return;

  registerForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Mencegah reload halaman

    const fullname = document.getElementById("fullname").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;

    // Validasi input
    if (!fullname || !email || !password || !confirmPassword) {
      alert("Semua kolom harus diisi!");
      return;
    }

    // Validasi format email
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert("Format email tidak valid!");
      return;
    }

    // Validasi password
    if (password !== confirmPassword) {
      alert("Password tidak cocok!");
      return;
    }

    // Simpan data ke localStorage
    localStorage.setItem("status", "true");
    localStorage.setItem("userFullname", fullname);

    alert("Pendaftaran berhasil! Silahkan cek email Anda untuk verifikasi.");

    // Redirect ke home setelah 1 detik
    setTimeout(() => {
      window.location.href = "home.html";
    }, 1000);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("login-form");
  if (!loginForm) return;

  loginForm.addEventListener("submit", function (e) {
    e.preventDefault(); // Mencegah reload halaman

    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;

    if (!email || !password) {
      alert("Email dan password harus diisi!");
      return;
    }

    // Login berhasil, simpan status di localStorage
    localStorage.setItem("status", "true");
    alert("Login berhasil!");

    // Redirect ke home setelah 1 detik
    setTimeout(() => {
      window.location.href = "home.html";
    }, 1000);
  });
});
