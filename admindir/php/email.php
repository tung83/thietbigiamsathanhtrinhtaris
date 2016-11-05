<?php
function mainProcess()
{
	//process request form
	$msg="";
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from email where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:50%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Quản lý email sending
	<a href=\"/export_excel.php\" target=\"_blank\">Export to excel</a>
	</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>ID</td>				
				<td>Email</td>				
				<td>Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="SELECT * from email order by id desc";
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
					<td>'.($row->email==""?"&ensp;":$row->email).'</td>
					<td>';
					
		$str.="<a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"8\" align=\"center\" style=\"padding:5px\">
				&ensp;".adminPaging($lim,$count,"main.php?cnht=email&")."</td></tr>";
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	
	$str.='
			<input type="hidden" name="idLoad" value="'.$_POST["idLoad"].'"/>
			<input type="hidden" name="Edit"/>
			<input type="hidden" name="Del"/>
		';
	//end process group
	
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}
?> 
