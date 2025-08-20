<?php
session_start(); // เริ่มต ้น session เพอื่ จัดกำรกำรเขำ้สรู่ ะบบ
session_unset(); // ล้ำงค่ำใน session
session_destroy(); // ท ำลำย session ทั้งหมด
header("Location: login.php"); // เปลยี่ นเสน้ ทำงไปยังหนำ้ login.php
exit; // หยดุ กำรท ำงำนของสครปิ ตธ์ ลังจำกเปลยี่ นเสน้ ทำง
?>
✅ index.php – แสดงรายการสินค้าสำหรับผู้ใช้ที่เข้าสู่ระบบแล้ว
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<body>
    
</body>
</html>