<?php
  class App {

  // FIELDS
    private $db;

  // CONSTRUCTOR
    public function __construct(){
      require 'class.db.php';
      $this->db = DB::getInstance();
    }

  // METHODS
    // PUBLIC
      public function header(){
        echo '<div id="header" class="header navbar navbar-default navbar-fixed-top">';
        echo '<div class="container-fluid">';
        echo '<div class="navbar-header">';
        echo '<a href="index.php" class="navbar-brand"><i class="fa fa-won"></i>estBound</a>';
        echo '<button type="button" class="navbar-toggle" data-click="sidebar-toggled">';
        echo '<span class="icon-bar"></span>';
        echo '<span class="icon-bar"></span>';
        echo '<span class="icon-bar"></span>';
        echo '</button>';
        echo '</div>';
        echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li class="dropdown navbar-user">';
        echo '<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">';
        echo '<span class="hidden-xs">'.$_SESSION['current_user']['first_name'].' '.$_SESSION['current_user']['last_name'].'</span> <b class="caret"></b>';
        echo '</a>';
        echo '<ul class="dropdown-menu animated fadeInLeft">';
        echo '<li class="arrow"></li>';
        echo '<li><a href="../logout.php">Log Out</a></li>';
        echo '</ul>';
        echo '</li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';
      }
      public function sidebar($active){
        echo '<div id="sidebar" class="sidebar">';
        echo '<div data-scrollbar="true" data-height="100%">';
        echo '<ul class="nav">';
        echo '<li class="nav-profile">';
        echo '<div class="info">'.$_SESSION['current_user']['first_name'].' '.$_SESSION['current_user']['last_name'];
        echo '</div>';
        echo '</li>';
        echo '</ul>';
        echo '<ul class="nav">';
        if($active['main'] == "dashboard")
          echo '<li class="active"><a href="index.php"><i class="fa fa-laptop"></i><span> Dashboard</span></a></li>';
        else
          echo '<li><a href="index.php"><i class="fa fa-laptop"></i><span> Dashboard</span></a></li>';
        echo '<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>';
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        echo '<div class="sidebar-bg"></div>';
      }
      public function get_cinemas(){
        $results = $this->db->select("tbl_cinemas", array("*"));
        if (isset($results)) {
          return $results;
        }
        else
          return null;
      }
      public function get_cinema_details($id){
        $cinema = $this->db->select_where("tbl_cinemas", array("name"), array("id"=>$id));
        $movies = $this->db->select_function("s.`id`, c.`name` AS `cinema_name`, m.`name` AS `movie_name` FROM `tbl_showing` s INNER JOIN `tbl_cinemas` c ON s.`cinema_id` = c.`id` INNER JOIN `tbl_movies` m ON s.`movie_id` = m.`id` WHERE s.`cinema_id` = $id");
        return array("name"=>$cinema[0]['name'],"data"=>$movies);
      }
  }
?>