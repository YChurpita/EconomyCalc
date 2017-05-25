<?php

class ConnectBase {
    //put your code here
      private $host;
      private $user;
      private $passwd;
      private $dbname;
      private $stconnect;
    //  private $selectbuff=[];
//-----------------------------------------------------------------------------      
    public function setDBname($aVal){
        $this->dbname=$aVal;
    }
//-----------------------------------------------------------------------------
    public function setConnectParam($host,$users,$passw,$dbn ){
        $this->host=$host;
        $this->user=$users;
        $this->passwd=$passw;
        $this->dbname=$dbn;
    }    
   // 'mysql:host=localhost;dbname=test
//-----------------------------------------------------------------------------    
    public function connectDbaServ(){
        try {        
            $this->stconnect= new PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->passwd);
            $this->stconnect->exec('SET NAMES utf8'); 
			
            } catch (PDOException $e) {
              echo '10010';
            }    
    }
//-----------------------------------------------------------------------------    
 public function getConnect(){
        return $this->stconnect ;
    } 
}
?>