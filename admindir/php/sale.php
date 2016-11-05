<?php
function mainProcess()
{
	if(isset($_GET["productId"]))
	{
		return productImage();
	}
	else return product();
}
function product()
{
	//process request form
	$msg="";
	
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$title=str_replace("'","&rsquo;",$_POST["title"]);
		$price=str_replace("'","&rsquo;",$_POST["price"]);
		$contact=str_replace("'","&rsquo;",$_POST["contact"]);
		$area=str_replace("'","&rsquo;",$_POST["area"]);
		$feature=str_replace("'","&rsquo;",$_POST["feature"]);
		$sum=str_replace("'","&rsquo;",$_POST["sum"]);
		$detail=str_replace("'","",$_POST["detail"]);
		$active=$_POST["active"]=="on"?1:0;
		$dId=$_POST["district"];
		$dates=date("Y-m-d H:i:s");
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into sale(title,price,contact,area,detail,feature,sum,active,dates,dId";
		$sInsert.=") values('$title','$price','$contact','$area','$detail','$feature','$sum',$active,'$dates',$dId)";
		$test=mysql_query($sInsert);
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error().$sInsert;			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update sale set title='$title',price='$price',contact='$contact',area='$area',active=$active,dId=$dId";
		$sUpdate.=",area='$area',detail='$detail',feature='$feature',sum='$sum'";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from sale where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from sale where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test)
		{
			delForeign("sImage","pId",$_POST["idLoad"]);
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý sản phẩm <strong></td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Tiêu đề</td>
				<td>Giá bán</td>
				<td>Người liên hệ</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from sale order by id desc";
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
					<td>'.$row->title.' <br/></td>
					
					<td>'.$row->price.'
					
					</td>
					<td>'.$row->contact.'
					
					</td>
					
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	<br/>
		<a href=\"?cnht=sale&productId=$row->id\">Upload ảnh</a></td>
				</tr>";
	}
	
	//end content column
	//paing park here
	$str.="<tr>
			<td colspan=\"7\" align=\"center\" style=\"padding:5px\">&ensp;".adminPaging($lim,$count,"main.php?cnht=sale&")."</td>
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
				<td width="220" style="font-weight:bold">Tiêu đề(*):</td>
				<td>
					<input type="text" name="title" class="txtBox" value="'.$rowEdit->title.'" style="width:80%">
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Giá bán(*):</td>
				<td>
					<input type="text" name="price" class="txtBox" value="'.$rowEdit->price.'" style="width:80%">
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Liên hệ(*):</td>
				<td>
					<input type="text" name="contact" class="txtBox" value="'.$rowEdit->contact.'" style="width:80%">
				</td>
				
			</tr>';		
	$str.='<tr>
				<td width="220" style="font-weight:bold">Diện tích(*):</td>
				<td>
					<input type="text" name="area" class="txtBox" value="'.$rowEdit->area.'" style="width:80%">
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Sơ lược(*):</td>
				<td>
					<textarea name="sum" class="txtBox" style="width:80%">'.$rowEdit->sum.'</textarea>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Đặc điểm nổi bật(*):</td>
				<td>
					<textarea name="feature" class="txtBox" style="width:80%">'.$rowEdit->feature.'</textarea>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Mô tả chi tiết(*):</td>
				<td>
					<textarea name="detail" class="ckeditor" style="width:80%">'.$rowEdit->detail.'</textarea>
				</td>
				
			</tr>';		
	
			
	$str.='<tr>
				<td style="font-weight:bold">Quận/Huyện:</td>
				<td>
					'.getDistrict("district",$rowEdit).'
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
function productImage()
{
	//process request form
	$msg="";
	$productId=intval($_GET["productId"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$file=date("Ydis").$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$descript=str_replace("-","&dash;",str_replace("'","&rsquo;",$_POST["descript"]));
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into simage(active,pId,name)";
		$sInsert.=" values($active,$productId,'$descript')";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],myPath.$file);
			mysql_query("update simage set img='".$file."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from simage where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update simage set active=$active,name='$descript'";
		if(checkImg($file)==true)
		{
			move_uploaded_file($_FILES["file"]["tmp_name"],myPath.$file);
			$sUpdate.=",img='".$file."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from simage where id=".$_POST["idLoad"];
		$temp=mysql_query("select img from simage where id=".$_POST["idLoad"]);
		$temp=mysql_fetch_object($temp);
		if($temp->img!="")
		{
			unlink(myPath.$temp->img);	
		}
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$tempTab=mysql_query("select title from sale where id=$productId");
	$tempRow=mysql_fetch_object($tempTab);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"7\" class=\"headTitle\">Thông tin quản lý hình ảnh: $tempRow->title
				
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
	$s="select * from simage where pId=$productId order by id desc";
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
					<td><img src="'.myPath.$row->img.'" border="0" height="70"/></td>
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


		<img src="'.myPath.$rowEdit->img.'" border="0" style="width:222px;border:1px solid #aeaeae"/>
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