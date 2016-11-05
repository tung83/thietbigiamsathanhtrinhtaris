<?php
function mainProcess()
{
	//process request form
	$msg="";
	$kindId=intval($_GET["id"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$caption=$_POST["caption"];
		$eCaption=$_POST["eCaption"];
		$cCaption=$_POST["cCaption"];
		$lnk=$_POST["lnk"];
		$eLnk=str_replace("'","",$_POST["eLnk"]);
		$cLnk=str_replace("'","",$_POST["cLnk"]);	
		$file=$_FILES["file"]["name"];
		$eFile=$_FILES["eFile"]["name"];
		$cFile=$_FILES["cFile"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$ind=$_POST["ind"];
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into bannerpd(title,eTitle,cTitle,lnk,eLnk,cLnk,active,ind,kindId) values('".str_replace("'","&rsquo;",$caption)."',";
		$sInsert.="'".str_replace("'","&rsquo;",$eCaption)."','".str_replace("'","&rsquo;",$cCaption)."'";
		$sInsert.=",'".str_replace("'","&rsquo;",$lnk)."','$eLnk','$cLnk',$active,$ind,$kindId)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkpic($file)==true)
		{
			$newName=reziseImg(980,326,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/banner/","");
			mysql_query("update bannerpd set img='".$newName."' where id=$recent");
		}
		if(checkpic($eFile)==true)
		{
			$newName=reziseImg(980,326,$_FILES["eFile"]["tmp_name"],$_FILES["eFile"]["name"],"../images/banner/","");
			mysql_query("update bannerpd set eImg='".$newName."' where id=$recent");
		}
		if(checkpic($cFile)==true)
		{
			$newName=reziseImg(980,326,$_FILES["cFile"]["tmp_name"],$_FILES["cFile"]["name"],"../images/banner/","");
			mysql_query("update bannerpd set cImg='".$newName."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from bannerpd where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update bannerpd set title='".str_replace("'","&rsquo;",$caption)."',eTitle='".str_replace("'","&rsquo;",$eCaption)."',eLnk='$eLnk'";
		$sUpdate.=",lnk='".str_replace("'","&rsquo;",$lnk)."',active=$active,ind=$ind,cTitle='".str_replace("'","&rsquo;",$cCaption)."',cLnk='$cLnk'";
		if(checkpic($file)==true)
		{
			$newName=reziseImg(980,326,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/banner/","");
			$sUpdate.=",img='".$newName."'";
		}
		if(checkpic($eFile)==true)
		{
			$newName=reziseImg(980,326,$_FILES["eFile"]["tmp_name"],$_FILES["eFile"]["name"],"../images/banner/","");
			$sUpdate.=",eImg='".$newName."'";
		}
		if(checkpic($cFile)==true)
		{
			$newName=reziseImg(980,326,$_FILES["ile"]["tmp_name"],$_FILES["ile"]["name"],"../images/banner/","");
			$sUpdate.=",cImg='".$newName."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from bannerpd where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin quản lý Slide</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Hình ảnh</td>
				<td>Liên kết</td>
				<td>Tiêu đề</td>
				<td>Tiêu đề(ENG)</td>
				<td>Tiêu đề(CN)</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from bannerpd where kindId=$kindId order by ind asc";
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
					<td>'.($row->img==""?"&ensp;":$row->img.'<i style="color:red">(Vn)</i>').'
					'.($row->eImg==""?"&ensp;":"<br/>".$row->eImg.'<i style="color:red">(En)</i>').'
					'.($row->cImg==""?"&ensp;":"<br/>".$row->cImg.'<i style="color:red">(Cn)</i>').'</td>
					<td>'.($row->lnk==""?"&ensp;":$row->lnk.'<i style="color:red">(Vn)</i>').'
					'.($row->eLnk==""?"&ensp;":"<br/>".$row->eLnk.'<i style="color:red">(En)</i>').'
					'.($row->cLnk==""?"&ensp;":"<br/>".$row->cLnk.'<i style="color:red">(Cn)</i>').'</td>
					<td>'.($row->title==""?"&ensp;":$row->title).'</td>
					<td>'.($row->eTitle==""?"&ensp;":$row->eTitle).'</td>
					<td>'.($row->cTitle==""?"&ensp;":$row->cTitle).'</td>
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
				<td width="120" style="font-weight:bold">Tiều đề(*):</td>
				<td >
					<input type="text" name="caption" class="txtBox" value="'.$rowEdit->title.'"/>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tiêu đề (ENG)(*):</td>
				<td>
					<input type="text" name="eCaption" class="txtBox" value="'.$rowEdit->eTitle.'"/>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tiêu đề (CN)(*):</td>
				<td>
					<input type="text" name="cCaption" class="txtBox" value="'.$rowEdit->cTitle.'"/>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết(*):</td>
				<td>
					<input type="text" name="lnk" class="txtBox" value="'.$rowEdit->lnk.'"/> (Http://)
				</td>
			</tr>';
		$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết-Eng(*):</td>
				<td>
					<input type="text" name="eLnk" class="txtBox" value="'.$rowEdit->eLnk.'"/> (Http://)
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Liên kết-CN(*):</td>
				<td>
					<input type="text" name="cLnk" class="txtBox" value="'.$rowEdit->cLnk.'"/> (Http://)
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh(*):
				<br/><i style="font-weight:normal">Size hình 980x326</i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh cũ:</td>
					<td>
						<img src="../images/banner/'.$rowEdit->img.'" border="0" style="height:100px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh-Eng(*):
				<br/><i style="font-weight:normal">Size hình 980x326</i></td>
				<td>
					<input type="file" name="eFile" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh cũ-Eng:</td>
					<td>
						<img src="../images/banner/'.$rowEdit->eImg.'" border="0" style="height:100px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh-CN(*):
				<br/><i style="font-weight:normal">Size hình 980x326</i></td>
				<td>
					<input type="file" name="cFile" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh cũ-CN:</td>
					<td>
						<img src="../images/banner/'.$rowEdit->cImg.'" border="0" style="height:100px;border:1px solid #aeaeae"/>
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