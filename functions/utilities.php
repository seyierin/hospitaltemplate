<?php 
    class Utilities {
        // function to sanitize input data
        function sanitizeInput($data) {
            return htmlspecialchars(strip_tags(trim($data)));
        }

        function message($message, $type = 'success') {
            if($type == "error") $type = "danger";
            return "<div class='alert alert-{$type}'>{$message}</div>";
        }
    }