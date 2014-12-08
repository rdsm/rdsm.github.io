<?php

// Below are the CSS styles for the counter.  Modify these values to change  
// the colors, font, or borders of the counter.
// For valid values, see the links to the corresponding CSS documentation. 

// Fonts Properties - See http://www.w3.org/TR/CSS1#font-properties
$COUNTER_FONT = 'bold 18px arial,serif';

// Color and Background Properties - http://www.w3.org/TR/CSS1#color-and-background-properties 
$COUNTER_COLOR = '#ffffff';
$COUNTER_BACKGROUND = '#000000';

// Border Property - http://www.w3.org/TR/CSS1#box-properties
$COUNTER_BORDER = '1px solid #cccccc';

// The minimum number of digits to display.
$COUNTER_NUMBER_OF_DIGITS = 6;

// Optional CSS class name for the span tag containing the counter.
$COUNTER_CLASS = 'counter';

// Set this to TRUE to send a cookie to the client web browser indicating 
// that the user has already been counted.  This user will not be counted 
// again until the cookie expires.
$COUNTER_USE_COOKIES = TRUE;

// List of valid counter IDs.  All counter requests are checked against this 
// list to ensure that invalid counter IDs cannot be used.  Add or modify 
// values in this array to customize the available counter IDs for new  
// counters.  All values in this array must be strings.  In addition, they  
// must only use alphanumeric characters (A-Z, a-z, and 0-9) and be 
// less than 40 characters.
$VALID_COUNTER_IDS = array('1');

?>