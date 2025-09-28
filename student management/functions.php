<?php
function uploadfile($file) {
    // Check if the uploads directory exists, if not, create it
    if (!is_dir('uploads')) {
        mkdir('uploads', 0755, true);
    }

    // Attempt to move the uploaded file to the uploads directory
    if (move_uploaded_file($file["tmp_name"], "uploads/" . $file["name"])) {
        return "uploads/" . $file["name"];
    } else {
        // Return an error message if the file upload fails
        return "Error uploading file.";
    }
}

function validateInput($input, $pattern, $input_type) {
    if ($input_type == 'preg') {
        // Ensure the pattern has delimiters
        if (strpos($pattern, '/') === false) {
            $pattern = '/' . $pattern . '/';
        }
        return (isset($input) && preg_match($pattern, $input));
    } elseif ($input_type == 'email') {
        return (isset($input) && filter_var($input, FILTER_VALIDATE_EMAIL));
    } elseif ($input_type == 'url') {
        return (isset($input) && filter_var($input, FILTER_VALIDATE_URL));
    } elseif ($input_type == 'int') {
        return (isset($input) && filter_var($input, FILTER_VALIDATE_INT));
    } elseif ($input_type == 'file') {
        // Check if the file input is set and has no errors
        if (isset($input) && $input['error'] == 0) {
            // Validate the file extension
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            $file_extension = strtolower(pathinfo($input['name'], PATHINFO_EXTENSION));
            return in_array($file_extension, $allowed_extensions);
        }
        return false;
    } else {
        return false;
    }
}
?>
