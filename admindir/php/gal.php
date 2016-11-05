
<?php
function mainProcess()
{
	//process request form
	$msg="";
	$pId=intval($_GET["id"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$file=date("Ydis").$_FILES["file"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$descript=str_replace("-","&dash;",str_replace("'","&rsquo;",$_POST["descript"]));
	}
	if(isset($_POST["addNew"]))
	{
		
		$sInsert="insert into gal(active,pId)";
		$sInsert.=" values($active,$pId)";
		
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($file)==true)
		{
			//imageRex(656,332,$_FILES["file"]["tmp_name"],myPath.$file)	;
			//makeThumbnails(myPath,$file,"small_",126,64);
			move_uploaded_file($_FILES["file"]["tmp_name"],myPath.$file);
			mysql_query("update gal set img='".$file."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();
				
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from gal where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update gal set active=$active";
		if(checkImg($file)==true)
		{
			//imageRex(656,332,$_FILES["file"]["tmp_name"],myPath.$file)	;
			//makeThumbnails(myPath,$file,"small_",126,64);
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
		$sDelete="delete from gal where id=".$_POST["idLoad"];
		$temp=mysql_query("select img from dimage where id=".$_POST["idLoad"]);
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
	$tempTab=mysql_query("select id,name from galkind where id=$pId");
	$tempRow=mysql_fetch_object($tempTab);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:68%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"7\" class=\"headTitle\">Gallery&rsquo;s images manage ($pId: $tempRow->name)
			</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>
				<td width="450">Hình ảnh</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from gal where pId=$pId order by id desc";
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
					<td width="80">'.$row->id.'</td>
					<td width="220"><img src="'.myPath.$row->img.'" border="0" style="max-width:100px;max-height:70px"/></td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
					
					<td>';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Pass</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Edit</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Edit</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Delete</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"8\" align=\"center\" style=\"padding:5px\">
				&ensp;".adminPaging(10,$count,"main.php?cnht=gal&id=$pId&")."</td></tr>";
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:920px;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật & Thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';	
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh 656x332(*):</td>
				<td>
					<input type="file" name="file" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Hình hiện tại:</td>
					<td>


		<img src="'.myPath.$rowEdit->img.'" border="0" style="max-width:222px;max-height:100px;border:1px solid #aeaeae"/>
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
		$str.='<input type="submit" name="update" value="Update"/>';
	}
	else $str.='<input type="submit" name="addNew" value="Add New"/>';
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
