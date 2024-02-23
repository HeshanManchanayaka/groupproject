<?php
include 'config.php';

session_start();

if (!isset($_SESSION['cus_id'])) {
  header("location: login.php");
  exit();
}

$cus_id = $_SESSION['cus_id'];

if (isset($_POST['add'])) {
  $itemId = $_POST['book_id'];
  $itemQty = $_POST['qty'];


  $query = "SELECT * FROM book WHERE book_id = $itemId";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $item = mysqli_fetch_assoc($result);

    if ($itemQty <= $item['qty']) {

      $cartQuery = "SELECT * FROM shopping_cart WHERE cus_id = $cus_id AND book_id = $itemId";
      $cartResult = mysqli_query($conn, $cartQuery);


      mysqli_query($conn, "INSERT INTO shopping_cart (cus_id, book_id, qty) VALUES ($cus_id, $itemId, $itemQty)");
    }

    updateTotalAmount($cus_id, $conn);

    $newQuantity = $item['qty'] - $itemQty;
    mysqli_query($conn, "UPDATE book SET available_qty = $newQuantity WHERE book_id = $itemId");

    echo "Item added to cart!";
  } else {
    echo "Not enough quantity available in stock.";
  }
}

function updateTotalAmount($cus_id, $conn)
{
  $totalPrice = 0;

  $cartQuery = "SELECT sc.qty, t.price
                  FROM shopping_cart sc
                  JOIN book t ON sc.book_id = t.book_id
                  WHERE sc.cus_id = $cus_id";
  $cartResult = mysqli_query($conn, $cartQuery);

  if ($cartResult) {
    while ($cartItem = mysqli_fetch_assoc($cartResult)) {
      $totalPrice += $cartItem['price'] * $cartItem['qty'];
    }
  }

  mysqli_query($conn, "UPDATE shopping_cart SET total_amount = $totalPrice WHERE cus_id = $cus_id");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookStore</title>
  <link rel="stylesheet" href="shopingcart.css">
  <script src="scripts.js"></script>
  <style>
    .action-btn {
      background-color: red;
      color: aliceblue;

    }
  </style>
</head>

<body>
  <main>
    <header class="navbar">
      <ul>
        <li><a href="login.html">Home</a></li>
        <li><a href="home.html">Products</a></li>
        <li><a href="shopingCart.html">Cart</a></li>
        <li><a href="aboutus.html">About Us</a></li>
      </ul>
    </header>

    <section class="page_border">
      <div class="page_border_h3">
        <h3>Cart</h3><a href="bookhome.php">Home > </a><span>Cart</span>
      </div>
    </section>

    <div>
      <center>
        <table class="small_container_cart_page" border="1">
          <thead>
            <tr>
              <th>Book ID</th>
              <th>Book Image</th>
              <th>BookName</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cartQuery = "SELECT sc.cart_id, sc.book_id, sc.qty,t.book_name, t.price, t.book_image
                 FROM shopping_cart sc
                 JOIN book t ON sc.book_id = t.book_id
                 WHERE sc.cus_id = $cus_id";
            $cartResult = mysqli_query($conn, $cartQuery);

            if ($cartResult) {
              while ($cartItem = mysqli_fetch_assoc($cartResult)) {
                echo "<tr>";
                echo "<td>{$cartItem['book_id']}</td>";
                echo "<td><img src='images/{$cartItem['book_image']}' alt='{$cartItem['book_name']}' style='max-width: 50px; max-height: 75px;'></td>";
                echo "<td>{$cartItem['book_name']}</td>";

                echo "<td>{$cartItem['price']}</td>";
                echo "<td>{$cartItem['qty']}</td>";
                echo "<td><a href='?remove=" . $cartItem['cart_id'] . "' class='action-btn'>Remove</a></td>";
                echo "</tr>";
              }
            }

            ?>
            <tr>
              <td class="total-price" colspan="7">Total Price: $<?php echo calculateTotalPrice($cus_id, $conn); ?></td>
            </tr>
          </tbody>
        </table>
        <form action="Checkout.php">
          <button class="outbtn"><b>CheckOut</b></button>
        </form><br><br>
        <form action="bookhome.php">
          <button class="outbtn1"><b>Continue Shopping</b></button>
        </form>

        <?php
        function calculateTotalPrice($cus_id, $conn)
        {
          $totalPrice = 0;


          $cartQuery = "SELECT sc.qty,  t.price
                  FROM shopping_cart sc
                  JOIN book t ON sc.book_id = t.book_id
                  WHERE sc.cus_id = $cus_id";
          $cartResult = mysqli_query($conn, $cartQuery);

          if ($cartResult) {
            while ($cartItem = mysqli_fetch_assoc($cartResult)) {
              $totalPrice += $cartItem['price'] * $cartItem['qty'];
            }
          }

          return number_format($totalPrice, 2);
        }
        ?>
        <?php

        if (isset($_GET['remove'])) {
          $removeCartId = $_GET['remove'];

          $query = "DELETE FROM shopping_cart WHERE cart_id = ?";
          $stmt = mysqli_prepare($conn, $query);
          mysqli_stmt_bind_param($stmt, "i", $removeCartId);
          $result = mysqli_stmt_execute($stmt);

         
          updateTotalAmount($cus_id, $conn);


          mysqli_stmt_close($stmt);
        }
        ?>
  </main>
  <footer>
    <?php include 'footer.html'; ?>
  </footer>
</body>

</html>