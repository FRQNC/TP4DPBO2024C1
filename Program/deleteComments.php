<?php
include_once("models/Template.class.php");
include_once("models/DB.class.php");
include_once("controllers/Comments.controller.php");

$comments = new CommentsController();

if(isset($_GET['id_delete'])){
    $comments->delete($_GET['id_delete']);
}