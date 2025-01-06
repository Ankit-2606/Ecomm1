<?php
session_start();
include '../utils/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../user/login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch cart items
$query = "SELECT c.Id AS Cart_Id, p.Name, p.Price, c.Quantity 
          FROM cart c 
          JOIN products p ON c.Product_Id = p.Id 
          WHERE c.User_Id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Your Cart</h1>
        <?php if (!empty($cartItems)) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['Name']); ?></td>
                            <td>$<?php echo number_format($item['Price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($item['Quantity']); ?></td>
                            <td>$<?php echo number_format($item['Price'] * $item['Quantity'], 2); ?></td>
                            <td>
                                <form action="update_cart.php" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['Cart_Id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['Quantity']; ?>" min="1">
                                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                                </form>
                                <form action="remove_from_cart.php" method="POST" style="display: inline-block;">
                                    <input type="hidden" name="cart_id" value="<?php echo $item['Cart_Id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-center">Your cart is empty.</p>
        <?php } ?>
    </div>
</body>
</html>
