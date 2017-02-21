<?php
  class DB {
  // FIELDS
    private $db;
    private static $instance;

    // Constructor
    private function __construct() {
      $this->db = new mysqli("localhost", "root", "", "westbound_demo");
    
      // Error handling
      if(@mysqli_connect_error()) {
        trigger_error("Failed to connect to MySQL: " . @mysqli_connect_error(),
           E_USER_ERROR);
      }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
    // Get mysqli connection
    public function getConnection() {
      return $this->db;
    }

    //Get an instance of the Database
    public static function getInstance() {
      if(!self::$instance)
        self::$instance = new self();
      return self::$instance;
    }

    //Function to Create Table
    public function create_table($sql){
      //Create Table
      if ($this->db->query($sql) === TRUE) {
          return TRUE;
      } else {
          return FALSE;
      }
    }//End of function CreateTable

    //Fetch data by accepting table name and columns(1 dimentional array) name
    public function select($table, array $columns){
      $columns=implode(",",$columns);
      $result=$this->db->query("SELECT $columns FROM $table");
    
      if($this->db->errno){
        die("Fail Select ".$this->db->error);
      }

      //return tow dimentional array as required columns result
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Fetch data by accepting table name and columns(1 dimentional array) name
    public function select_function($function_name){
      $result=$this->db->query("SELECT $function_name");

      if($this->db->errno){
        die("Fail Select ".$this->db->error);
      }

      //return tow dimentional array as required columns result
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    //Fetch data by accepting table name and columns(1 dimentional array) and where condition
    public function select_where($table, array $columns, array $condition){
      $columns=implode(",",$columns);
      
      $i=0;
      foreach($condition as $key=>$value) {
        $cod[$i] = "`".$key."` = '".$value."'";
          $i++;
      }
      $Stcod = implode(" AND ",$cod);

      $result=$this->db->query("SELECT $columns FROM `$table` WHERE $Stcod");
    
      if($this->db->errno){
        die("Fail Select ".$this->db->error);
      }

      //return tow dimentional array as required columns result
      return $result->fetch_all(MYSQLI_ASSOC);
    }

    # Insert Data within table by accepting TableName and Table column => Data as associative array
    public function insert($tblname, array $val_cols){
      $keysString = implode("`, `", array_keys($val_cols));

      $i=0;
      foreach($val_cols as $key=>$value) {
        $StValue[$i] = "'".$value."'";
          $i++;
      }

      $StValues = implode(", ",$StValue);
      
      if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      //Perform Insert operation
      if($this->db->query("INSERT INTO $tblname (`$keysString`) VALUES ($StValues)") === TRUE){
        return TRUE;
      }else{
        echo "Error ".$this->db->error;
        return FALSE;
      }
    }//End of function insert

    //Update data within table; Accepting Table Name and Keys=>Values as associative array
    public function update($tblname, array $set_val_cols, array $cod_val_cols){
      //append set_val_cols associative array elements 
      $i=0;
      foreach($set_val_cols as $key=>$value) {
        $set[$i] = "`".$key."` = '".$value."'";
          $i++;
      }

      $Stset = implode(", ",$set);

      //append cod_val_cols associative array elements
      $i=0;
      foreach($cod_val_cols as $key=>$value) {
        $cod[$i] = "`".$key."` = '".$value."'";
          $i++;
      }

      $Stcod = implode(" AND ",$cod);

      //Update operation
      if($this->db->query("UPDATE `$tblname` SET $Stset WHERE $Stcod") === TRUE){
        if(mysqli_affected_rows($this->db)){
          return TRUE;
        }
        else{
          return FALSE;
        }
      }else{
        echo "Error to update".$this->db->error;
        return FALSE;
      }
    }

    //Delete data form table; Accepting Table Name and Keys=>Values as associative array
    public function delete($tblname, array $val_cols){
      //Append each element of val_cols associative array 
      $i=0;
      foreach($val_cols as $key=>$value) {
        $exp[$i] = "`".$key."` = '".$value."'";
          $i++;
      }

      $Stexp = implode(" AND ",$exp);

      //Perform Delete operation
      if($this->db->query("DELETE FROM `$tblname` WHERE $Stexp") === TRUE){
        if(mysqli_affected_rows($this->db)){
          return TRUE;
        }
        else{
          return FALSE;
        }
      }
      else{
        echo "Error to delete".$this->db->error;
        return FALSE;
      }
    }

    //Call destructor function 
    public function __destruct() {
      if($this->db){
        // Close the db
            $this->db->close();
          } 
    }
  }
?>