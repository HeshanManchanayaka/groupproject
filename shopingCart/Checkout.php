<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Checkout.css">
  <title>Customer Details Form</title>
</head>
<section class="page_border">
  <div class="page_border_h3">
    <h3>Check Out</h3><a href="bookhome.php">Home > </a><span>checkout</span>
  </div>
</section>

<body>

  <form action="payment.php" method="post">
    <div>
      <div class="error_list">
        <ul></ul>
      </div>
      <h1 class="item-in-cart">Delivery Details</h1><br>

      <div class="class_name">
        <div class="fname">
          <label class="form-label">First Name<span>*</span></label><input name="billing_first_name" type="text" id="billing_first_name" class="form-control" value="">
        </div>
        <div class="lname">
          <label class="form-label">Last Name<span>*</span></label><input name="billing_last_name" type="text" id="billing_last_name" class="form-control" value="">
        </div>
      </div>
      <br>

      <label class="form-label">Email Address<span>*</span></label><input name="billing_email" type="email" id="billing_email" class="form-control" value=""><br><br>


      <label class="form-label">Telephone<span>*</span></label><input name="billing_tp" type="text" id="billing_tp" class="form-control" value=""><br>

      <br>
      <label class="form-label">Street Address<span>*</span></label><input name="billing_street_address" type="text" id="billing_street_address" class="form-control" value=""><br>
      <br>

      <label class="form-label">Postcode/ ZIP<span>*</span></label><input name="billing_postal_code" type="text" id="billing_postal_code" class="form-control" value=""><br>
      <br>
    </div>


    <label class="form-label">Order Notes (Optional)</label><input name="billing_order_note" type="text" id="billing_order_note" class="form-control" value=""><br><br>

    </div>
    <button type="submit">Submit</button>
  </form>
  <footer>
    <?php include 'footer.html'; ?>
  </footer>
</body>

</html>