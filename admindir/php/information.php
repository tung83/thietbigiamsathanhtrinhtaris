<?php
function mainProcess()
{

	//process request form
	$msg="";

	if(isset($_POST["update"]))
	{
		$name=$_POST["name"];
		$eName=$_POST["eName"];
		$adds=$_POST["adds"];
		$eAdds=$_POST["eAdds"];
		$phone=$_POST["phone"];
		$copy=$_POST["vcopy"];
		$eCopy=$_POST["eCopy"];
		$hotline=$_POST["hotline"];
		$eHotline=$_POST["eHotline"];
		$sUpdate="update information set ";
		$sUpdate.="name='".str_replace("'","&rsquo;",$name)."',eName='".str_replace("'","&rsquo;",$eName)."',";
		$sUpdate.="adds='".str_replace("'","&rsquo;",$adds)."',eAdds='".str_replace("'","&rsquo;",$eAdds)."',";
		$sUpdate.="phone='".str_replace("'","&rsquo;",$phone)."'";
		$sUpdate.=",vcopy='".str_replace("'","&rsquo;",$copy)."'";
		$sUpdate.=",eCopy='".str_replace("'","&rsquo;",$eCopy)."'";
		$sUpdate.=",hotline='".str_replace("'","&rsquo;",$hotline)."'";
		$sUpdate.=",eHotline='".str_replace("'","&rsquo;",$eHotline)."'";
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	
	//end process request form
	
	$str="";
	$tab=mysql_query("select * from information");
	$row=mysql_fetch_object($tab);
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:78%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="4" style="" class="headTitle">Cập nhật thông tin công ty</td></tr>';
	$str.='<tr><td colspan="4" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	
	$str.='<tr>
				<td style="font-weight:bold">Tên công ty(*):</td>
				<td>
					<textarea type="text" name="name" cols="60" rows=3>'.$row->name.'</textarea>
				</td>
				<td style="font-weight:bold">Tên công ty-ENG(*):</td>
				<td>
					<textarea type="text" name="eName" cols="60" rows=3>'.$row->eName.'</textarea>
				</td>
				
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Địa chỉ*):</td>
				<td>
					<textarea type="text" name="adds" cols="60" rows=5>'.$row->adds.'</textarea>
				</td>
				<td style="font-weight:bold">Địa chỉ(ENG)(*):</td>
				<td>
					<textarea type="text" name="eAdds" cols="60" rows=5>'.$row->eAdds.'</textarea>
				</td>
			</tr>';
		$str.='<tr>
				<td style="font-weight:bold">Hotline(*):</td>
				<td>
					<textarea type="text" name="hotline" cols="60" rows=5>'.$row->hotline.'</textarea>
				</td>
				<td style="font-weight:bold">Hotline(ENG)(*):</td>
				<td>
					<textarea type="text" name="eHotline" cols="60" rows=5>'.$row->eHotline.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Copy right(*):</td>
				<td>
					<textarea type="text" name="vcopy" cols="60" rows=5>'.$row->vcopy.'</textarea>
				</td>
				<td style="font-weight:bold">Copy right(ENG)(*):</td>
				<td>
					<textarea type="text" name="eCopy" cols="60" rows=5>'.$row->eCopy.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Điện thoại - Fax:</td>
				<td>
					<textarea type="text" name="phone" cols="60" rows=5>'.$row->phone.'</textarea>
				</td><td colspan=2></td>
			</tr>';	
	
	
	//process group
	$str.='<tr><td></td><td>';
	$str.="<input type=\"submit\" name=\"update\" value=\"Cập nhật\" onclick=\"return confirm('Bạn có muốn cập nhật không?');\"/>";

	$str.='';
	$str.='</td></tr>';
	$str.="<tr><td colspan=2 height=200></td></tr>
	";
	//end process group
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}


?>