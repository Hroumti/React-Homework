<?php
include 'db.php';
include 'functions.php';
$result = mysqli_query($conn, "SELECT * FROM students2");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007BFF;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    img {
        border-radius: 50%;
        object-fit: cover;
    }

    .btn {
        padding: 5px 10px;
        margin: 2px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
        width: 90%;
    }

    .btn-warning {
        background-color: #ffc107;
        color: black;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
    .btn a{
        color: white;
        text-decoration: none;
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
    <h1>Students</h1>
    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Github</th>
            <th>Branch</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><img src="<?= $row['image'] ; ?>" width="70" height="70"></td>
                <td><?= $row['name']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['github']; ?></td>
                <td><?= $row['branch']; ?></td>
                <td><?= $row['gender']; ?></td>
                <td><?= $row['hobbies']; ?></td>
                <td>
                    <button class="btn btn-sm btn-warning"><a href="edit.php?id=<?= $row['id']; ?>">Edit</a></button>
                    <button class="btn btn-sm btn-danger">
                    <a href="delete.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete?')">Delete</a>
                    </button>
                </td>
            </tr>
            <?php } ?>
    </table>
</body>
</html>