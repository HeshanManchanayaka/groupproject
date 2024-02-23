<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .div1{
            display: flex;
            position: relative;
            left: 350px;
            top: 80px
        }
        .add{
            text-align:center;
            padding: 1%;
        }
     
        
    </style>
</head>
<body>

    <?php
       
    ?>
    
    <center>
    
        <h1>Welcome to Admin Dashboard</h1>
        <a href="logout.php"><button class="logout">Log Out</button></a>
    </center>
   
    <div class="div1">
    <div class="add">
    <a href="addbook.php"><img src="bookManagement.png" style="width:200px";></a>
    <p>Books Manegment</p>
    </div>

    <div class="add">
    <a href="managecustomer.php"><img src="customer.webp" style="width:230px";></a>
    <p>Customer Manegment</p>
    </div>

    <div class="add">
    <a href="admin_reg.php"><table>
    <img src=admin.jpg style="width:230px";>
    </table></a>
    <p>Admin Manegment</p>
    </div>
    </div1>
    

</body>
</html>