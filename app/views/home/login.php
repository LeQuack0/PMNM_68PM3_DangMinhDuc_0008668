<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>

    <h1>Đăng nhập</h1>

    <form action="/auth/login" method="post">

        <label>Tên đăng nhập</label>
        <input type="text" name="username">

        <br><br>

        <label>Mật khẩu</label>
        <input type="password" name="password">

        <br><br>

        <button type="submit">Đăng nhập</button>

    </form>

</body>
</html>