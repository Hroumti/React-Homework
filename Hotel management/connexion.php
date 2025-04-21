<?php
include("db.php");
include("functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $_POST["login"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM user WHERE login = '$login' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        header("Location: reservEncour.php?id_user=".$login);
    } else {
        echo "Login ou mot de passe incorrect";
    };
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="login">login</label>
        <input type="text" name="login" id="login" required>
        <label for="password">password</label>
        <input type="password" name="password" id="password" required>
        <input type="submit" value="login">
    </form>
</body>
</html>