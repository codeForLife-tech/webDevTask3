<?php
class LikedArticlesProvider {
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function getArticles() {
        $articles=array();
        $query=$this->con->prepare("SELECT articleId FROM likes WHERE username=:username and commentId=0 ORDER BY id DESC");
        $query->bindParam(":username", $username);
        $username=$this->userLoggedInObj->getUsername();
        $query->execute();

        while($row=$query->fetch(PDO::FETCH_ASSOC)) {
            $articles[]=new Article($this->con, $row["articleId"], $this->userLoggedInObj);
        }

        return $articles;
    }
}
?>