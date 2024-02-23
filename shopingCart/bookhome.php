<?php
include 'config.php';

session_start();
$query = 'SELECT * FROM book';
$results = mysqli_query($conn, $query);
if (isset($_SESSION['user_id'])) {
    $logoutLink = '<a href="logout.php" class="nav1">Log Out</a>';
} else {
    
    $logoutLink = '<a href="login.php" class="nav1">Log in</a>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>book Shop</title>

    <link rel="stylesheet" href="homecss.css" />
    <style>
     
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .product {
            text-align: center;
        }

        .book img {
            max-width: 130px;
        }

        .book a {
            font-size: 13px;
            font-weight: bold;
            
        }

        .book p {
            font-size: 12px;
        }
        .book label{
            font-size: 12px;
        }
        .add-to-cart-btn {
            background-color: lightskyblue;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            transition-duration: 0.4ms;
        }

        .add-to-cart-btn:hover {
            background-color: red;
        }

        #searchInput {
            height: 30px;
            width: 300px;
        }

        .incre1 {
            width: 20px;
            color: black;
            font-size: 20px;
            height: 20px;
            position: relative;
            top: 3px;
            text-align: center;
            border-style: none;
        }

        .incre2 {
            width: 20px;
            color: black;
            font-size: 20px;
            height: 20px;
            position: relative;
            top: 2px;
            text-align: center;
            border-style: none;
        }

        .num {
            width: 25px;
            text-align: center;
            height: 25px;
            border-style: none;
            margin-bottom: 5px;
        }



        nav {
            font-style: unset;
            height: 30px;
            padding: 1px 2px;
            background-color: white;
            overflow: visible;
            position: absolute;
            width: 98.5%;
            top: 14%;
            z-index: 1;
        }



        #search-bar {
            padding: 8px;
            width: 200px;
            border: 1px solid #ccc2a4;
            border-radius: 4px;
            outline: none;
            position: absolute;
            left: auto;
            right: 44%;
            top: 40px;

        }

        #search-button {
            padding: 9px;
            background-color: #60d745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            position: absolute;
            right: 38%;
            top: 40px;

        }

        .banner-container img {
      
            justify-content: flex-end;
        }

        .add-to-card-button {
            background-color: lightskyblue;
            color: white;
            border-radius: 5px;
            padding: 5px;
            cursor: pointer;
            top: 20px;
            right: 5px;
        }

        .navbar {
            background-color: skyblue;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 12px 14px;
            text-decoration: none;

        }

        .navbar1 .nav1 {
            position: absolute;
            right: 10px;
            top: 2px;
        }

        .navbar1 .nav2 {
            position: absolute;
            right: 100px;
            top: 2px;
        }

        .nav3 {
            position: absolute;
            right: 220px;
            top: 2px;

        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.active {
            background-color: lightskyblue;
            color: white;
        }

        .search-box {

            width: 200px;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .search-btn {

            background-color: lightskyblue;
            color: white;
            padding: 5px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-btn:hover {
            background-color: lightskyblue;
        }

        .search-result {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 5px;
            display: flex;
        }

        .search-result img {
            max-width: 100px;
            margin-right: 10px;
        }
    </style>
    <script>
        function changeValue(input, change) {
            var value = parseInt(input.value, 10) || 0;
            value = Math.max(parseInt(input.min) || 1, Math.min(value + change, parseInt(input.max) || 10));
            input.value = value;
        }

        const images = ["img/ad1.jpg", "img/ad5.jpg", "img/ad4.jpg"];
        let currentIndex = 0;

        function changeImage() {
            const bannerImage = document.querySelector('.banner-image');
            bannerImage.src = images[currentIndex];

            currentIndex = (currentIndex + 1) % images.length;
        }

        setInterval(changeImage, 3000);
    </script>

</head>

<body>
    <div class="navbar">
        <a href="#home" class="active">Home</a>


        <center>
            <div>
                <form action="search.php" method="GET"><input type="text" id="searchInput" name="query" class="search-box" placeholder="Search..."> <button type="submit" class="search-btn">Search</button></form>
            </div>
        </center>
     
        <div class="navbar1">
        <a href="shopingCart.php" class="nav3"><img style="height: 20px; margin-left: 3px;" src="img/cart-shopping-solid.png" alt="">Cart</a>
        <a href="myaccount.php" class="nav2"><img style="height: 20px;" src="img/user1.png" alt="">My Account</a>
        <?php echo $logoutLink; ?>
    </div>
    </div>

    <div id="searchResults"></div>

    <div class="advertisment">
        <div class="banner-container">
            <img class="banner-image" src="img/ad5.jpg" alt="Banner Image">
        </div>
    </div>

    <hr>

    <div class="container" style="width: 100%" id="cartContainer">
        <?php
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_assoc($results)) {
        ?>
                <div class="col-md-3" style="float: right;">
                    <form method="post" action="shopingCart.php?action=add&id=<?php echo $row["book_id"]; ?>">

                        <div class="book">
                            <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                            <a href="view_details.php?id=<?php echo $row['book_id']; ?> "><img src="images/<?php echo $row['book_image']; ?>" width="200px" height="200px" class="img-responsive"></a><br>
                            <a class="text-info"><?php echo $row["book_name"]; ?></a><br>
                            <a class="text-info">(<?php echo $row["catalog_name"]; ?>)</a>
                            <p style="margin: 5px 0;">PRICE: RS.<?php echo $row['price']; ?></p>
                            <label for="quantity" style="margin-bottom: 5px;">Qty:</label>
                            <button type="button" class="incre1" onclick="changeValue(this.parentNode.querySelector('.num'), -1)">-</button>
                            <input type="text" name="qty" value="1" min="1" max="10" class="num">
                            <button type="button" class="incre2" onclick="changeValue(this.parentNode.querySelector('.num'), 1)">+</button><br>
                            <button name="add" class="add-to-cart-btn" style="margin-top: 5px;">Add to Cart</button>
                        </div>

                    </form><br><br>
                </div>
        <?php
            }
        }
        ?>
    </div>

    <script>
        function performSearch() {
            const searchTerm = document.getElementById('searchInput').value;

            if (searchTerm.trim() === '') {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }

      
            fetch(`search.php?query=${searchTerm}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('searchResults').innerHTML = data;
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                });
        }

      
        document.getElementById('searchInput').addEventListener('input', performSearch);
    </script>

    </div>

    <div><br>
        <hr>
        <footer>
            <?php include 'footer.html'; ?>
        </footer>

    </div>


</body>

</html>