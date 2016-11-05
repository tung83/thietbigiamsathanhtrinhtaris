<?php
function mainProcess()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$notice=str_replace("'","&rsquo;",$_POST["notice"]);
		$active=$_POST["active"]=="on"?1:0;
		$content=str_replace("'","",$_POST["content"]);
		$eContent=str_replace("'","",$_POST["eContent"]);
		$cContent=str_replace("'","",$_POST["cContent"]);
		$ind=$_POST["ind"];
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into show_room(notice,active,content,eContent,cContent,ind) values(";
		$sInsert.="'$notice','$active','$content','$eContent','$cContent',$ind)";
		$test=mysql_query($sInsert);
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update show_room set notice='$notice',content='$content'";
		$sUpdate.=",eContent='$eContent',cContent='$cContent',active=$active,ind='$ind'";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from show_room where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from show_room where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý show Room</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Ghi chú</td>
				<td>Vị trí</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from show_room order by id desc";
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
					<td>'.$row->notice.'</td>
					<td>'.$row->ind.'</td>
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
	//paing park here
	$str.="<tr><td colspan=\"8\" align=\"center\" style=\"padding:5px\">&ensp;".adminPaging($lim,$count,"main.php?cnht=showroom&")."</td></tr>";
	//end paging park here
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:98%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Ghi chú(*):</td>
				<td width="250">
					<textarea name="notice" cols="30" rows="5">'.$rowEdit->notice.'</textarea>
				</td>
				<td style="padding:5px;" rowspan="6" valign="top">
					<b>Nội dung:</b>
					<textarea name="content" id="content" class="ckeditor">'.$rowEdit->content.'</textarea><br/>
					<b>Nội dung(ENG):</b>
					<textarea name="eContent" id="eContent" class="ckeditor">'.$rowEdit->eContent.'</textarea><br/>
					<b>Nội dung(CN):</b>
					<textarea name="cContent" id="cContent" class="ckeditor">'.$rowEdit->cContent.'</textarea>
				</td>
			</tr>';

	$str.='<tr>
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").' />
				</td>
			</tr>';	
	$str.='<tr>
				<td style="font-weight:bold">Vị trí sắp xếp(*):</td>
				<td>
					<input type="text" name="ind" class="txtBox" value="'.$rowEdit->ind.'" onkeypress="return keypress(event);"/>
				</td>
			</tr>';
	
	$str.="<tr><td colspan=\"2\"></td></tr>";
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
	$str.="<tr><td colspan=\"2\" height=\"800\">&ensp;</td></tr>";
	//end process group
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}

?>