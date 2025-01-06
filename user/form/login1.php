<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['password'])) {
        $Name = $_POST['name'];
        $Password = $_POST['password'];

        // Create database connection
        $con = new mysqli('localhost', 'root', '123456', 'ecomm');
        if ($con->connect_error) {
            die("Database connection failed: " . $con->connect_error);
        }

        // Prepare the SQL query to prevent SQL injection
        $stmt = $con->prepare("SELECT * FROM `tbluser` WHERE Username = ? OR Email = ?");
        $stmt->bind_param("ss", $Name, $Name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($Password, $user['Password'])) {
                $_SESSION['user_id'] = $user['Id']; // Store user_id in session
                $_SESSION['username'] = $user['Username'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['login_success'] = true;
            
                // Redirect to the intended page or default to products.php
                $redirectTo = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : '/Ecomm1/user/products.php';
                unset($_SESSION['redirect_to']); // Clear the redirect session variable
                header("Location: $redirectTo");
                exit();
            } else {
                $_SESSION['login_error'] = 'Incorrect password.';
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['login_error'] = 'Username or email not found.';
            header("Location: login.php");
            exit();
        }

        // Close the prepared statement and connection
        $stmt->close();
        $con->close();
    } else {
        $_SESSION['login_error'] = 'Please fill in both username and password.';
        header("Location: login.php");
        exit();
    }
}
?>
