<?php
session_start(); // Start the session to use session variables
require_once 'config.php'; 

$error = ""; 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $usernameOrEmail = trim($_POST['username_or_email']);
    $password = $_POST['password'];




    // เอาค่าที่รับมาจากฟอร์มมาตรวจสอบว่าตรงกับใน db หรือไม่ 
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

       

    if($user && password_verify($password, $user['password'])) {

     $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

        if($user['role'] === 'admin') {
            header("Location: index.php");
        } else {
            header("Location: index.php");
        }
        exit(); // หยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
    }else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

<body>
<?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
    <div class="alert alert-success text-center position-absolute top-0 start-50 translate-middle-x mt-3" 
         style="max-width: 400px; z-index: 999;">
        สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ
    </div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%;">
        <h3 class="text-center mb-4">เข้าสู่ระบบ</h3>
        
        <form method="post">
            <div class="mb-3">
                <label for="username_or_email" class="form-label">ชื่อผู้ใช้ หรือ อีเมล</label>
                <input type="text" name="username_or_email" id="username_or_email" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">รหัสผ่าน</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">เข้าสู่ระบบ</button>
                <a href="register.php" class="btn btn-outline-secondary">สมัครสมาชิก</a>
            </div>
        </form>
    </div>
</div>



 <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
</body>
</html>