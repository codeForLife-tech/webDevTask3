<?php
require_once("ProfileData.php");
class ProfileGenerator {
    private $con, $userLoggedInObj, $profileData;

    public function __construct($con, $userLoggedInObj, $profileUsername) {
        $this->con=$con;
        $this->userLoggedInObj=$userLoggedInObj;
        $this->profileData=new ProfileData($con, $profileUsername);
    }

    public function create() {
        $profileUsername=$this->profileData->getProfileUsername();
        
        if(!$this->profileData->userExists()) {
            return "User does not exist";
        }

        $coverPhotoSection=$this->createCoverPhotoSection();
        $headerSection=$this->createHeaderSection();
        $tabsSection=$this->createTabsSection();
        $contentSection=$this->createContentSection();

        return "<div class='profileContainer'>
                    $coverPhotoSection
                    $headerSection
                    $tabsSection
                    $contentSection
                </div>";
    }

    public function createCoverPhotoSection() {
        $coverPhotoSrc=$this->profileData->getCoverPhoto();
        $name=$this->profileData->getProfileUserFullName();
        return "<div class='coverPhotoContainer'>
                    <img src='$coverPhotoSrc' class='coverPhoto'>
                    <div>
                    <span class='channelName'>$name</span>
                    </div>
                </div>";
}

    public function createHeaderSection() {
        $profileImage=$this->profileData->getProfilePic();
        $name=$this->profileData->getProfileUserFullName();
        $subCount=$this->profileData->getSubscriberCount();

        $button=$this->createHeaderButton();

        return "<div class='profileHeader'>
                    <div class='userInfoContainer'>
                        <img class='profileImage' src='$profileImage'>
                        <div class='userInfo'>
                            <span class='title'>$name</span>
                            <span class='subscriberCount'>$subCount subscribers</span>
                        </div>
                    </div>

                    <div class='buttonContainer'>
                        <div class='buttonItem'>
                            $button
                        </div>
                    </div>
                </div>";
    }

    public function createTabsSection() {
        return "<ul class='nav nav-tabs' role='tablist'>
                    <li class='nav-item'>
                    <a class='nav-link active' id='articles-tab' data-toggle='tab' href='#articles' role='tab' aria-controls='articles' aria-selected='true'>ARTICLES</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link' id='about-tab' data-toggle='tab' href='#about' role='tab' aria-controls='about' aria-selected='false'>ABOUT</a>
                    </li>
                </ul>";
    }

    public function createContentSection() {

        $articles=$this->profileData->getUsersArticles();


        if(sizeof($articles)>0) {
            $articleGrid=new ArticleGrid($this->con, $this->userLoggedInObj);
            $articleGridHtml=$articleGrid->create($articles, null, false);
        }
        else {
            $articleGridHtml="<span>This user has no articles</span>";
        }

        $aboutSection=$this->createAboutSection();

        return "<div class='tab-content channelContent'>
                    <div class='tab-pane fade show active' id='articles' role='tabpanel' aria-labelledby='articles-tab'>
                        $articleGridHtml
                    </div>
                    <div class='tab-pane fade' id='about' role='tabpanel' aria-labelledby='about-tab'>
                        $aboutSection
                    </div>
                </div>";
    }

    private function createHeaderButton() {
        if($this->userLoggedInObj->getUsername() == $this->profileData->getProfileUserName()) {
            return "<form id='file-upload' enctype='multipart/form-data'>
                            <label for='exampleFormControlFile1' class='btn btn-primary' >Change profile pictue</label>
                            <input type='file' class='form-control-file' name='image' onchange='submitForm()' id='exampleFormControlFile1' required hidden>
                            <button type='submit' id= 'press' hidden></button>
                     </form>";
        }
        else {
            return ButtonProvider::createSubscriberButton($this->con, $this->profileData->getProfileUserObj(), $this->userLoggedInObj);
        }
     }

    private function createAboutSection() {
        $html="<div class='section'>
                    <div class='title'>
                        <span>Details</span>
                    </div>
                    <div class='values'>";

        $details=$this->profileData->getAllUserDetails();
        foreach($details as $key=>$value) {
            $html.= "<span>$key: $value</span>";
        }

        $html.= "</div></div>";

        return $html;
    }
}
?>