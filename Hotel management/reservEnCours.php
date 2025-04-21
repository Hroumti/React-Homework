<?php
include("db.php");
include("functions.php");

if (isset($_GET['id_user'])) {
    $login = $_GET['id_user'];

    $sql_user = "SELECT cin, name FROM client WHERE login = '$login'";
    $result_user = mysqli_query($conn, $sql_user);

    if (mysqli_num_rows($result_user) > 0) {
        $user_data = mysqli_fetch_assoc($result_user);
        $cin = $user_data['cin'];
        $name = $user_data['name'];
    } else {
        echo "User not found.";
        exit;
    }

    $sql_reservations = "SELECT * FROM reservation WHERE id_user = '$login'";
    $result_reservations = mysqli_query($conn, $sql_reservations);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
</head>
<body>
    <h1>User Information</h1>
    <p>CIN: <?php echo htmlspecialchars($cin); ?></p>
    <p>Name: <?php echo htmlspecialchars($name); ?></p>

    <h2>Reservations</h2>
    <?php
    echo '<table>';
    echo '<tr>';
    echo '<th>id_reservation</th>';
    echo 'th>id_client</th>';
    echo '<th>id_hotel</th>';
    echo '<th>date_debut</th>';
    echo '<th>date_fin</th>';
    echo '</tr>';
    while ($row = mysqli_fetch_assoc($result_reservations)) {
        echo '<tr>';
        echo '<td>'.$row['id_reservation'].'</td>'; 
        echo '<td>'.$row['id_client'].'</td>';
        echo '<td>'.$row['id_hotel'].'</td>';
        echo '<td>'.$row['date_debut_sejour'].'</td>';
        echo '<td>'.$row['date_fin_sejour'].'</td>';
        echo '</tr>';
};
    ?>
</body>
</html>
