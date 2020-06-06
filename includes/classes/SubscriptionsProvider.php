<?php
class SubscriptionsProvider {
    private $con, $userLoggedInObj;

    public function __construct($con, $userLoggedInObj) {
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
    }

    public function getArticles() {
        $articles=array();
        $subscriptions=$this->userLoggedInObj->getSubscriptions();

        if(sizeof($subscriptions)>0) {
            
            $condition="";
            $i=0;
            while($i<sizeof($subscriptions)) {
                
                if($i==0) {
                    $condition.= "WHERE uploadedBy=?";
                }
                else {
                    $condition.= " OR uploadedBy=?";
                }
                $i++;
            }

            $articleSql="SELECT * FROM articles $condition ORDER BY uploadDate DESC";
            $articleQuery=$this->con->prepare($articleSql);

            $i=1;
            foreach($subscriptions as $sub) {
                 $subUsername=$sub->getUsername();
                 $articleQuery->bindValue($i, $subUsername);
                 $i++;
            }

            $articleQuery->execute();
            while($row=$articleQuery->fetch(PDO::FETCH_ASSOC)) {
                $article=new Article($this->con, $row, $this->userLoggedInObj);
                array_push($articles, $article);
            }


        }
        
        return $articles;
    }
}
?>