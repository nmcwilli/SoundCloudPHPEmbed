<?php 
/* ----------------------------------------------------------
SoundCloudPHPEmbed Script
Source: https://github.com/nmcwilli/SoundCloudPHPEmbed
License: MIT

SoundCloud PHP API Wrapper (code under Services folder) is Licensed to Anton Lindqvist. 
-------------------------------------------------------------

-------------------------------------------------------------
SoundCloudPHPEmbed Script created by Neil McWilliam
Email: mcwilliam@gmail.com
GitHub: https://github.com/nmcwilli/
Twitter: https://twitter.com/nmcwilli/
-------------------------------------------------------------

*Important note: Before using this code, you must (1) sign up for a developer account with SoundCloud and then (2) obtain a CLIENT_ID and a CLIENT_SECRET for your web based application.

Variables
============================================================= */
$soundcloudURL = 'YOURSOURCEURL'; /* Add source soundcloud url here */
$soundcloudColor = "FF7344"; /* Allows you to customize the color of your html5 widget */
$soundcloudComments = "true"; /* Allows you to show the the comments or not */
$soundcloudShowArtwork = "false"; /* Allows you to show the artwork of the album in your HTML5 widget or not */
$soundcloudClientID = 'YOUR_CLIENT_ID'; /* Change this to be your application CLIENT_ID */
$soundcloudClientSecret = 'YOUR_CLIENT_SECRET'; /* Change this to be your application CLIENT_SECRET */
$souncloudMaxHeight = '315'; /* Change default height to whatever you want */
/* ========================================================== */

/* If soundcloud variable is set, start */
if (isset($soundcloudURL))
{
	
	// Create a Client Object with your Credentials
	$client = new Services_Soundcloud($soundcloudClientID, $soundcloudClientSecret);
	$client->setCurlOptions(array(CURLOPT_FOLLOWLOCATION => 1));
	
	// Get Track
	try
	{
	   $track = json_decode($client->get('oembed', array('url'=>$soundcloudURL, 'color'=>$soundcloudColor, 'show_comments'=>$soundcloudComments, 'show_artwork'=>$soundcloudShowArtwork, 'maxheight'=>$souncloudMaxHeight)));
	} 
	catch (Services_Soundcloud_Invalid_Http_Response_Code_Exception $e)
	{
	   // If error you can display an error image here, or whatever you want
	}
	
	// If link is VALID - no errors
	if (empty($e))
	{
		// Render soundcloud html5 player
		print $track->html;
	}
}
?>