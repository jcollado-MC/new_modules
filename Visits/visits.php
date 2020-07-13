<?php
include 'class.myVisits.php';
$visits = new myVisits();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visits Mockup</title>
    <script src="../Jquery/jquery-3.4.1.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../columns/styles.css">
    <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
</head>


<body>
<main>
    <div class="content col-12">
        <?php
        echo $visits->show();
        ?>
    </div>
</main>
</body>
</html>
