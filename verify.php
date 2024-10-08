<?php
session_start();
if (!isset($_SESSION['verification_code'])) {
    die("No verification code found. Please register first.");
}

if (isset($_POST['verify'])) {
    $inputCode = $_POST['verification_code'];

    // Check if the input code matches the generated code
    if ($inputCode == $_SESSION['verification_code']) {
        echo "Verification successful! You can now log in.";
        // Clear the verification code from the session
        unset($_SESSION['verification_code']);
        // Optionally, redirect to the login page
        header("Location: login.php");
        exit();
    } else {
        echo "Invalid verification code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Verify Your Account</title>
</head>
<body>
    <div class="container mt-5">
        <h2>Enter Verification Code</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="verification_code">Verification Code</label>
                <input type="text" name="verification_code" class="form-control" required>
            </div>
            <button type="submit" name="verify" class="btn btn-primary">Verify</button>
        </form>
    </div>
</body>
</html>
