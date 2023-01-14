<?php

    class Counselor extends Controller{

        public function announcement(){

            $data = [];

            $this->loadView('Counselor/announcement',$data);
        }


        public function appointment(){

            $data = [];

            $this->loadView('Counselor/appointment',$data);
        }



        public function dashboard(){

            $data = [];

            $this->loadView('Counselor/dashboard',$data);
        }



        public function editDetails(){

            $data = [];

            $this->loadView('Counselor/editDetails',$data);
        }
        public function notification(){

            $data = [];

            $this->loadView('Counselor/notification',$data);
        }
        public function profile(){

            $data = [];

            $this->loadView('Counselor/profile',$data);
        }
        public function student(){

            $data = [];

            $this->loadView('Counselor/student',$data);
        }

       
    }

?>