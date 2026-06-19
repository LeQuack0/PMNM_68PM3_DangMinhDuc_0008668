<?php

require_once '../app/core/controller.php';

class lophocController extends Controller
{
   
    public function create()
    {
        $this->view('lophoc/create');
    }

    public function store()
    {
        $model = $this->model('lophocModel');

        $model->create([
            'ma_lop'=>$_POST['ma_lop'],
            'ten_lop'=>$_POST['ten_lop']
        ]);

        header('Location: /lophoc/index');
    }

    public function delete($id)
    {
        $model = $this->model('lophocModel');

        $model->delete($id);

        header('Location: /lophoc/index');
    }

    public function update($id)
    {
        $model = $this->model('lophocModel');

        $model->update($id,[
            'ma_lop'=>$_POST['ma_lop'],
            'ten_lop'=>$_POST['ten_lop']
        ]);

        header('Location: /lophoc/index');
    }
    public function index()
{
    $limit = 5;

    $page = isset($_GET['page'])
        ? (int)$_GET['page']
        : 1;

    $offset = ($page - 1) * $limit;

    $search = $_GET['search'] ?? '';

    $sort = $_GET['sort'] ?? 'ma_lop';

    $allowSort = [
        'ma_lop',
        'ten_lop'
    ];

    if (!in_array($sort, $allowSort))
    {
        $sort = 'ma_lop';
    }

    $model = $this->model('lophocModel');

    $result = $model->paging(
        $limit,
        $offset,
        $search,
        $sort
    );

    $this->view(
        'layout/masterlayout',
        [
            'viewname' => 'lophoc/index',
            'lophocs' => $result['lophocs'],
            'totalPages' => $result['totalPages'],
            'currentPage' => $page,
            'search' => $search,
            'sort' => $sort
        ]
    );
}
}