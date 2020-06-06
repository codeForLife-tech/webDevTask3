<?php
class ArticleGridItem{

    private $article, $largeMode;

    public function __construct($article, $largeMode)  {
        $this->article=$article;
        $this->largeMode=$largeMode;
    }

    public function create() {
        $thumbnail=$this->createThumbnail();
        $details=$this->createDetails();
        $url = "read.php?id=".$this->article->getId();
        $id=$this->article->getId();
        $add="editArticle.php?articleId=".$id;
        $editOption=(basename($_SERVER["PHP_SELF"])=="editArticles.php")? "<span class='editing $add'>Edit</span>": "";
        if(basename($_SERVER["PHP_SELF"])=="history.php"||basename($_SERVER["PHP_SELF"])=="editArticles.php") {
            $delete="<div class='dropdown'>
                        <ul class='dropbtn icons btn-right showLeft $id'>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div class='dropdown-content myDropdown' id='$id'>
                            <span class='removing $id'>Remove</span>
                            $editOption
                        </div>
                    </div>";
            return "<a class='flexing' href='$url'>
                        <div class='articleGridItem'>
                            $thumbnail
                            $details
                            $delete
                        </div>
                    </a>";
        }
        return "<a id='$id' href='$url'>
                    <div class='articleGridItem'>
                        $thumbnail
                        $details
                    </div>
                </a>";
    }

    public function createThumbnail() {
        
        $thumbnail=$this->article->getThumbnail();
        $length=$this->article->getLength();

        return "<div class='thumbnail'>
                    <img src='$thumbnail'>
                    <div class='length'>
                        <span>$length</span>
                    </div>
                </div>";

    }

    private function createDetails() {
        $title=$this->article->getTitle();
        $username=$this->article->getUploadedBy();
        $views=$this->article->getViews();
        $description=$this->createDescription();
        $timestamp=$this->article->getTimeStamp();

        return "<div class='details'>
                    <h3 class='title'>$title</h3>
                    <span class='username'>$username</span>
                    <div class='stats'>
                        <span class='viewCount'>$views reads - </span>
                        <span class='timeStamp'>$timestamp</span>
                    </div>
                    $description
                </div>";

    }

    private function createDescription() {
        if(!$this->largeMode) {
            return "";
        }
        else {
            $description=$this->article->getDescription();
            $description=(strlen($description)>350) ? substr($description, 0, 347) . "..." : $description;
            return "<span class='description'>$description</span>";
        }
    }
}
?>