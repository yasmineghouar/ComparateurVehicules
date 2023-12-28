<?php
require_once ('templateModel.php');
class ContactModel extends templateModel {

    public function getContact(){
       
        $conn = $this->connect("root", "", "TDW", "localhost");
        $q = "SELECT * FROM contact_infos";

        $result = $this->request($conn, $q);

        $this->disconnect($conn);
        return $result;
       
        }
    
    
   /* public function getEmail(){
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT email_contact FROM contact_infos";
        
         $r= $this->request($conn,$q);
         $this->disconnect($conn);
         return $r;
    
    }
    public function getAdresse(){
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT adresse FROM contact_infos";
        
         $r= $this->request($conn,$q);
         $this->disconnect($conn);
         return $r;
    
    }
    public function getDescription(){
        $conn=$this->connect("root","","TDW","localhost");
        $q= "SELECT description FROM contact_infos";
        
         $r= $this->request($conn,$q);
         $this->disconnect($conn);
         return $r;
    
    }
*/


}
?>