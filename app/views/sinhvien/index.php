<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Danh sách sinh viên' ?></title>

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Segoe UI', Tahoma;
            background: linear-gradient(135deg,#f5f7fa,#c3cfe2);
            padding: 30px;
        }

        h1 {
            text-align:center;
            margin-bottom:20px;
            color:#2c3e50;
        }

        table {
            width:100%;
            max-width:1200px;
            margin:auto;
            border-collapse:collapse;
            background:#fff;
            border-radius:12px;
            overflow:hidden;
        }

        th {
            background:#3498db;
            color:#fff;
            padding:12px;
        }

        td {
            padding:12px;
            border-bottom:1px solid #eee;
        }

        tr:nth-child(even){ background:#f8f9fa; }

        .btn {
            padding:6px 10px;
            border-radius:6px;
            color:white;
            text-decoration:none;
            font-size:13px;
        }

        .edit { background:#f39c12; }
        .delete { background:#e74c3c; }

        .pagination {
            text-align:center;
            margin-top:20px;
        }

        .pagination a {
            padding:8px 12px;
            margin:2px;
            text-decoration:none;
            background:#ddd;
            border-radius:5px;
            color:black;
        }

        .pagination a.active {
            background:red;
            color:white;
        }

        input {
            padding:6px;
        }
    </style>
</head>

<body>

<h1>Danh sách sinh viên</h1>

<table>
<thead>
<tr>
    <th>STT</th>
    <th>Mã SV</th>
    <th>Họ tên</th>
    <th>Giới tính</th>
    <th>Ngày sinh</th>
    <th>Địa chỉ</th>
    <th>Lớp</th>
    <th>Thao tác</th>
</tr>
</thead>

<tbody>

<?php foreach ($sinhviens as $index => $sv): ?>
<tr>

    <td><?= ($currentPage - 1) * 5 + $index + 1 ?></td>

    <td><?= htmlspecialchars($sv['ma_sv']) ?></td>
    <td><?= htmlspecialchars($sv['ho_ten']) ?></td>
    <td><?= htmlspecialchars($sv['gioi_tinh']) ?></td>
    <td><?= htmlspecialchars($sv['ngay_sinh']) ?></td>
    <td><?= htmlspecialchars($sv['dia_chi']) ?></td>
    <td><?= htmlspecialchars($sv['lop']) ?></td>

    <td>
        <a class="btn edit"
           href="/sinhvien/index?page=<?= $currentPage ?>&edit=<?= $sv['id'] ?>">
            Sửa
        </a>

        <a class="btn delete"
           href="/sinhvien/delete/<?= $sv['id'] ?>"
           onclick="return confirm('Xóa sinh viên?')">
            Xóa
        </a>
    </td>
</tr>

<!-- INLINE EDIT -->
<?php if (isset($_GET['edit']) && $_GET['edit'] == $sv['id']): ?>
<tr>
<td colspan="8">

<form method="post"
      action="/sinhvien/update/<?= $sv['id'] ?>"
      style="display:flex; gap:10px; flex-wrap:wrap;">

    <input name="ma_sv" value="<?= $sv['ma_sv'] ?>" required>
    <input name="ho_ten" value="<?= $sv['ho_ten'] ?>" required>
    <input name="gioi_tinh" value="<?= $sv['gioi_tinh'] ?>" required>
    <input type="date" name="ngay_sinh" value="<?= $sv['ngay_sinh'] ?>" required>
    <input name="dia_chi" value="<?= $sv['dia_chi'] ?>">
    <input name="lop" value="<?= $sv['lop'] ?>" required>

    <button type="submit" style="background:#2ecc71;color:white;padding:6px 10px;border:none;">
        Lưu
    </button>

    <a href="/sinhvien/index?page=<?= $currentPage ?>"
       style="background:#95a5a6;color:white;padding:6px 10px;text-decoration:none;">
        Hủy
    </a>

</form>

</td>
</tr>
<?php endif; ?>

<?php endforeach; ?>

</tbody>
</table>

<!-- PAGINATION -->
<div class="pagination">

<?php if ($currentPage > 1): ?>
    <a href="/sinhvien/index?page=<?= $currentPage - 1 ?>">⬅</a>
<?php endif; ?>

<?php for ($i = 1; $i <= $totalPages; $i++): ?>
    <a class="<?= ($i == $currentPage) ? 'active' : '' ?>"
       href="/sinhvien/index?page=<?= $i ?>">
        <?= $i ?>
    </a>
<?php endfor; ?>

<?php if ($currentPage < $totalPages): ?>
    <a href="/sinhvien/index?page=<?= $currentPage + 1 ?>">➡</a>
<?php endif; ?>

</div>

</body>
</html>