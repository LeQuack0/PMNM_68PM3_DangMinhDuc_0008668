<?php

require_once '../app/core/controller.php';

class sinhvien extends Controller
{
    public function index()
    {
        $limit = 5;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;
        $search = $_GET['search'] ?? '';

        $model = $this->model('sinhvienModel');
        $result = $model->paging($limit, $offset, $search);

        $this->view("layout/masterlayout", [
            'viewname' => 'sinhvien/index',
            'sinhviens' => $result['sinhviens'],
            'totalPages' => $result['totalPages'],
            'currentPage' => $page,
            'search' => $search
        ]);
    }

    public function create()
    {
        $this->view('sinhvien/create', [
            'title' => 'Thêm sinh viên'
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'ma_sv'     => $_POST['ma_sv'] ?? null,
                'ho_ten'    => $_POST['ho_ten'] ?? null,
                'gioi_tinh' => $_POST['gioi_tinh'] ?? null,
                'ngay_sinh' => $_POST['ngay_sinh'] ?? null,
                'dia_chi'   => $_POST['dia_chi'] ?? null,
                'lop'       => $_POST['lop'] ?? null
            ];

            if (empty($data['ho_ten'])) {
                $_SESSION['error'] = "Họ tên không được để trống!";
                header('Location: /sinhvien/create');
                exit();
            }

            $model = $this->model('sinhvienModel');
            $result = $model->create($data);

            if ($result) {
                $_SESSION['success'] = 'Thêm sinh viên thành công!';
                header('Location: /sinhvien/index');
                exit();
            }

            $_SESSION['error'] = 'Thêm sinh viên thất bại!';
            header('Location: /sinhvien/create');
            exit();
        }
    }

    public function delete($id)
    {
        $model = $this->model('sinhvienModel');
        $result = $model->delete($id);

        $_SESSION[$result ? 'success' : 'error'] =
            $result ? 'Xóa thành công!' : 'Xóa thất bại!';

        header('Location: /sinhvien/index');
        exit();
    }

    // 👉 sửa trực tiếp trong danh sách (KHÔNG cần view edit riêng)
    public function edit($id)
    {
        $model = $this->model('sinhvienModel');
        $sinhvien = $model->edit($id);

        if (!$sinhvien) {
            $_SESSION['error'] = 'Không tìm thấy sinh viên!';
            header('Location: /sinhvien/index');
            exit();
        }

        // update ngay từ index (nếu bạn muốn làm inline form)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'ma_sv'     => $_POST['ma_sv'],
                'ho_ten'    => $_POST['ho_ten'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'ngay_sinh' => $_POST['ngay_sinh'],
                'dia_chi'   => $_POST['dia_chi'],
                'lop'       => $_POST['lop']
            ];

            $model->update($id, $data);

            $_SESSION['success'] = "Cập nhật thành công!";
            header('Location: /sinhvien/index');
            exit();
        }

        header('Location: /sinhvien/index');
        exit();
    }
}