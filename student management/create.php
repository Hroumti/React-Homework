<?php
include('db.php');
include('functions.php');

$errors = [];
$name = $email = $github = $branch = $gender = $hobbies = $image = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate name
    if (!validateInput($_POST['name'], '/^[a-zA-Z ]+$/', 'preg')) {
        $errors["name"] = "Invalid name format.";
    } else {
        $name = trim($_POST['name']);
    }

    // Validate email
    if (!validateInput($_POST['email'], '', 'email')) {
        $errors["email"] = "Invalid email format.";
    } else {
        $email = trim($_POST['email']);
    }

    // Validate GitHub URL
    if (!validateInput($_POST['github'], '', 'url')) {
        $errors["github"] = "Invalid URL format.";
    } else {
        $github = trim($_POST['github']);
    }

    // Validate branch
    if (!validateInput($_POST['branch'], '', 'preg')) {
        $errors["branch"] = "Invalid branch format.";
    } else {
        $branch = trim($_POST['branch']);
    }

    // Validate gender
    if (!validateInput($_POST['gender'], '/^(Male|Female)$/', 'preg')) {
        $errors['gender'] = 'Invalid gender format.';
    } else {
        $gender = trim($_POST['gender']);
    }

    // Validate hobbies
    if (!isset($_POST['hobbies']) || empty($_POST['hobbies'])) {
        $errors['hobbies'] = 'Please select at least one hobby.';
    } else {
        // Ensure hobbies is an array
        if (is_array($_POST['hobbies'])) {
            $hobbies = implode(', ', $_POST['hobbies']);
        } else {
            $hobbies = $_POST['hobbies'];
        }
    }

    // Check if the 'image' key exists in the $_FILES array
    if (isset($_FILES['image']) && !validateInput($_FILES['image'], '', 'file')) {
        $errors['image'] = 'Invalid image format.';
    } elseif (isset($_FILES['image'])) {
        $image = uploadfile($_FILES['image']);
    }

    if (empty($errors)) {
        
        $query = "INSERT INTO students2 (name, email, github, branch, gender, hobbies, image) VALUES ('$name', '$email', '$github', '$branch', '$gender', '$hobbies', '$image')";
        mysqli_query($conn, $query);

        
        header('Location: index.php');
            
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #333;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: auto;
    }

    input[type="text"],
    input[type="email"],
    input[type="file"],
    select {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
    }

    button {
        background-color: #007BFF;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .alert {
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .alert p {
        margin: 0;
    }
    nav {
        background-color: #007BFF;
        padding: 10px 0;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    nav ul li {
        margin: 0 15px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    nav ul li a:hover {
        background-color: #0056b3;
    }


</style>

</head>
<body>
    <?php include('navbar.php'); ?>
    <h1>Add</h1>
    <?php
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="github" placeholder="Github" required>
        <select name="branch" required>
            <option value="">Select Branch</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
            <!-- Add more branches as needed -->
        </select>
        <input type="radio" name="gender" value="Male" required>Male
        <input type="radio" name="gender" value="Female" required>Female
        <label>Hobbies:</label>
        <input type="checkbox" name="hobbies[]" value="Reading">Reading
        <input type="checkbox" name="hobbies[]" value="Traveling">Traveling
        <input type="checkbox" name="hobbies[]" value="Gaming">Gaming
        <input type="checkbox" name="hobbies[]" value="Cooking">Cooking
        <input type="checkbox" name="hobbies[]" value="Sports">Sports
        <input type="checkbox" name="hobbies[]" value="Music">Music
        <input type="checkbox" name="hobbies[]" value="Art">Art
        <input type="checkbox" name="hobbies[]" value="Photography">Photography
        <!-- Add more hobbies as needed -->
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/gif">
        <button type="submit" name="submit">Add</button>
    </form>
</body>
</html>
