<?php
function mainProcess()
{
	if(!isset($_GET["id"])) return khoahoc();
	else return subClass();
}
function khoahoc()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$title=str_replace("'","&rsquo;",$_POST["title"]);
		
		$sum=str_replace("'","&rsquo;",$_POST["sum"]);
		$des=str_replace("'","&rsquo;",$_POST["des"]);
		$bgClr=$_POST["bgClr"];
		$btnClr=$_POST["btnClr"];
		$ico=date("Ydis").$_FILES["ico"]["name"];
		$active=$_POST["active"]=="on"?1:0;
		$fileName=date("Ydis").$_FILES["file"]["name"];
		$content=str_replace("'","",$_POST["content"]);
		$ind=intval($_POST["ind"]);
		
		$dates=date("Y-m-d H:i:s");
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into khoahoc(tit,sum,content,act,dat,ind,btnClr,bgClr,des) values(";
		$sInsert.="'$title','$sum','$content',$active,'$dates',$ind,'$btnClr','$bgClr','$des')";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($fileName)==true)
		{
			imageRex(250,250,$_FILES["file"]["tmp_name"],myPath.$fileName)	;
			mysql_query("update khoahoc set img='".$fileName."' where id=$recent");
		}
		if(checkImg($ico)==true)
		{
			move_uploaded_file($_FILES["ico"]["tmp_name"],myPath.$ico);
			mysql_query("update khoahoc set ico='".$ico."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error();			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update khoahoc set tit='$title',sum='$sum',content='$content',des='$des',bgClr='$bgClr',btnClr='$btnClr'";
		$sUpdate.=",act=$active,ind=$ind";
		if(checkImg($fileName)==true)
		{
			imageRex(250,250,$_FILES["file"]["tmp_name"],myPath.$fileName)	;
			$sUpdate.=",img='".$fileName."'";
		}
		if(checkImg($ico)==true)
		{
			move_uploaded_file($_FILES["ico"]["tmp_name"],myPath.$ico);
			$sUpdate.=",ico='".$ico."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from khoahoc where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from khoahoc where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý khóa học</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT-ID</td>				
				<td>Tiêu đề</td>
				<td>Tóm tắt</td>
				<td>Hiển thị</td>
				<td>Ngày đăng</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from khoahoc order by id desc";
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
					<td>'.$row->ind.'-'.$row->id.'</td>
					<td>'.$row->tit.'</td>					
					<td>'.nl2br($row->sum).'</td>
					<td>'.($row->act==1?"Hiện":"Ẩn").'</td>
					<td>'.date("d/m/Y",strtotime($row->dat)).'</td>
					<td>';
		if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";
					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a><br/>
		<a href=\"main.php?cnht=class&id=$row->id\">Chi tiết</a>	</td>
				</tr>";
	}
	
	//end content column
	//paing park here
	$str.="<tr><td colspan=\"8\" align=\"center\" style=\"padding:5px\">&ensp;".adminPaging(10,$count,"main.php?cnht=class&")."</td></tr>";
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
				<td style="font-weight:bold">Chọn màu(*):</td>
				<td>
	<p>Màu button:
	<input type="text" name="btnClr" maxlength="6" size="6" id="colorpickerField1" value="';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.=$rowEdit->btnClr;
	}
	else
	{
		$str.='e1eaad';	
	}
	$str.='" onkeypress="return keypress(event);"/>';
	$str.='<p>Màu Background:
	<input type="text" name="bgClr" maxlength="6" size="6" id="colorpickerField1" value="';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.=$rowEdit->bgClr;
	}
	else
	{
		$str.='e1eaad';	
	}
	$str.='" onkeypress="return keypress(event);"/>';
	$str.='<script>';
	$str.="				
						$('#colorpickerField1, #colorpickerField2').ColorPicker({
							onSubmit: function(hsb, hex, rgb, el) {
								$(el).val(hex);
								$(el).ColorPickerHide();
							},
							onBeforeShow: function () {
								$(this).ColorPickerSetColor(this.value);
							}
						})
						.bind('keyup', function(){
							$(this).ColorPickerSetColor(this.value);
						});
					</script>";
	$str.='		</td>
			</tr>';
	$str.='<tr>
				<td style="font-weight:bold">Tóm tắt (Trang chủ)(*):</td>
				<td>
					<textarea type="text" class="txtBox" name="des" cols="30" rows=5>'.$rowEdit->des.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Ảnh tiêu đề(height:34px)(*):
				<td>
					<input type="file" name="ico" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Ảnh tiêu đề hiện tại:</td>
					<td>
						<img src="'.myPath.$rowEdit->ico.'" border="0" style="height:34px;border:1px solid #aeaeae"/>
					</td>
				</tr>';	
	}
	$str.='<tr>
				<td width="120" style="font-weight:bold">Hình ảnh(*):
				<br/><i style="font-weight:normal">Size hình 215x215</i></td>
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
				<td style="font-weight:bold">Vị trí(*):</td>
				<td>
					<input type="text" name="ind" class="txtBox" onkeypress="return keypress(event);" value="'.$rowEdit->ind.'"/>
				</td>
			</tr>';
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
function subClass()
{
	//process request form
	$msg="";
	$pId=intval($_GET["id"]);
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$name=str_replace("'","&rsquo;",$_POST["name"]);	
		$active=$_POST["active"]=="on"?1:0;
		$content=str_replace("'","",$_POST["content"]);
		$ico=date("Ydis").$_FILES["ico"]["name"];
	}
	if(isset($_POST["addNew"]))
	{
		$sInsert="insert into subclass(title,active,content,pId)";
		$sInsert.=" values('$name',$active,'$content',$pId)";
		$test=mysql_query($sInsert);
		$recent=mysql_insert_id();
		if(checkImg($ico)==true)
		{
			imageRex(65,65,$_FILES["ico"]["tmp_name"],myPath.$ico)	;
			mysql_query("update subclass set ico='".$ico."' where id=$recent");
		}
		if($test)
		{
			echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		}
		else $msg=mysql_error().$sInsert;			
	}
	if(isset($_POST["update"]))
	{
		$sUpdate="update subclass set title='$name',content='$content'";
		$sUpdate.=",active=$active";
		if(checkImg($ico)==true)
		{
			imageRex(65,65,$_FILES["ico"]["tmp_name"],myPath.$ico)	;
			$sUpdate.=",ico='".$ico."'";
		}
		$sUpdate.=" where id=".$_POST["idLoad"];
		$test=mysql_query($sUpdate);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from subclass where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from subclass where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	$temp=mysql_query("select * from khoahoc where id=$pId");
	$temp=mysql_fetch_object($temp);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý chi tiết(<span style=\"color:red\">$temp->tit</span>) - 
	<a href=\"main.php?cnht=class\" style=\"color:yellow\">Back</a></td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Tiêu đề</td>
				<td>Icon</td>
				<td>Hiển thị</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from subclass where pId=$pId order by id desc";
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
					<td>'.($row->ico!=''?'<img src="'.myPath.$row->ico.'" border="0"/>':'').'</td>
					<td>'.($row->active==1?"Hiện":"Ẩn").'</td>
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
	$str.="<tr>
			<td colspan=\"7\" align=\"center\" style=\"padding:5px\">
				&ensp;".adminPaging($lim,$count,"main.php?cnht=class&id=$pId&")."</td>
		</tr>";
	//end paging park here
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:80%;margin:10px auto;font-size:12px" class="productClass">';
	$str.='<tr><td colspan="2" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="2" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="220" style="font-weight:bold">Tiêu đề(*):</td>
				<td>
				
						<input type="text" name="name" class="txtBox" value="'.$rowEdit->title.'">(VI)
			
					
				</td>				
			</tr>';
	/*$str.='<tr>
				<td width="220" style="font-weight:bold">Sơ lược(*):</td>
				<td>
					<p>
						<textarea name="sum" class="txtBox" style="height:70px">'.$rowEdit->sum.'</textarea>(VI)
					</p>
					<p>
						<textarea name="eSum" class="txtBox" style="height:70px">'.$rowEdit->eSum.'</textarea>(EN)
					</p>
				</td>				
			</tr>';*/
	$str.='
			<tr>
				<td>
					<strong>Chi tiết:</strong>
				</td>
				<td>				
					<textarea name="content" id="content" class="ckeditor">'.$rowEdit->content.'</textarea>	
										
				</td>
			</tr>
			';
	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Icon(*):
				<br/><i style="font-weight:normal">Size hình 65x65</i></td>
				<td>
					<input type="file" name="ico" class="txtBox"/>
				</td>
			</tr>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<tr>
					<td width="120" style="font-weight:bold">Icon hiện tại:</td>
					<td>
						<img src="'.myPath.$rowEdit->ico.'" border="0" style="height:100px;border:1px solid #aeaeae"/>
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