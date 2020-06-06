<?php

class ProfileData {
    private $con, $profileUserObj;

    public function __construct($con, $profileUsername) {
        $this->con=$con;
        $this->profileUserObj=new User($con, $profileUsername);
    }

    public function getProfileUserObj() {
        return $this->profileUserObj;
    }

    public function getProfileUsername() {
        return $this->profileUserObj->getUsername();
    }

    public function userExists() {
        $query=$this->con->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam(":username", $profileUsername);
        $profileUsername=$this->getProfileUsername();
        $query->execute();

        return $query->rowCount() != 0;
    }

    public function getCoverPhoto() {
        return "assets/images/coverPhotos/default-cover-photo.jpg";
    }

    public function getProfileUserFullName() {
        return $this->profileUserObj->getName();
    }

    public function getProfilePic() {
        return $this->profileUserObj->getProfilePic();
    }

    public function getSubscriberCount() {
        return $this->profileUserObj->getSubscriberCount();
    }

    public function getUsersArticles() {
        $query=$this->con->prepare("SELECT * FROM articles WHERE uploadedBy=:uploadedBy ORDER BY uploadDate DESC");
        $query->bindParam(":uploadedBy", $username);
        $username=$this->getProfileUsername();
        $query->execute();

        $articles=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)) {
            $articles[]=new Article($this->con, $row, $this->profileUserObj->getUsername());
        }

        return $articles;
    }

    public function getUsersPlaylists() {
        $query=$this->con->prepare("SELECT * FROM playlists WHERE uploadedBy=:uploadedBy ORDER BY timeUploaded DESC");
        $query->bindParam(":uploadedBy", $username);
        $username=$this->getProfileUsername();
        $query->execute();

        $playlists=array();
        while($row=$query->fetch(PDO::FETCH_ASSOC)) {
            $playlists[]=new Playlist($this->con, $row, $this->profileUserObj->getUsername());
        }

        return $playlists;
    }

    public function getAllUserDetails() {
        return array(
          "Name"=>$this->getProfileUserFullName(),
          "Username"=>$this->getProfileUsername(),  
          "Subscribers"=>$this->getSubscriberCount(),
          "Total reads"=>$this->getTotalViews(),
          "Sign up date"=>$this->getSignUpDate()

        );
    }

    private function getTotalViews() {
        $query=$this->con->prepare("SELECT sum(views) FROM articles WHERE uploadedBy=:uploadedBy");
        $query->bindParam(":uploadedBy", $username);
        $username=$this->getProfileUsername();
        $query->execute();

        return $query->fetchColumn();
    }

    private function getSignUpDate() {
        $date=$this->profileUserObj->getSignUpDate();
        return date("F jS, Y", strtotime($date));
    }
}
?>