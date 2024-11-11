<h1>Quản lý nhân sự</h1>

<h2><?php echo $_GET['id'] ? 'Cập nhật thông tin nhân viên' : 'Thêm nhân viên'?></h2>
<form action="" method="POST">
    <input type="text" name="name" placeholder="Tên" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Điện thoại" required>
    <input type="text" name="position" placeholder="Chức vụ" required>
    <input type="number"  name="salary" placeholder="Lương" required>
    <input type="date" name="hire_date" placeholder="Ngày ký HĐ" required>
    <button type="submit"
        name="addOrUpdate"><?php echo $_GET['id'] ? 'Cập nhật' : 'Thêm nhân viên'?></button>
</form>
<br />
<a href="/">Quay lại danh sách nhân viên</a>

<script>
    // Kiểm tra có dữ liệu của nhân viên không?
    let employeeId = "<?php echo $_GET['id'] ?>";
    if (!!employeeId) {
        let employee_data = <?php echo json_encode($employee) ?>;

        // Fill dữ liệu của nhân viên (nếu có) vào form
        document.getElementsByName('name')[0].value = employee_data['name'];
        document.getElementsByName('email')[0].value = employee_data['email'];
        document.getElementsByName('phone')[0].value = employee_data['phone'];
        document.getElementsByName('position')[0].value = employee_data['position'];
        document.getElementsByName('salary')[0].value = employee_data['salary'];
        document.getElementsByName('hire_date')[0].value = employee_data['hire_date'];
    }
</script>
