<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Members.controller.php");

$members = new MembersController();

if (isset($_POST['edit'])) {
  $members->confirmEdit($_POST);
} else if(isset($_GET['id_edit'])){
    $members->editView($_GET['id_edit']);
}
else{
  header("location:index.php");
}