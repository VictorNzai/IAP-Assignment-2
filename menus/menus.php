<?php
class menus {
    public function navMenu() {
        echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">';
        echo '<a class="navbar-brand" href="#">My Project</a>';
        echo '<div class="collapse navbar-collapse">';
        echo '<ul class="navbar-nav mr-auto">';
        echo '<li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>';
        echo '<li class="nav-item"><a class="nav-link" href="viewUsers.php">View Users</a></li>';
        echo '</ul></div></nav>';
    }
}
?>
