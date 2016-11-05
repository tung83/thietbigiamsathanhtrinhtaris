<?php
function mainProcess()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$title=$_POST["caption"];
		$eTitle=$_POST["eCaption"];
		$cTitle=$_POST["cCaption"];
		$nick=$_POST["lnk"];
		$ind=$_POST["ind"];
		$skNick=$_POST["skNick"];
		$hotline=str_replace("'","&rsquo;",$_POST["hotline"]);
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into support(title,eTitle,cTitle,nick,skNick,ind) values('".str_replace("'","&rsquo;",$title)."',";
		$sInsert.="'".str_replace("'","&rsquo;",$eTitle)."','".str_replace("'","&rsquo;",$cTitle)."'";
		$sInsert.=",'".str_replace("'","&rsquo;",$nick)."','".str_replace("'","&rsquo;",$skNick)."',$ind)";
		$test=mysql_query($sInsert);
		mysql_query("update hotline set hotline='$hotline'");
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from support where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update support set title='".str_replace("'","&rsquo;",$title)."',eTitle='".str_replace("'","&rsquo;",$eTitle)."'";
		$sUpdate.=",nick='".str_replace("'","&rsquo;",$nick)."',skNick='".str_replace("'","&rsquo;",$skNick)."'";
		$sUpdate.=",ind=$ind,cTitle='".str_replace("'","&rsquo;",$cTitle)."'";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		mysql_query("update hotline set hotline='$hotline'");
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from support where id=".$_POST["idLoad"];
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
				<td>Yahoo</td>
				<td>Skype</td>
				<td>Tiêu đề</td>
				<td>Tiêu đề(ENG)</td>
				<td>Tiêu đề(CN)</td>
				
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from support order by ind asc";
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
					<td>'.$row->nick.'</td>
					<td>'.$row->skNick.'</td>
					<td>'.($row->title==""?"&ensp;":$row->title).'</td>
					<td>'.($row->eTitle==""?"&ensp;":$row->eTitle).'</td>
					<td>'.($row->cTitle==""?"&ensp;":$row->cTitle).'</td>
					
					
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
	$temp=mysql_query("select * from hotline");
	$temp=mysql_fetch_object($temp);
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
				<td rowspan="6" valign="top">
					<textarea name="hotline" class="txtBox">'.$temp->hotline.'</textarea>
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
				<td width="120" style="font-weight:bold">Nickname Yahoo(*):</td>
				<td>
					<input type="text" name="lnk" class="txtBox" value="'.$rowEdit->nick.'"/> (Http://)
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Nickname Skype(*):</td>
				<td>
					<input type="text" name="skNick" class="txtBox" value="'.$rowEdit->skNick.'"/> (Http://)
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