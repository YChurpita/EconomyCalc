<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *       10010: Ошиька подключения к серверу баз Даниних!  
         10020: Ошибка подключения к базе!  
 *       10025: Ошибка создания таблицы 
         10030: Ошибка добавления записи в базу!
         10040: Спасибо за ваши контакты мы с Вами свяжемся ! - (Сообщение если все ОК)
         10050: Вы уже отправляли нам ваши контакты - сообщение если таккой 
 * Description of DataBase
 *
 * @author Администратор
 */
class PriceBase {
      private $dbname;
      private $stconnect;
      private $selectbuff;
//-----------------------------------------------------------------------------      
    public function setConnect($aVal){
        $this->stconnect=$aVal;
    }
 
//-----------------------------------------------------------------------------    
    public function createDBA(){
        $this->stconnect->exec("CREATE DATABASE ".$this->dbname);  
      }

//---------------------------Метод для создании теблицы-------------------------    
    public function creategass_date(){
       try{
        $this->stconnect->exec("
                CREATE TABLE `gass_date` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `price_data` datetime NOT NULL,
                `active` int(2) NOT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `id` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
                ");
         }catch (PDOException $e) {
         
        } 
    }  
//------------------------------------------------------------------------------//    
 public function createpryce_text(){
       try{
        $this->stconnect->exec("
               CREATE TABLE `gass_base_pryce_text` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `print_text` varchar(50) DEFAULT NULL,
              `print_data` varchar(20) DEFAULT NULL,
              `price_data_id` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`),
              KEY `price_data_id` (`price_data_id`),
              CONSTRAINT `gass_base_pryce_text_fk1` FOREIGN KEY (`price_data_id`) REFERENCES `gass_date` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
            ");
         }catch (PDOException $e) {
         
        } 
    }      
 /*----------------------------------------------------------------------------*/
 public function createpryce_nak(){
       try{
        $this->stconnect->exec("
               CREATE TABLE `gass_price_nak` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `nOn` float(20,3) DEFAULT NULL,
              `nOff` float(20,3) DEFAULT NULL,
              `pDate` datetime DEFAULT NULL,
              `price_data_id` int(11) DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`),
              KEY `price_data_id` (`price_data_id`),
              CONSTRAINT `gass_price_nak_fk1` FOREIGN KEY (`price_data_id`) REFERENCES `gass_date` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;

            ");
         }catch (PDOException $e) {
         
        } 
    }          
    
/*-----------------------------------------------------------------------------*/    
public function createprice_off(){
       try{
        $this->stconnect->exec("
         CREATE TABLE `gass_price_off` (
         `id` int(11) NOT NULL AUTO_INCREMENT,
         `p1` float(20,3) DEFAULT NULL,
         `p2` float(20,3) DEFAULT NULL,
         `p3` float(20,3) DEFAULT NULL,
         `p4` float(20,3) DEFAULT NULL,
         `p5` float(20,3) DEFAULT NULL,
         `price_data_id` int(11) DEFAULT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `id` (`id`),
          KEY `price_data_id` (`price_data_id`),
          CONSTRAINT `gass_price_off_fk1` FOREIGN KEY (`price_data_id`) REFERENCES `gass_date` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
            ");
         }catch (PDOException $e) {
         
        } 
    }          
 /*-----------------------------------------------------------------------------*/    
public function createprice_on(){
       try{
        $this->stconnect->exec("
        CREATE TABLE `gass_price_on` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `p1` float(20,3) DEFAULT NULL,
        `p2` float(20,3) DEFAULT NULL,
        `p3` float(20,3) DEFAULT NULL,
        `p4` float(20,3) DEFAULT NULL,
        `p5` float(20,3) DEFAULT NULL,
        `price_data_id` int(11) DEFAULT NULL,
         PRIMARY KEY (`id`),
         UNIQUE KEY `id` (`id`),
         KEY `price_data_id` (`price_data_id`),
        CONSTRAINT `gass_price_on_fk1` FOREIGN KEY (`price_data_id`) REFERENCES `gass_date` (`id`)
       ) ENGINE=InnoDB DEFAULT CHARSET=utf8 PACK_KEYS=0;
            ");
         }catch (PDOException $e) {
         
        } 
    }  
    
/*-----------------------------------------------------------------------------*/ 
    public function selectPrice(){
$stm= $this->stconnect->query( " SELECT 
  `gass_date`.`id`,
  `gass_date`.`price_data`,
  `gass_date`.`active`,
  `gass_base_pryce_text`.`print_text`,
  `gass_base_pryce_text`.`print_text2`,
  `gass_base_pryce_text`.`print_data`,
  `gass_price_nak`.`nOn`,
  `gass_price_nak`.`nOff`,
  `gass_price_nak`.`pDate`,
  `gass_price_on`.`p1` AS `on_p1`,
  `gass_price_on`.`p2` AS `on_p2`,
  `gass_price_on`.`p3` AS `on_p3`,
  `gass_price_on`.`p4` AS `on_p4`,
  `gass_price_on`.`p5` AS `on_p5`,
  `gass_price_off`.`p1` AS `off_p1`,
  `gass_price_off`.`p2` AS `off_p2`,
  `gass_price_off`.`p3` AS `off_p3`,
  `gass_price_off`.`p4` AS `off_p4`,
  `gass_price_off`.`p5` AS `off_p5`
FROM
  `gass_date`
  INNER JOIN `gass_price_on` ON (`gass_date`.`id` = `gass_price_on`.`price_data_id`)
  INNER JOIN `gass_base_pryce_text` ON (`gass_date`.`id` = `gass_base_pryce_text`.`price_data_id`)
  INNER JOIN `gass_price_nak` ON (`gass_date`.`id` = `gass_price_nak`.`price_data_id`)
  INNER JOIN `gass_price_off` ON (`gass_date`.`id` = `gass_price_off`.`price_data_id`)
  where (`gass_date`.`active`=1); ")->fetchAll(\PDO::FETCH_ASSOC);

 
                $this->selectbuff=$stm;
           
}    
    
 
//------------------------------------------------------------------------------
 public function getSelBuff(){
        return $this->selectbuff ;
    } 
  
}
