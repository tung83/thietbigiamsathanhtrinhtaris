<?php
function mainProcess()
{
	return serv();
}
function serv()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$title=str_replace("'","&rsquo;",$_POST["title"]);		
		$sum=str_replace("'","&rsquo;",$_POST["sum"]);
		$active=$_POST["active"]=="on"?1:0;
		$hot=$_POST["hot"]=="on"?1:0;
		$fileName=date("Ydis").$_FILES["file"]["name"];
		$content=str_replace("'","",$_POST["content"]);		
		$dates=date("Y-m-d H:i:s");
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into serv(title,sum,content,active,dates,hot) values(";
		$sInsert.="'$title','$sum','$content',$active,'$dates',$hot)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($fileName)==true)
		{
			imageRex(270,202,$_FILES["file"]["tmp_name"],myPath.$fileName)	;
			mysql_query("update serv set img='".$fileName."' where id=$recent");
		}
		
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else echo $sInsert;//$msg=mysql_error();			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update serv set title='$title',sum='$sum',content='$content'";
		$sUpdate.=",active=$active,hot=$hot";
		if(checkImg($fileName)==true)
		{
			imageRex(270,202,$_FILES["file"]["tmp_name"],myPath.$fileName)	;
			$sUpdate.=",img='".$fileName."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from serv where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from serv where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý tin tức</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Tiêu đề</td>
				<td>Tóm tắt</td>
				<td>HOT??</td>
				<td width="100">Hiển thị</td>
				<td>Ngày đăng</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from serv order by id desc";
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
					<td>'.$row->title.'</td>					
					<td>'.nl2br($row->sum).'</td>
					<td>'.($row->hot==1?"<font style=\"color:#f00\">&#x2714;</font>":"").'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>'.date("d/m/Y",strtotime($row->dates)).'</td>
					<td>';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>
		
				</tr>";

	}
	
	//end content column
	//paing park here
	$str.="<tr><td colspan=\"8\" align=\"center\" style=\"padding:5px\">
			&ensp;".adminPaging(10,$count,"main.php?cnht=serv&")."</td></tr>";
	//end paging park here
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:1130px;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tiêu đề(*):</td>
				<td>
					<input type="text" class="txtBox" name="title" value="'.$rowEdit->title.'"/>
				</td>
			</tr>';
	

	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(*):</td>
				<td>
					<textarea type="text" class="txtBox" name="sum" cols="30" rows=5>'.$rowEdit->sum.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Nội dung(*):</td>
				<td>
					<div style="width:1000px">
					<textarea name="content" id="content" class="ckeditor">'.$rowEdit->content.'</textarea><br/>
					</div>
				</td>
				</td>
			</tr>';
	
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh(*):
				<br/><i style="font-weight:normal">Size hình 270x202</i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh hiện tại:</td>
					<td>
						<img src="'.myPath.$rowEdit->img.'" border="0" style="height:100px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	$str.='<tr>
				<td style="font-weight:bold">HOT(*):</td>
				<td>
					<input type="checkbox" name="hot" '.($rowEdit->hot==1?"checked='checked'":"").' />
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").' />
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
	//end process group
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;	
}

?>