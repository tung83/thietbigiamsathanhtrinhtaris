
<?php
function mainProcess()
{
	if(isset($_GET["parentId"]))
	{
		return subKind();
	}
	else if(isset($_GET["id"]))
	{
		return product();
	}
	else if(isset($_GET["productId"]))
	{
		return productImage();
	}
	else return kind();
}

function kind()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);		
		$ind=$_POST["ind"];
		$active=$_POST["active"]=="on"?1:0;
		
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into kind(name,ind,active) value('$name'";
		$sInsert.=",$ind,$active)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
		
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from kind where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update kind set name='$name'";
		$sUpdate.=",ind='$ind',active=$active";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from kind where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin phân loại sản phẩm</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Danh mục dự án</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from kind order by ind asc,id desc";
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
					<td>'.$row->name.'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>';
		$str.="<a href=\"main.php?cnht=product&parentId=$row->id\">Xem</a> / ";
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"7\" style=\"padding:10px\">".adminPaging($lim,$count,"main.php?cnht=product&")."</td></tr>";
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:48%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="200" style="font-weight:bold">Danh mục dự án(*):</td>
				<td>
					<input type="text" name="name" class="txtBox" value="'.$rowEdit->name.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Vị trí sắp xếp(*):</td>
				<td>
					<input type="text" name="ind" class="txtBox" value="'.$rowEdit->ind.'" onkeypress="return keypress(event);"/>
				</td>
			</tr>';
	
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hiển thị???:</td>
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
function subKind()
{
	//process request form
	$getKind=intval($_GET["parentId"]);
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);
		
		$ind=$_POST["ind"];
		$active=$_POST["active"]=="on"?1:0;
		$pId=$_POST["parentKind"];
			
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into subkind(name,ind,active,pId) value('$name'";
		$sInsert.=",$ind,$active,$pId)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
		
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from subkind where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update subkind set name='$name'";
		$sUpdate.=",ind='$ind',active=$active,pId=$pId";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from subkind where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$tmp=mysql_query("select name,id from kind where id=$getKind");
	$tmp=mysql_fetch_object($tmp);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin danh mục con <strong>( $tmp->name )</strong>
	 - <a href=\"?cnht=product\" style=\"color:yellow\">
	Back</a></td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Danh mục con</td>				
				
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from subkind where pId=$getKind order by ind asc,id desc";
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
					<td>'.$row->name.'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>';
		$str.="<a href=\"main.php?cnht=product&id=$row->id\">Xem</a> / ";
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"7\" style=\"padding:10px\">".adminPaging($lim,$count,"main.php?cnht=product&")."</td></tr>";
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:48%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="200" style="font-weight:bold">Tên danh mục con(*):</td>
				<td>
					<input type="text" name="name" class="txtBox" value="'.$rowEdit->name.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Vị trí sắp xếp(*):</td>
				<td>
					<input type="text" name="ind" class="txtBox" value="'.$rowEdit->ind.'" onkeypress="return keypress(event);"/>
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").' />
				</td>
			</tr>';
	$slt="<select name=\"parentKind\" style=\"width:200px\">";
	$sltTab=mysql_query("select * from kind order by ind asc");
	while($sltRow=mysql_fetch_object($sltTab))
	{
		if($sltRow->id==$getKind) $slt.="<option value=\"$sltRow->id\" selected=\"selected\">$sltRow->name</option>";
		else $slt.="<option value=\"$sltRow->id\">$sltRow->name</option>";
	}
	$slt.="</select>";
	$str.='<tr>
				<td width="120" style="font-weight:bold">Thuộc phân loại:</td>
				<td>
					'.$slt.'
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
function product()
{
	//process request form
	$msg="";
	$getKind=isset($_GET["id"])?$_GET["id"]:0;
	if(mysql_num_rows(mysql_query("select id from kind where id=$getKind"))==0)
	{
		echo "<script>location.href=\"main.php?cnht=product\"</script>";
	}
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);
		$files=date("Y_m_d_H_i_s").$_FILES["files"]["name"];
		$feature=str_replace("'","&rsquo;",$_POST["feature"]);
		$content=$_POST["content"];
		$active=$_POST["active"]=="on"?1:0;
		$hot=$_POST["hot"]=="on"?1:0;
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into project(name,content,feature,pId,active,hot";
		$sInsert.=") values('$name','$content','$feature',$getKind,$active,$hot)";
		$test=mysql_query($sInsert);
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error().$sInsert;			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update project set name='$name',content='$content',feature='$feature',active=$active,hot=$hot";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from project where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from project where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$temp=mysql_query("select id,name,pId from subkind where id=$getKind");
	$temp=mysql_fetch_object($temp);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý sản phẩm <strong>( $temp->name )</strong>- 
	<a href=\"?cnht=product&parentId=$temp->pId\" style=\"color:yellow\">Back</a></td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Tên dự án</td>
				<td>Điểm nổi bật</td>
				<td>SP nổi bật</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from project where pId=$getKind order by id desc";
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
					<td>'.$row->name.' <br/></td>
					
					<td>'.nl2br($row->feature).'
					
					</td>
					<td>'.($row->hot==1?"Có":"Không").'</td>
					
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	<br/>
		<a href=\"?cnht=product&productId=$row->id\">Upload ảnh</a></td>
				</tr>";
	}
	
	//end content column
	//paing park here
	$str.="<tr>
			<td colspan=\"7\" align=\"center\" style=\"padding:5px\">&ensp;".adminPaging($lim,$count,"main.php?cnht=product&id=$getKind&")."</td>
		</tr>";
	//end paging park here
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:88%;margin:10px auto;font-size:12px" class="productClass">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Tên dự án(*):</td>
				<td>
					<input type="text" name="name" class="txtBox" value="'.$rowEdit->name.'" style="width:80%">
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Đặc điểm nổi bật(*):</td>
				<td>
					<textarea name="feature" class="txtBox" style="width:80%">'.$rowEdit->feature.'</textarea>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Nội dung(*):</td>
				<td>
					<textarea name="content" class="ckeditor" style="width:80%">'.$rowEdit->content.'</textarea>
				</td>
				
			</tr>';		
	$str.='<tr>
				<td style="font-weight:bold">Hiển thị???:</td>
				<td>
					<input type="checkbox" name="active" '.($rowEdit->active==1?"checked='checked'":"").' />
				</td>
			</tr>';	
	$str.='<tr>
				<td style="font-weight:bold">Sản phẩm nổi bật???:</td>
				<td>
					<input type="checkbox" name="hot" '.($rowEdit->hot==1?"checked='checked'":"").' />
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
function productImage()
{
	//process request form
	$msg="";
	$productId=intval($_GET["productId"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$file=$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$descript=str_replace("-","&dash;",str_replace("'","&rsquo;",$_POST["descript"]));
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into pimage(active,pId,name)";
		$sInsert.=" values($active,$productId,'$descript')";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/project/".date("Y-m-d-H-i-s").$_FILES["file"]["name"]);
			mysql_query("update pimage set img='".date("Y-m-d-H-i-s").$_FILES["file"]["name"]."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from pimage where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update pimage set active=$active,name='$descript'";
		if(checkImg($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],"../images/project/".date("Y-m-d-H-i-s").$_FILES["file"]["name"]);
			$sUpdate.=",img='".date("Y-m-d-H-i-s").$_FILES["file"]["name"]."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from pimage where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$tempTab=mysql_query("select pId,id,name from project where id=$productId");
	$tempRow=mysql_fetch_object($tempTab);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"7\" class=\"headTitle\">Thông tin quản lý hình ảnh sản phẩm $productId: $tempRow->name
				<a href=\"?cnht=product&id=$tempRow->pId\" style=\"color:yellow\">Quay lại trang trước</a>
			</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>
				<td>Hình ảnh</td>
				<td>Ghi chú</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from pimage where pId=$productId order by id desc";
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
					<td><img src="../images/project/'.$row->img.'" border="0" height="70"/></td>
				<td>'.$row->name.'</td>
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
				<td width="120" style="font-weight:bold">Hình ảnh 538x340(*):
				<br/><i style="font-weight:normal">Size hình </i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh cũ:</td>
					<td>

						<img src="../images/project/'.$rowEdit->img.'" border="0" style="width:222px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Ghi chú:</td>
				<td width="250">
					<input type="text" name="descript" class="txtBox" value="'.$rowEdit->name.'">
					
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
