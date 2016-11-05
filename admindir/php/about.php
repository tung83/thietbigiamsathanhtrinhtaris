<?php
function mainProcess()
{
	//process request form
	$msg="";
	$getKind=intval($_GET["id"]);
	if(isset($_POST["update"]))
	{
		$sum=$_POST["sum"];
		$eSum=$_POST["eSum"];
		$cSum=str_replace("'","&rsquo;",$_POST["cSum"]);
		$content=$_POST["content"];
		$eContent=$_POST["eContent"];
		$cContent=$_POST["cContent"];
		$file=$_FILES["file"]["name"];
		$sUpdate="update about set ";
		$sUpdate.="sum='".str_replace("'","&rsquo;",$sum)."',eSum='".str_replace("'","&rsquo;",$eSum)."',";
		$sUpdate.="cSum='$cSum',content='$content',eContent='$eContent',cContent='$cContent'";
		if(checkImg($file)==true)
		{
			$newName=reziseImg(377,0,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/about/","");
			$sUpdate.=",img='".$newName."'";
		}
		$sUpdate.=" where id=$getKind";
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	
	//end process request form
	
	$str="";
	$tab=mysql_query("select * from about where id=$getKind");
	$row=mysql_fetch_object($tab);
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:98%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật '.$row->title.'</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	
	/*$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(*):</td>
				<td>
					<textarea type="text" name="sum" cols="20" rows=5>'.$row->sum.'</textarea>
				</td>
				<td rowspan="7" valign=top>
					<b>Nội dung:</b>
					<textarea name="content" id="content" class="ckeditor">'.$row->content.'</textarea><br/>
					<b>Nội dung(ENG):</b>
					<textarea name="eContent" id="eContent" class="ckeditor">'.$row->eContent.'</textarea>
					<b>Nội dung(China):</b>
					<textarea name="cContent" id="cContent" class="ckeditor">'.$row->cContent.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(ENG)(*):</td>
				<td>
					<textarea type="text" name="eSum" cols="20" rows=5>'.$row->eSum.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(China)(*):</td>
				<td>
					<textarea type="text" name="cSum" cols="20" rows=5>'.$row->cSum.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Hình ảnh:</td>
				<td>
					<input type="file" name="file" />
				</td>
			</tr>';	
	$str.='<tr>
				<td style="font-weight:bold">Hình ảnh cũ:</td>
				<td style="padding:5px;" valign="top">
					<img src="../images/about/'.$row->img.'" border=0 style="border:1px solid red" width="180"/>
				</td>
			</tr>';	*/
	$str.='<tr>
				<td  valign=top>
				<div style="width:744px;margin:auto">
					<b>Tóm tắt:</b>
					<textarea name="sum" id="sum" class="ckeditor">'.$row->sum.'</textarea><br/>
					<b>Tóm tắt:(ENG):</b>
					<textarea name="eSum" id="eSum" class="ckeditor">'.$row->eSum.'</textarea>
					<b>Tóm tắt:(China):</b>
					<textarea name="cSum" id="cSum" class="ckeditor">'.$row->cSum.'</textarea>
					<b>Nội dung:</b>
					<textarea name="content" id="content" class="ckeditor">'.$row->content.'</textarea><br/>
					<b>Nội dung(ENG):</b>
					<textarea name="eContent" id="eContent" class="ckeditor">'.$row->eContent.'</textarea>
					<b>Nội dung(China):</b>
					<textarea name="cContent" id="cContent" class="ckeditor">'.$row->cContent.'</textarea>
				</div>
				</td>
			</tr>';

	//process group
	$str.='<tr><td align="center">';
	$str.="<input type=\"submit\" name=\"update\" value=\"Cập nhật\" onclick=\"return confirm('Bạn có muốn cập nhật không?');\"/>";

	$str.='';
	$str.='</td></tr>';
	$str.="<tr><td colspan=2 height=400></td></tr>
	";
	//end process group
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}


?>