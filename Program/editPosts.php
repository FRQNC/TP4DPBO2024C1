<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Posts.controller.php");

$posts = new PostsController();

if (isset($_POST['edit'])) {
  $posts->confirmEdit($_POST);
} else if(isset($_GET['id_edit'])){
    $posts->editView($_GET['id_edit']);
}
else{
  header("location:index.php");
}