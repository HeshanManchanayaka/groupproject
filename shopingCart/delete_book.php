<?php
session_start();

if (isset($_POST["submit"])) {
    $deleteBookId = $_POST['deleteBookId'];

    require_once 'config.php';

    $deleteQuery = "DELETE FROM book WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $deleteBookId);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Book deleted successfully."); window.location.href = "admin.php";</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
