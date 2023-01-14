
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/announcement.css"?>">
  <title></title>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
        <div class="logo">
            <div class="logo_name">STUDENTCARE</div>
        </div>
        <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <ul class="nav_list">
        <li>
            <a href="#">
            <i class="fa-solid fa-gauge"></i>
            <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="#">
            <i class="fa-solid fa-user-pen"></i>
            <span class="links_name">Edit Profile</span>
            </a>
            <span class="tooltip">Edit Profile</span>
        </li>
        <li>
            <a href="#">
            <i class="fa-solid fa-users"></i>
            <span class="links_name">View Student</span>
            </a>
            <span class="tooltip">View Student</span>
        </li>
        <li>
            <a href="#">
            <i class="fa-solid fa-bell"></i>
            <span class="links_name">Notification</span>
            </a>
            <span class="tooltip">Notification</span>
        </li>
        <li>
            <a href="#">
            <i class="fa-solid fa-calendar-check"></i></i>
            <span class="links_name">Appointments</span>
            </a>
            <span class="tooltip">Appointments</span>
        </li>
        <li>
            <a href="#">
            <i class="fa-solid fa-bullhorn"></i></i>
            <span class="links_name">Announcements</span>
            </a>
            <span class="tooltip">Announcements</span>
        </li>
        <li>
            <a href="#">
            <i class="fa-solid fa-rectangle-list"></i>
            <span class="links_name">Report</span>
            </a>
            <span class="tooltip">Report</span>
        </li>
        </ul>
        <div class="profile_content">
        <div class="profile">
            <div class="profile_details">
            <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bWFufGVufDB8fDB8fA%3D%3D&w=1000&q=80" alt="">
            <div class="name">
                Oshada
            </div>
            </div>
            <a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i></a>
        </div>
        </div>

    </div>
    <div class="home_content">
        
            
            <div class="div4">
                <div class="topSection">
                    <input class="search" type="search" placeholder="search">
                    <select class="selector"> 
                        <option>All announcements</option> 
                        <option>My announcements</option>
                    </select>
                </div>
                <div class="bottomSection">
                    <div class="div5">
                        <?php foreach ($posts as $ann_post): ?>
                            <div class="annDescription">
                                <div class="dp">
                                    <h4 class="uName"><?= $ann_post->{'username'} ?></h4>
                                    <img class="dpImg" src="Images/andrew-power-y9L5-wmifaY-unsplash.jpg" alt=""><br>
                                    <?php if($ann_post->username === $_SESSION['username']) : ?>
                                        <form action="post.php" method="POST">
                                            <div class="buttonU">
                                                <button class="btnEdit" name="btnEdit" type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <input type="hidden" name="id" value="<?php echo $ann_post->{'post_id'};?>">
                                                <button class="btnDlt" name="btnDlt" type="submit" ><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        </form>
                                    <?php endif;?>
                                
                                </div>
                                <div class="description">
                                    <?= $ann_post->{'post_desc'}; ?><br><br>
                                    <?= $ann_post->{'date'} ;?>
                                    
                                </div>
                            </div>
                        <?php endforeach ?> 
                    </div>
                    <div class="div6">
                        <form action="post.php" method="post">
                            <h3>Create a post</h3>
                            <?php if($ann_post->{'post_id'} == $_POST['id']): ?>
                            <textarea class="postDesc" name="postDesc" id="" placeholder="Description" rows = "15" cols = "5"><?= $ann_post->{'post_desc'}; ?></textarea>
                            <?php endif; ?>
                            <button class="postBtn" name="submit">Post announcement</button>
                        </form>
                    </div>
                </div>
            </div>
            
        
    </div>
  <script>
  let btn = document.querySelector("#btn");
  let sidebar = document.querySelector(".sidebar");

  btn.onclick = function(){
    sidebar.classList.toggle("active");
  }
  </script>
</body>

</html>
