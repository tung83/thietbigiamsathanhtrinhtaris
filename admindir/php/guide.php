<?php
function mainProcess()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$title=str_replace("'","&rsquo;",$_POST["title"]);
		$eTitle=str_replace("'","&rsquo;",$_POST["eTitle"]);
		$cTitle=str_replace("'","&rsquo;",$_POST["cTitle"]);
		$sum=str_replace("'","&rsquo;",$_POST["sum"]);
		$eSum=str_replace("'","&rsquo;",$_POST["eSum"]);
		$cSum=str_replace("'","&rsquo;",$_POST["cSum"]);
		$active=$_POST["active"]=="on"?1:0;
		$file=$_FILES["file"]["name"];
		$content=str_replace("'","",$_POST["content"]);
		$eContent=str_replace("'","",$_POST["eContent"]);
		$cContent=str_replace("'","",$_POST["cContent"]);
		$ind=intval($_POST["ind"]);
		$dates=date("Y-m-d H:i:s");
		$tabAD=mysql_query("select name from admin where id='".$_SESSION["userId"]."'");
		$rowAd=mysql_fetch_object($tabAD);
		$userId=$rowAd->name;
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into guide(title,eTitle,cTitle,sum,eSum,cSum,content,eContent,cContent,active,dates,userId,ind) values(";
		$sInsert.="'$title','$eTitle','$cTitle','$sum','$eSum','$cSum','$content','$eContent','$cContent',$active,'$dates','$userId',$ind)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkpic($file)==true)
		{
			$newName=reziseImg(320,214,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/news/","");
			mysql_query("update guide set img='".$newName."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update guide set title='$title',eTitle='$eTitle',cTitle='$cTitle',sum='$sum',eSum='$eSum',cSum='$cSum',content='$content'";
		$sUpdate.=",eContent='$eContent',cContent='$cContent',active=$active,ind=$ind";
		if(checkpic($file)==true)
		{
			$newName=reziseImg(320,214,$_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"../images/news/","");
			$sUpdate.=",img='".$newName."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from guide where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from guide where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý hướng dẫn mua hàng</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>	
				<td>STT</td>					
				<td>Tiêu đề</td>
				<td>Tiêu đề (Eng)</td>
				<td>Tiêu đề (CN)</td>
				<td>Hình ảnh</td>
				<td>Hiển thị</td>
				<td>Ngày đăng</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from guide order by id desc";
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
					<td>'.$row->ind.'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->eTitle.'</td>
					<td>'.$row->cTitle.'</td>
					<td>'.$row->img.'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>'.date("d/m/Y",strtotime($row->dates)).'</td>
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
	$str.="<tr><td colspan=\"9\" align=\"center\" style=\"padding:5px\">&ensp;".adminPaging(10,$count,"main.php?cnht=guide&")."</td></tr>";
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
				<td width="120" style="font-weight:bold">Tiêu đề(*):</td>
				<td width="250">
					<textarea name="title" cols="30" rows="5">'.$rowEdit->title.'</textarea>
				</td>
				<td style="padding:5px;" rowspan="11" valign="top">
					<b>Nội dung tin tức:</b>
					<textarea name="content" id="content" class="ckeditor">'.$rowEdit->content.'</textarea><br/>
					<b>Nội dung tin tức(ENG):</b>
					<textarea name="eContent" id="eContent" class="ckeditor">'.$rowEdit->eContent.'</textarea><br/>
					<b>Nội dung tin tức(CN):</b>
					<textarea name="cContent" id="cContent" class="ckeditor">'.$rowEdit->cContent.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tiêu đề(ENG)(*):</td>
				<td>
					<textarea name="eTitle" cols="30" rows="5">'.$rowEdit->eTitle.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tiêu đề(CN)(*):</td>
				<td>
					<textarea name="cTitle" cols="30" rows="5">'.$rowEdit->cTitle.'</textarea>
				</td>
			</tr>';

	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(*):</td>
				<td>
					<textarea type="text" name="sum" cols="30" rows=5>'.$rowEdit->sum.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(ENG)(*):</td>
				<td>
					<textarea type="text" name="eSum" cols="30" rows=5>'.$rowEdit->eSum.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt(CN)(*):</td>
				<td>
					<textarea type="text" name="cSum" cols="30" rows=5>'.$rowEdit->cSum.'</textarea>
				</td>
			</tr>';

	$str.='<tr>
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").' />
				</td>
			</tr>';	
	$str.='<tr>
				<td style="font-weight:bold">Vị trí(*):</td>
				<td>
					<input type="text" name="ind" class="txtBox" value="'.$rowEdit->ind.'" onkeypress="return keypress(event);"/>
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
					<img src="../images/news/'.$rowEdit->img.'" border=0 style="border:1px solid red" width="90"/>
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