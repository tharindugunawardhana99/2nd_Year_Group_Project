<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/unauth.css"?>>
    <title>StudentCare</title>
</head>
<body>
    <h1>ERROR: <?php echo $data['err_code']?></h1>
    <img src="<?php echo URLROOT . "/public/img/error.png"?>" alt="error-logo">
    <h3 class="unauth-txt"><?php echo $data['display_data']?></h3>
</body>
</html>