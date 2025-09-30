<?php
include("db.php");
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: auth.php");
    exit();
} ;
$mat = $_SESSION['user']['matricule'];

$stmt = $conn->prepare("SELECT
    a.matricule,
    a.nom,
    a.prenom,
    a.date_naissance,
    a.nb_enfant,
    a.situation_familiale,
    a.total_remb,
    a.date_deces,
    e.nom_entreprise
FROM
    Assuré a
JOIN
    Entreprise e ON a.num_entreprise = e.num_entreprise
WHERE
    a.matricule = ?;");
    $stmt->bind_param("s", $mat);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $depot = $_POST['date_depot'];
        $trait = $_POST['date_traitement'];
        $rembours = $_POST['montant_remboursement'];
        $lien = $_POST['lien_maladie'];
        $num_malad = $_POST['num_maladie'];
        $total = $_POST['total_dossier'];

        if ($depot == '' || $trait == '' || $rembours == '' || $lien == '' || $num_malad == '' || $total == '') {
            echo "<script>alert('Veuillez remplir tous les champs');</script>";
        } elseif (!is_numeric($rembours) || !is_numeric($total)) {
            echo "<script>alert('Le montant de remboursement et le total du dossier doivent être des nombres');</script>";
        } elseif ($rembours < 0 || $total < 0) {
            echo "<script>alert('Le montant de remboursement et le total du dossier ne peuvent pas être négatifs');</script>";
        } elseif ($rembours > 1000000 || $total > 1000000) {
            echo "<script>alert('Le montant de remboursement et le total du dossier ne peuvent pas dépasser 1 000 000');</script>";
        } elseif (!filter_var($lien, FILTER_VALIDATE_URL)) {
            echo "<script>alert('Le lien maladie doit être une URL valide');</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO Dossier (datedepot, date_traitement, montant_remboursement, lien_maladie, num_maladie, total_dossier, matricule) VALUES (?, ?, ?, ?, ?, ?, ?);");
            $stmt->bind_param("ssissi", $depot, $trait, $rembours, $lien, $num_malad, $total, $mat);
            if ($stmt->execute()) {
                echo "<script>alert('Dossier ajouté avec succès');</script>";
            } else {
                echo "<script>alert('Erreur lors de l\'ajout du dossier');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
body {
    font-family: sans-serif;
    margin: 20px;
    background-color: #f4f4f4;
    color: #333;
}

nav {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 20px;
}

nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

nav ul li h1 {
    margin: 0;
    font-size: 24px;
    color: #007bff;
}

nav ul li a {
    text-decoration: none;
    color: #007bff;
    padding: 10px 15px;
    border: 1px solid #007bff;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

nav ul li a:hover {
    background-color: #007bff;
    color: #fff;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #e0f7fa;
}

form {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    border: 1px solid #ddd;
    display: grid;
    grid-template-columns: auto auto;
    gap: 15px;
    align-items: center;
}

form label {
    font-weight: bold;
    color: #555;
}

form input[type="date"],
form input[type="number"],
form input[type="url"],
form select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

form input[type="submit"] {
    background-color: #28a745;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    grid-column: 1 / span 2; /* Make submit button span both columns */
    text-align: center;
}

form input[type="submit"]:hover {
    background-color: #1e7e34;
}

form select option:first-child {
    color: #777;
}
</style>
</head>
<body>
    <nav>
        <ul>
            <li><h1>Bienvenue <?php echo $row['nom'] . ' ' . $row['prenom']; ?></h1></li>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </ul>
        <table>
            <tr>
                <td>nom</td>
                <td>prenom</td>
                <td>date de naissance</td>
                <td>Nombre d'enfant</td>
                <td>situation familiale</td>
                <td>nom d'entreprise</td>
                <td>total_remb</td>
                <td>date_deces</td>
            </tr>
            <tr>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['prenom']; ?></td>
                <td><?php echo $row['date_naissance']; ?></td>
                <td><?php echo $row['nb_enfant']; ?></td>
                <td><?php echo $row['situation_familiale']; ?></td>
                <td><?php echo $row['nom_entreprise']; ?></td>
                <td><?php echo $row['total_remb']; ?></td>
                <td><?php echo $row['date_deces']; ?></td>
        </table>
        <form action="" method="post">
            <label for="date_depot">Date de depot: </label>
            <input type="date" name="date_depot">
            <label for="date_traitement">Date de traitement: </label>
            <input type="date" name="date_traitement">
            <label for="montant_remboursement">Total remboursement: </label>
            <input type="number" name="montant_remboursement" max="1000000" min="0" step="10">
            <label for="lien_maladie">Lien maladie: </label>
            <input type="url" name="lien_maladie">
            <label for="num_maladie">Numero de maladie: </label>
            <select name="num_maladie" id="num_maladie">
                <option value="" selected disabled>----------------</option>
                <?php
                $stmt = $conn->prepare("SELECT * FROM Maladie");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['num_maladie'] . "'>" . $row['designation_maladie'] . "</option>";
                }
                ?>

            </select>
            <label for="total_dossier">Total dossier: </label>
            <input type="number" name="total_dossier" max="1000000" min="0" step="10">
            <input type="submit" value="Ajouter dossier" name="ajouter_dossier">
        </form>
    </nav>
</body>
</html>