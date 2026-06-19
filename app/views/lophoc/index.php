<h2>Danh sách lớp học</h2>

<a href="/lophoc/create">
    Thêm lớp học
</a>

<form method="GET">

    <input
        type="text"
        name="search"
        value="<?= $search ?>"
        placeholder="Tìm lớp học">

    <select name="sort">

        <option value="ma_lop"
        <?= $sort=='ma_lop'?'selected':'' ?>>
            Mã lớp
        </option>

        <option value="ten_lop"
        <?= $sort=='ten_lop'?'selected':'' ?>>
            Tên lớp
        </option>

    </select>

    <button type="submit">
        Tìm
    </button>

</form>

<table border="1">

<tr>
    <th>ID</th>
    <th>Mã lớp</th>
    <th>Tên lớp</th>
    <th>Thao tác</th>
</tr>

<?php foreach($lophocs as $lop): ?>

<tr>

    <td><?= $lop['id'] ?></td>

    <td><?= $lop['ma_lop'] ?></td>

    <td><?= $lop['ten_lop'] ?></td>

    <td>

        <a href="/lophoc/delete/<?= $lop['id'] ?>">
            Xóa
        </a>

    </td>

</tr>

<?php endforeach; ?>

</table>

<div>

<?php for($i=1;$i<=$totalPages;$i++): ?>

<a href="?page=<?= $i ?>
&search=<?= $search ?>
&sort=<?= $sort ?>">

<?= $i ?>

</a>

<?php endfor; ?>

</div>