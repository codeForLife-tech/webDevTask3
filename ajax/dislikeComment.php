<?php
require_once("../includes/config.php");
require_once("../includes/classes/Comment.php");
require_once("../includes/classes/User.php");

$articleId = $_POST["articleId"];
$username=$_SESSION["userLoggedIn"];
$commentId=$_POST["commentId"];

$userLoggedInObj = new User($con, $username);
$comment = new Comment($con, $commentId, $userLoggedInObj, $articleId);
if(!($comment->wasDisLikedBy())) {
    $action="disliked your comment on";
}
else {
    $action="removed the dislike on your commment on";
}
$query=$con->prepare("INSERT INTO notifications(postedBy, article_commentId, action) VALUES(:user, :article_commentId, :action)");
    $query->bindParam(":user", $username);
    $query->bindParam(":article_commentId", $commentId);
    $query->bindParam(":action", $action);
    $query->execute();
echo $comment->dislike();
?>