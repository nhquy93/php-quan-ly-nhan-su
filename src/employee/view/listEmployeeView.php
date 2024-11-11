<h2>Danh sách nhân viên</h2>
<table border="1">
    <!-- Tìm kiếm -->
    <form method="GET" action="">
        <input type="text" name="keyword" placeholder="Nhập id, tên, email, sđt hoặc chức vụ">
        <button type="submit">Tìm kiếm</button>
    </form>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Chức vụ</th>
        <th>Lương</th>
        <th>Ngày ký HĐ</th>
        <th>Thao tác</th>
    </tr>
    <?php if (!empty($employees)): ?>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?php echo htmlspecialchars($employee['id']); ?></td>
                <td><?php echo htmlspecialchars($employee['name']); ?></td>
                <td><?php echo htmlspecialchars($employee['email']); ?></td>
                <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                <td><?php echo htmlspecialchars($employee['position']); ?></td>
                <td><?php echo htmlspecialchars(number_format($employee['salary'])); ?> đ</td>
                <td><?php echo htmlspecialchars($employee['hire_date']); ?></td>
                <td>
                    <!-- Nút Thêm -->
                    <a href="/cap-nhat-thong-tin">Thêm</a> |
                    <!-- Nút Sửa -->
                    <a href="/cap-nhat-thong-tin?id=<?php echo $employee['id']; ?>">Sửa</a> |
                    <!-- Nút Xóa -->
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
                        <input type="submit" value="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">Không có dữ liệu nhân viên.</td>
        </tr>
    <?php endif; ?>
</table>

<!-- Phân trang -->
<div class="pagination">
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<!-- Hiển thị thông báo nếu có -->
<?php if (isset($_SESSION['message'])): ?>
    <script>
        // Chạy function JS showNotification() trong file Notify.js
        showNotification('<?php echo $_SESSION['message']; ?>', 'success');
        // Unset thông báo sau khi hiển thị
        <?php unset($_SESSION['message']); ?>
    </script>
<?php endif; ?>

<!-- Hiển thị lỗi nếu có -->
<?php if (isset($_SESSION['error'])): ?>
    <script>
        // Chạy function JS showNotification() trong file Notify.js
        showNotification('<?php echo $_SESSION['error']; ?>', 'error');
        // Unset lỗi sau khi hiển thị
        <?php unset($_SESSION['error']); ?>
    </script>
<?php endif; ?>
