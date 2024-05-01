<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Comments.controller.php");

$comments = new CommentsController();

if (isset($_POST['edit'])) {
  $comments->confirmEdit($_POST);
} else if(isset($_GET['id_edit'])){
    $comments->editView($_GET['id_edit']);
}
else{
  header("location:index.php");
}