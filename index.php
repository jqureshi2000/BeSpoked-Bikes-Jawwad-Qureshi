<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeSpoked Bikes</title>

    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="BeSpokeLogo.jpg">
    <link rel= "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <div id ="landing">
        <div id ="header" class = "animate__animated animate__fadeInDown">
            <h1 class = "AttentionGrabber">BeSpoked Bikes</h1>
        </div>

        <div id = "infobox" class = "animate__animated animate__fadeInLeftBig">
            <h1>Welcome to BeSpoked Bikes</h1>
            <h3><i>Change your biking experience with our high-end bicycles</i></h3>
            <p>My name is Jawwad Qureshi, and this is my BeSpoked Bikes Sample Application Submission.
                Hope this reaches you well and I am able to <br> display my knowledge of full-stack development.
                <br><br><br> Looking forward to meeting with you all Friday morning!
            </p>
        </div>

        <a href = "#secondary"><button type = "button" id = "cta" class = "animate__animated animate__fadeInLeft">Click here to see my submission ↓</button></a>

    </div>

    <script>
      function show(nr) {
        document.getElementById("table1").style.display="none";
        document.getElementById("table2").style.display="none";
        document.getElementById("table3").style.display="none";
        document.getElementById("table4").style.display="none";
        document.getElementById("table"+nr).style.display="block";
      }
    </script>

    <div id ="secondary">
        <h1 class = "informationHeader">
          Please click on the buttons for more information
        </h1>
        <div class="buttongui">
          <a href="#secondary" onclick='show(1);'><button type="button" id = "displayTable">View List of Sales Persons</button></a> <br><br><br>
          <a href="#secondary" onclick='show(2);'>  <button type="button" id = "displayTable">View List of Products</button></a> <br><br><br>
          <a href="#secondary" onclick='show(3);'>  <button type="button" id = "displayTable">View List of Customers</button></a> <br><br><br>
          <a href="#secondary" onclick='show(4);'>  <button type="button" id = "displayTable">View List of Sales</button></a> <br><br><br>
          <a href="#formsubmission"><button type="button" id = "displayTable">Update Database</button></a>
        </div>

        <div id = "table1">
          <?php
            include("connection1.php");

            $q = mysqli_query($dbc, "SELECT * FROM salesperson ORDER BY LastName ASC");
            echo "<table> <tr>
                  <td> <b> Salesperson's Name </b> </td>
                  <td> <b> Address </b> </td>
                  <td> <b> Phone </b> </td>
              </tr>";

              while ($row = mysqli_fetch_array($q)) {
                echo "<tr> <td align = 'left'>".$row['FirstName'].' '.$row['LastName']."</td> <td>".$row['Address']."</td> <td>".$row['Phone']."</td> </tr>";
                echo "<br>";
              }

            echo "</table>";
          ?>
        </div>

        <div  id = "table2">
          <?php
            include("connection1.php");

            $p = mysqli_query($dbc, "SELECT * FROM products ORDER BY Name");
            echo "<table> <tr>
                  <td> <b> Product Name</b> </td>
                  <td> <b> Manufacturer </b> </td>
                  <td> <b> Sale Price </b> </td>
              </tr>";

              while ($row = mysqli_fetch_array($p)) {
                echo "<tr> <td align = 'left'>".$row['Name']."</td> <td>".$row['Manufacturer']."</td> <td>".'$'.$row['SalePrice']."</td> </tr>";
                echo "<br>";
              }

            echo "</table>";
          ?>
        </div>  

        <div  id = "table3">
          <?php    
            include("connection1.php");

            $c = mysqli_query($dbc, "SELECT * FROM customer ORDER BY LastName ASC");
            echo "<table> <tr>
                  <td> <b> Customer's Name </b> </td>
                  <td> <b> Address </b> </td>
                  <td> <b> Phone </b> </td>
              </tr>";

              while ($row = mysqli_fetch_array($c)) {
                echo "<tr> <td align = 'left'>".$row['FirstName'].' '.$row['LastName']."</td> <td>".$row['Address']."</td> <td>".$row['Phone']."</td> </tr>";
                echo "<br>";
              }

            echo "</table>";
            mysqli_close($dbc);
          ?>
        </div>

        <div  id = "table4">
          <?php    
            include("connection1.php");

            $saleProduct = mysqli_query($dbc, 
            "SELECT *
            FROM sales, products
            WHERE sales.ProductID = products.ProductID");

            $saleC = mysqli_query($dbc,
            "SELECT *
            FROM sales, customer
            WHERE sales.CustomerID = products.CustomerID");

            echo "<table> <tr>
                  <td> <b> Product </b> </td>
                  <td> <b> Customer </b> </td>
                  <td> <b> Date </b> </td>
                  <td> <b> Price </b> </td>
                  <td> <b> Salesperson </b> </td>
                  <td> <b> Salesperson's Commission </b> </td>
              </tr>";

              while ($row = mysqli_fetch_array($saleProduct)) {
                echo "<tr> <td align = 'left'>".$row['Name']."</td>"
                ;
                echo "<br>";
              }

            echo "</table>";
            mysqli_close($dbc);
          ?>
        </div>

        <div id = "formsubmission">
          <?php 
          $fname = $fnameErr = $lname = $lnameErr = $address = $addressErr = $phone = $phoneErr = $manager = $managerErr =  " ";
          $name = $nameErr = $manufacturer = $manufacturerErr = $style = $styleErr = $pprice = $ppriceErr = $sprice = $spriceErr = $quantity = $quantityErr = $cpercentage = $cpercentageErr = " ";
          $flag = 0;    

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($_POST['submit_1']) {
              if (empty($_POST["fname"])) {
                $fnameErr = "First Name is required";
                $flag = 1;
              }
              else {
                $fname = testInput($_POST["fname"]);
                if (!preg_match("/^[a-zA-Z' ]*$/",$fname)) {
                  $fnameErr = "Only letters and white space allowed";
                  $flag = 1;
                }
              }  
  
              if (empty($_POST["lname"])) {
                $lnameErr = "Last Name is required";
                $flag = 1;
              }
              else {
                $lname = testInput($_POST["lname"]);
                if (!preg_match("/^[a-zA-Z' ]*$/",$lname)) {
                  $lnameErr = "Only letters and white space allowed";
                  $flag = 1;
                }
              }  
  
              if (empty($_POST["phone"])) {
                $phoneErr = "Phone is required";
                $flag = 1;
              }
              else {
                $phone = testInput($_POST["phone"]);
                if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)) {
                  $phoneErr = "Invalid Phone Format";
                  $flag = 1;
                }
              }
  
              if (empty($_POST["manager"])) {
                $managerErr = "Manager's name is required";
                $flag = 1;
              }
              else {
                $manager = testInput($_POST["manager"]);
                if (!preg_match("/^[a-zA-Z' ]*$/",$manager)) {
                  $managerErr = "Only letters and white space allowed";
                  $flag = 1;
                }
              } 

              if ($flag == 0) {
                include("connection1.php");
  
                $q = mysqli_query($dbc, "SELECT * FROM salesperson WHERE Phone = '$phone'");
                $num_phone = mysqli_num_rows($q);
                if ($num_phone!=0){
                  echo "Phone number has been used! Please us another phone number. <br>";
                }
  
                if ($num_phone == 0) {
                  mysqli_query($dbc, "INSERT INTO salesperson(FirstName, LastName, Address, Phone, Manager) VALUES('$fname','$lname','$address','$phone','$manager')");
                  $registered = mysqli_affected_rows($dbc);
                  echo $registered." rows affected";
                }
              }
            } else {
                if (empty($_POST["name"])) {
                  $nameErr = "Product Name is required";
                  $flag = 1;
                }
                else {
                  $name = testInput($_POST["name"]);
                  if (!preg_match("/^[a-zA-Z' ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed";
                    $flag = 1;
                  }
                }  
    
                if (empty($_POST["manufacturer"])) {
                  $manufacturerErr = "Manufacturer Name is required";
                  $flag = 1;
                }
                else {
                  $manufacturer = testInput($_POST["manufacturer"]);
                  if (!preg_match("/^[a-zA-Z' ]*$/",$manufacturer)) {
                    $manufacturerErr = "Only letters and white space allowed";
                    $flag = 1;
                  }
                }
    
                if (empty($_POST["style"])) {
                  $styleErr = "Style is required";
                  $flag = 1;
                }
                else {
                  $style = testInput($_POST["style"]);
                  if (!preg_match("/^[a-zA-Z' ]*$/",$style)) {
                    $styleErr = "Only letters and white space allowed";
                    $flag = 1;
                  }
                }

                if (empty($_POST["pprice"])) {
                  $ppriceErr = "Purchase Price is required";
                  $flag = 1;
                }


                if (empty($_POST["sprice"])) {
                  $spriceErr = "Sale Price is required";
                  $flag = 1;
                }

                if (empty($_POST["quantity"])) {
                  $quantityErr = "Quantity is required";
                  $flag = 1;
                }

                if (empty($_POST["cpercentage"])) {
                  $cpercentageErr = "Sale Price is required";
                  $flag = 1;
                }

                if ($flag == 0) {
                  include("connection1.php");
    
                  $q = mysqli_query($dbc, "SELECT * FROM products WHERE Name = '$name'");
                  $num_products = mysqli_num_rows($q);
                  if ($num_products!=0){
                    echo "Product has been used! Please enter a new product. <br>";
                  }
    
                  if ($num_products == 0) {
                    mysqli_query($dbc, "INSERT INTO products(Name, Manufacturer, Style, PurchasePrice, SalePrice, QtyOnHand, CommissionPercentage) VALUES('$name', '$manufacturer', '$style', '$pprice', '$sprice', '$quantity', '$cpercentage')");
                    $registered = mysqli_affected_rows($dbc);
                    echo $registered." rows affected";
                  }
                }
              }
            }
          ?>

          <?php
          function testInput($data) {
            $data = trim($data);
            $data = htmlspecialchars($data);
            $data = stripslashes($data);
            return $data;
          }
          ?>

          <h1>Enter new Sales Person</h1>

          <p><span class = "error">*</span> Required Field </p>
          <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          First Name: <input type = "text" name = "fname" value="<?php echo $fname; ?>"  maxlength = "50">
          <span class = "error">* <?php echo $fnameErr; ?></span>
          <br><br>

          Last Name: <input type = "text" name = "lname" value="<?php echo $lname; ?>"  maxlength = "50">
          <span class = "error">* <?php echo $lnameErr; ?></span>
          <br><br>

          Address: <input type = "text" name = "Address" value="<?php echo $address; ?>"  maxlength = "100">
          <span class = "error">* <?php echo $addressErr; ?></span>
          <br><br>

          Phone: <input type = text name = "phone" value= "<?php echo $phone; ?>" maxlength = "12">
          <span class = "error">* <?php echo $phoneErr; ?></span>
          <br><br>

          Manager: <input type = text name = "manager" value= "<?php echo $manager; ?>" maxlength = "10">
          <span class = "error">* <?php echo $managerErr; ?></span> 
          <br><br>
          <input type = "submit" name = "submit_1" value = "submit"> 
          </form>

          <hr>

          <h1>Enter new Product</h1>

          <p><span class = "error">*</span> Required Field </p>
          <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          Name: <input type = "text" name = "name" value="<?php echo $fname; ?>"  maxlength = "50">
          <span class = "error">* <?php echo $fnameErr; ?></span>
          <br><br>

          Manufacturer: <input type = "text" name = "manufacturer" value="<?php echo $manufacturer; ?>"  maxlength = "50">
          <span class = "error">* <?php echo $manufacturerErr; ?></span>
          <br><br>

          Style: <input type = "text" name = "style" value="<?php echo $style; ?>"  maxlength = "100">
          <span class = "error">* <?php echo $styleErr; ?></span>
          <br><br>

          Purchase Price: <input type = text name = "pprice" value= "<?php echo $pprice; ?>" maxlength = "12">
          <span class = "error">* <?php echo $ppriceErr; ?></span>
          <br><br>

          Sale Price: <input type = text name = "sprice" value= "<?php echo $sprice; ?>" maxlength = "10">
          <span class = "error">* <?php echo $spriceErr; ?></span> 
          <br><br>

          Quantity on Hand: <input type = text name = "quantity" value= "<?php echo $quantity; ?>" maxlength = "10">
          <span class = "error">* <?php echo $quantityErr; ?></span> 
          <br><br>

          Commission Percentage: <input type = text name = "cpercentage" value= "<?php echo $cpercentage; ?>" maxlength = "10">
          <span class = "error">* <?php echo $cpercentageErr; ?></span> 
          <br><br>

          <input type = "submit"> 
          </form>

        </div>


    </div>

</body>
</html>
