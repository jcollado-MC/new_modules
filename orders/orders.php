<?php
include 'class.myOrders.php';
$order = new myOrders();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Mockup</title>
    <link rel="stylesheet" type="text/css" href="../columns/styles.css">
    <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
</head>


<body>
<main>
    <div class="content col-12">
        <?php
        echo $order->show();
        ?>
    </div>
</main>
</body>
</html>
