<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");

require("config.php");
require("dataHandler.php");

if(isset($_POST['id']) && isset($_POST['EssayJSON'])){
    try{
        $id = $_POST['id'];
        $data = $_POST['EssayJSON'];
        updateData($id,json_encode($data));
        $arr = array(
            "result" => "success",
            "description" => "Progress Saved"
        );
        print_r(json_encode($arr));
    }catch(Exception $e){
        $arr = array(
            "result" => "error",
            "description" => $e->getMessage()
        );
        print_r(json_encode($arr));
    }
}else if(isset($_POST['post'])){
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
        $arr = array(
            "result" => "error",
            "description" => $e->getMessage()
        );
        print_r(json_encode($arr));
    }
}

function getAllData($id = null){
    return getData($id);
}

function getHashedId($newId){
    // your hash logic here
    return $newId;
}

?>