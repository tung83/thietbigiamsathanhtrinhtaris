
<?php
function mainProcess()
{
	if(isset($_GET["pId"]))
	{
		return productImage();	
	}
	else if(isset($_GET["id"]))
	{
		return product();
	}else if(isset($_GET["kind"])) return kind();
	else return brand();
}
function kind()
{
	//process request form
	$msg="";
	$pId=intval($_GET["kind"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);		
		$ind=$_POST["ind"];
		$active=$_POST["active"]=="on"?1:0;		
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into kind(name,ind,active,pId) value('$name'";
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
	$tmp=mysql_query("select id,name from brand where id=$pId order by id desc");
	$tmp=mysql_fetch_object($tmp);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý phân loại (Thuộc: $tmp->name)
		<a href=\"main.php?cnht=product\" style=\"color:yellow\">Back...</a></td>
	</tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Tên Nhóm</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from kind where pId=$pId order by ind asc,id desc";
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
		$str.="<a href=\"main.php?cnht=product&id=$row->id\">Chi tiết</a> / ";
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"7\" style=\"padding:10px\">".adminPaging($lim,$count,"main.php?cnht=product&kind=$pId&")."</td></tr>";
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
				<td width="200" style="font-weight:bold">Tên phân loại(*):</td>
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
function brand()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);		
		$ind=$_POST["ind"];
		$active=$_POST["active"]=="on"?1:0;
		$fileName=date("HisdY").$_FILES["files"]["name"];
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into brand(name,ind,active) value('$name'";
		$sInsert.=",$ind,$active)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($fileName)==true)
		{
			imageRex(35,27,$_FILES["files"]["tmp_name"],myPath.$fileName)	;
			mysql_query("update brand set img='".$fileName."' where id=$recent");
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
		$sUpdate="update brand set name='$name'";
		$sUpdate.=",ind='$ind',active=$active";
		if(checkImg($fileName)==true)
		{
			imageRex(35,27,$_FILES["files"]["tmp_name"],myPath.$fileName)	;
			$sUpdate.=",img='".$fileName."'";
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
	$tmp=mysql_query("select * from groups where id=$pId");
	$tmp=mysql_fetch_object($tmp);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý danh mục SP 
		</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Tên nhãn hiệu</td>
				<td>Icon</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from brand order by ind asc,id desc";
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
					<td>'.($row->img==""?"&ensp;":'<img src="'.myPath.$row->img.'" height="27" border="0"/>').'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					<td>';
		$str.="<a href=\"main.php?cnht=product&kind=$row->id\">Chi tiết</a> / ";
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"7\" style=\"padding:10px\">
		".adminPaging($lim,$count,"main.php?cnht=product&brand=$pId&")."</td></tr>";
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
				<td width="200" style="font-weight:bold">Tên nhãn hiệu(*):</td>
				<td>
					<input type="text" name="name" class="txtBox" value="'.$rowEdit->name.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Icon(*):
				<br/><i style="font-weight:normal">Size hình PNG transparent(35,27)</i></td>
				<td>
					<input type="file" name="files" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Icon hiện tại:</td>
					<td>
						<img src="'.myPath.$rowEdit->img.'" border="0" style="height:27px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
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
function group()
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
		$sInsert="insert into groups(name,ind,active) value('$name'";
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
		$sql="select * from groups where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update groups set name='$name'";
		$sUpdate.=",ind='$ind',active=$active";
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from groups where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý Nhóm</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Tên Nhóm</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from groups order by ind asc,id desc";
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
		$str.="<a href=\"main.php?cnht=product&brand=$row->id\">Chi tiết</a> / ";
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
				<td width="200" style="font-weight:bold">Tên nhóm(*):</td>
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

function product()
{
	//process request form
	$msg="";
	$getKind=isset($_GET["id"])?$_GET["id"]:0;
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);
		$feature=str_replace("'","&rsquo;",$_POST["feature"]);
		$sum=str_replace("'","&rsquo;",$_POST["sum"]);
		$content=str_replace("'","",$_POST["content"]);
		$active=($_POST["active"]=="on")?1:0;
		$hot=($_POST["hot"]=="on")?1:0;
		$pd_new=($_POST["pd_new"]=="on")?1:0;
		$price=intval($_POST["price"]);
		$dates=date("Y-m-d H:i:s");
		$files=date("is").$_FILES["files"]["name"];
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into product(name,content,hot,active,dates,pId,pd_new) values(";
		$sInsert.="'$name','$content',$hot,$active,'$dates',$getKind,$pd_new)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($files)==true)
		{
			imageRex(500,330,$_FILES["files"]["tmp_name"],myPath.$files);
			mysql_query("update product set img='$files' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error().$sInsert;			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update product set name='$name',content='$content',hot=$hot,active=$active,pd_new=$pd_new";
		if(checkImg($files)==true)
		{
			imageRex(500,330,$_FILES["files"]["tmp_name"],myPath.$files);
			$sUpdate.=",img='$files'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from product where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from product where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$sql="select a.id,a.name,b.id as pId,b.name as pName,c.id as gId,c.name as gName";
	$sql.=" from kind a,brand b,groups c where a.pId=b.id and b.pId=c.id and a.id=$getKind";
	$temp=mysql_query($sql);
	$temp=mysql_fetch_object($temp);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý sản phẩm ($temp->gName > $temp->pName > $temp->name)- 
	<a href=\"?cnht=product&parentId=$temp->pId\" style=\"color:yellow\">Back	</a></td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Tên sản phẩm</td>
				
				
				<td>Hình đại diện</td>
				<td width="80">HOT??</td>
				<td width="80">NEW??</td>
				<td width="80">Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from product where pId=$getKind order by id desc";
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
					
					
					<td>'.($row->img!=""?'<img src="'.myPath.$row->img.'" border="0" style="max-height:100px"/>':'&nbsp;').'				
					</td>
					<td>'.($row->hot==1?"<font style=\"color:#f00\">&#x2714;</font>":"&nbsp;").'</td>
					<td>'.($row->pd_new==1?"<font style=\"color:#f00\">&#x2714;</font>":"&nbsp;").'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					
					<td style=\"line-height:17px\">';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	<br/>
		<a href=\"main.php?cnht=product&pId=$row->id\">Upload Ảnh</a>
		</td>
				</tr>";
	}
	
	//end content column
	//paing park here
	$str.="<tr>
			<td colspan=\"9\" align=\"center\" style=\"padding:5px\">&ensp;
			".adminPaging($lim,$count,"main.php?cnht=product&id=$getKind&")."</td>
		</tr>";
	//end paging park here
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:98%;margin:10px auto;font-size:12px" class="productClass">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tên sản phẩm(*):</td>
				<td width="250">
					<input type="text" name="name" class="txtBox" value="'.$rowEdit->name.'">
				</td>
				<td style="padding:5px;" rowspan="9" valign="top">
					<b>Bài viết:</b>
					
					<textarea name="content" id="content" class="ckeditor">'.$rowEdit->content.'</textarea>
					
				</td>
			</tr>';
	
	
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh(500x330)(*):</td>
				<td width="250"><br/>
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
				<td width="120" style="font-weight:bold">Sản phẩm HOT(*):</td>
				<td>
					<input type="checkbox" name="hot" '.($rowEdit->hot==1?"checked='checked'":"").'/>
				</td>
			</tr>';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Sản phẩm Mới(*):</td>
				<td>
					<input type="checkbox" name="pd_new" '.($rowEdit->pd_new==1?"checked='checked'":"").'/>
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
		$str.='&ensp;<input type="reset" name="reset" onclick="'."location.href='".$_SERVER['REQUEST_URI']."'".'" value="Bỏ qua"/>';
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
	$pId=intval($_GET["pId"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$files=date("Ydis").$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into pimage(active,pId)";
		$sInsert.=" values($active,$pId)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($files)==true)
		{
			imageRex(500,330,$_FILES["file"]["tmp_name"],myPath.$files);
			mysql_query("update pimage set img='".$files."' where id=$recent");
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
		$sUpdate="update pimage set active=$active";
		if(checkImg($files)==true)
		{
			imageRex(500,330,$_FILES["file"]["tmp_name"],myPath.$files);
			$sUpdate.=",img='".$files."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from pimage where id=".$_POST["idLoad"];
		$temp=mysql_query("select img from pimage where id=".$_POST["idLoad"]);
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
	$tempTab=mysql_query("select pId,id,name from product where id=$pId");
	$tempRow=mysql_fetch_object($tempTab);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"7\" class=\"headTitle\">Thông tin quản lý hình ảnh sản phẩm $pId: $tempRow->name
				<a href=\"?cnht=product&id=$tempRow->pId\" style=\"color:yellow\">Quay lại trang trước</a>
			</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>
				<td>Hình ảnh</td>
				
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from pimage where pId=$pId order by id desc";
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
				<td width="120" style="font-weight:bold">Hình ảnh 500x330(*):
				<br/><i style="font-weight:normal">Size hình </i></td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình ảnh hiện tại:</td>
					<td>


		<img src="'.myPath.$rowEdit->img.'" border="0" style="width:222px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	
	
	
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
