<?php
include 'db.php';
include 'functions.php';

$id = $_GET['id'] ?? null;
$errors = [];
$name = $email = $github = $branch = $gender = $hobbies = $image = '';

if (!$id) {
    header('Location: index.php');
    exit;
}

// Fetch the student data
$result = mysqli_query($conn, "SELECT * FROM students2 WHERE id = $id");
if (mysqli_num_rows($result) === 0) {
    header('Location: index.php');
    exit;
}

$row = mysqli_fetch_assoc($result);
$name = htmlspecialchars($row['name']);
$email = htmlspecialchars($row['email']);
$github = htmlspecialchars($row['github']);
$branch = htmlspecialchars($row['branch']);
$gender = htmlspecialchars($row['gender']);
$hobbies = explode(', ', $row['hobbies']);
$image = htmlspecialchars($row['image']);

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
        $hobbies = implode(', ', $_POST['hobbies']);
    }

    // Check if the 'image' key exists in the $_FILES array
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (!validateInput($_FILES['image'], '', 'file')) {
            $errors['image'] = 'Invalid image format.';
        } else {
            $image = uploadfile($_FILES['image']);
        }
    }

    if (empty($errors)) {
        // Sanitize inputs to prevent SQL injection
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $github = mysqli_real_escape_string($conn, $github);
        $branch = mysqli_real_escape_string($conn, $branch);
        $gender = mysqli_real_escape_string($conn, $gender);
        $hobbies = mysqli_real_escape_string($conn, $hobbies);
        $image = mysqli_real_escape_string($conn, $image);

        $query = "UPDATE students2 SET name='$name', email='$email', github='$github', branch='$branch', gender='$gender', hobbies='$hobbies', image='$image' WHERE id=$id";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "Error: " . mysqli_error($conn);
        } else {
            header('Location: index.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
    <?php include 'navbar.php'; ?>
    <h1>Edit Student</h1>
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
        <input type="text" name="name" placeholder="Name" value="<?= $name ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= $email ?>" required>
        <input type="text" name="github" placeholder="Github" value="<?= $github ?>" required>
        <select name="branch" required>
            <option value="">Select Branch</option>
            <option value="Computer Science" <?= $branch === 'Computer Science' ? 'selected' : '' ?>>Computer Science</option>
            <option value="Electrical Engineering" <?= $branch === 'Electrical Engineering' ? 'selected' : '' ?>>Electrical Engineering</option>
            <option value="Mechanical Engineering" <?= $branch === 'Mechanical Engineering' ? 'selected' : '' ?>>Mechanical Engineering</option>
            <!-- Add more branches as needed -->
        </select>
        <input type="radio" name="gender" value="Male" <?= $gender === 'Male' ? 'checked' : '' ?> required>Male
        <input type="radio" name="gender" value="Female" <?= $gender === 'Female' ? 'checked' : '' ?> required>Female
        <label>Hobbies:</label>
        <input type="checkbox" name="hobbies[]" value="Reading" <?= in_array('Reading', $hobbies) ? 'checked' : '' ?>>Reading
        <input type="checkbox" name="hobbies[]" value="Traveling" <?= in_array('Traveling', $hobbies) ? 'checked' : '' ?>>Traveling
        <input type="checkbox" name="hobbies[]" value="Gaming" <?= in_array('Gaming', $hobbies) ? 'checked' : '' ?>>Gaming
        <input type="checkbox" name="hobbies[]" value="Cooking" <?= in_array('Cooking', $hobbies) ? 'checked' : '' ?>>Cooking
        <input type="checkbox" name="hobbies[]" value="Sports" <?= in_array('Sports', $hobbies) ? 'checked' : '' ?>>Sports
        <input type="checkbox" name="hobbies[]" value="Music" <?= in_array('Music', $hobbies) ? 'checked' : '' ?>>Music
        <input type="checkbox" name="hobbies[]" value="Art" <?= in_array('Art', $hobbies) ? 'checked' : '' ?>>Art
        <input type="checkbox" name="hobbies[]" value="Photography" <?= in_array('Photography', $hobbies) ? 'checked' : '' ?>>Photography
        <!-- Add more hobbies as needed -->
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/gif">
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
