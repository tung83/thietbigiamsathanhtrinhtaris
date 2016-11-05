
<?php
function mainProcess()
{
	if(isset($_GET["id"]))
	{
		return cart();
	}
	else
	{
		return allCart();
	}
}

function allCart()
{
	//process request form
	$msg="";
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from cart where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		mysql_query("delete from cartdetail where cartId=".$_POST["idLoad"]);
		if($test) echo "<script>location.href=\"".$_SERVER['REQUEST_URI']."\"</script>";
		else $msg=mysql_error();
	}
	//end process request form
	
	$str="";
	//show information here!!	
	
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin tất cả đơn hàng</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Họ tên</td>
				<td>Địa chỉ</td>
				<td>Email</td>
				<td>Điện thoại</td>
				<td>Thời gian</td>
				<td width="120">Thao tác</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from cart order by id desc";
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
					<td>'.$row->name.'</td>
					<td>'.$row->adds.'</td>
					<td><a href="mailto:'.$row->email.'">'.$row->email.'</a></td>
					<td>'.$row->phone.'</td>
					<td>'.date("d/m/Y H:i:s",strtotime($row->dates)).'</td>
					<td>';
		$str.="<a href=\"main.php?cnht=cart&id=$row->id\">Chi tiết</a> / ";					
		$str.="/ <a onclick=\"operationFrm($row->id,'D')\">Xóa</a>	</td>
				</tr>";
	}
	$str.="<tr><td colspan=\"7\" style=\"padding:10px\">".adminPaging($lim,$count,"main.php?cnht=cart&")."</td></tr>";
	//end content column
	$str.="</table>";
	//end show information
	
	//form action
	$str.='<form action="" name="actionForm" method="post" enctype="multipart/form-data">';
	//modify option
	
	
	
	//process group
	
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
function cart()
{
	if(isset($_POST["Del"])&&$_POST["Del"]==1)
	{
		$sDelete="delete from cart where id=".$_POST["idLoad"];
		$test=mysql_query($sDelete);
		mysql_query("delete from cartdetail where cartId=".$_POST["idLoad"]);
		if($test) echo "<script>location.href=\"?cnht=cart\"</script>";
		else $msg=mysql_error();
	}
	$cartId=$_GET['id'];
	$str="";
	//show information here!!	
	$cartTab=mysql_query("select * from cart where id=$cartId");
	$cartRow=mysql_fetch_object($cartTab);
	$str.="<table cellpadding=\"0\" cellspacing=\"0\" border=\"1\" style=\"width:98%;margin:10px auto;font-size:12px\">";
	$str.="<tr><td colspan=\"11\" class=\"headTitle\">Thông tin chi tiết đơn hàng ( id: $cartId ) - 
														$cartRow->name - 
														$cartRow->adds<br/> 
														$cartRow->email - 
														$cartRow->phone<br/>
														".date("d/m/Y H:i:s",strtotime($row->dates))."
	
			</td></tr>";
	//header column
	$str.='<tr class="headerColumn">
				<td>STT</td>
				<td>Tên sản phẩm</td>
				<td>Hình ảnh</td>
				<td>Số lượng</td>
				<td>Đơn giá</td>
				<td>Thành tiền</td>
			</tr>';	
	//end header column
	//content column
	$s="select * from cartdetail where cartId=$cartId order by id asc";
	$tab=mysql_query($s);
	$lim=10;
	$page=isset($_GET["page"])?intval($_GET["page"]):1;
	$count=mysql_num_rows($tab);
	$start=($page-1)*$lim;
	$tb=mysql_query($s);
	$total=0;
	while($row=mysql_fetch_object($tb))
	{
		$temp=mysql_query("select * from product where id=$row->productId");
		$tempR=mysql_fetch_object($temp);
		$pi=mysql_query("select * from product_image where productId=$tempR->id and active=1 order by ind asc,id desc limit 1");
		$pi=mysql_fetch_object($pi);
		$sum=$row->qty*$tempR->price;
		$str.='<tr class="contentColumn">
					<td>'.$row->id.'</td>
					<td>'.$tempR->name.'</td>
					<td><img src="../images/product/'.$pi->img.'" width="50" style="border:1px solid black"/></td>
					<td>'.$row->qty.'</td>
					<td style="text-align:right !important;color:red">'.number_format($tempR->price,0,".",".").' VNĐ</td>
					<td style="text-align:right !important;color:red">'.number_format($sum,0,".",".").' VNĐ</td></tr>';
		$total+=$sum;
	}
	//end content column
	$str.="<tr class=\"contentColumn\">
			<td><a href=\"javascript:history.go(-1);\" style=\"color:yellow\"> << Back </a></td>
			<td colspan=\"4\" style=\"text-align:right;padding:5px;background:#ccc\"><strong>Tổng cộng:</strong></td>
			<td style=\"font-weight:bold;color:red;padding:5px;background:#ccc;text-align:right\">
						".number_format($total,0,".",".")." VNĐ</td></tr>";
	$str.="<tr><td colspan=\"2\" style=\"text-align:right;padding:5px;background:white\"><strong>Ghi chú:</strong></td>
			<td colspan=\"4\" style=\"font-weight:bold;padding:5px;background:white\">
				".nl2br($cartRow->descript)."
			</td></tr>";
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
	$str.='</table>';
	
	//end modify option	
	$str.='</form>';
	//end form action
	return $str;
}



?> 
