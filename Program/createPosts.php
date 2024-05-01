<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Posts.controller.php");

$posts = new PostsController();

if (isset($_POST['add'])) {
  $posts->add($_POST);
} else{
    $posts->addView();
}