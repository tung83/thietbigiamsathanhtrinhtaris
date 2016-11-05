<?php

/*function sessionTime($thoiHan=1000){

	$nowTime = time();

	if( !session_is_registered('ssTime')){

		session_register('ssTime');	

	}

	else{

		if( ($nowTime - $_SESSION['ssTime']) >= $thoiHan ){

			session_unset();		

			session_register('ssTime');	

		}

	}

	$_SESSION['ssTime'] = $nowTime;

}

function GetBanner(&$con){

	$ojHtml = new CHtmlTemplate();

	$ojHtml->setTemplate(_dirTemplates.'banner.htm');

	$ojHtml->setParameter('TenAdmin',$_SESSION['ssHoVaTen']);

	$ojHtml->setParameter('MaAdmin',$_SESSION['ssMaAdmin']);

	return $ojHtml->CreatePageReturn();

}

function GetMenu(){

	$ojHtml = new CHtmlTemplate();

	$ojHtml->setTemplate(_dirTemplates.'menu.htm');

	return $ojHtml->CreatePageReturn();

}

function GetBody($db){

global $db;*/

	$chucNang = isset($_GET["cnht"])?$_GET["cnht"]:"";

	switch ($chucNang) 

	{

		case "addTool":

		{

			require("php/addTool.php");

			break;

		}

		case "news":

		{

			require("php/news.php");			

			break;

		}

		case "aboutus":

		{

			require("php/aboutus.php");			

			break;

		}

		case "serv":

		{

			require("php/serv.php");			

			break;

		}

		case "product":

		{

			require("php/product.php");

			break;

		}

		case "partner":

		{

			require("php/partner.php");

			break;

		}

		case "about":

		{

			require("php/about.php");

			break;

		}

		case "banner":

		{

			require("php/banner.php");

			break;

		}

		case "slider":

		{

			require("php/slider.php");

			break;

		}

		case "contact":

		{

			require("php/contact.php");

			break;

		}

		case "service":

		{

			require("php/service.php");

			break;

		}

		case "blog":

		{

			require("php/blog.php");

			break;

		}

		case "email":

		{

			require("php/email.php");

			break;

		}

		case "sale":

		{

			require("php/sale.php");

			break;

		}

		case "career":

		{

			require("php/career.php");

			break;

		}

		case "qtext":

		{

			require("php/qtext.php");

			break;

		}

		case "cart":

		{

			require("php/cart.php");

			break;

		}

		case "faqs":

		{

			require("php/FAQs.php");

			break;

		}

		case "brand":

		{

			require("php/brand.php");

			break;

		}

		case "pdSlide":

		{

			require("php/pdSlide.php");

			break;

		}

		case "guide":

		{

			require("php/guide.php");

			break;

		}

		case "popup":

		{

			require("php/popup.php");

			break;

		}

		case "upload":

		{

			require("php/documents.php");

			break;

		}

	}



function checkad()

{

	$idadmin=(isset($_SESSION['ssMaAdmin']))?$_SESSION['ssMaAdmin']:0;

	$checkadmin=mysql_query("select * from admin where MaAdmin=$idadmin");

	$rowcheck=mysql_fetch_object($checkadmin);

	$pwer=$rowcheck->CapDo;

	return $pwer;

	

}

function checkpic($file)

{

	if($file!="")

	{

		$sb="png,gif,jpg,bmp,swf";

		$str=strtolower(substr($file,-3,3));

		if(strstr($sb,$str)!=NULL||strstr($sb,$str)!="") return true;	

		else return false;

	}else return false;

}

function chkRarPdf($file)

{

	if($file!="")

	{

		$sb="rar,pdf,zip";

		$str=strtolower(substr($file,-3,3));

		if(strstr($sb,$str)!=NULL||strstr($sb,$str)!="") return true;	

		else return false;

	}else return false;

}



function uploadimg($file,$tmp_file,$adds)

{

	$tail=strtolower(substr($file,-3,3));

	if($tail=="jpg")

		$img = imagecreatefromjpeg($tmp_file);  

	else if($tail=="png")

		$img= imagecreatefrompng($tmp_file);

	else if($tail=="gif")

		$img=imagecreatefromgif($tmp_file);

	$img_width  = imagesx($img);

	$img_height = imagesy($img);

	$width  = 700;

	$height = 382;

	$tlx = floor($img_width / 2) - floor ($width / 2);

	$tly = floor($img_height / 2) - floor($height / 2);

	if ($tlx < 0)

	{

	  $tlx = 0;

	}

	if ($tly < 0)

	{

	  $tly = 0;

	}

	if (($img_width - $tlx) < $width)

	{

	  $width = $img_width - $tlx;

	}

	if (($img_height - $tly) < $height)

	{

	  $height = $img_height - $tly;

	}

	$im = imagecreatetruecolor($width, $height);

	imagecopy($im, $img, 0, 0, $tlx, $tly, $width, $height);

	$newfilename=$adds.date("Y-m-d-H-i-s")."giashock.png";

	imagepng($im, "../images/products/".$newfilename, 0);

	imagedestroy($img);

	return $newfilename;

}

function getDistrict($sName,$rowEdit)

{

	$str='<select name="'.$sName.'">';

	$tab=mysql_query("select * from district order by id asc");

	while($row=mysql_fetch_object($tab))

	{

		if(isset($_POST["Edit"])&&$_POST["Edit"]==1)

		{

			if($rowEdit->dId==$row->id)

			{

				$str.='<option value="'.$row->id.'" selected="selected">'.$row->name.'</option>';	

			}	

			else

			{

				$str.='<option value="'.$row->id.'">'.$row->name.'</option>';	

			}

		}

		$str.='<option value="'.$row->id.'">'.$row->name.'</option>';	

	}

	$str.='</select>';

	return $str;	

}



?>