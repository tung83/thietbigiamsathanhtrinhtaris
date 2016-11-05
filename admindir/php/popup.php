
<?php
function mainProcess()
{
	//process request form
	$msg="";
	$productId=intval($_GET["productId"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$lnk=$_POST["lnk"];
		$file=$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$descript=str_replace("'","",str_replace("'","&rsquo;",$_POST["descript"]));
		$eDescript=str_replace("","",str_replace("'","&rsquo;",$_POST["eDescript"]));
		$cDescript=str_replace("","",str_replace("'","&rsquo;",$_POST["cDescript"]));
		$notes=str_replace("'","",str_replace("'","&rsquo;",$_POST["notes"]));
		$eNotes=str_replace("","",str_replace("'","&rsquo;",$_POST["eNotes"]));
		$cNotes=str_replace("","",str_replace("'","&rsquo;",$_POST["cNotes"]));
	}

	if(isset($_POST["update"]))
	{
		$sUpdate="update popup set active=$active,lnk='$descript',eLnk='$eDescript',cLnk='$cDescript',notes='$notes'";
		$sUpdate.=",eNotes='$eNotes',cNotes='$cNotes'";
		if(checkImg($file)==true)
		{
			$newName=reziseImg(240,200,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/news/","");
			$sUpdate.=",img='".$newName."'";
		}
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	$str="";
	//show information here!!	
	$tab=mysql_query("select * from popup");
	$row=mysql_fetch_object($tab);
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:920px;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';	
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh 240x200(*):
				<br/><i style="font-weight:normal">Size hình </i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh cũ:</td>
				<td>
					<img src="../images/news/'.$row->img.'" border="0" style="width:240px;height:200px;border:1px solid #aeaeae"/>
				</td>
			</tr>';	
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Dòng chữ hiển thị(*):
				</td>
				<td>
					<input type="text" name="notes" class="txtBox" value="'.$row->notes.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Dòng chữ hiển thị - Eng(*):
				</td>
				<td>
					<input type="text" name="eNotes" class="txtBox" value="'.$row->eNotes.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Dòng chữ hiển thị - CN(*):
				</td>
				<td>
					<input type="text" name="cNotes" class="txtBox" value="'.$row->cNotes.'"/>
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết(*):
				</td>
				<td>
					<input type="text" name="descript" class="txtBox" value="'.$row->lnk.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết - Eng(*):
				</td>
				<td>
					<input type="text" name="eDescript" class="txtBox" value="'.$row->eLnk.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết - CN(*):
				</td>
				<td>
					<input type="text" name="cDescript" class="txtBox" value="'.$row->cLnk.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($row->active==1?"checked='checked'":"").' />
				</td>
			</tr>';	
	
	//process group
	$str.='<tr><td></td><td>';
	$str.='<input type="submit" name="update" value="Cập nhật"/>';
	$str.='';
	$str.='</td></tr>';
	$str.='
			<input type="hidden" name="idLoad" value="'.$_POST["idLoad"].'"/>
			<input type="hidden" name="Edit"/>
			<input type="hidden" name="Del"/>
		';
	//end process group
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}

?> 
