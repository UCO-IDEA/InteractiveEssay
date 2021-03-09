<?php
	foreach($essayData->paragraphs as $p){
		if(!property_exists($p,'delete')){
				$html = "";
				$deleteIconHTML = '<div class="options_icons">
							<div class="icon_delete">
								<i class="fa fa-window-close" aria-hidden="true"></i>
							</div>
						</div>';
				$comment_btns = '<button class="btn add_comment"><i class="fa fa-commenting" aria-hidden="true"></i></button>
								<button class="btn view_comment"  data-toggle="modal" data-target="#exampleModalCenter" ><i class="fa fa-list" aria-hidden="true"></i></button>';

				$paragraphText  = $p->text;

				$html = '<div class="paragraphs" id="'.$p->id.'" data-timeStamp="'.$p->timeStamp.'">
						<p>'.$paragraphText.'</p> 
						 '.$deleteIconHTML.'
						 '.$comment_btns.'
					</div>';
			echo $html;

			}
		}
?>