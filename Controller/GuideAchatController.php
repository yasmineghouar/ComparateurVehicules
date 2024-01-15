<?php
require_once('./Model/GuideModel.php');
require_once('./View/GuideAchatView.php');

class GuideAchatController{



    public function index(){
        $v=new GuideAchatView();
        $v->index();

    }

    public function GuideInfos()
    {
        $guideModel = new GuideModel();
        $r=$guideModel->getGuide();
        return $r;//retourne le guide depuis le model
    }

    public function getGuideAchat(){
        //retourne le guide complet
        $guideModel = new GuideModel();
        $r=$guideModel->getGuideAchat();
        return $r;
    }

}

?>