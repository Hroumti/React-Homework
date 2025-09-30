<?php
include("db.php");
include("functions.php");

// Fetch hotel data
$sql = "SELECT id_hotel, titre, adresse, prix_par_nuit, nombre_de_places FROM hotel";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Hotels</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        
    </style>
</head>
<body>

<h1>List of Hotels</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Address</th>
        <th>Price per Night</th>
        <th>Number of Places</th>
        <th>Action</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["id_hotel"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["titre"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["adresse"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["prix_par_nuit"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["nombre_de_places"]) . "</td>";
            echo "<td><form method='post' action='delete_hotel.php'>
                      <input type='hidden' name='id_hotel' value='" . htmlspecialchars($row["id_hotel"]) . "'>
                      <button type='submit'>Delete</button>
                  </form></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No hotels found</td></tr>";
    }
    ?>
    <button><a href="ajouterH.php">Ajouter un hotel</a></button>
</table>
</body>
</html>
