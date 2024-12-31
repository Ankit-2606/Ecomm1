<?php
$con = mysqli_connect('localhost', 'root', '123456', 'ecomm');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Name = mysqli_real_escape_string($con, $_POST['name']);
    $Email = mysqli_real_escape_string($con, $_POST['email']);
    $Number = mysqli_real_escape_string($con, $_POST['number']);
    $Password = mysqli_real_escape_string($con, $_POST['password']);

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        header("Location: register.php?message=Invalid email format");
        exit;
    }

    if (!preg_match("/^[0-9]{10}$/", $Number)) {
        header("Location: register.php?message=Invalid phone number");
        exit;
    }

    $Dup_Email = mysqli_query($con, "SELECT * FROM tbluser WHERE Email = '$Email'");
    $Dup_Username = mysqli_query($con, "SELECT * FROM tbluser WHERE Username = '$Name'");

    if (mysqli_num_rows($Dup_Email) > 0) {
        header("Location: register.php?message=Email already exists");
    } elseif (mysqli_num_rows($Dup_Username) > 0) {
        header("Location: register.php?message=Username already exists");
    } else {
        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $query = "INSERT INTO tbluser (Username, Email, Number, Password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $Name, $Email, $Number, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            session_start();
            $_SESSION['username'] = $Name;
            $_SESSION['email'] = $Email;
            $_SESSION['registration_success'] = true; 


            header("Location: home.php?message=Registration successful");
        } else {
            header("Location: register.php?message=Error in registration");
        }
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($con);
?>
