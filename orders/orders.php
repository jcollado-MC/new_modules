
<?php
include 'class.ordereditor.php';
$order = new OrderEditor();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders Mockup</title>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://bossanova.uk/jexcel/v4/jexcel.js'></script>
    <script src='https://bossanova.uk/jsuites/v2/jsuites.js'></script>
    <link rel='stylesheet' href='https://bossanova.uk/jexcel/v4/jexcel.css' type='text/css' />
    <link rel='stylesheet' href='https://bossanova.uk/jsuites/v2/jsuites.css' type='text/css' />
    <link rel="stylesheet" type="text/css" href="../columns/styles.css">
    <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
</head>


<body>
<main>
    <div class="content col-12">
        <?php
        echo $order->show($_GET['id']);
        ?>
    </div>
</main>
</body>
</html>
