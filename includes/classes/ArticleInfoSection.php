<?php
require_once("includes/classes/ArticleInfoControls.php");
class  ArticleInfoSection {
    private $con, $article, $userLoggedInObj;

    public function __construct($con, $article, $userLoggedInObj) {
            $this->article=$article;
            $this->con=$con;
            $this->userLoggedInObj=$userLoggedInObj;
    }

    public function create() {
        return $this->createPrimaryInfo() . $this->createSecondaryInfo();
    }

    private function createPrimaryInfo() {
        $title=$this->article->getTitle();
        $views=$this->article->getViews();

        $articleInfoControls=new ArticleInfoControls($this->article, $this->userLoggedInObj);
        $controls=$articleInfoControls->create();

        return "<div class='articleInfo'>
                    <h1>$title</h1>
                    
                    <div class='bottomSection'>
                        <span class='viewCount'>$views people read this</span>
                        $controls
                    </div>
                </div>";
    }

    private function createSecondaryInfo() {

        $description=$this->article->getDescription();
        $uploadDate=$this->article->getUploadDate();
        $uploadedBy=$this->article->getUploadedBy();
        $profileButton=ButtonProvider::createUserProfileButton($this->con, $uploadedBy);

        if($uploadedBy == $this->userLoggedInObj->getUsername()) {
            $actionButton=ButtonProvider::createEditArticleButton($this->article->getId());
        }
        else {
            $userToObj=new User($this->con, $uploadedBy);
            $actionButton=ButtonProvider::createSubscriberButton($this->con, $userToObj, $this->userLoggedInObj);
            //$actionButton="";
        }
        $btn="btn";
        $speak="<a class='iconMargin' id='speaker'>
                    <i class='fas fa-2x fa-microphone'></i>
                </a>";
        $share="<a class='iconMargin' id='$btn'>
                    <i class='fas fa-2x fa-share-square'></i>
                </a>";
        return "<div class='secondaryInfo'>
                    <div class='topRow'>
                    $profileButton

                    <div class='uploadInfo'>
                        <span class='owner'>
                            <a href='profile.php?username=$uploadedBy'>
                                $uploadedBy
                            </a>
                        </span>
                        <span class='date'>Published on $uploadDate</span>
                    </div>
                    $speak
                    $share
                    $actionButton
                    </div>

                    <div class='descriptionContainer'>
                        $description
                    </div>
        
                </div>";
    }
}
?>