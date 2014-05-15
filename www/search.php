<?php

	require_once 'functions.php';
	$html = '';
	$html .= '<li class="result">';
	$html .= '<a target="_blank" href="urlString">';
	$html .= '<h3>userString</h3>';
	$html .= '<h4>nameString</h4>';
	$html .= '</a>';
	$html .= '</li>';

	//<li class="result"><a target="_blank" href="urlString"><h3>nameString</h3><h4>functionString</h4></a></li>
	
	$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
	$search_string = $con->real_escape_string($search_string);
	
	if (strlen($search_string) >= 1 && $search_string !== ' ') {
		
		$q = $search_string;

		$query = "select * from profile where username like '%$q%' or firstname like '%$q%' or lastname like '%$q%';";
	
		$result = $con->query($query);
		
		while($results = $result->fetch_array()) {
			$result_array[] = $results;
		}
		
		if (isset($result_array)) {
			foreach ($result_array as $result) {

				// Format Output Strings And Hightlight Matches
				$display_username = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['username']);
				$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['firstname']." ".$result['lastname']);
				$display_url = 'profile.php?username='.$result['username'];

				// Insert Name
				$output = str_replace('userString', $display_username, $html);

				// Insert Function
				$output = str_replace('nameString', $display_name, $output);

				// Insert URL
				$output = str_replace('urlString', $display_url, $output);

				// Output
				echo($output);
				
			}
		}else{
			
			// Format No Results Output
			$output = str_replace('urlString', 'javascript:void(0);', $html);
			$output = str_replace('nameString', '<b>No Results Found.</b>', $output);
			$output = str_replace('functionString', '', $output);
			
			// Output
			echo($output);
			
		}
	
	}
?>