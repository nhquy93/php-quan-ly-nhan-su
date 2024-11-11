function showNotification($message, $type = "success") {
  // Kiểm tra loại thông báo và thiết lập màu sắc tương ứng
  $colorClass = "";
  switch ($type) {
    case "success":
      $colorClass = "alert-success";
      break;
    case "error":
      $colorClass = "alert-danger";
      break;
    default:
      $colorClass = "alert-info";
  }

  document.addEventListener("DOMContentLoaded", function () {
    var notification = document.createElement("div");
    notification.className = "alert " + $colorClass;
    notification.innerHTML = $message;
    document.body.appendChild(notification);

    // Tự động ẩn thông báo sau 5 giây
    setTimeout(function () {
      notification.style.opacity = "0";
      setTimeout(function () {
        document.body.removeChild(notification);
      }, 600); // Thời gian ẩn
    }, 5000); // Thời gian hiển thị
  });
}
