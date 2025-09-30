<?php
include("db.php");
include("functions.php");

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!validateInput($_POST["titre"], '/^[a-zA-Z ]+$/', 'preg')) {
        $errors['titre'] = 'titre invalid';
    } else {
        $titre = trim($_POST["titre"]);
    }
    if (empty($_POST["adresse"])) {
        $errors["adresse"] = "adresse invalid";
    } else {
        $adresse = trim($_POST["adresse"]);
    }
    if (empty($_POST["prix_par_nuit"])) {
        $errors["prix_par_nuit"] = "prix_par_nuit invalid";
    } else {
        $prix_par_nuit = trim($_POST["prix_par_nuit"]);
    }
    if (empty($_POST["id_type"])) {
        $errors["id_type"] = "id_type invalid";
    } else {
        $id_type = trim($_POST["id_type"]);
    }
    if (empty($_POST["nombre_de_places"])) {
        $errors["nombre_de_places"] = "nombre_de_places invalid";
    } else {
        $nombre_de_places = trim($_POST["nombre_de_places"]);
    }
    

    if (empty($errors)){
        $sql = "INSERT INTO hotel (titre, adresse, prix_par_nuit, id_type, nombre_de_places)
            VALUES ('$titre', '$adresse', $prix_par_nuit, $id_type, $nombre_de_places)";
        mysqli_query($conn, $sql);
        header("Location: listerH.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Add New Hotel</h1>

<?php if ($errors): ?>
    <div style="color: red;">
        <h2>Errors:</h2>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="">
    <label for="titre">Title:</label>
    <input type="text" id="titre" name="titre" required>

    <label for="adresse">Address:</label>
    <input type="text" id="adresse" name="adresse" required>

    <label for="prix_par_nuit">Price per Night:</label>
    <input type="number" step="0.01" id="prix_par_nuit" name="prix_par_nuit" required>

    <label for="id_type">Hotel Type ID:</label>
    <input type="number" id="id_type" name="id_type" required>

    <label for="nombre_de_places">Number of Places:</label>
    <input type="number" id="nombre_de_places" name="nombre_de_places" required>

    <input type="submit" value="Add Hotel">
</form>
<a href="listerH.php">Hotel list</a>
</body>
</html>
