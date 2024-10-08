<?php
class fncs {
    public function sanitizeInput($data) {
        return htmlspecialchars(strip_tags($data));
    }
}
?>
