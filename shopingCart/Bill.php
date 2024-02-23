<?php
include 'config.php';
session_start();

// Assuming cus_id is stored in the session
$cusId = isset($_SESSION['cus_id']) ? (int)$_SESSION['cus_id'] : null;
$orderId = $orderDate = $totalAmount = $bookName = $customerName = '';
// Fetch order details based on cus_id

$query = "SELECT o.order_id, o.order_date, s.total_amount, b.book_name, c.name
FROM `orders` o
JOIN book b ON o.book_id = b.book_id
JOIN customers c ON o.cus_id = c.cus_id
JOIN shopping_cart s ON o.cart_id = s.cart_id
WHERE o.cus_id = ?";

// Attempt to prepare the statement
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "i", $cusId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if the query was successful
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $orderId, $orderDate, $totalAmount, $bookName, $customerName);
        mysqli_stmt_fetch($stmt);
    } else {
        echo "No order found for the given customer ID.";
    }

    // Close the statement after fetching the data
    mysqli_stmt_close($stmt);
} else {
    // Print an error message if preparation fails
    echo "Error preparing statement: " . mysqli_error($conn);
}

// Close your database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill</title>
    <style>
        /* Add your styles here */
        .container {
            text-align: center;
            margin-top: 50px;
        }

        .bill-details {
            margin-top: 20px;
        }

        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Order Bill</h2>
        <p>Thanks, <strong><?php echo $customerName; ?></strong>! Your order has been successfully received.</p>
        <div class="bill-details">
            <table>
                <tr>
                    <td><strong>Order ID:</strong></td>
                    <td><?php echo $orderId; ?></td>
                </tr>
                <tr>
                    <td><strong>Book Name:</strong></td>
                    <td><?php echo $bookName; ?></td>
                </tr>
                <tr>
                    <td><strong>Total Amount:</strong></td>
                    <td><?php echo $totalAmount; ?></td>
                </tr>
                <tr>
                    <td><strong>Order Date:</strong></td>
                    <td><?php echo $orderDate; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>