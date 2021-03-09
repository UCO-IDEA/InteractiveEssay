<?php
    require("config.php");
    require("dataHandler.php");

    $lastRowId = null;

    if(isset($_POST['submit'])){
        $hash = false;
        try{
            $lastRowId = getData(null,true);
            $newEssayJSON = '{"id":"'.$lastRowId.'","name":"","owner":"Anonymous User","paragraphs":[],"comments":[],"actions":[], "rowId":""}';
            
            postData($newEssayJSON);
            
            if(!$hash){
                $arr = array(
                    "newId" => $lastRowId
                );
                print_r(json_encode($arr));
            }
            else{
                $arr = array(
                    "newId" => getHashedId($lastRowId)
                );
                print_r(json_encode($arr));
            }
        }catch(Exception $e){
            throw new Exception("Internal Server Error.");
            die();
        }
    }

    function getHashedId($newId){
        return $newId;
    }

?>