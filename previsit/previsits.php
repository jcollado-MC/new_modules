<?php
include 'class.myPrevisits.php';
$previsits = new myPrevisits();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Previsits Mockup</title>
    <link rel="stylesheet" type="text/css" href="../columns/styles.css">
    <link rel="stylesheet" type="text/css" href="../FontAwesome/css/all.css">
</head>


<body>
<main>
    <div class="content col-12">
        <?php
        echo $previsits->show();
        ?>
    </div>
</main>
</body>
</html>