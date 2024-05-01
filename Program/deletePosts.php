<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Posts.controller.php");

$posts = new PostsController();

if(isset($_GET['id_delete'])){
    $posts->delete($_GET['id_delete']);
}