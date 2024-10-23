<?php include "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        button {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #4CAF50;
            color: white;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
        }
        .add-button {
            background-color: #008CBA;
            color: white;
            margin-bottom: 20px;
            float: right;
        }
    </style>
</head>
<body>

<h1>User List</h1>
<button class="add-button" onclick="window.location.href='form.php'">Add User</button>
<table id="userTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Full Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $sql = "SELECT p.id AS id,c.city_name AS City,
                s.state_name AS State,p.name AS name ,
                p.phone AS phone, p.gender AS gender, co.name AS Country 
                FROM personal_details p 
                JOIN countries co ON co.id = p.Country
                JOIN states s ON s.id = p.State
                JOIN cities c ON c.id = p.City  ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['Country'] . ", " . $row['State'] . ", " . $row['City'] . "</td>";
                    echo "<td>
                            <button class='edit-button' onclick=\"window.location.href='edit_form.php?id=" . $row['id'] . "'\">Edit</button>
                            <button class='delete-button' id='".$row['id']."' onclick='deleteRecord(" . $row['id'] . ")'>Delete</button>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
        ?>
    </tbody>
</table>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="asset/js/custom.js"></script>
<script > $('#userTable').DataTable();</script>

</body>
</html>
