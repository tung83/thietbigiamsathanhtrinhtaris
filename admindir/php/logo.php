<?php
function mainProcess()
{

	//process request form
	$msg="";

	if(isset($_POST["update"]))
	{
		$file=date("Y-m-d-H-i-s").$_FILES["file"]["name"];
		$eFile=date("Y-m-d-H-i-s").$_FILES["eFile"]["name"];
		if(checkpic($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/banner/$file");
			mysql_query("update logos set img='$file'");
		}
		if(checkpic($eFile)==true)
		{
			move_uploaded_file($_FILES["eFile"]["tmp_name"],"../images/banner/$eFile");
			mysql_query("update logos set eImg='$eFile'");
		}
		echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
	}
	
	//end process request form
	
	$str="";
	$tab=mysql_query("select * from logos");
	$row=mysql_fetch_object($tab);

		$img=playFlash("../images/banner/$row->img",650,80,"true");
	
		$eImg=playFlash("../images/banner/$row->eImg",650,80,"true");
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="1" style="width:800px;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="4" style="" class="headTitle">Cập nhật LOGO website ( Kích thước tối đa: 650px x 80px)</td></tr>';
	$str.='<tr><td colspan="4" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	
	$str.='<tr>
				<td style="font-weight:bold">Logo hiện tại(*):</td>
				<td width="680" align="center">
					'.$img.'
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Logo mới(*):</td>
				<td width="680" align="left">
					<input type="file" name="file" clas="txtBox"/>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Logo hiện tại - ENG(*):</td>
				<td width="680" align="center">
					'.$eImg.'
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Logo mới - ENG(*):</td>
				<td width="680" align="left">
					<input type="file" name="eFile" clas="txtBox"/>
				</td>
			</tr>';
	
	//process group
	$str.='<tr><td></td><td>';
	$str.="<input type=\"submit\" name=\"update\" value=\"Cập nhật\" onclick=\"return confirm('Bạn có muốn cập nhật không?');\"/>";

	$str.='';
	$str.='</td></tr>';
	//end process group
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}


?>