<?php
class ArticleRead {

    private $article;

    public function __construct($article) {
            $this->article=$article;
    }

    public function create() {
        $content=$this->article->getContent();
        return "<div class='articleRead'>
                    $content   
                </div>";
    }

}
?>