<script language="javascript" type="text/javascript">
function confrm()
{
	var frm=document.actionForm;
	if(frm.userId.value=="")
	{
		alert("Tài khoản chưa được nhập");
		frm.userId.focus();
		return;
	}
	if(frm.pwd.value!=frm.pwdConfirm.value)
	{
		alert("xác nhận mật khẩu không đúng!");
		frm.pwdConfirm.value="";
		frm.pwdConfirm.focus();
		return;
	}
	if(frm.name.value=="")
	{
		alert("Họ tên người quản trị chưa nhập!");
		frm.name.focus();
		return;
	}
	frm.action="";
}
</script>
<?php
function mainProcess()
{
	$action=isset($_GET["action"])?$_GET["action"]:"";
	switch($action)
	{
		case "addManager":return addManager();break;
		case "changePass":return changePass();break;
	}
	
}
function addManager()
{
	//process request form
	$msg="";
	if(isset($_POST["addNew"])||isset($_POST["update"]))
	{
		$userId=$_POST["userId"];
		$pwd=$_POST["pwd"];
		$pwd=md5($pwd);
		$name=$_POST["name"];
		$dates=$lastOnl=date("Y-m-d H:i:s");
		$level=$_POST["level"];
	}
	if(isset($_POST["addNew"]))
	{
		$tabTemp=mysql_query("select id from admin where id='$userId'");
		if(mysql_num_rows($tabTemp)!=0)
		{
			$msg="Tài khoản này đã có người sử dụng!";
		}
		else
		{
			$sInsert="insert into admin(id,pwd,name,lastOnl,dates,level) values('$userId','$pwd','$name','$lastOnl','$dates',$level)";	
			$test=mysql_query($sInsert);
			if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
			else $msg=mysql_error();
		}
	}
		
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		if($_POST["idLoad"]==$_SESSION["userId"])
		{
			$msg="Bạn không thể tự xóa chính mình!";
		}
		else
		{
			$sDelete="delete from admin where id='".$_POST["idLoad"]."'";
			$test=mysql_query($sDelete);
			if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
			else $msg=mysql_error();
		}
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin quản trị</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Tài khoản</td>
				<td>Họ và tên</td>
				<td>Cấp độ</td>
				<td>Lân đăng nhập cuối cùng</td>
				<td>Ngày tạo</td>
				<td>Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from admin where id<>'kidside' order by id desc";
	$tab=mysql_query($s);
	$lim=10;
	$page=isset($_GET["page"])?intval($_GET["page"]):1;
	$count=mysql_num_rows($tab);
	$start=($page-1)*$lim;
	$s.=" limit $start,$lim";
	$tb=mysql_query($s);
	$stt=1;
	while($row=mysql_fetch_object($tb))
	{
		$str.='<tr class="contentColumn">
					<td>'.$stt.'</td>
					<td>'.$row->id.'</td>
					<td>'.$row->name.'</td>
					<td>'.$row->level.'</td>
					<td>'.date("d/m/Y h:i:s a",strtotime($row->lastOnl)).'</td>
					<td>'.date("d/m/Y h:i:s a",strtotime($row->dates)).'</td>
					<td>';
					
		$str.=" <a onclick=\"operationFrm('$row->id','D')\">Xóa</a>	</td>
				</tr>";
		$stt++;
	}
	
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="javascript:void(0);" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:48%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Cập nhật - thêm mới thông tin</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Tài khoản(*):</td>
				<td>
					<input type="text" name="userId" class="txtBox" value=""/>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Mật khẩu(*):</td>
				<td>
					<input type="password" name="pwd" class="txtBox" />
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Lặp lại mật khẩu (*):</td>
				<td>
					<input type="password" name="pwdConfirm" class="txtBox" />
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Họ và tên(*):</td>
				<td>
					<input type="text" name="name" class="txtBox" value=""/>
				</td>
			</tr>';
	$select="";
	$select.="<option value=\"1\" selected=\"selected\">Cấp administrator</option>";
	$select.="<option value=\"2\">Cấp nhập liệu</option>";
	$select.="<option value=\"3\">Cấp giao hàng</option>";
	$str.='<tr>
				<td width="120" style="font-weight:bold">Cấp độ(*):</td>
				<td>
					<select name="level">'.$select.'</select>
				</td>
			</tr>';
	
	//process group
	$str.='<tr><td></td><td>';
	if(isset($_POST["Edit"])&&$_POST["Edit"]==1)
	{
		$str.='<input type="submit" name="update" value="Cập nhật"/>';
	}
	else $str.='<input type="submit" name="addNew" value="Thêm mới" onclick="return confrm();"/>';
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
function changePass()
{
	//process request form
	$msg="";		
	if(isset($_POST["submit"]))
	{
		$oldPwd=$_POST["oldPwd"];
		$pwd=$_POST["pwd"];
		$pwdConfirm=$_POST["pwdConfirm"];
		$tabTemp=mysql_query("select pwd from admin where id='".$_SESSION["userId"]."'");
		$rowTemp=mysql_fetch_object($tabTemp);
		if($rowTemp->pwd!=md5($oldPwd))
		{
			$msg="Nhập sai password cũ!";
		}
		else if($pwd!=$pwdConfirm)
		{
			$msg="Xác nhận mật khẩu mới không đúng!";
		}
		else
		{
			$test=mysql_query("update admin set pwd='".md5($pwd)."' where id='".$_SESSION["userId"]."'");
			if($test) $msg="Thay đổi mật khẩu thành công!";
			else $msg=mysql_error();
		}
	}
	//end process request form
	
	$str="";
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	$str.='<table cellpadding="0" cellspacing="5" border="0" style="width:48%;margin:10px auto;font-size:12px">';
	$str.='<tr><td colspan="3" style="" class="headTitle">Thay đổi mật khẩu</td></tr>';
	$str.='<tr><td colspan="3" style="padding:5px;color:red;font-style:italic">'.$msg.'</td></tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Mật khẩu cũ(*):</td>
				<td>
					<input type="password" name="oldPwd" class="txtBox" value=""/>
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Mật khẩu mới(*):</td>
				<td>
					<input type="password" name="pwd" class="txtBox" />
				</td>
				
			</tr>';
	$str.='<tr>
				<td width="120" style="font-weight:bold">Lặp lại mật khẩu mới(*):</td>
				<td>
					<input type="password" name="pwdConfirm" class="txtBox" />
				</td>
				
			</tr>';
		
	//process group
	$str.='<tr><td></td><td>';
	$str.='<input type="submit" name="submit" value="Cập nhật"/>';	
	$str.='';
	$str.='</td></tr>';
	$str.='
			<input type="hidden" name="idLoad" value=""/>
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