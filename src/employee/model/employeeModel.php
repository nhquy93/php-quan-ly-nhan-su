<?php

namespace Employee;

use Engine\Base;

class EmployeeModel extends Base
{
    /**
     * Trả về danh sách nhân viên có phân trang.
     *
     * @param int $limit  Số giới hạn danh sách nhân viên trả về.
     * @param int $offset Số Offset để bắt đầu lấy thông tin nhân viên.
     * @return array
     */
    public function getAllEmployees($limit, $offset): array
    {
        $query = "SELECT * FROM `employees` LIMIT :limit OFFSET :offset";
        return $this->database->query($query, ['limit' => $limit, 'offset' => $offset]);
    }

    /**
     * Thêm thông tin nhân viên mới vào CSDL
     *
     * @param string $name       Tên nhân viên
     * @param string $email      Email của nhân viên
     * @param string $phone      Số diện thoại
     * @param string $position   Chức vụ
     * @param int    $salary     Lương
     * @param string $hire_date  Ngày ký Hợp Đồng
     *
     * @return mixed
     */
    public function create(string $name, string $email, string $phone, string $position, int $salary, string $hire_date)
    {
        $query = "INSERT INTO `employees`(`name`, `email`, `phone`, `position`, `salary`, `hire_date`) VALUES('$name', '$email', '$phone', '$position', '$salary', '" . date("Y-m-d", strtotime($hire_date)) . "')";
        return $this->database->query($query);
    }

    /**
     * Tìm kiếm và trả về thông tin nhân viên theo ID
     *
     * @param int $id ID của nhân viên cần tìm
     * @return array Thông tin của nhân viên
     */
    public function findEmployeeById(int $id)
    {
        return $this->database->query("SELECT * FROM `employees` WHERE id = $id");
    }

    /**
     * Cập nhật thông tin nhân viên trong CSDL
     *
     * @param int    $id         ID của nhân viên
     * @param string $name       Tên nhân viên
     * @param string $email      Email của nhân viên
     * @param string $phone      Số diện thoại
     * @param string $position   Chức vụ
     * @param int    $salary     Lương
     * @param string $hire_date  Ngày ký Hợp Đồng
     *
     * @return mixed
     */
    public function updateEmployeeById(int $id, string $name, string $email, string $phone, string $position, int $salary, string $hire_date)
    {
        $query = "UPDATE employees SET
        name = '$name',
        email = '$email',
        phone = '$phone',
        position = '$position',
        salary = '$salary',
        hire_date = '" . date("Y-m-d", strtotime($hire_date))
            . "'" . "WHERE id = $id;";
        return $this->database->query($query);
    }

    /**
     * Tìm kiếm và trả về thông tin các nhân viên thỏa mãn điều kiện lọc
     *
     * @param string $id         ID của nhân viên
     * @param string $name       Tên của nhân viên
     * @param string $email      Email của nhân viên
     * @param string $phone      Số diện thoại
     * @param string $position   Chức vụ
     * @return array             Danh sách các nhân viên thỏa mãn điều kiện
     */
    public function filterEmployee(string $keyword)
    {
        $query = "SELECT * FROM `employees` WHERE id LIKE '%$keyword%' OR name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR position LIKE '%$keyword%'";
        return $this->database->query($query);
    }

    /**
     * Xóa thông tin nhân viên khỏi CSDL theo ID
     *
     * @param int $id ID của nhân viên cần xóa
     * @return mixed
     */
    public function deleteEmployeeById(int $id)
    {
        $query = "DELETE FROM `employees` WHERE id = $id";
        return $this->database->query($query);
    }

    /**
     * Trả về tổng số lượng nhân viên trong CSDL
     * @return int Tổng số lượng nhân viên
     */
    public function countAllEmployees(): int
    {
        return $this->database->query("SELECT COUNT(*) as total FROM `employees`")['total'];
    }
}
