<?php
function mainProcess()
{
	//process request form
	$msg="";
	$kindId=intval($_GET["id"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		
		$lnk=$_POST["lnk"];
		$eLnk=$_POST["eLnk"];
		$cLnk=$_POST["cLnk"];
		$file=$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$ind=$_POST["ind"];
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into brand(eLnk,cLnk,lnk,active,ind,kindId) values('".str_replace("'","&rsquo;",$eLnk)."',";
		$sInsert.="'".str_replace("'","&rsquo;",$cLnk)."'";
		$sInsert.=",'".str_replace("'","&rsquo;",$lnk)."',$active,$ind,$kindId)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkpic($file)==true)
		{
			$newName=reziseImg(170,0,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/banner/","");
			mysql_query("update brand set img='".$newName."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from brand where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update brand set eLnk='".str_replace("'","&rsquo;",$eLnk)."',cLnk='".str_replace("'","&rsquo;",$cLnk)."'";
		$sUpdate.=",lnk='".str_replace("'","&rsquo;",$lnk)."',active=$active,ind=$ind";
		if(checkpic($file)==true)
		{
			$newName=reziseImg(170,0,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/banner/","");
			$sUpdate.=",img='".$newName."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from brand where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	if($kindId==1)
	{
		$tip="nhãn hiệu";
	}
	else
	{
		$tip="link liên kết";
	}
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin quản lý $tip</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Hình ảnh</td>
				<td>Liên kết</td>
				<td>Liên kết(ENG)</td>
				<td>Liên kết(CN)</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from brand where kindId=$kindId order by ind asc";
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
					<td>'.$row->ind.'</td>
					<td>'.$row->img.'</td>
					<td>'.($row->lnk==""?"&ensp;":$row->lnk).'</td>
					
					<td>'.($row->eLnk==""?"&ensp;":$row->eLnk).'</td>
					<td>'.($row->cLnk==""?"&ensp;":$row->cLnk).'</td>
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
				<td width="120" style="font-weight:bold">Liên kết(*):</td>
				<td>
					<input type="text" name="lnk" class="txtBox" value="'.$rowEdit->lnk.'"/> (Http://)
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết (ENG)(*):</td>
				<td>
					<input type="text" name="eLnk" class="txtBox" value="'.$rowEdit->eLnk.'"/>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết (CN)(*):</td>
				<td>
					<input type="text" name="cLnk" class="txtBox" value="'.$rowEdit->cLnk.'"/>
				</td>
				
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh(*):
				<br/><i style="font-weight:normal">Size hình rộng 170px</i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh cũ:</td>
					<td>
						<img src="../images/banner/'.$rowEdit->img.'" border="0" style="width:170px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hiển thị(*):</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").'/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Vị trí(*):
				</td>
				<td>
					<input type="text" name="ind" class="txtBox" onkeypress="return keypress(event);" value="'.$rowEdit->ind.'"/>
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