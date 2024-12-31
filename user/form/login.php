<?php
session_start();
$loginError = '';
if (isset($_SESSION['login_error'])) {
    $loginError = $_SESSION['login_error'];
    unset($_SESSION['login_error']); // Clear the error after showing the modal
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../header.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 m-auto bg-white shadow font-monospace border border-info">
                <p class="text-info text-center fs-3 fw-bold my-3">User LOGIN</p>
                <form action="login1.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="name" class="form-label">UserName</label>
                        <input type="text" name="name" id="name" placeholder="Enter UserName" class="form-control" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">UserPassword</label>
                        <input type="password" name="password" id="password" placeholder="Enter Password" class="form-control" required>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <div class="mb-3">
                        <button name="submit" class="w-100 bg-info fs-4 text-white btn btn-info" type="submit">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Login Error -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="errorModalLabel">Login Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo htmlspecialchars($loginError); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show the error modal if there is a login error
        <?php if (!empty($loginError)) { ?>
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
        <?php } ?>

        // Bootstrap Validation Script
        (function () {
            'use strict';
            // Fetch all the forms we want to apply custom Bootstrap validation to
            var forms = document.querySelectorAll('.needs-validation');
            
            // Loop over them and prevent submission if invalid
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>

</html>
