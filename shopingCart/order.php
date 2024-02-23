<?php
include 'config.php';
session_start();

// Assuming you have the necessary variables for the update
$cusId = isset($_SESSION['cus_id']) ? $_SESSION['cus_id'] : null;

// Retrieve information from the shopping cart table
$query = "SELECT b.book_id, c.cus_id, s.qty, s.total_amount
              FROM `shopping_cart` s
              JOIN book b ON s.book_id = b.book_id
              JOIN customers c ON s.cus_id = c.cus_id
              WHERE c.cus_id = ?";

$ordersStmt = mysqli_prepare($conn, $query);

if (!$ordersStmt) {
    die("Error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($ordersStmt, "i", $cusId);

if (!mysqli_stmt_execute($ordersStmt)) {
    die("Error executing statement: " . mysqli_stmt_error($ordersStmt));
}

mysqli_stmt_bind_result($ordersStmt, $bookId, $cusId, $qty, $totalAmount);

// Assuming there is only one record in the shopping cart for simplicity
if (mysqli_stmt_fetch($ordersStmt)) {

    // Update the order table
    $updateQuery = "UPDATE `order` o SET
                                o.book_id = ?,
                                o.cus_id = ?,
                                o.qty = ?,
                                o.total_amount = ?,
                                o.order_date = NOW()
                                WHERE o.cus_id = ?";

    $updateStmt = mysqli_prepare($conn, $updateQuery);

    if (!$updateStmt) {
        die("Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($updateStmt, "iiid", $bookId, $cusId, $qty, $totalAmount);

    if (!mysqli_stmt_execute($updateStmt)) {
        die("Error executing statement: " . mysqli_stmt_error($updateStmt));
    }

    mysqli_stmt_close($updateStmt);
} else {
    echo "Error: No record found in the shopping cart.";
}

mysqli_stmt_close($ordersStmt);
mysqli_close($conn);
?>
