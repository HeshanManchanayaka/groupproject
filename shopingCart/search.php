<?php
include 'config.php';

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];

    $sql = "SELECT * FROM book WHERE book_name LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<div class='container' style='width: 100%' id='searchResultsContainer'>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='col-md-3' style='float: right;'>";
            echo "<form method='post' action='shopingCart.php?action=add&id={$row['book_id']}'>";

            echo "<div class='book'>";
            echo "<input type='hidden' name='book_id' value='{$row['book_id']}'>";
            echo "<img src='images/{$row['book_image']}' width='200px' height='200px' class='img-responsive'><br>";
            echo "<a class='text-info'>{$row['book_name']}</a><br>";
            echo "<a class='text-info'>({$row['catalog_name']})</a>";
            echo "<p style='margin: 5px 0;'>PRICE: RS.{$row['price']}</p>";
            echo "<label for='quantity' style='margin-bottom: 5px;'>Qty:</label>";
            echo "<button type='button' class='incre1' onclick=\"changeValue(this.parentNode.querySelector('.num'), -1)\">-</button>";
            echo "<input type='text' name='qty' value='1' min='1' max='10' class='num'>";
            echo "<button type='button' class='incre2' onclick=\"changeValue(this.parentNode.querySelector('.num'), 1)\">+</button><br>";
            echo "<button name='add' class='add-to-cart-btn' style='margin-top: 5px;'>Add to Cart</button>";
            echo "</div>";

            echo "</form><br><br>";
            echo "</div>";
        }
        echo "</div>";

        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
