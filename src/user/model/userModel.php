<?php

namespace User;

use Engine\Base;

class UserModel extends Base
{
    /**
     * Đăng nhập với tài khoản người dùng
     *
     * @param string $username
     * @param string $password
     *
     * @return array
     */
    public function getUser($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $params = array("username" => $username, "password" => md5($password));
        return $this->database->query($query, $params);
    }

    /**
     * Kiểm tra xem tên tài khoản đã tồn tại hay chưa
     *
     * @param string $username
     *
     * @return bool
     */
    private function isUsernameTaken($username)
    {
        $query = "SELECT COUNT(*) FROM users WHERE username = :username";
        $params = array("username" => $username);
        $result = $this->database->query($query, $params);

        return $result['COUNT(*)'] > 0; // Return true nếu tài khoản tồn tại
    }

    /**
     * Đăng ký tài khoản người dùng mới
     *
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function register($username, $password)
    {
        // Kiểm tra xem tên người dùng đã tồn tại chưa?
        $existUser = $this->isUsernameTaken($username);
        if ($existUser) {
            return false; // Tên người dùng đã được sử dụng
        } else {
            //Băm mật khẩu để bảo mật
            $hashedPassword = md5($password);

            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $params = array("username" => $username, "password" => $hashedPassword);

            return $this->database->query($query, $params);
        }
    }

    /**
     * Đặt lại mật khẩu cho tài khoản người dùng
     *
     * @param string $username
     * @param string $password
     *
     * @return bool
     */
    public function resetPassword($username, $password)
    {
        // Kiểm tra xem tên người dùng đã tồn tại chưa?
        $existUser = $this->isUsernameTaken($username);
        if ($existUser) {
            //Băm mật khẩu để bảo mật
            $hashedPassword = md5($password);

            $query = "UPDATE users SET password = :password WHERE username = :username";
            $params = array("username" => $username, "password" => $hashedPassword);

            return $this->database->query($query, $params);
        } else {
            return false; // Tên tài khoản không tồn tại
        }
    }
}
