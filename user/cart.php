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

        <!-- Back to Shop Button -->
        <div class="mb-3 text-center">
            <a href="products.php" class="btn btn-primary">Back to Shop</a>
        </div>

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
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $item['Cart_Id']; ?>)">Remove</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-center">Your cart is empty.</p>
        <?php } ?>
    </div>

    <!-- Success Message Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Removal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this product from your cart?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="remove_from_cart.php" method="POST">
                        <input type="hidden" name="cart_id" id="cartIdToRemove">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');

            if (status) {
                let message = '';
                if (status === 'updated') {
                    message = 'Cart updated successfully!';
                } else if (status === 'removed') {
                    message = 'Product removed from the cart!';
                }

                if (message) {
                    document.getElementById('modalMessage').textContent = message;
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                }
            }
        });

        function confirmDelete(cartId) {
            document.getElementById('cartIdToRemove').value = cartId;
            const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmDeleteModal.show();
        }
    </script>
</body>
</html>
