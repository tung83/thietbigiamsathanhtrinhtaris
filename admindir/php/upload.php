<?php
function mainProcess()
{
//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$file=date("Y_m_d_H_i_s").$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$ind=intval($_POST["ind"]);
		$descript=str_replace("'","&rsquo;",str_replace("'","&rsquo;",$_POST["descript"]));
		$eDescript=str_replace("'","&rsquo;",str_replace("'","&rsquo;",$_POST["eDescript"]));
		$cDescript=str_replace("'","&rsquo;",str_replace("'","&rsquo;",$_POST["cDescript"]));
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into document(active,ind,title,eTitle,cTitle)";
		$sInsert.=" values($active,$ind,'$descript','$eDescript','$cDescript')";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if($_FILES["file"]["name"]!="")
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/product/".$file);
			mysql_query("update document set file='".$file."' where id=$recent");
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
		$sUpdate="update document set active=$active,ind=$ind,title='$descript',eTitle='$eDescript',cTitle='$cDescript'";
		if($_FILES["file"]["name"]!="")
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/product/".$file);
			$sUpdate.=",file='".$file."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
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
	$str.="<tr><td colspan=\"7\" class=\"headTitle\">Quản lý upload file
			</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				
				<td>Tiêu đề</td>
				<td>File download</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from document order by ind asc";
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
					
					<td>'."$row->title</br>$row->eTitle<br/>$row->cTitle".'</td>	
					<td>'.("$row->file"!=""?'<a href="../images/product/'."$row->file".'">Files...</a>':"").'</td>
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
				<td width="120" style="font-weight:bold">Files upload(*):
				</td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tiêu đề(*):
				</td>
				<td>
					<input type="text" name="descript" class="txtBox" value="'.$rowEdit->title.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tiêu đề - Eng(*):
				</td>
				<td>
					<input type="text" name="eDescript" class="txtBox" value="'.$rowEdit->eTitle.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tiêu đề - CN(*):
				</td>
				<td>
					<input type="text" name="cDescript" class="txtBox" value="'.$rowEdit->cTitle.'"/>
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Vị trí(*):
				</td>
				<td>
					<input type="text" name="ind" class="txtBox" onkeypress="return keypress(event);" value="'.$rowEdit->ind.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").' />
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