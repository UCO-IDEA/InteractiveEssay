<?php 
	foreach(array_reverse($essayData->actions) as $a){
		
		$actionHTML = "";
		$timeStamp = date('m/d/Y', ($a->timeStamp/1000));

		if($a->type === 'Add Paragraph' || $a->type === 'Added Paragraph'){
			$actionHTML = "<div class='action'><strong>".$a->owner."</strong> ".$a->type."<div class='action_text'><p>".$a->text."</p></div>".$timeStamp."</div>";
		}
		if($a->type === 'Added Comment'){
			$actionHTML = "<div class='action'><strong>".$a->owner."</strong> ".$a->type."<div class='action_text' data-toggle='modal' data-target='#exampleModalCenter' data-paragraph='".$a->paragraphId."'><p>".$a->text."</p></div>".$timeStamp."</div>";
		}
		if($a->type === 'Deleted Paragraph'){
			$actionHTML = "<div class='action'><strong>".$a->owner ."</strong> ".$a->type."<div class='action_text'><p>".$a->text ."</p></div>".$timeStamp."</div>";
		}
		if($a->type === 'Rearranged Paragraph' || $a->type === 'Rearranged Paragraphs'){
			$actionHTML = "<div class='action'><strong>".$a->owner."</strong> ".$a->type." <br>".$timeStamp."</div>";
		}
		if($a->type === 'Changed Essay Name To'){
			$actionHTML = "<div class='action'><strong>".$a->owner."</strong> ".$a->type." <span class='essay_name'>".$a->name."</span> <br>".$timeStamp."</div>";
		}
	echo $actionHTML;
	}
?>