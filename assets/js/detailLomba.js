// DETAIL LOMBA JS
document.addEventListener("DOMContentLoaded", function () {
  // Bookmark functionality for detail page
  const detailBookmarkBtn = document.querySelector(".btn-bookmark");
  if (detailBookmarkBtn) {
    detailBookmarkBtn.addEventListener("click", function () {
      this.classList.toggle("active");
      if (this.classList.contains("active")) {
        this.querySelector("i").classList.replace("far", "fas");
        this.querySelector("span").textContent = "Dibookmark";
      } else {
        this.querySelector("i").classList.replace("fas", "far");
        this.querySelector("span").textContent = "Bookmark";
      }
    });
  }

  // Share link functionality
  const shareBtn = document.querySelector(".btn-share");
  if (shareBtn) {
    shareBtn.addEventListener("click", function () {
      // Get current URL
      const url = window.location.href;

      // Copy to clipboard
      navigator.clipboard
        .writeText(url)
        .then(() => {
          // Visual feedback
          const originalText = this.querySelector("span").textContent;
          this.querySelector("span").textContent = "Tautan Disalin!";

          // Add temporary class for animation
          this.classList.add("copied");

          // Reset after 2 seconds
          setTimeout(() => {
            this.classList.remove("copied");
            this.querySelector("span").textContent = originalText;
          }, 2000);
        })
        .catch((err) => {
          console.error("Failed to copy: ", err);
          alert("Gagal menyalin tautan. Silakan coba lagi.");
        });
    });
  }

  // Download button functionality
  const downloadBtn = document.querySelector(".btn-download");
  if (downloadBtn) {
    downloadBtn.addEventListener("click", function (e) {
      // This would typically download a file
      // For demo purposes, we'll just show an alert
      e.preventDefault();
      alert("Downloading guidebook...");
      // In a real implementation, you would trigger the file download here
    });
  }
});
