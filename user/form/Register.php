<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php include '../header.php'; ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 m-auto bg-white shadow border border-info p-4">
                <h3 class="text-info text-center fw-bold mb-4">User Register</h3>
                <form id="registerForm" action="insert.php" method="POST" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="name" placeholder="Enter Name" required>
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        <div class="valid-feedback">Valid email!</div>
                        <div class="invalid-feedback" id="emailFeedback">Please enter a valid email address.</div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="number" placeholder="Enter Number" required>
                        <div class="valid-feedback">Valid number!</div>
                        <div class="invalid-feedback" id="phoneFeedback">Please enter a valid 10-digit phone number starting with 9.</div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required minlength="8"
                            pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                        <div class="valid-feedback">Password looks good!</div>
                        <div class="invalid-feedback">
                            Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
                        <div class="invalid-feedback">Passwords do not match.</div>
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="terms" required>
                        <label class="form-check-label" for="terms">Agree to terms and conditions</label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-info w-100" type="submit">Register</button>
                    </div>

                    <div class="mb-3">
                        <a href="login.php" class="btn btn-info w-100">Already Registered</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="responseModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="responseMessage"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("registerForm");
            const password = document.getElementById("password");
            const confirmPassword = document.getElementById("confirmPassword");
            const phoneInput = document.getElementById("phone");

            // Form submission validation
            form.addEventListener("submit", (e) => {
                // Bootstrap built-in validation for empty fields
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                form.classList.add("was-validated");

                // Custom validation after Bootstrap checks for specific fields

                // Password confirmation validation
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity("Passwords do not match");
                } else {
                    confirmPassword.setCustomValidity("");
                }
                const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                if (!passwordPattern.test(password.value)) {
                    password.setCustomValidity("Password must be at least 8 characters long, contain an uppercase letter, a lowercase letter, a number, and a special character.");
                } else {
                    password.setCustomValidity("");
                }
                // Phone number validation: starts with 9, and is exactly 10 digits
                const phonePattern = /^9\d{9}$/;
                if (!phonePattern.test(phoneInput.value)) {
                    phoneInput.setCustomValidity("Please enter a valid 10-digit phone number starting with 9.");
                } else {
                    phoneInput.setCustomValidity("");
                }

                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(emailInput.value)) {
                    emailInput.setCustomValidity("Please enter a valid email address.");
                } else {
                    emailInput.setCustomValidity("");
                }

            });

            // Show modal message if any
            <?php if (isset($_GET['message'])): ?>
                const modal = new bootstrap.Modal(document.getElementById("responseModal"));
                document.getElementById("responseMessage").innerText = "<?php echo $_GET['message']; ?>";
                modal.show();
            <?php endif; ?>
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>