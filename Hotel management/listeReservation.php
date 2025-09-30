<?php
include("db.php");
include("functions.php");

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
        <select name="type" id="type">
            <option value="" disabled selected>--select a type--</option>
            <?php
            $result = mysqli_query($conn,"SELECT * FROM typehotel");
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['id_type'].'">'.$row['id_type'].'</option>';
            };
            if (isset($_POST['type'])) {
                $sql = mysqli_query($conn, 'SELECT id_hotel FROM hotel WHERE id_type = '.$_POST['type']);
                $hotelIds = [];
                while ($row = mysqli_fetch_assoc($sql)) {
                    $hotelIds[] = $row['id_hotel'];
                }
                $hotelIdsList = implode(',', $hotelIds);
                $res = mysqli_query($conn, 'SELECT * FROM reservation WHERE id_hotel IN ('.$hotelIdsList.')');
                echo '<table>';
                echo '<tr>';
                echo '<th>id_reservation</th>';
                echo 'th>id_client</th>';
                echo '<th>id_hotel</th>';
                echo '<th>date_debut</th>';
                echo '<th>date_fin</th>';
                echo '</tr>';
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<tr>';
                    echo '<td>'.$row['id_reservation'].'</td>'; 
                    echo '<td>'.$row['id_client'].'</td>';
                    echo '<td>'.$row['id_hotel'].'</td>';
                    echo '<td>'.$row['date_debut_sejour'].'</td>';
                    echo '<td>'.$row['date_fin_sejour'].'</td>';
                    echo '</tr>';
            };
        };
            ?>
        </select>
    </form>
</body>
</html>