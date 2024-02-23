<?php
if (isset($_POST["submit"])) {
 
    if (isset($_FILES['filename']) && $_FILES['filename']['error'] === UPLOAD_ERR_OK) {
        $uploadsDirectory = 'images/';

        // Create the destination directory if it doesn't exist
        if (!file_exists($uploadsDirectory) && !mkdir($uploadsDirectory, 0755, true)) {
            die('Failed to create destination directory...');
        }

        $filename = basename($_FILES['filename']['name']);
        $targetPath = $uploadsDirectory . $filename;

        if (move_uploaded_file($_FILES['filename']['tmp_name'], $targetPath)) {

            $bookName = $_POST['bookName'];
            $bookCategory = $_POST['bookCategory'];
            $bookPrice = $_POST['bookPrice'];
            $addQty = $_POST['addQty'];

            require_once 'config.php';

            $insertQuery = "INSERT INTO book (book_image, book_name, catalog_name, price, qty, available_qty) 
                            VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $insertQuery);

            mysqli_stmt_bind_param($stmt, "ssssii", $filename, $bookName, $bookCategory, $bookPrice, $addQty, $addQty);

            if (mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Book added successfully."); window.location.href = "admin.php";</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        } else {
            echo "Failed to move the uploaded file.";
        }
    } else {
        echo "No file uploaded or an error occurred during upload.";
    }
}
?>
