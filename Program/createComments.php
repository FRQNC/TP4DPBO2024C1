<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Comments.controller.php");

$comments = new CommentsController();

if (isset($_POST['add'])) {
  $comments->add($_POST);
} else{
    $comments->addView();
}