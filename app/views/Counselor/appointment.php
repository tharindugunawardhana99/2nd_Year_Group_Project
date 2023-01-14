<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <script src="https://kit.fontawesome.com/174ad75841.js" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo URLROOT . "/public/css/Counselor/appointment.css"?>">
  <title></title>
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
        <div class="logo">
            <div class="logo_name"></div>
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
            <i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i>
        </div>
        </div>

    </div>
    <div class="home_content">
        
            
            
                <div class="bottomSection">
                    <div class="div5">
                        <div class="wrap">
                            <div class="wrapper">
                              <header>
                                <p class="current-date"></p>
                                <div class="icons">
                                  <i id="prev" class="fa-solid fa-chevron-left"></i>
                                  <i id="next" class="fa-solid fa-chevron-right"></i>
                                </div>
                              </header>
                              <div class="calendar">
                                <ul class="weeks">
                                  <li>Sun</li>
                                  <li>Mon</li>
                                  <li>Tue</li>
                                  <li>Wed</li>
                                  <li>Thu</li>
                                  <li>Fri</li>
                                  <li>Sat</li>
                                </ul>
                                <form id="form" method="post" action="form.php">
                                  <ul class=" days">
                  
                                  </ul>
                                  <input type="text" id="date" name="date">
                  
                                </form>
                              </div>
                            </div>
                        </div>
                       
                        
                            
                    </div>
                    <div class="div6">
                        <h3>Create an Appointment</h3><br><br>
                        <label for="stu_ID">Student User_ID</label><br>
                        <input type="text"><br><br>
                        <label for="stu_Name">Student Name</label><br>
                        <input type="text"><br><br>
                        <label for="date">Date</label><br>
                        <input type="date"><br><br>
                        <label for="time">Time</label><br>
                        <input type="time"><br><br>
                        <label for="description">Description</label><br>
                        <textarea name="" id="" cols="5" rows="5"></textarea>
                        <button class="postBtn">Add appointment</button>
                    </div>
                </div>
           
            
        
    </div>
  <script src="<?php echo URLROOT . "/public/js/Counselor/appointment.js"?>">
  let btn = document.querySelector("#btn");
  let sidebar = document.querySelector(".sidebar");

  btn.onclick = function(){
    sidebar.classList.toggle("active");
  }
  </script>
</body>

</html>
