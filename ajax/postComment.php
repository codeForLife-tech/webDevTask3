<?php
require_once("../includes/config.php");
require_once("../includes/classes/User.php");
require_once("../includes/classes/Comment.php");

if(isset($_POST['commentText']) && isset($_POST['postedBy']) && isset($_POST['articleId'])) {
    $userLoggedInObj=new User($con, $_SESSION["userLoggedIn"]);
    
    $query=$con->prepare("INSERT INTO comments(postedBy, articleId, responseTo, body)
                          VALUES(:postedBy,:articleId,:responseTo,:body)");
    $query->bindParam(":postedBy", $postedBy);
    $query->bindParam(":articleId", $articleId);
    $query->bindParam(":responseTo", $responseTo);
    $query->bindParam(":body", $commentText);

    $postedBy=$_POST['postedBy'];
    $articleId=$_POST['articleId'];
    $responseTo=isset($_POST['responseTo']) ? $_POST['responseTo'] : 0;
    $commentText=$_POST['commentText'];

    $query->execute();

    
    $newComment = new Comment($con, $con->lastInsertId(), $userLoggedInObj, $articleId);
    if($responseTo==0) {
        $action="commented on";
        $commentId=$articleId;
    }
    else {
        $action="replied to your comment on";
        $commentId=$responseTo;
    }
    
    $query=$con->prepare("INSERT INTO notifications(postedBy, article_commentId, action) VALUES(:user, :article_commentId, :action)");
        $query->bindParam(":user", $postedBy);
        $query->bindParam(":article_commentId", $commentId);
        $query->bindParam(":action", $action);
        $query->execute();
    echo $newComment->create();
}
else {
    echo "One or more parameters are not passed into the postComment.php file";
}

?>