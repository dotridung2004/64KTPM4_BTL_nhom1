document.addEventListener("DOMContentLoaded", function () {
  // Xử lý thay đổi icon trái tim
  var heartBtn = document.getElementById("heartBtn");
  var icon = document.getElementById("heartIcon");

  if (heartBtn && icon) {
    heartBtn.addEventListener("click", function () {
      if (icon.classList.contains("fa-regular")) {
        icon.classList.remove("fa-regular");
        icon.classList.add("fa-solid");
        icon.style.color = "red";
      } else {
        icon.classList.remove("fa-solid");
        icon.classList.add("fa-regular");
        icon.style.color = ""; // Reset màu
      }
    });
  }

  // Xử lý thay đổi ảnh chính khi click thumbnail
  const mainImage = document.getElementById("mainImage");
  const thumbnails = document.querySelectorAll(".thumbnail-img");

  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener("click", () => {
      mainImage.src = thumbnail.src;
    });
  });
});
