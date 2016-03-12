<?php
add_shortcode( 'WPSM_FAQ', 'WPSM_FAQ_ShortCode' );
function WPSM_FAQ_ShortCode( $Id ) {
	ob_start();	
	if(!isset($Id['id'])) 
	 {
		$WPSM_FAQ_ID = "";
	 } 
	else 
	{
		$WPSM_FAQ_ID = $Id['id'];
	}
	require("content.php"); 
	wp_reset_query();
    return ob_get_clean();
}
?>