<?php
     $data = [
        'dob_err' => '',
        'specialization_err' => '',
        'qualifications_err' => '',
        'verification_err' => '',
        'terms_err' => ''

    ];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=<?php echo URLROOT . "/public/css/counsellor-register.css"?>>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src=<?php echo URLROOT . "/public/js/counsellor-register.js"?> defer></script>
</head>
<body>
    <div class="header">
        <a href= "<?php echo URLROOT?>/users/login">Already have an Account?</a>
        <button class="login">Login Here</button>
    </div>
    <div class="form-container">
        <h1>Registering as a Counsellor</h1>
        <form action="./counsellor_register" method="post" enctype="multipart/form-data">
            <?php 
                if($data['dob_err'])
                   echo '<div class="form-field" data-error=" ' . $data['dob_err'] . '">';
                else
                   echo '<div class="form-field">';
            ?>
                <label for="dob" class="lable">Date of Birth:</label><br>
                <input type="date" name="dob" id="dob" class="form-input">
            </div>
            <?php 
                if($data['specialization_err'])
                   echo '<div class="form-field" data-error=" ' . $data['specialization_err'] . '">';
                else
                   echo '<div class="form-field">';
            ?>
                <label for="specialization" class="lable">Specialization:</label><br>
                <input type="" name="specialization" id="specialization" class="form-input">
            </div>
            <?php 
                if($data['qualifications_err'])
                   echo '<div class="form-field" id="qualifications" data-error=" ' . $data['qualifications_err'] . '">';
                else
                   echo '<div class="form-field" id="qualifications">';
            ?>
                <label for="qualifications" class="lable">Qualification(s):</label><br>
                <input type="" name="qualifications" id="qualification" class="form-input">
                <button class="add" id="add-new">+ Add Another</button>
            </div>
            <?php 
                if($data['verification_err'])
                   echo '<div class="form-field" data-error=" ' . $data['verification_err'] . '">';
                else
                   echo '<div class="form-field">';
            ?>
                <label for="verification" class="lable">Verification Document:</label><br>
                <input type="file" name="verification" id="verification" class="form-input">
            </div>
            <?php 
                if($data['terms_err'])
                   echo '<div class="form-field" id="terms-cond" data-error=" ' . $data['terms_err'] . '">';
                else
                   echo '<div class="form-field" id="terms-cond">';
            ?>
                <input type="checkbox" name="terms" id="terms" class="form-input">
                <span class="note">I hereby declare that the information given above is true and accurate to the best of my knowledge</span>
            </div>
            <div class="form-field">
                <p class="note2">Note: The registration procedure for counsellor is differ from other users so that our admins have to manually verify each profile which will take few days just to ensure a safe space for the user community and to provide a better service from our platfrom. Don’t worry, an email will be sent to notify you once it is completed.</p>
            </div>
            <input type="submit" value="Register Me" class="button" name="register">
        </form>
    </div>
    <img src=<?php echo URLROOT . "/public/img/counsellor-banner.jpg"?> alt="counsellor-banner" id="background">
</body>
</html>