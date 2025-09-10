<?php 
session_start();
require 'config.php';

$isLoggedIn = isset($_SESSION['user_id']);

// ดึงข้อมูลสินค้าทั้งหมดจากฐานข้อมูล
$stmt = $conn->query("SELECT p.*, c.category_name
FROM products p
LEFT JOIN categories c ON p.category_id = c.category_id
ORDER BY p.created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            background-color: #f8f9fa;
        }
        .product-card {
            transition: transform 0.2s ease;
        }
        .product-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header-bar {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }
    </style>
</head>
<body class="container mt-4">

    <div class="header-bar d-flex justify-content-between align-items-center">
        <h1 class="mb-0">🛒 หน้าหลักร้านค้า</h1>
        <div>
            <?php if ($isLoggedIn): ?>
                <span class="me-3">👋 ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']) ?> (<?= $_SESSION['role'] ?>)</span>
                <a href="profile.php" class="btn btn-info btn-sm">ข้อมูลส่วนตัว</a>
                <a href="cart.php" class="btn btn-warning btn-sm">ดูตะกร้า</a>
                <a href="logout.php" class="btn btn-secondary btn-sm">ออกจากระบบ</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-success btn-sm">เข้าสู่ระบบ</a>
                <a href="register.php" class="btn btn-primary btn-sm">สมัครสมาชิก</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- รายการสินค้า -->
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($product['category_name']) ?></h6>
                        <p class="card-text mb-2" style="flex-grow: 1;"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        <p><strong>ราคา:</strong> <?= number_format($product['price'], 2) ?> บาท</p>

                        <div class="mt-auto">
                            <?php if ($isLoggedIn): ?>
                                <form action="cart.php" method="post" class="d-inline">
                                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-sm btn-success">เพิ่มในตะกร้า</button>
                                </form>
                            <?php else: ?>
                                <small class="text-muted">เข้าสู่ระบบเพื่อสั่งซื้อ</small>
                            <?php endif; ?>
                            <a href="product_detail.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary float-end">ดูรายละเอียด</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
