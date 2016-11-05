<?php
function mainProcess()
{
	$id=isset($_GET["id"])?$_GET["id"]:1;
	return about($id);	
}
function about($id)
{
	//process request form
	$msg="";

	if(isset($_POST["update"]))
	{
		$content=$_POST["content"];
		$eContent=$_POST["eContent"];
		$cContent=$_POST["cContent"];
		$sUpdate="update qtext set content='$content'";
		$sUpdate.=" where id=$id";
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	
	//end process request form
	
	$str="";
	$tab=mysql_query("select * from qtext where id=$id");
	$row=mysql_fetch_object($tab);
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:98%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật '.$row->name.'</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';

	$str.='<tr>
				
				<td valign=top>
					<b>Nội dung:</b>
					<textarea name="content" id="content" class="ckeditor">'.$row->content.'</textarea><br/>
				</td>
			</tr>';	
	//process group
	$str.='<tr><td>';
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