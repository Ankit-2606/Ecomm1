<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Ecomm1/utils/config.php';

// Handle form submission for updating discounts
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_discount'])) {
    $product_id = intval($_POST['product_id']);
    $discount = floatval($_POST['discount']);

    $query = "UPDATE products SET Discount = ? WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $discount, $product_id);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Discount updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to update discount.</div>";
    }

    $stmt->close();
}

// Fetch all products
$query = "SELECT Id, Name, Price, Discount FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Discounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Manage Product Discounts</h1>
    <table class="table table-bordered mt-4">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Current Discount (%)</th>
            <th>Update Discount</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['Id']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Price']; ?></td>
                <td><?php echo $row['Discount']; ?></td>
                <td>
                    <form method="POST" class="d-flex">
                        <input type="hidden" name="product_id" value="<?php echo $row['Id']; ?>">
                        <input type="number" name="discount" class="form-control me-2" step="0.01" min="0" max="100" required>
                        <button type="submit" name="update_discount" class="btn btn-primary">Update</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
