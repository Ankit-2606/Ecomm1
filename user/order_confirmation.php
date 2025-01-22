<?php
session_start();
include '../utils/config.php';

if (!isset($_GET['order_id'])) {
    die("Invalid request.");
}

$orderId = intval($_GET['order_id']);

// Fetch order details
$orderQuery = "SELECT * FROM orders WHERE Id = ?";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$orderResult = $stmt->get_result();
$order = $orderResult->fetch_assoc();

// Fetch order items
$orderItemsQuery = "SELECT oi.*, p.Name 
                    FROM order_items oi 
                    JOIN products p ON oi.Product_Id = p.Id 
                    WHERE oi.Order_Id = ?";
$stmt = $conn->prepare($orderItemsQuery);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$orderItems = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Order Confirmation</h1>
        <div class="card mt-3">
            <div class="card-body">
                <h4>Order Details</h4>
                <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['Id']); ?></p>
                <p><strong>Total Amount:</strong> $<?php echo htmlspecialchars($order['Total_Amount']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($order['Order_Status']); ?></p>
                <p><strong>Placed On:</strong> <?php echo htmlspecialchars($order['Created_At']); ?></p>
            </div>
        </div>
        <h4 class="mt-4">Items</h4>
        <ul class="list-group">
            <?php while ($item = $orderItems->fetch_assoc()) { ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($item['Name']); ?></strong>
                    <span class="badge bg-primary"><?php echo htmlspecialchars($item['Quantity']); ?> x $<?php echo htmlspecialchars($item['Price']); ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
