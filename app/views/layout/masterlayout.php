<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Quản lý sinh viên' ?></title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f6f9;
        }

        /* Header */
        .header{
            background:#2563eb;
            color:white;
            padding:15px 40px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
        }

        .logo{
            font-size:22px;
            font-weight:bold;
        }

        .menu a{
            color:white;
            text-decoration:none;
            margin-left:20px;
            font-weight:500;
        }

        .menu a:hover{
            text-decoration:underline;
        }

        /* Content */
        .content{
            width:90%;
            max-width:1200px;
            margin:30px auto;
        }

        /* Card */
        .card{
            background:white;
            padding:25px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.08);
        }

        h1,h2,h3{
            margin-bottom:20px;
            color:#333;
        }

        /* Table */
        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        table th{
            background:#2563eb;
            color:white;
            padding:12px;
            text-align:left;
        }

        table td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        table tr:hover{
            background:#f5f5f5;
        }

        /* Button */
        .btn{
            display:inline-block;
            padding:10px 18px;
            border-radius:6px;
            text-decoration:none;
            color:white;
            border:none;
            cursor:pointer;
        }

        .btn-primary{
            background:#2563eb;
        }

        .btn-success{
            background:#16a34a;
        }

        .btn-danger{
            background:#dc2626;
        }

        .btn:hover{
            opacity:0.9;
        }

        /* Footer */
        .footer{
            text-align:center;
            padding:20px;
            margin-top:40px;
            color:#666;
        }
    </style>
</head>

<body>

<header class="header">
    <div class="logo">
        🎓 Quản Lý Sinh Viên
    </div>

    <div class="menu">
        <a href="/sinhvien/index">Danh sách sinh viên</a>
        <a href="/sinhvien/create">Thêm sinh viên</a>
    </div>
</header>

<div class="content">
    <div class="card">
        <?php require_once dirname(__DIR__) . '/' . $viewname . '.php'; ?>
    </div>
</div>

<footer class="footer">
    © <?= date('Y') ?> - Hệ thống quản lý sinh viên
</footer>

</body>
</html>