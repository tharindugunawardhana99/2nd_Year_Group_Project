<?php

    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->loadModel('User');
        }

        public function login(){
            //Start the session
            Session::init();

            //Check whether the user is already logged in
            Middleware::isLoggedIn();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //Log the user in and start the session

                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'username_err' => '',
                    'password_err' => ''
                ];

                if(empty($data['username'])){
                    $data['username_err'] = '*Username cannot be Empty';
                }

                if(empty($data['password'])){
                    $data['password_err'] = '*Must Provide Password to Login';
                }
                
                //Check whether a user exists with the given username or email
                if(!$this->userModel->findUserByUsername($data['username']) && !$this->userModel->findUserByEmail($data['username'])){
                    $data['username_err'] = $data['password_err'] = '*Invalid Credentials';
                }
                else{
                    //there exists a user with the given username/email
                    if(!$this->userModel->validatePassword($data['username'], $data['password'])){
                        $data['password_err'] = '*Username and Password does not match';
                    }
                }
                //If no errors are set then log in the user
                if(empty($data['username_err']) && empty($data['password_err'])){
                    if(!$this->userModel->isVerified($data['username'])){
                        //If the user is not verified then he/she should be redirected to unauth page
                        Middleware::redirect('access/verify');
                    }
                    else{
                        $userInfo = $this->userModel->getUserInfo($data['username']);
                        Session::set('userrole', $userInfo->user_role);
                        Session::set('userID', $userInfo->userID);
                        Session::set('username', $userInfo->username);
                        Middleware::redirect(Session::get('userrole') . '/home');
                    }
                }
                else{
                    //load the page with relevant errors
                    $this->loadView('login', $data);
                }
                
            }else{
               //Send the login view with relevant data
               $data = [
                    'username_err' => '',
                    'password_err' => ''
               ];

               $this->loadView('login', $data);
            }
        }

        public function logout(){
            Session::unset('userID');
            Session::unset('username');
            Session::unset('userrole');
            Session::destroy();
            Middleware::redirect('users/login');
        }

        public function register(){
            //Check whether the user is already logged in
            Middleware::isLoggedIn();
            if(isset($_POST['continue'])){
                
                //Start the session
                Session::init();

                //Check and validate the data
                //Set errors if something is wrong
                $name = $_POST['name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $nic = $_POST['nic'];
                $password = $_POST['password'];
                $password_confirm = $_POST['password-confirm'];
                $contact = $_POST['contact'];
                array_key_exists('terms', $_POST)? ($_POST['terms'] = true) : ($_POST['terms'] = false);

                $data = [
                    'name' => trim($_POST['name']),
                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'address' => trim($_POST['address']),
                    'nic' => trim($_POST['nic']),
                    'password' => trim($_POST['password']),
                    'password_confirm' => trim($_POST['password-confirm']),
                    'contact' => trim($_POST['contact']),
                    'terms' => $_POST['terms'],
                    'name_err' => '',
                    'username_err' => '',
                    'email_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'contact_err' => '',
                    'terms_err' => ''

                ];
               
                //Check whether all the fields are filled properly
                if(!$_POST['username'] && !$_POST['name'] && !$_POST['email'] && !$_POST['address'] && !$_POST['nic'] && !$_POST['password'] && !$_POST['password-confirm'] && !$_POST['contact'] && !$_POST['terms']){
                    //echo("Must fill all the fields in the form!");
                    $data['name_err'] =  "*This field is Required";
                    $data['username_err'] = "*This field is Required";
                    $data['email_err'] = "*This field is Required";
                    $data['nic_err'] = "*This field is Required";
                    $data['address_err'] = "*This field is Required";
                    $data['password_err'] = "*This field is Required";
                    $data['confirm_password_err'] = "*This field is Required";
                    $data['contact_err'] = "*This field is Required";
                    $data['terms_err'] = "*You must agree to the terms and conditions before registering";
                    //die();
                }

                //Check whether an account already exists with the provided email
                if($this->userModel->findUserByEmail($email)){
                    //echo("An account has been already registered using this email");
                    $data['email_err'] = "*An account has been already registered using this email";
                    //die();
                }

                //Check whether an account already exists with the provided username
                if($this->userModel->findUserByUsername($username)){
                    //echo("This Username is already taken");
                    $data['username_err'] = "*This Username is already taken";
                    //die();
                }

                //Email is valid or not
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    //echo("Invalid email format");
                    $data['email_err'] = "*Invalid email format";
                    //die();
                }

                //Password and repeated once are matched
                if($_POST['password'] !== $_POST['password-confirm']){
                    //echo("Password mismatch");
                    $data['confirm_password_err'] = "*Password mismatch";
                   // die();
                }

                //password has(Min. 8 len, one character, one letter, one special char)
                if(strlen($password)<8){
                    //echo("Password should have at least 8 characters");
                    $data['password_err'] = "*Password should have at least 8 characters";
                    //die();
                }
                else{
                    if (!preg_match('/[0-9]/', $password)) {
                        //echo("Password must contain at least one number");
                        $data['password_err'] = "*Password must contain at least one number";
                        //die();
                    }
                    else if(!preg_match('/[a-z]/', $password)){
                        //echo('Password must contain at least one lowercase letter');
                        $data['password_err'] = "*Password must contain at least one lowercase letter";
                        //die();
                    }
                    else if(!preg_match('/[A-Z]/', $password)){
                        //echo('Password must contain at least one uppercase letter');
                        $data['password_err'] = "*Password must contain at least one uppercase letter";
                        //die();
                    }
                    else if(!preg_match("/[\[^\'£$%^&*()}{@:\'#~?><>,;@\|\-=\-_+\-¬\`\]]/", $password)){
                        //echo('Password must contain at least one special character');
                        $data['password_err'] = "*Password must contain at least one special character";
                        //die();
                    }
                }

                //Check NIC number 200020902030
                if(!(str_contains($nic,'v') || (str_contains($nic,'V')))){
                    if(strlen($nic) != 12){
                        //echo 'Invalid NIC';
                        $data['nic_err'] = "*Invalid NIC";
                        //die();
                    }
                }
                else{
                    if(strlen($nic) != 10){
                        //echo 'Invalid NIC';
                        $data['nic_err'] = "*Invalid NIC";
                        //die();
                    }
                }   

                //Check the mobile number
                if(strlen($contact) != 10){
                    //echo 'Invalid Contact Number';
                    $data['contact_err'] = "*Invalid Contact Number";
                    //die();
                }

                //Terms and cond. agreement check
                if(!$_POST['terms']){
                    //echo 'You Must Agree to the Terms and Conditions Before Registering to Our Platform.';
                    $data['terms_err'] = "*You Must Agree to the Terms and Conditions Before Registering to Our Platform.";
                    //die();
                }

                //Make sure there are no error flags are set
                if(empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['password_confirm_err']) 
                && empty($data['nic_err']) && empty($data['contact_err']) && empty($data['terms_err'])){
                    
                    //Store the data in session and load the next page if no errors
                    foreach ($_POST as $key => $value){
                        $_SESSION['info'][$key] = $value;
                    }
                    //Storing password as a hash
                    $_SESSION['info']['password'] = password_hash($_SESSION['info']['password'], PASSWORD_DEFAULT);
                    $keys = array_keys($_SESSION['info']);

                    //Unsettings the continue button click variable in session data
                    if(in_array('continue', $keys)){
                        unset($_SESSION['info']['continue']);
                    }

    
                    // echo "<pre>";
                    // if(!empty($_SESSION)){
                    //     print_r($_SESSION['info']);
                    // }
                    // echo "</pre>";
                    
                    //load the view for pick the user role
                    Middleware::redirect('users/pick_userrole');
                }
                else{
                    //load the same page with erros
                    $this->loadView('common-register', $data);
                }
                
            }else{
               //Send the empty register page
               $data = [
                    'name' => '',
                    'username' => '',
                    'email' => '',
                    'address' => '',
                    'nic' => '',
                    'password' => '',
                    'password_confirm' => '',
                    'contact' => '',
                    'terms' => '',
                    'name_err' => '',
                    'username_err' => '',
                    'email_err' => '',
                    'address_err' => '',
                    'nic_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                    'contact_err' => '',
                    'terms_err' => ''

                ];

                $this->loadView('common-register', $data);
            }
        }

        public function pick_userrole(){
            //Check whether the user is already logged in
            Middleware::isLoggedIn();

            if(isset($_POST['role'])){

                //Start the session
                Session::init();

                $choice = $_POST['role'];
                if($choice == '1'){
                   $role = 'student';
                }
                else if($choice == '2'){
                    $role = 'counsellor';
                }
                else if($choice == '3'){
                    $role = 'facility_provider';
                }
                $_SESSION['info']['role'] = $role;
                    Middleware::redirect( 'users/' . $role . '_register');
            }else{
                $this->loadView('userrole-pick');
            }
        }

        public function student_register(){
            //Check whether the user is already logged in
            Middleware::isLoggedIn();

            if(isset($_POST['register'])){

                 //Start the session
                 Session::init();

                //Check and validate the data
                //Set errors if something is wrong
                array_key_exists('terms', $_POST)? ($_POST['terms'] = true) : ($_POST['terms'] = false);


                $data = [
                    'dob' => trim($_POST['dob']),
                    'university' => trim($_POST['university']),
                    'locations' => trim($_POST['locations']),
                    'terms' => $_POST['terms'],
                    'dob_err' => '',
                    'university_err' => '',
                    'terms_err' => ''
                ];

                //Check whether an account already exists with the provided email
                if(empty($_POST['dob'])){
                    //echo("You must provide your Birth date");
                    $data['dob_err'] = "You must provide your Birth date";
                    //die();
                }

                if(empty($_POST['university'])){
                    //echo("You must select your university");
                    $data['university_err'] = "You must select your university";
                    //die();
                }
                

                //Terms and cond. agreement check
                if(!$_POST['terms']){
                    //echo 'You Must confirm the details you have provided to be true and valid';
                    $data['terms_err'] = "You Must confirm the details you have provided to be true and valid";
                    //die();
                }

                //Check whether all the fields are filled properly
                if(!($_POST['dob'] && $_POST['university'] && $_POST['terms'])){
                    //echo("Must fill all the fields in the form!");
                    //die();
                    $data['dob_err'] =  "*This field is Required";
                    $data['university_err'] = "*This field is Required";
                    $data['terms_err'] = "*This field is Required";
                }

                //Make sure there are no error flags are set
                if(empty($data['dob_err']) && empty($data['university_err']) && empty($data['terms_err'])){
                    
                    //Store the data in session and load the next page if no errors
                    foreach ($_POST as $key => $value){
                        $_SESSION['info'][$key] = $value;
                    }

                    $keys = array_keys($_SESSION['info']);

                    //Unsettings the continue button click variable in session data
                    if(in_array('register', $keys)){
                        unset($_SESSION['info']['register']);
                    }
    
                    // echo "<pre>";
                    // if(!empty($_SESSION)){
                    //     print_r($_SESSION['info']);
                    // }
                    // echo "</pre>";

                    
                    //$this->loadView('test', $_SESSION['info']);
                    if($this->userModel->register($_SESSION['info']))
                        //$this->loadView('test', 'Successfully registered as a student');
                        Middleware::redirect('users/verify');
                    else
                        $this->loadView('test', 'Something Went wrong!');
                }
                else{
                    //load the same page with erros
                    $this->loadView('student-register', $data);
                }
                
            }else{
               //Send the login view with relevant data
               $data = [
                'dob' => '',
                'university' => '',
                'locations' => '',
                'terms' => '',
                'dob_err' => '',
                'university_err' => '',
                'terms_err' => ''
               ];

               $this->loadView('student-register', $data);
            }
        }
        
        public function facility_provider_register(){
            //Check whether the user is already logged in
            Middleware::isLoggedIn();

            if(isset($_POST['register'])){

                //Start the session
                Session::init();

                array_key_exists('facility', $_POST)? ($_POST['facility'] = true) : ($_POST['facility'] = false);
                array_key_exists('food', $_POST)? ($_POST['food'] = true) : ($_POST['food'] = false);
                array_key_exists('furniture', $_POST)? ($_POST['furniture'] = true) : ($_POST['furniture'] = false);

                $empty = !$_POST['facility'] && !$_POST['food'] && !$_POST['furniture'];

                $data = [
                    'facility' => $_POST['facility'],
                    'food' => $_POST['food'],
                    'furniture' => $_POST['furniture'],
                    'type_err' => ''
                    ];

                if($empty) $data['type_err'] = "*You must pick at least one of the given choices";

                if(empty($data['type_err'])){

                    $category = [];
                    ($_POST['facility']) ? array_push($category, 'facility') :  '';
                    ($_POST['food']) ? array_push($category, 'food') :  '';
                    ($_POST['furniture']) ? array_push($category, 'furniture') :  '';

                    //Continue and register as a facolity-provider
                    $_SESSION['info']['category'] = $category;
                   
                    if($this->userModel->register($_SESSION['info']))
                        //$this->loadView('test', 'Successfully registered as a Facility Provider');
                        Middleware::redirect('users/verify');
                    else
                        $this->loadView('test', 'Something Went wrong!');


                }else{
                    //load with erros
                    $this->loadView('facility_provider-register',$data);
                }
            }
            else{
                
                $data = [
                    'facility' => '',
                    'food' => '',
                    'furniture' => '',
                    'type_err' => ''
                ];

                $this->loadView('facility_provider-register', $data);
            }
        }

        public function counsellor_register(){
            //Check whether the user is already logged in
            Middleware::isLoggedIn();

            if(isset($_POST['register'])){

                //Start the session
                Session::init();

                //Check and validate the data
                //Set errors if something is wrong
                array_key_exists('terms', $_POST)? ($_POST['terms'] = true) : ($_POST['terms'] = false);

                $filename = $_FILES["verification"]["name"];
                $tempname = $_FILES["verification"]["tmp_name"];
                $folder = APPROOT. "/uploads/" . $filename;
            
                if (move_uploaded_file($tempname, $folder)) {
                    $verification_doc = $filename;
                    unset($_POST['verification']);
                } else {
                    $data['verification_err'] = '*Something went wrong when uploading the file. Try again';
                }

                $dob = $_POST['dob'];
                unset($_POST['dob']);
                $specialization = $_POST['specialization'];
                unset($_POST['specialization']);
                $terms = $_POST['terms'];
                unset($_POST['terms']);
                unset($_POST['register']);
                $qualifications = [];
                
                //Storing all qualifications into an array after isolating them in $_POST
                while(!empty($_POST)){
                    foreach ($_POST as $key => $value){
                        array_push($qualifications, $value);
                        unset($_POST[$key]);
                    }
                }

                //Setting the data
                $data = [
                    'dob' => trim($dob),
                    'specialization' => trim($specialization),
                    'qualifications' => $qualifications,
                    'verification_doc' => $verification_doc,
                    'terms' => $terms,
                    'dob_err' => '',
                    'specialization_err' => '',
                    'qualifications_err' => '',
                    'verification_err' => '',
                    'terms_err' => ''
                ];

                 //Check whether all the fields are filled properly
                 if(!$data['dob'] && !$data['specialization'] && !$data['terms'] && !$data['qualifications'] && !$data['verification_doc']){
                    //echo("Must fill all the fields in the form!");
                    //die();
                    $data['dob_err'] =  "*This field is Required";
                    $data['qualifications_err'] = "*This field is Required";
                    $data['specialization_err'] = "*This field is Required";
                    $data['verification_err'] = "*Verification Document is Required";
                    $data['terms_err'] = "*You must verify the above provided data as true and valid";
                }

                //Check whether an account already exists with the provided email
                if(empty($data['dob'])){
                    //echo("You must provide your Birth date");
                    $data['dob_err'] = "You must provide your Birth date";
                    //die();
                }

                if(empty($data['specialization'])){
                    //echo("You must select your university");
                    $data['specialization_err'] = "You must select your area of specialization";
                    //die();
                }

                if(empty($data['qualifications'])){
                    //echo("You must select your university");
                    $data['qualifications_err'] = "You must provide at least one of your qualifications";
                    //die();
                }

                if(empty($data['verification_doc'])){
                    //echo("You must select your university");
                    $data['verification_err'] = "You must provide a valid verification document to continue";
                    //die();
                }

                //Terms and cond. agreement check
                if(!$data['terms']){
                    //echo 'You Must confirm the details you have provided to be true and valid';
                    $data['terms_err'] = "You Must confirm the details you have provided to be true and valid";
                    //die();
                }

                //Make sure there are no error flags are set
                if(empty($data['dob_err']) && empty($data['qualifications_err']) && empty($data['specialization_err'] && empty($data['terms_err'])  && empty($data['verification_err']))){
                    
                    //Store the data in session and load the next page if no errors
                    $_SESSION['info']['dob'] = $data['dob'];
                    $_SESSION['info']['qualifications'] = $qualifications;
                    $_SESSION['info']['specialization'] = $data['specialization'];
                    $_SESSION['info']['verification_doc'] = $data['verification_doc'];
                    
                    // echo "<pre>";
                    // if(!empty($_SESSION)){
                    //     print_r($_SESSION['info']);
                    // }
                    // echo "</pre>";

                    //$this->loadView('test', $_SESSION['info']);
                    //$this->userModel->register_student();

                    if($this->userModel->register($_SESSION['info']))
                        //$this->loadView('test', 'Successfully registered as a counsellor');
                        Middleware::redirect('users/verify');
                    else
                        $this->loadView('test', 'Something Went wrong!');
                }
                else{
                    //load the same page with erros
                    $this->loadView('counsellor-register', $data);
                }
                
            }else{
               //Send the login view with relevant data
               $data = [
                'dob' => '',
                'specialization' => '',
                'qualifications' => '',
                'verification_doc' => '',
                'terms' => '',
                'dob_err' => '',
                'specialization_err' => '',
                'qualifications_err' => '',
                'terms_err' => ''
            ];

               $this->loadView('counsellor-register', $data);
            }
        }

        public function verify(){
            //Check whether the user is already logged in
            Middleware::isLoggedIn();
            
            Session::init();
            
            $data = [
                'email' => $_SESSION['info']['email']
            ];

            Session::destroy();
            $this->loadView('email-verify', $data);

            //Code for sending verification email
        }

        public function index(){

            $data = [
                'username' => 'Osura'
            ];

            $this->loadView('test',$data);
        }
    
    }
