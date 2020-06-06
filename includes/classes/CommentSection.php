<?php
class  CommentSection {
    private $con, $article, $userLoggedInObj;

    public function __construct($con, $article, $userLoggedInObj) {
            $this->article=$article;
            $this->con=$con;
            $this->userLoggedInObj=$userLoggedInObj;
    }

    public function create() {
        return $this->createCommentSection();
    }

    private function createCommentSection() {
        $numComments=$this->article->getNumberOfComments();
        $postedBy = $this->userLoggedInObj->getUsername();
        $articleId=$this->article->getId();
        
        $profilePic=ButtonProvider::createUserProfileButton($this->con, $postedBy);
        $commentAction="postComment(this, \"$postedBy\", $articleId, null, \"comments\")";
        $commentButton=ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");

        $comments=$this->article->getComments();
        $commentItems="";
        foreach($comments as $comment) {
            $commentItems.=$comment->create();
        }

        return "<div class='commentSection'>

                    <div class='header'>
                        <span class='commentCount'>$numComments Comments</span>

                        <div class='commentForm'>
                            $profilePic
                            <textarea class='commentBodyClass' placeholder='Add a public comment'></textarea>
                            $commentButton
                        </div>
                    </div>

                    <div class='comments'>
                        $commentItems
                    </div>

                </div>";
    }
 }
?>