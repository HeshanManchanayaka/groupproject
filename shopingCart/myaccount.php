<!DOCTYPE html>
<html>

<head>
    <title>Customer Details and Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #188eef;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: blue;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include 'config.php';

        // Assuming you have customer ID in a variable, replace this with the actual customer ID
        $customerId = 1;

        // SQL query
        $query = "SELECT customers.cus_id, customers.name, customers.email, shopping_cart.book_id, shopping_cart.qty
              FROM customers
              LEFT JOIN cart ON customers.cus_id = shopping_cart.cus_id
              WHERE customers.cus_id = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $customerId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Display customer details
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>Customer Details:</h2>";
            echo "<p>Customer ID: " . $row['cus_id'] . "</p>";
            echo "<p>Name: " . $row['name'] . "</p>";
            echo "<p>Email: " . $row['email'] . "</p>";

            // Display cart items
            echo "<h2>Cart Items:</h2>";
            echo "<ul>";
            do {
                echo "<li>Book ID: " . $row['book_id'] . " | Quantity: " . $row['qty'] . "</li>";
            } while ($row = mysqli_fetch_assoc($result));
            echo "</ul>";
        } else {
            echo "Customer not found.";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        ?>
    </div>
</body>

</html>