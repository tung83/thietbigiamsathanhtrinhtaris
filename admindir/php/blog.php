<?php
function mainProcess()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$title=str_replace("'","&rsquo;",$_POST["title"]);		
		$sum=str_replace("'","&rsquo;",$_POST["sum"]);		
		$active=$_POST["active"]=="on"?1:0;
		$fileName=date("Ydis").$_FILES["files"]["name"];
		$content=str_replace("'","",$_POST["content"]);
		$tags=str_replace("'","&rsquo;",$_POST["tags"]);	
		$dates=date("Y-m-d H:i:s");
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into blog(tit,sum,content,act,dat,tags) values(";
		$sInsert.="'$title','$sum','$content',$active,'$dates','$tags')";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($fileName)==true)
		{
			imageRex(160,140,$_FILES["files"]["tmp_name"],myPath.$fileName)	;
			mysql_query("update blog set img='".$fileName."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update blog set tit='$title',sum='$sum',content='$content',tags='$tags'";
		$sUpdate.=",act=$active";
		if(checkImg($fileName)==true)
		{
			imageRex(160,140,$_FILES["files"]["tmp_name"],myPath.$fileName)	;
			$sUpdate.=",img='".$fileName."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from blog where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from blog where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý Blog</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Tiêu đề</td>
				<td>Tóm tắt</td>
				<td>Hình ảnh</td>
				<td>Hiển thị</td>
				<td>Ngày đăng</td>
				<td>Lượt xem</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from blog order by id desc";
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
					<td>'.$row->tit.'</td>					
					<td>'.nl2br($row->sum).'</td>
					<td>'.($row->img!=''?'<img src="'.myPath.$row->img.'" border="0" style="height:50px"/>':'&nbsp;').'</td>
					<td>'.($row->act==1?"Hiện":"Ẩn").'</td>
					<td>'.date("d/m/Y",strtotime($row->dat)).'</td>
					<td>'.$row->vie.'</td>
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
	$str.="<tr><td colspan=\"8\" align=\"center\" style=\"padding:5px\">&ensp;".adminPaging(10,$count,"main.php?cnht=blog&")."</td></tr>";
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
					<input type="text" class="txtBox" name="title" value="'.$rowEdit->tit.'"/>
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
				<td width="120" style="font-weight:bold">Tags(*):</td>
				<td>
					<input type="text" class="txtBox" name="tags" value="'.$rowEdit->tags.'"/>
					<font color="#FF0000" style="display:block;margin:5px">(Mỗi tag cách nhau bằng dấu \'#\')</font>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh(*):
				<br/><i style="font-weight:normal">Size hình 160x140</i></td>
				<td>
					<input type="file" name="files" class="txtBox"/>
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
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->act==1?"checked='checked'":"").' />
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