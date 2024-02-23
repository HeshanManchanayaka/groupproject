<html>

<head>
    <style>
        .addform {
            position: relative;
            width: 500px;
            background-color: #3adee6;
            font-family: Arial, sans-serif;
            padding: 5px;
        }

        fieldset {
            border: hidden;
        }

        .backbtn:hover {
            color: blue;
        }

        .div {
            position: absolute;
            left: 10;
        }

        .submit {
            font-size: 15px;
            width: 60px;
            height: 40px;
        }

        .photo {
            width: 800px;
            position: relative;
            left: 0;
            height: 650;
            object-fit: cover;
        }

        .div {
            display: flex;
        }

        body {

            margin: 0;
        }
        .delete{
            background-color: #3adee6;
            max-width: 35%;
        }
        .submit2{
            font-size: 15px;
            width: 70px;
            height: 40px;
            text-align: center;
        }
    </style>

</head>

<body>


    <div>
        <center>
            <h1>Add Books</h1>
            <form class="addform" method="POST" action="add_book.php" enctype="multipart/form-data">

                <fieldset>
                    <label>Book Image</label><br>
                    <input type="file" name="filename" accept=".jpg, .jpeg, .png, image/*"><br><br>
                    <label>Book Name</label><br>
                    <input type="text" name="bookName"><br><br>
                    <label>Book Categary</label><br>
                    <select name="bookCategory" id="cata">
                        <option value="child">Children's books</option>
                        <option value="shortStory">Short Story</option>
                        <option value="novel">novel</option>
                        <option value="educational">Educational</option>
                    </select>
                    <br><br>
                    <label> Price</label><br>
                    <input type="text" name="bookPrice"><br><br>
                    <label>Add Qty</label><br>
                    <input type="text" name="addQty"><br><br><br>
                    <button class="submit" type="submit" name="submit">SAVE</button><br>
                </fieldset>
            </form>
        </center>
       
    </div>
    <div>
        <center>
            <h1>Delete Books</h1>
         
            <?php
            require_once 'config.php';

            $selectQuery = "SELECT book_id, book_name FROM book";
            $result = mysqli_query($conn, $selectQuery);

            if ($result) {
            ?>
                <form  class="delete" method="POST" action="delete_book.php">
                    <fieldset>
                        <label>Select Book to Delete</label><br>
                        <select name="deleteBookId">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['book_id']; ?>"><?php echo $row['book_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select><br><br>
                        <button class="submit2" type="submit" name="submit">DELETE</button><br>
                    </fieldset>
                </form>
            <?php
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            mysqli_close($conn);
            ?>
        </center>
        <center>
            <form action="admin.php" class="backbtn">
                <button class="backbtn">Back</button>
            </form>
        </center>
    </div>
</body>

</html>