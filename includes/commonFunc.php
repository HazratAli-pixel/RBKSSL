<?php 
function menuActive($lastLinkName,$currenFileName) {
	if ($lastLinkName == $currenFileName){
		return 'style="margin: 5px 10px 5px 50px; background: #c9c8c3; color: #000000; border-radius: 10px;"';
	}
	else return 'style="margin-left: 50px;" class="hover_class"';
  }


?>