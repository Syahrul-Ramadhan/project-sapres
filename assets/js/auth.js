document.addEventListener("DOMContentLoaded", function () {
  // Handle Register Form
  const registerForm = document.getElementById("register-form");
  if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData();
      formData.append("action", "register");
      formData.append("fullname", document.getElementById("fullname").value);
      formData.append("email", document.getElementById("email").value);
      formData.append("password", document.getElementById("password").value);
      formData.append(
        "confirm_password",
        document.getElementById("confirm-password").value
      );

      // Show loading state
      const submitBtn = registerForm.querySelector(".register-btn");
      const originalText = submitBtn.textContent;
      submitBtn.textContent = "MENDAFTAR...";
      submitBtn.disabled = true;

      fetch("php/auth_handler.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            showMessage(data.message, "success");
            setTimeout(() => {
              window.location.href = "login.php";
            }, 2000);
          } else {
            showMessage(data.message, "error");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showMessage("Terjadi kesalahan jaringan", "error");
        })
        .finally(() => {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        });
    });
  }

  // Handle Login Form
  const loginForm = document.getElementById("login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const formData = new FormData();
      formData.append("action", "login");
      formData.append("email", document.getElementById("email").value);
      formData.append("password", document.getElementById("password").value);
      formData.append(
        "remember",
        document.getElementById("remember").checked ? "1" : "0"
      );

      // Show loading state
      const submitBtn = loginForm.querySelector(".register-btn");
      const originalText = submitBtn.textContent;
      submitBtn.textContent = "MASUK...";
      submitBtn.disabled = true;

      fetch("php/auth_handler.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            showMessage(data.message, "success");
            setTimeout(() => {
              window.location.href = data.redirect;
            }, 1500);
          } else {
            showMessage(data.message, "error");
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showMessage("Terjadi kesalahan jaringan", "error");
        })
        .finally(() => {
          submitBtn.textContent = originalText;
          submitBtn.disabled = false;
        });
    });
  }

  // Handle Logout
  document.addEventListener("click", function (e) {
    if (e.target.id === "logout") {
      e.preventDefault();

      if (confirm("Apakah Anda yakin ingin keluar?")) {
        const formData = new FormData();
        formData.append("action", "logout");

        fetch("php/auth_handler.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              window.location.href = data.redirect;
            }
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    }
  });

  // Toggle password visibility - FIXED
  const toggleButtons = document.querySelectorAll(".toggle-password");
  toggleButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      // Find the password input (previous sibling)
      const passwordInput = this.previousElementSibling;

      if (passwordInput && passwordInput.type) {
        // Toggle input type
        const type = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = type;

        // Toggle icon classes
        if (type === "text") {
          this.classList.remove("fa-eye-slash");
          this.classList.add("fa-eye");
        } else {
          this.classList.remove("fa-eye");
          this.classList.add("fa-eye-slash");
        }
      }
    });
  });
});

// Show message function
function showMessage(message, type) {
  // Remove existing messages
  const existingMessages = document.querySelectorAll(".auth-message");
  existingMessages.forEach((msg) => msg.remove());

  // Create message element
  const messageDiv = document.createElement("div");
  messageDiv.className = `auth-message ${type}`;
  messageDiv.style.cssText = `
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      text-align: center;
      ${
        type === "success"
          ? "background: #d4edda; color: #155724; border: 1px solid #c3e6cb;"
          : "background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb;"
      }
  `;
  messageDiv.textContent = message;

  // Insert message at the top of form
  const form = document.querySelector(".register-form");
  if (form) {
    form.insertBefore(messageDiv, form.firstChild);

    // Auto remove after 5 seconds
    setTimeout(() => {
      if (messageDiv.parentNode) {
        messageDiv.remove();
      }
    }, 5000);
  }
}
