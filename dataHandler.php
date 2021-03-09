<?php

require_once '../../../Google/google-api-php-client-2.2.0/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("InteractiveEssay_Data");
$client->setDeveloperKey($keys['API_KEY']);
$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
$client->setAccessType('offline');
$client->setAuthConfig($keys["Service_Account"]);

$service = new Google_Service_Sheets($client);

$spreadsheetId = $keys['SHEET_ID'];

function getData($id = null,$lastInsertRow = null){
	GLOBAL $service, $spreadsheetId;

	if($id != null) {
		$range = 'Sheet1!A'.$id.':A'.$id;
		$counter = 0;
	}else{
		$range = 'Sheet1!A:A';
		$counter = 1;
	}
	
	$options = array('valueRenderOption' => 'FORMATTED_VALUE');
	
	$response = $service->spreadsheets_values->get($spreadsheetId, $range, $options);
	
	$values = $response->getValues();

	if(!$values){
		return array(
			"error" => "No essay exist at this url"
		);
	}

	if($lastInsertRow){
		return count($values) + 1;
	}

	$ids = ["EssayJSON"];
		
	for ($i = $counter; $i < count($values); $i++) { 
		if(empty($values[$i])){
			$values[i] = "";
		}
			$myJSON[] = array_combine($ids, $values[$i]);
	}
	
	return $myJSON;
	
}

function postData($essayJson){
	
	GLOBAL $service, $spreadsheetId;
	
	$range = 'Sheet1!A:A';
	$requestBody = new Google_Service_Sheets_ValueRange();
	
	$values = [$essayJson];
	
	$requestBody->setValues(["values" => $values]);
	
	$conf = ["valueInputOption" => "RAW"];
	
	$response = $service->spreadsheets_values->append($spreadsheetId, $range, $requestBody, $conf);
	
	$updatedRange = $response["updates"]->updatedRange;
	
	$newRangePos = strpos($updatedRange, "A") + 1;
	
	$rangeId = substr($updatedRange, $newRangePos, strrpos($updatedRange, ":") - $newRangePos);
	
	return $rangeId;
	
}

function updateData($id,$essayJson){
	
	GLOBAL $service, $spreadsheetId;
	
	$rangeId = -1;
	
	$range = 'Sheet1!A'.$id.':A'.$id;
	$requestBody = new Google_Service_Sheets_ValueRange();
	
	$values = [$essayJson];
	
	$requestBody->setValues(["values" => $values]);
	
	$conf = ["valueInputOption" => "RAW"];
	
	$response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $conf);

	return $response->getUpdatedCells();
}

?>