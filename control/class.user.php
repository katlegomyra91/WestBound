<?php
  class User {

  // FIELDS
    public $user;
    private $db;
    private $t_hasher;

  // CONSTRUCTOR
    public function __construct(){
      require 'class.db.php';
      require 'class.password.hash.php';
      $this->db = DB::getInstance();
      $this->t_hasher = new PasswordHash(8, FALSE);
    }

  // METHODS
    // PRIVATE
      private function get_user_email($email){
        $results = $this->db->select_where("tbl_users", array("*"), array("username"=>$email));
        if (isset($results))
          return $results[0];
        else
          return null;
      }
      private function check_pass($username, $password){
        $results = $this->db->select_where("tbl_users", array("password"), array("username"=>$username));
        if (!empty($results)) {
          if($this->t_hasher->CheckPassword($password, $results[0]['password']))
            return TRUE;
          else
            return FALSE;
        } else {
          return FALSE;
        }
      }

    // PUBLIC
      public function sign_in($username, $password){
        if($this->check_pass($username, $password)){
          $user = $this->get_user_email($username);
          $_SESSION["current_user"] = $user;
          $_SESSION['created'] = time();
          return TRUE;
        } else {
          return FALSE;
        }
      }
      public function sign_up($first_name, $last_name, $username, $password){
        if(!$this->db->insert("tbl_users", array("first_name"=>$first_name,"last_name"=>$last_name,"username"=>$username,"password"=>$this->t_hasher->HashPassword($password)))) { return FALSE; }
        return TRUE;
      }
  }
?>