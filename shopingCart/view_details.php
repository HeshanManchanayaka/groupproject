<?php
include 'config.php';

$bookid = $_GET["id"];
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #1e82a6b1;
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            width: 100%;
            position: absolute;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            box-sizing: border-box;
            background-color: #e5e2e2;
        }

        #logo-container {
            display: flex;
            align-items: center;
        }

        #logo {
            width: 35px;
            margin-right: 15px;
        }

        #store-name {
            font-size: 18px;
            font-weight: bold;
        }

        #home-icone-container {
            display: flex;
            align-items: center;
        }

        #home {
            width: 30px;
            margin-right: 20px;
        }

        #see-details {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 50px;
        }



        #book-info-container {
            background-color: rgb(255, 255, 255);
            padding: 90px;
            padding-left: 50px;
            text-align: left;
            max-width: 800px;
            min-width: 300px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-style: outset;
            border-width: 3px;
            border-color: #050505;
            position: relative;
            margin-top: 60px;
            margin-bottom: 40px;

        }

        #book-details {
            flex: 1;
            padding-right: 20px;
        }

        #book-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #stock {
            font-size: 16px;
            font-style: italic;
            margin-bottom: 8px;
            color: #06b217;
        }


        #price {
            font-size: 20px;
            font-weight: 600;
            color: #2428de;
            margin-bottom: 30px;
        }

        #info {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .book {
            font-size: 16px;
        }

        #language,
        #author,
        #publisher,
        #additional-info {
            margin-bottom: 8px;
        }


        #cover-image {
            width: 150px;
            border-radius: 8px;
            position: absolute;
            top: 30px;
            margin-left: 300px;
        }

        #cover-image1 {
            width: 80px;
            border-radius: 8px;
            position: absolute;
            top: 125px;
            margin-left: 120px;
        }

        #buttons-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            color: #fff;
            transition: background-color 0.3s;
            text-align: center;
        }

        #add-to-cart-button {
            background-color: #33358f;
            margin-left: 40px;
        }

        .a {
            margin-left: 50px;
            display: block;
        }

        #minus,
        #plus {
            padding: 10px 10px;
            color: #050505;
        }

        #count {
            width: 30px;
            padding: 10px 30px;
            border-radius: 5px;
            background-color: #fff;
            text-align: center;
        }

        footer {
            background-color: #fff;
        }
    </style>
</head>

<body>
<header>

<div id="logo-container">
    <img id="logo" src="logo.jpg" alt="Logo">
    <div id="store-name">Nalanda <br> Book Store</div>
</div>
<div id="home-icone-container">
    <a href="bookhome.php"><img id="home" src="home_icon.png" alt="Home"></a>
</div>
</header>

    <?php
    $stmt = $conn->prepare("SELECT * FROM book WHERE book_id= $bookid");
    $stmt->execute();
    $result = $stmt->get_result();

    foreach ($result as $row) :
    ?>

        <div id="see-details">
            <div id="book-info-container">
                <div id="book-details">
                    <div id="book-name"><?php echo $row['book_name']; ?></div>
                    <div id="stock">in Stock</div>
                    <div id="price"><?php echo $row['price']; ?></div>
                    <div id="info"><b>INFORMATION</b></div>
                    <div class="book">
                        <ul>
                            <li>
                                <div id="language"><b>Language &nbsp; &nbsp;&nbsp; &nbsp;:</b><?php echo $row['language']; ?></div>
                            </li>
                            <li>
                                <div id="author"><b>Author &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp;:</b><?php echo $row['author']; ?>
                                </div>
                            </li>
                            <li>
                                <div id="publisher"><b>Publisher &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;:</b><?php echo $row['publisher']; ?>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
                <img id="cover-image" src="<?php echo $row['book_image']; ?>" alt="Book Cover">
                <img id="cover-image1" src="<?php echo $row['book_image']; ?>" alt="Book Cover">
            </div>
        </div>

    <?php endforeach; ?>

    <footer>
        <footer>
            <?php include 'footer.html'; ?>
        </footer>

</body>

</html>