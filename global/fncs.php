<?php
class fncs {
    // Add this method if you intend to sanitize input data
    public function escapeValues($value) {
        return htmlspecialchars(strip_tags($value), ENT_QUOTES, 'UTF-8');
    }
}

?>


