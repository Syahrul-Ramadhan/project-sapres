// Enhanced auth.js dengan debugging yang lebih detail
document.addEventListener('DOMContentLoaded', function() {
    console.log('Auth.js loaded');
    
    // Handle login form - cari dengan berbagai selector
    const loginForm = document.querySelector('#login-form');
    if (loginForm) {
        console.log('Login form found with ID:', loginForm.id);
        loginForm.addEventListener('submit', handleLogin);
    } else {
        console.log('Login form with ID not found, trying other selectors...');
        const altLoginForm = document.querySelector('form.register-form');
        if (altLoginForm) {
            console.log('Alternative login form found');
            altLoginForm.addEventListener('submit', handleLogin);
        }
    }
    
    // Handle register form
    const registerForm = document.querySelector('#register-form');
    if (registerForm) {
        console.log('Register form found with ID:', registerForm.id);
        registerForm.addEventListener('submit', handleRegister);
    } else {
        console.log('Register form with ID not found, trying other selectors...');
        const altRegisterForm = document.querySelector('form.register-form');
        if (altRegisterForm && window.location.pathname.includes('register')) {
            console.log('Alternative register form found');
            altRegisterForm.addEventListener('submit', handleRegister);
        }
    }
    
    // Handle logout button click
    const logoutBtn = document.getElementById('logout');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Show confirmation
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                // Send logout request
                fetch('php/auth_process.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=logout'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to login page
                        window.location.href = 'login.php?message=logged_out';
                    } else {
                        // Fallback: direct redirect
                        window.location.href = 'php/logout.php';
                    }
                })
                .catch(error => {
                    console.error('Logout error:', error);
                    // Fallback: direct redirect
                    window.location.href = 'php/logout.php';
                });
            }
        });
    }
    
    console.log('Auth event listeners attached');
});

function handleLogin(event) {
    event.preventDefault();
    console.log('Login form submitted');
    
    const form = event.target;
    console.log('Form element:', form);
    
    // Get form data manually to ensure we get the values
    const email = form.querySelector('#email').value.trim();
    const password = form.querySelector('#password').value;
    
    console.log('Email value:', email);
    console.log('Password length:', password.length);
    
    // Validate on client side first
    if (!email || !password) {
        showNotification('Email dan password harus diisi', 'error');
        return;
    }
    
    // Create FormData manually
    const formData = new FormData();
    formData.append('action', 'login');
    formData.append('email', email);
    formData.append('password', password);
    
    // Debug form data
    console.log('FormData contents:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + (key === 'password' ? '[HIDDEN]' : value));
    }
    
    const submitBtn = form.querySelector('button[type="submit"], .register-btn');
    const originalText = submitBtn.textContent;
    
    // Show loading state
    submitBtn.textContent = 'Memproses...';
    submitBtn.disabled = true;
    
    console.log('Sending login request to php/auth_process.php');
    
    fetch('php/auth_process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        return response.text();
    })
    .then(text => {
        console.log('Raw response:', text);
        try {
            const result = JSON.parse(text);
            console.log('Parsed result:', result);
            
            if (result.success) {
                showNotification(result.message, 'success');
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 1000);
            } else {
                showNotification(result.message, 'error');
            }
        } catch (e) {
            console.error('JSON parse error:', e);
            console.error('Response text:', text);
            showNotification('Server response error. Check console for details.', 'error');
        }
    })
    .catch(error => {
        console.error('Login error:', error);
        showNotification('Terjadi kesalahan jaringan: ' + error.message, 'error');
    })
    .finally(() => {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    });
}

function handleRegister(event) {
    event.preventDefault();
    console.log('Register form submitted');
    
    const form = event.target;
    console.log('Form element:', form);
    
    // Get form data manually
    const fullname = form.querySelector('#fullname').value.trim();
    const email = form.querySelector('#email').value.trim();
    const password = form.querySelector('#password').value;
    const confirmPassword = form.querySelector('#confirm-password').value;
    
    console.log('Register data - Name:', fullname, 'Email:', email);
    
    // Validate on client side first
    if (!fullname || !email || !password || !confirmPassword) {
        showNotification('Semua field harus diisi', 'error');
        return;
    }
    
    if (password !== confirmPassword) {
        showNotification('Password dan konfirmasi password tidak sama', 'error');
        return;
    }
    
    // Create FormData manually
    const formData = new FormData();
    formData.append('action', 'register');
    formData.append('fullname', fullname);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('confirm_password', confirmPassword);
    
    // Debug form data
    console.log('FormData contents:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + (key.includes('password') ? '[HIDDEN]' : value));
    }
    
    const submitBtn = form.querySelector('button[type="submit"], .register-btn');
    const originalText = submitBtn.textContent;
    
    // Show loading state
    submitBtn.textContent = 'Memproses...';
    submitBtn.disabled = true;
    
    console.log('Sending register request to php/auth_process.php');
    
    fetch('php/auth_process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.text();
    })
    .then(text => {
        console.log('Raw response:', text);
        try {
            const result = JSON.parse(text);
            console.log('Parsed result:', result);
            
            if (result.success) {
                showNotification(result.message, 'success');
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 1500);
            } else {
                showNotification(result.message, 'error');
            }
        } catch (e) {
            console.error('JSON parse error:', e);
            console.error('Response text:', text);
            showNotification('Server response error. Check console for details.', 'error');
        }
    })
    .catch(error => {
        console.error('Register error:', error);
        showNotification('Terjadi kesalahan jaringan: ' + error.message, 'error');
    })
    .finally(() => {
        submitBtn.textContent = originalText;
        submitBtn.disabled = false;
    });
}

function handleLogout() {
    if (confirm('Apakah Anda yakin ingin keluar?')) {
        const formData = new FormData();
        formData.append('action', 'logout');
        
        console.log('Sending logout request');
        
        fetch('php/auth_process.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(text => {
            console.log('Logout response:', text);
            try {
                const result = JSON.parse(text);
                if (result.success) {
                    showNotification(result.message, 'success');
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1000);
                } else {
                    showNotification(result.message, 'error');
                }
            } catch (e) {
                console.error('JSON parse error:', e);
                showNotification('Logout error: ' + text, 'error');
            }
        })
        .catch(error => {
            console.error('Logout error:', error);
            showNotification('Terjadi kesalahan jaringan', 'error');
        });
    }
}

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

function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.auth-notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification
    const notification = document.createElement('div');
    notification.className = `auth-notification auth-notification-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    // Set background color based on type
    const colors = {
        success: '#28a745',
        error: '#dc3545',
        info: '#17a2b8',
        warning: '#ffc107'
    };
    notification.style.backgroundColor = colors[type] || colors.info;
    
    notification.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" 
                    style="background: none; border: none; color: white; font-size: 18px; cursor: pointer; margin-left: 10px;">&times;</button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}
