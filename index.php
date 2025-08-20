<?php 
session_start(); // เริ่มต้น session เพื่อจัดการการเข้าสู่ระบบ

// ตรวจสอบว่าเข้าสู่ระบบหรือยัง
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // ถ้าไม่ login ให้กลับไปหน้า login
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
     <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5); /* ไล่สีพื้นหลัง */
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Prompt", sans-serif;
        }
        .card {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-primary {
            background: #4e73df;
            border: none;
        }
        .btn-primary:hover {
            background: #2e59d9;
        }
    </style>
</head>
<body style="background:#f5f6fa; min-height:100vh;background-color:#4e73df;">

    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="card shadow-lg p-4 text-center" style="max-width: 500px; width:100%;">
            <h1 class="mb-4">ยินดีต้อนรับสู่หน้าหลัก</h1>
            
            <p>
                ผู้ใช้: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> 
                (<?= htmlspecialchars($_SESSION['role']) ?>)
            </p>

            <div class="mt-3">
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </div>
        </div>
    </div>

</body>
</html>
