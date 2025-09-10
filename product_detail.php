<?php 
session_start(); 
require 'config.php';

if(!isset($_GET['id'])){
    header("Location: index.php");
    exit();
}

$isLoggedIn = isset($_SESSION['user_id']);
$product_id = $_GET['id'];

$stmt = $conn->prepare("SELECT p.*, c.category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.category_id
    WHERE p.product_id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// ถ้าไม่พบสินค้า
if (!$product) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>ไม่พบสินค้าที่คุณเลือก</div><a href='index.php' class='btn btn-primary'>กลับหน้าหลัก</a></div>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายละเอียดสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .card-title {
            font-size: 1.75rem;
        }
        .btn-back {
    display: inline-block; /* ให้ขนาดพอดีกับข้อความ */
    padding: 0.25rem 0.5rem; /* ลด padding ให้กระชับ */
    font-size: 1rem;
    margin-bottom: 20px;
    border-radius: 5px;
}

    </style>
</head>
<body class="container mt-5">

    <a href="index.php" class="btn btn-secondary btn-back">← กลับหน้ารายการสินค้า</a>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title"><?= htmlspecialchars($product['product_name']) ?></h3>
            <h6 class="text-muted mb-3">หมวดหมู่: <?= htmlspecialchars($product['category_name']) ?></h6>

            <p><strong>ราคา:</strong> <?= number_format($product['price'], 2) ?> บาท</p>
            <p><strong>คงเหลือ:</strong> <?= $product['stock'] ?> ชิ้น</p>

            <?php if ($isLoggedIn): ?>
                <form action="cart.php" method="post" class="row g-2 align-items-center mt-3">
                    <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">

                    <div class="col-auto">
                        <label for="quantity" class="col-form-label">จำนวน:</label>
                    </div>
                    <div class="col-auto">
                        <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" max="<?= $product['stock'] ?>" required>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">เพิ่มในตะกร้า</button>
                    </div>
                </form>
            <?php else: ?>
                <div class="alert alert-info mt-3">กรุณาเข้าสู่ระบบเพื่อสั่งซื้อสินค้า</div>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
