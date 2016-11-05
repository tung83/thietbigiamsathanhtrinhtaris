<?php
function mainProcess()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$caption=str_replace("'","&rsquo;",$_POST["caption"]);
		$img=$_FILES["img"]["name"];
		$file=$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		
		$dates=date("Y-m-d");
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into document(title,active,dates) values('$caption'";
		$sInsert.=",$active,'".date("Y-m-d H:i:s")."')";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(chkRarPdf($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/upload/".$dates.$file);
			mysql_query("update document set files='".$dates.$file."' where id=$recent");
		}
		if(checkImg($img)==true)
		{
			move_uploaded_file($_FILES["img"]["tmp_name"],"../images/upload/".$dates.$img);
			mysql_query("update document set img='".$dates.$img."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from document where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update document set title='".$caption."'";
		$sUpdate.=",active=$active";
		if(chkRarPdf($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/upload/".$dates.$file);
			$sUpdate.=",files='".$dates.$file."'";
		}
		if(checkImg($img)==true)
		{
			move_uploaded_file($_FILES["img"]["tmp_name"],"../images/upload/".$dates.$file);
			$sUpdate.=",img='".$dates.$file."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=$sUpdate;
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from document where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin quản lý Download file</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>File</td>
				<td>Tiêu đề</td>				
				<td>Hình đại diện</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from document order by id desc";
	$tab=mysql_query($s);
	$lim=10;
	$page=isset($_GET["page"])?intval($_GET["page"]):1;
	$count=mysql_num_rows($tab);
	$start=($page-1)*$lim;
	$s.=" limit $start,$lim";
	$tb=mysql_query($s);
	while($row=mysql_fetch_object($tb))
	{
		$str.='<tr class="contentColumn">
					<td>'.$row->id.'</td>
					<td>'.$row->files.'</td>
					<td>'.($row->title==""?"&ensp;":$row->title).'</td>
					<td>
		<img src="../images/upload/'.$row->img.'" border="0" style="max-height:100px;border:1px solid black"/>
					</td>				
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					
					<td>';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:920px;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="180" style="font-weight:bold">Tiều đề(*):</td>
				<td >
					<input type="text" name="caption" class="txtBox" value="'.$rowEdit->title.'"/>
				</td>
				
			</tr>';
	
	
	$str.='<tr>
				<td width="" style="font-weight:bold">File(*):
				<br/><i style="font-weight:normal">(Chỉ up file rar,pdf,zip)</i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="" style="font-weight:bold">Ảnh đại diện(224x310)(*):
				</td>
				<td>
					<input type="file" name="img" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])==1&&$rowEdit->img!="")
	{
		$str.='<tr>
				<td width="" style="font-weight:bold;color:red">Ảnh hiện tại
				</td>
				<td>
<img src="../images/upload/'.$rowEdit->img.'" style="díplay:block;mã-height:150px;border:1px solid green;margin:5px auto"/>
				</td>
			</tr>';	
	}
	$str.='<tr>
				<td width="" style="font-weight:bold">Hiển thị(*):</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").'/>
				</td>
			</tr>';
	
	//process group
	$str.='<tr><td></td><td>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<input type="submit" name="update" value="Cập nhật"/>';
	}
	else $str.='<input type="submit" name="addNew" value="Thêm mới"/>';
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