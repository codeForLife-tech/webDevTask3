<?php
require_once("ButtonProvider.php");

class CommentControls{
    private $con, $comment, $userLoggedInObj;

    public function __construct($con, $comment, $userLoggedInObj) {
        $this->con=$con;
        $this->comment=$comment;
        $this->userLoggedInObj=$userLoggedInObj;
}

public function create() {

    $replyButton=$this->createReplyButton();
    $likesCount=$this->createLikesCount();
    $likeButton=$this->createLikeButton();
    $dislikeButton=$this->createDislikeButton();
    $replySection=$this->createReplySection();

    return "<div class='controls'>
                $replyButton
                $likesCount
                $likeButton
                $dislikeButton
            </div>
            $replySection";
}

private function createReplyButton() {
    $text="REPLY";
    $action="toggleReply(this)";
    return ButtonProvider::createButton($text, null, $action, null);
}

private function createLikesCount() {
    $text=$this->comment->getLikes();

    if($text==0) $text="";

    return "<span class='likesCount'>$text</span>";
}

private function createReplySection() {
        $postedBy = $this->userLoggedInObj->getUsername();
        $articleId=$this->comment->getArticleId();
        $commentId=$this->comment->getId();
        
        $profilePic=ButtonProvider::createUserProfileButton($this->con, $postedBy);

        $cancelButtonAction="toggleReply(this)";
        $cancelButton=ButtonProvider::createButton("Cancel", null, $cancelButtonAction, "cancelComment");

        $postButtonAction="postComment(this, \"$postedBy\", $articleId, $commentId, \"repliesSection\")";
        $postButton=ButtonProvider::createButton("Reply", null, $postButtonAction, "postComment");

        return "<div class='commentForm replyForm hidden'>
                    $profilePic
                    <textarea class='commentBodyClass' placeholder='Add a public reply'></textarea>
                    $cancelButton
                    $postButton
                </div>";
}

private function createLikeButton(){
    $articleId=$this->comment->getArticleId();
    $commentId=$this->comment->getId();
    $action="likeComment($commentId, this, $articleId)";
    $class="likeButton";

    $imageSrc="assets/images/icons/thumb-up.png";

    if($this->comment->wasLikedBy()) {
        $imageSrc="assets/images/icons/thumb-up-active.png";
    }

    return ButtonProvider::createButton("", $imageSrc, $action, $class);
}

private function createDislikeButton(){
    $commentId=$this->comment->getId();
    $articleId=$this->comment->getArticleId();
    $action="dislikeComment($commentId, this, $articleId)";
    $class="dislikeButton";

    $imageSrc="assets/images/icons/thumb-down.png";

    if($this->comment->wasDislikedBy()) {
        $imageSrc="assets/images/icons/thumb-down-active.png";
    }

    return ButtonProvider::createButton("", $imageSrc, $action, $class);
}

}
?>