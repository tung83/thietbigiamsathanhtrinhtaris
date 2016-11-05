
<?php
function mainProcess()
{
	//process request form
	$msg="";
	
	
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$sql="select * from deposit where id=".$_POST["idLoad"];
		$tabEdit=mysql_query($sql);
		$rowEdit=mysql_fetch_object($tabEdit);
	}
	
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from deposit where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	

	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin về liên hệ</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>
				<td>Họ và tên</td>
				<td>Địa chỉ</td>
				<td>Điện thoại</td>
				<td>Email</td>
				<td>Tiêu Đề</td>
				<td>Nội dung</td>
				<td>File</td>
				<td>Ngày gởi</td>
				<td>Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from deposit order by id desc";
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
					<td>'.$row->name."<b>$row->cName</b>".'</td>
					<td>'.($row->adds==""?"&ensp;":$row->adds).'</td>
					<td>'.$row->phone.'</td>
					<td><a href="mailto:'.$row->email.'">'.$row->email.'</a></td>
					<td>'.$row->title.'</td>
					<td>'.nl2br($row->content).'</td>
					<td>'.($row->img!=""?'<a href="'.myPath.$row->img.'" target="_blank">'.$row->img.'</a>':'').'</td>
					<td>'.date("d/m/Y",strtotime($row->dates)).'</td>
					<td>';
		/*if(isset($_POST["Edit"])==1)
		{
			if($_POST["idLoad"]==$row->id) $str.="<a href=\"".$_SERVER['REQUEST_URI']."\">Bỏ qua</a> ";
			else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";			
		}
		else $str.="<a onclick=\"operationFrm($row->id,'E')\">Sửa</a> ";*/
					
		$str.=" <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td style=\"padding:5px;\" colspan=8>".ultimatePaging($lim,$count,"main.php?cnht=contact&")."</td></tr>";
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	/*$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:98%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">User account(*):</td>
				<td width="200">
					<input type="text" name="userId" class="txtBox" value="'.$rowEdit->userId.'"/>
				</td>
				<td style="padding:5px;font-weight:bold">Giới thiệu riêng:</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">PassWord(*):</td>
				<td>
					<input type="password" name="pwd" class="txtBox" />
				</td>
				<td rowspan="14">
					<textarea name="descript" class="ckeditor">'.$row->descript.'</textarea>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Họ và chữ lót(*):</td>
				<td>
					<input type="text" name="firstName" class="txtBox" value="'.$rowEdit->firstName.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tên người dùng(*):</td>
				<td>
					<input type="text" name="lastName" class="txtBox" value="'.$rowEdit->lastName.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Ngày sinh:</td>
				<td>
					<input type="text" name="birth" id="birth" class="txtBox" 
					onkeypress="return false;" value="'.date("d-m-Y",strtotime($rowEdit->birth)).'"/>
				</td>
			</tr>';	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Địa chỉ:</td>
				<td>
					<input type="text" name="adds" class="txtBox" value="'.$rowEdit->adds.'"/>
				</td>
			</tr>';	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Đã có gia đình???:</td>
				<td>
					<input type="checkbox" name="married"
					 '.($rowEdit->married==1?"checked='checked'":"").' />
				</td>
			</tr>';	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Ngày cưới:</td>
				<td>
					<input type="text" name="wedding" id="wedding" class="txtBox" 
					onkeypress="return false;" value="'.date("d-m-Y",strtotime($rowEdit->wedding)).'"/>
				</td>
			</tr>';	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Con cái:</td>
				<td>
					<input type="text" name="children" id="children" class="txtBox" onkeypress="return keypress(event);" value="'.$rowEdit->children.'"/>
				</td>
			</tr>';	
	$str.='<tr>
				<td width="120" style="font-weight:bold">Nghề nghiệp:</td>
				<td>
					<input type="textbox" class="txtBox" name="job" value="'.$rowEdit->job.'"/>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Địa chỉ email:</td>
				<td>
					<input type="textbox" class="txtBox" name="email" value="'.$rowEdit->email.'"/>
				</td>
			</tr>';
	list($side,$desk,$ind)=explode("/",$rowEdit->desk);
	$str.='<tr>
				<td width="120" style="font-weight:bold">Dãy ghế:</td>
				<td>
					<select name="side">
						<option value="1" '.($side==1?"selected='selected'":"").'>Bên trái</option>
						<option value="2" '.($side==2?"selected='selected'":"").'>Bên phải</option>
					</select>
				</td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Bàn số:</td>
				<td><select name="desk">';
	for($i=1;$i<=7;$i++)
	{
		$str.='<option value="'.$i.'" '.($desk==$i?"selected='selected'":"").'>'.$i.'</option>';
	}				
	$str.='			</select></td>
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Vị trí(từ trái qua):</td>
				<td><select name="ind">';
	for($i=1;$i<=4;$i++)
	{
		$str.='<option value="'.$i.'" '.($ind==$i?"selected='selected'":"").'>'.$i.'</option>';
	}				
	$str.='			</select></td>
			</tr>';*/
	//process group
	/*$str.='<tr><td></td><td>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<input type="submit" name="update" value="Cập nhật"/>';
	}
	else $str.='<input type="submit" name="addNew" value="Thêm mới"/>';
	$str.='';
	$str.='</td></tr>';*/
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
