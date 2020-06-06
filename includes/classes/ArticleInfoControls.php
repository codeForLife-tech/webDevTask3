<?php
require_once("includes/classes/ButtonProvider.php");

class ArticleInfoControls{
    private $article, $userLoggedInObj;

    public function __construct($article, $userLoggedInObj) {
        $this->article=$article;
        $this->userLoggedInObj=$userLoggedInObj;
}

public function create() {

    $likeButton=$this->createLikeButton();
    $dislikeButton=$this->createDislikeButton();

    return "<div class='controls'>
                $likeButton
                $dislikeButton
            </div>";
}

private function createLikeButton(){
    $text=$this->article->getLikes();
    $articleId=$this->article->getId();
    $action="likeArticle(this, $articleId)";
    $class="likeButton";

    $imageSrc="assets/images/icons/thumb-up.png";

    if($this->article->wasLikedBy()) {
        $imageSrc="assets/images/icons/thumb-up-active.png";
    }

    return ButtonProvider::createButton($text, $imageSrc, $action, $class);
}

private function createDislikeButton(){
    $text=$this->article->getDislikes();
    $articleId=$this->article->getId();
    $action="dislikeArticle(this, $articleId)";
    $class="dislikeButton";

    $imageSrc="assets/images/icons/thumb-down.png";

    if($this->article->wasDislikedBy()) {
        $imageSrc="assets/images/icons/thumb-down-active.png";
    }

    return ButtonProvider::createButton($text, $imageSrc, $action, $class);
}

}
?>