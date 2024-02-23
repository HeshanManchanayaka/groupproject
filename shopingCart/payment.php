<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $cardType = $_POST['card_type'];
    $cardNumber = $_POST['number'];
    $expiryMonth = $_POST['expiry_month'];
    $expiryYear = $_POST['expiry_year'];
    $cardCVC = $_POST['cvv'];

    $cusId = isset($_SESSION['cus_id']) ? (int)$_SESSION['cus_id'] : null;

    $insertQuery = "INSERT INTO checkout (card_type, card_number, expiry_month, expiry_year, card_cvv, cus_id)
                    VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);

    if (!$stmt) {
        die("Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "ssssii", $cardType, $cardNumber, $expiryMonth, $expiryYear, $cardCVC, $cusId);

    if (!mysqli_stmt_execute($stmt)) {
        die("Error executing statement: " . mysqli_stmt_error($stmt));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header('location: order.php');
}
?>


<html>

<head>
    <style>
        .check_form {
            max-width: 100s;
        }

        .page_border {
            background-color: #5bc0de;
            padding: 10px;
        }

        .page_border_h3 {
            text-align: center;
            color: white;
        }

        .page_border_h3 a,
        .page_border_h3 span {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <main>
        <center>
            <section class="page_border">
                <div class="page_border_h3">
                    <h3>Cart</h3><a href="bookhome.php">Home > </a><span>Payment</span>
                </div>
            </section>
            <form class="check_form" method="POST" action="Bill.php">
                <fieldset>
                    <center>
                        <h3> Payment</h3>
                    </center><br>

                    <label class="label"> Card Type</label><br>
                    <select class="input" name="card_type">
                        <option value="visa"> Visa Debit</option>
                        <option value="mastercard"> Master Card</option>
                        <option value="amex"> American Express</option>
                        <option value="maestro"> Maestro</option>
                        <option value="discover"> Discover</option>
                    </select><br><br>

                    <label class="label"> Card Number</label><br>
                    <input placeholder="•••• •••• •••• ••••" type="cardnumber" name="number" maxlength="16" class="input"><br><br>

                    <label class="label"> Expiry Date</label><br>
                    <div class="select">
                        <select class="input1" name="expiry_month">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                         
                        </select>

                        <select class="input1" name="expiry_year">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2025">2025</option>
                           
                        </select>
                    </div><br>

                    <label class="label"> CVV</label><br>
                    <input placeholder="•••" type="password" maxlength="3" class="input1" name="cvv"><br><br>

                    <p class="label">agreement By clicking pay you are agreeing to our <a href="#" class="tandc"><br>Terms and Condition</a></p><br><br>

                    <button class="next" name="submit">Next</button><br>
                </fieldset>
            </form>

        </center>
    </main>
    <hr>
    <footer>
        <?php include 'footer.html'; ?>
    </footer>
</body>

</html>