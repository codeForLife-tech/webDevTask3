<?php
class SearchResultsProvider {
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function getArticles($term, $orderBy) {
        $query=$this->con->prepare("SELECT * FROM articles WHERE title LIKE CONCAT('%', :term, '%')
                                    OR uploadedBy LIKE CONCAT('%', :term, '%') ORDER BY $orderBy DESC");
        $query->bindParam(":term", $term);
        $query->execute();

        $articles=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)) {
            $article= new Article($this->con, $row, $this->userLoggedInObj);
            array_push($articles,$article);
        }

        return $articles;
    }
}
?>