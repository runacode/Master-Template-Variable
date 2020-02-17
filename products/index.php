<?php
$CloakerConfig = json_decode( file_get_contents(sprintf("%s/../includes/config/Cloaker.json", dirname(__FILE__))));

$GLOBALS['_ta_campaign_key'] = '3eefdf4319ef6896233270ead9985f30';
$GLOBALS['_ta_debug_mode'] = false; //To enable debug mode, set to true or load this script with a '?debug_key=3eefdf4319ef6896233270ead9985f30' parameter

require 'bootloader_dcdd1f867cef62dee890df599bdc27c0.php';

$campaign_id = $CloakerConfig->campaign_id;

$ta = new TALoader($campaign_id);


if ($ta->suppress_response()) {//Do not send any output when hybrid mode is enabled and a visitor is being filtered (after hybrid page was generated)
    exit;
}

$response = $ta->get_response();
$visitor = $ta->get_visitor();

/*
 * Advanced users: uncomment lines below during development to expose variables you may want to use in your custom code:
 */
//print_r($response);
//print_r($visitor);
//exit;
/*
 * Don't forget to re-comment the lines above before sending live traffic
 */

/*
Note: when using hybrid mode, please use one of our built-in functions as your final step when routing your visitors:
    print header_redirect("http://url.com"); //performs a 302 header redirect (or a window.location=xxx in JS)
    print load_fullscreen_iframe("http://url.com"); //Loads a fullscreen iframe of the specified URL
    print paste_html("http://url.com"); //Downloads HTML in specified URL and outputs it to the screen (uses JS to insert the HTML in hybrid mode)
(These functions will automatically output either regular HTML or JS code depending on what the visitor's browser is expecting)
*/

switch ($response['action']) {
    case 'header_redirect':
        print header_redirect($response['url']); //Uses <script>window.location='xxx'</script> when in hybrid mode (required behaviour)
        exit;
    case 'iframe':
      include_once('catalog.php');
        exit;

    case 'paste_html':
        include_once('catalog.php');
        exit;
    /* Please be VERY CAREFUL if modifying this block: */
    case 'load_hybrid_page':
       include_once('catalog.php');
        exit;
        $ta->load_hybrid_page();
        break;
    /* ...it is needed for hybrid mode to function correctly */
}

/*
 * Note: if using the "Remain on Safe Page" action for Filtered Visitors, append your safe page's HTML/PHP code after the closing PHP tag below:
 */ 
?>
