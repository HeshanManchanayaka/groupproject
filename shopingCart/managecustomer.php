<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td input {
            margin-right: 5px;
        }

        button {
            padding: 8px 12px;
            background-color:#3adee6;
            color: black;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Manage Customers</h1>

    <script>
        function editCustomer(customerId) {
            // Redirect to the edit customer page with the selected customer ID
            window.location.href = 'edit_customer.php?cus_id=' + customerId;
        }
    </script>
</body>
<center>
        <form action="admin.php" class="backbtn">
            <button >Back</button>
        </form>
    </center>
</html>
<?php
// Include the configuration file
include 'config.php';

// Check if the form for deleting customers is submitted
if (isset($_POST['deleteCustomers']) && isset($_POST['selectedCustomers'])) {
    $selectedCustomers = $_POST['selectedCustomers'];

    // Use prepared statement to prevent SQL injection
    $deleteQuery = "DELETE FROM customers WHERE cus_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);

    foreach ($selectedCustomers as $customerId) {
        $deleteStmt->bind_param("i", $customerId);
        $deleteStmt->execute();
    }

    $deleteStmt->close();
}

// Fetch all customers from the database
$query = "SELECT * FROM customers";
$result = mysqli_query($conn, $query);

// Display the customers in a table
if ($result) {
    echo '<form method="POST" action="">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Select</th>';
    echo '<th>ID</th>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>Role</th>';
    echo '<th>Action</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><input type="checkbox" name="selectedCustomers[]" value="' . $row['cus_id'] . '"></td>';
        echo '<td>' . $row['cus_id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo '<td><button type="button" onclick="editCustomer(' . $row['cus_id'] . ')">Edit</button></td>';
        echo '</tr>';
    }

    echo '</table>';
   
   echo '<button type="submit" name="deleteCustomers">Delete Selected</button>';
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
