<?php
require_once("../includes/config.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/User.php");

$articleId = $_POST["articleId"];
$username=isset($_SESSION["userLoggedIn"])?$_SESSION["userLoggedIn"]:"";
$commentId=$_POST["commentId"];

$userLoggedInObj = new User($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $articleId);

echo $comment->getReplies();
?>