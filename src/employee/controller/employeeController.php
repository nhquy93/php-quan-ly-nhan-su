<?php
namespace Employee;
use Engine\Base;

class EmployeeController extends Base
{
    /**
     * Xử lý trang index. Hiển thị tất cả nhân viên theo phân trang.
     * Nếu phương thức yêu cầu là POST, nó sẽ xóa nhân viên có id đã cho.
     * Nếu phương thức yêu cầu là GET, nó sẽ lọc các nhân viên theo từ khóa đã cho.
     * Thêm tệp "Notify.js" vào trang.
     */
    public function index(): void
    {
        $employee_model = new EmployeeModel();
        $data = array();

        $limit = 10; // Số sản phẩm trên mỗi trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Tìm tổng số nhân viên
        $totalEmployees = $employee_model->countAllEmployees();
        // Tính số trang
        $totalPages = ceil($totalEmployees / $limit);

        // Gán số trang vào mảng $data["totalPages"]
        $data["totalPages"] = $totalPages;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];

            try {
                $employee_model->deleteEmployeeById($id);

                $_SESSION['message'] = "Xóa thành công.";
            } catch (\Exception $e) {
                $_SESSION['error'] = "Đã xảy ra lỗi: " . $e->getMessage();
            }

            // Redirect về này trang chủ
            header("Location: /");
            exit;
        }

        // Nếu phương thức hiện tại là GET => thực hiện lọc dữ liệu nhân viên
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            if (!empty($keyword)) {
                $result = $employee_model->filterEmployee($keyword);
                /**
                 * Dòng mã phía dưới đang gán giá trị cho mảng $data["employees"].
                 * Nếu biến $result rỗng, nó sẽ gán một mảng rỗng cho $data["employees"].
                 * Nếu biến $result không rỗng, nó sẽ kiểm tra xem phần tử đầu tiên của $result có tồn tại hay không?
                 * Nếu có, nó sẽ gán $result cho $data["employees"].
                 * Nếu không, nó sẽ bọc $result trong một mảng và gán mảng đó cho $data["employees"]
                 */
                $data["employees"] = empty($result) ? array() : (isset($result[0]) ? $result : array($result));
            } else {
                // Nếu $keyword rỗng, trả lại danh sách nhân viên
                $employees = $employee_model->getAllEmployees($limit, $offset);
                // Tương tự như với $result, dòng này gán $employees cho $data["employees"]
                $data["employees"] = empty($employees) ? array() : (isset($employees[0]) ? $employees : array($employees));
            }
        }

        /**
         * Thêm tệp JavaScript "Notify.js" vào.
         */
        $this->output->addJs("js/Notify");
        $this->output->load("employee/listEmployee", $data);
    }

    /**
     * Function dùng để thêm hoặc sửa thông tin nhân viên
     *
     * Nếu có $id => Sửa dữ liệu nhân viên
     * Nếu không có $id => Thêm dữ liệu nhân viên
     *
     * @return void
     */
    public function createOrUpdateEmployee(): void
    {
        $data = array();
        $employee_model = new EmployeeModel();

        // Nếu phương thức hiện tại là POST => thực hiện thêm hoặc sửa dữ liệu
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_GET['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $position = $_POST['position'];
            $salary = $_POST['salary'];
            $hire_date = $_POST['hire_date'];

            // Kiểm tra xem có truyền id không?
            if ($id) {
                // Sửa dữ liệu nhân viên mới bằng function updateEmployeeById() đã tạo trong Model
                try {
                    $employee_model->updateEmployeeById(
                        $id,
                        $name,
                        $email,
                        $phone,
                        $position,
                        $salary,
                        $hire_date
                    );

                    $_SESSION['message'] = "Cập nhật thành công.";
                } catch (\Exception $e) {
                    $this->console->addError("Error during update: " . $e->getMessage());
                    $_SESSION['error'] = "Có lỗi xảy ra trong quá trình cập nhật!";
                }
            } else {
                // Thêm dữ liệu nhân viên mới bằng function create() đã tạo trong Model
                try {
                    $employee_model->create(
                        $name,
                        $email,
                        $phone,
                        $position,
                        $salary,
                        $hire_date
                    );

                    $_SESSION['message'] = "Thêm thành công.";
                } catch (\Exception $e) {
                    $this->console->addError("Error during create: " . $e->getMessage());
                    $_SESSION['error'] = "Có lỗi xảy ra trong quá trình thêm!";
                }
            }

            // Redirect về lại trang chủ
            header("Location: /trang-chu");
        } else {
            // Lấy dữ liệu nhân viên nếu có $id
            if ($_GET['id']) {
                $data['employee'] = $employee_model->findEmployeeById($_GET['id']);
            }
        }

        // Load trang thêm hoặc sửa nhân viên
        $this->output->load("employee/createOrUpdateEmployee", $data);
    }

    /**
     * Hiển thị trang thống kê các chức vụ
     */
    public function chartPage(): void
    {
        $labels = array();
        $sizes = array();

        $employee_model = new EmployeeModel();
        $result = $employee_model->getPositionForChart();
        foreach ($result as $row) {
            $labels[] = $row['position'];
            $sizes[] = $row['total'];
        }

        // Dữ liệu cho biểu đồ
        $data = [
            'labels' => $labels,
            'datasets' => [
                [
                    'data' => $sizes,
                    // Mẫu màu cho từng phần tử biểu đồ, có thể thay bằng mẫu màu khác
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40'
                    ],
                ]
            ]
        ];
        $this->output->load("employee/chart", $data);
    }
}
