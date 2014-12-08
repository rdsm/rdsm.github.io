<?php

require_once(dirname(__FILE__) . '/config.php');

function do_counter_hit($counter_id) {
	
	// Validate counter ID
	if(!is_valid_counter_id($counter_id)) {
		die('An invalid counter ID was specified');
	}
	
	// Get current hit count
	$total_hits = get_counter_total_hits($counter_id);
	
	// Check whether this is a unique hit
	if(!is_counter_hit_duplicate($counter_id)) {	
	
		// Update hit count
		$total_hits++;
		save_counter_hit($counter_id, $total_hits);
		
	}

}

function show_counter($counter_id) {
	
	// Validate counter ID
	if(!is_valid_counter_id($counter_id)) {
		die('An invalid counter ID was specified');
	}
	
	// Get current hit count
	$total_hits = get_counter_total_hits($counter_id);
	
	// Apply formatting to the hit count
	$formatted_hits = '' . $total_hits;
	global $COUNTER_NUMBER_OF_DIGITS;
	if(strlen($formatted_hits) < $COUNTER_NUMBER_OF_DIGITS) {
		$formatted_hits = str_repeat('0', $COUNTER_NUMBER_OF_DIGITS - strlen($formatted_hits)) . $formatted_hits;
	}
	
	// Output hits
	$span_style = get_counter_span_style();
	$text_style = get_counter_text_style();
	
	/* DO NOT REMOVE OR ALTER THE CREDIT LINK BELOW, PER LICENSE! */
	global $COUNTER_CLASS;
	echo('<span' . ((!empty($COUNTER_CLASS))?' class="' . htmlspecialchars($COUNTER_CLASS) . '"':'') .
		((!empty($span_style))?' style="' . htmlspecialchars($span_style) . '"':'') .
		'><a title="Number of Visitors"' .
		((!empty($text_style))?' style="' . htmlspecialchars($text_style) . '"':'') . '>' .  
		htmlspecialchars($formatted_hits) . "</a></span>\r\n");
	
}

function get_counter_span_style() {
	global $COUNTER_BACKGROUND;
	global $COUNTER_BORDER;
		
	// Handle span
	$style = 'padding: 1px 1px 1px 1px;';
	if(!empty($COUNTER_BACKGROUND)) $style = $style . "background: $COUNTER_BACKGROUND;";
	if(!empty($COUNTER_BORDER)) $style = $style . "border: $COUNTER_BORDER;";
	return $style;

}

function get_counter_text_style() {
	
	// Handle font and color
	$style = '';
	global $COUNTER_FONT;
	if(!empty($COUNTER_FONT)) $style = $style . "font: $COUNTER_FONT;";
	global $COUNTER_COLOR;
	if(!empty($COUNTER_COLOR)) $style = $style . "color: $COUNTER_COLOR;";
	
	// Apply inline style to all necessary selectors
	if(!empty($style)) {
		$style = "{$style} :link, :visited, :active, :link:hover, :visited:hover, :active:hover {$style}"; 
	}
	
	return $style;
		
}

function is_counter_hit_duplicate($counter_id) {

 	global $COUNTER_USE_COOKIES;
 	$cookie_name = 'HIT_COUNTER_' . $counter_id;
 	if($COUNTER_USE_COOKIES === TRUE && isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == 'TRUE') {
		return TRUE;
 	}

	return FALSE;
}

function counter_summary_file_path($counter_id) {
	return dirname(__FILE__) . '/data/summary_' . $counter_id . '.dat';
}

function get_counter_total_hits($counter_id) {
	$total_hits = @file_get_contents(counter_summary_file_path($counter_id));
	if($total_hits === FALSE) {
		return 0;
	} else {
		return intval($total_hits);
	}
}

function save_counter_hit($counter_id, $new_total_hits) {
	
	// Open file
	$summary_fp = @fopen(counter_summary_file_path($counter_id), "w");
 	if($summary_fp === FALSE) {
 		die("Unable to open counter data file for writing");
 	}
 	
 	// Lock file
 	@flock($summary_fp, LOCK_EX);
 	
 	// Update count
 	fputs($summary_fp, '' . $new_total_hits);
 	
 	// Close
 	@fclose($summary_fp);
 	
 	// Set a cookie to prevent user from counting again during this session
 	global $COUNTER_USE_COOKIES;
 	if($COUNTER_USE_COOKIES === TRUE) {
 		$cookie_name = 'HIT_COUNTER_' . $counter_id;
 		setcookie($cookie_name, 'TRUE', time() + 3600 * 24 * 356 * 10);
 	}
}



function is_valid_counter_id($counter_id) {
	global $VALID_COUNTER_IDS;
	return (
		!empty($counter_id) && 
		preg_match('/^[a-zA-Z0-9]+$/D', $counter_id) === 1 && 
		strlen($counter_id) <= 40 &&
		in_array($counter_id, $VALID_COUNTER_IDS, TRUE)
	);
}
 
?>
