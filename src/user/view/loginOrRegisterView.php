<div class="wrapper">
    <div class="wrapper-auth" id="authForm">
        <form id="authForm" action="" method="POST">
            <h2 id="formTitle">Đăng nhập</h2>
            <input type="hidden" name="loginMode" value="">
            <input type="text" name="username" placeholder="Tên tài khoản" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <!-- Hiển thị lỗi nếu có -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <p class="error-message" style="color: red;"><?php echo $_SESSION['error_message']; ?></p>
                <!-- Unset lỗi sau khi hiển thị -->
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            <button type="submit" id="loginOrRegister">Đăng nhập</button>
            <a href="#" id="forgotPasswordLink">Quên Mật Khẩu?</a>
            <br>
            <a href="#" id="toggleLink">Chưa có tài khoản? Đăng ký ngay</a>
        </form>
    </div>

    <!-- Form tên tài khoản để đặt lại mật khẩu -->
    <div class="wrapper-auth" id="forgotPasswordForm" style="display: none;">
        <h4>Đặt lại mật khẩu</h4>
        <form id="forgotPasswordForm" action="" method="POST">
            <input type="text" name="username" placeholder="Nhập tên tài khoản cần đổi mật khẩu" required>
            <input type="password" name="newPassword" placeholder="Mật khẩu mới" required>
            <button type="submit">Xác nhận đặt lại mật khẩu</button>
        </form>
        <a href="#" id="backToLoginLink">Quay lại Đăng nhập</a>

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

    <script>
        const toggleLink = document.getElementById('toggleLink');
        const submitButton = document.getElementById('loginOrRegister');
        const formTitle = document.getElementById('formTitle');
        const authForm = document.getElementById('authForm');
        const loginMode = document.querySelector('input[name="loginMode"]');

        const forgotPasswordLink = document.getElementById('forgotPasswordLink');
        const forgotPasswordForm = document.getElementById('forgotPasswordForm');
        const backToLoginLink = document.getElementById('backToLoginLink');

        let isLoginMode = true; // Flag theo dõi
        loginMode.value = isLoginMode;

        toggleLink.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chặn hành vi nhấp chuột mặc định

            // Chuyển đổi giữa đăng nhập và đăng ký
            isLoginMode = !isLoginMode;
            loginMode.value = isLoginMode;
            if (isLoginMode) {
                formTitle.textContent = 'Đăng nhập';
                submitButton.textContent = 'Đăng nhập';
                authForm.querySelector('input[name="username"]').placeholder = "Tên tài khoản";
            } else {
                formTitle.textContent = 'Đăng ký';
                submitButton.textContent = 'Đăng ký';
                authForm.querySelector('input[name="username"]').placeholder = "Tên tài khoản mới";
            }

            // Cập nhật text
            toggleLink.textContent = isLoginMode ? 'Chưa có tài khoản? Đăng ký ngay' : 'Đã có tài khoản? Đăng nhập ngay';
        });

        forgotPasswordLink.addEventListener('click', function (event) {
            event.preventDefault();
            authForm.style.display = 'none';
            forgotPasswordForm.style.display = 'block';
        });

        backToLoginLink.addEventListener('click', function (event) {
            event.preventDefault();
            forgotPasswordForm.style.display = 'none';
            authForm.style.display = 'block';
        });
    </script>
