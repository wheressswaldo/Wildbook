<?php


function displayEntry($username, $diaryTitle, $diaryDesc, $timeposted, $lastedited)
{
	echo "<div class='col-xs-6 col-md-3'>
			<div>
				<h4>$username</h4>
			</div>
			<div class='caption'>
				<h2>$diaryTitle</h2>
			</div>
			<div>
				<h5>$diaryDesc
			</div>
				<h6>Posted: $timeposted Last edited: $lastedited</h6>
			</div>";
}

function displayActivity()
{


}	

?>
