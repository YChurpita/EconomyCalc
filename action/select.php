<?php
    include 'class/ConnectBase.php';
    include 'class/PriceBase.php';
 
     $dbPriceBase= new PriceBase();  
     $dbconnect= new ConnectBase();         
     $dbconnect->setConnectParam('*************', '**********', '***********','*******');
     $dbconnect->connectDbaServ();
     $dbPriceBase->setConnect($dbconnect->getConnect());
 
     $dbPriceBase->selectPrice(); 
     
   
     echo (json_encode($dbPriceBase->getSelBuff())); 
   
  
?>