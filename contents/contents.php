<?php
class contents {
    public function signUpForm($globalObj) {
        // Navbar with different color scheme
        echo '
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #4CAF50;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MyApp</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="signup.php">Signup</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">See Users</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>';

        // Signup form with different color scheme for button
        echo '<div class="container mt-5">';
        echo '<h2>Signup Form</h2>';
        echo '<form action="" method="POST">';
        echo '<div class="mb-3">';
        echo '<label for="username" class="form-label">Username</label>';
        echo '<input type="text" name="username" class="form-control" required>';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="email" class="form-label">Email</label>';
        echo '<input type="email" name="email" class="form-control" required>';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="password" class="form-label">Password</label>';
        echo '<input type="password" name="password" class="form-control" required>';
        echo '</div>';
        echo '<div class="mb-3">';
        echo '<label for="phone" class="form-label">Phone Number</label>';
        echo '<input type="text" name="phone" class="form-control" required>';
        echo '</div>';
        echo '<button type="submit" name="submit" class="btn" style="background-color: #FF5722; color: white;">Signup</button>';
        echo '</form></div>';
    }
}
?>
