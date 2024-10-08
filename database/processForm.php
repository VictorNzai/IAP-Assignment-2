<?php
class processForm {
    public function signup($conn, $globalObj) {
        if (isset($_POST['submit'])) {
            // Input validation
            $username = $globalObj->escapeValues($_POST['username']);
            $email = $globalObj->escapeValues($_POST['email']);
            $password = $globalObj->escapeValues($_POST['password']);
            $phone = $globalObj->escapeValues($_POST['phone']);

            // Validate username (alphanumeric, min 3 chars)
            if (!preg_match('/^[a-zA-Z0-9]{3,}$/', $username)) {
                echo "Username must be at least 3 characters long and alphanumeric.";
                return;
            }

            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format.";
                return;
            }

            // Validate password (min 6 chars)
            if (strlen($password) < 6) {
                echo "Password must be at least 6 characters long.";
                return;
            }

            // Validate phone number (10 digits)
            if (!preg_match('/^[0-9]{10}$/', $phone)) {
                echo "Phone number must be 10 digits.";
                return;
            }

            // Hash the password before storing it
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare data for insertion
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword,
                'phone' => $phone
            ];

            // Insert into database
            if ($conn->insert('users', $data)) {
                echo "User registered successfully. A verification code has been sent to your email.";
                // Implement the 2FA process
                $this->sendVerificationCode($email);
            } else {
                echo "Failed to register user.";
            }
        }
    }

    private function sendVerificationCode($email) {
        // Generate a random verification code
        $verificationCode = rand(100000, 999999);
        
        // Save the verification code in session for later validation
        session_start();
        $_SESSION['verification_code'] = $verificationCode;

        // Send verification code to user's email
        $subject = "Your Verification Code";
        $message = "Your verification code is: $verificationCode";
        mail($email, $subject, $message); // Simple mail function (ensure your server is configured to send emails)

        // Redirect to verification page
        header("Location: verify.php");
        exit();
    }
}
?>
