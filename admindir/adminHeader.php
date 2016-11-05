<link rel="stylesheet" type="text/css" href="admin.css">

<script type="text/javascript"> 

$(document).ready(function(){



	$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled - Adds empty span tag after ul.subnav

	

	$("ul.topnav li span").mouseover(function() { //When trigger is clicked...

		

		//Following events are applied to the subnav itself (moving subnav up and down)

		$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click



		$(this).parent().hover(function() {

		}, function(){	

			$(this).parent().find("ul.subnav").slideUp('slow'); //When the mouse hovers out of the subnav, move it back up

		});



		//Following events are applied to the trigger (Hover events for the trigger)

		}).hover(function() { 

			$(this).addClass("subhover"); //On hover over, add class "subhover"

		}, function(){	//On Hover Out

			$(this).removeClass("subhover"); //On hover out, remove class "subhover"

	});



});

</script>

<div style="height:120px;">

	<?php echo menuTable();?>

</div>

<?php 

	echo adminMenu();

	function adminMenu()

	{

		//Menu chính (id,name,lnk)

		$topNav=array(

						array(1,"Q.lý sản phẩm","?cnht=product"),

						/*array(2,"Q.lý Nhà Bán","?cnht=sale"),*/

						array(3,"Q.lý bài viết",""),

						array(4,'Responsive Slider','?cnht=slider'),

						array(8,"Banner","?cnht=banner"),

						array(9,'Đối tác','?cnht=partner'),

						

						array(10,"Q.Lý text",""),

						array(11,"Liên hệ","?cnht=contact")

						

					);

		//Submenu (parent,name,lnk)

		$subNav=array(

						array(3,"Tin tức","?cnht=news"),						

						array(3,"Dịch vụ","?cnht=serv"),

						/*array(9,"Cơ sở vật chất","?cnht=gal&id=1"),

						array(9,"Wallpaper","?cnht=gal&id=2"),

						array(9,"Tác phẩm của bé","?cnht=gal&id=3"),

						array(9,"Hoạt động Master Kid","?cnht=gal&id=4"),*/

						

						//array(10,"Giới thiệu Home","?cnht=qtext&id=1"),

						array(10,"Giới thiệu","?cnht=aboutus"),

						array(10,"Text liên hệ","?cnht=qtext&id=2"),

						array(10,"Text Footer","?cnht=qtext&id=3")					

						

					);

		$size=sizeof($topNav);

		$str='<ul class="topnav">

				';

		for($i=0;$i<$size;$i++)

		{

			if($topNav[$i][2]!="")

			{

				$str.='<li><a href="'.$topNav[$i][2].'">'.$topNav[$i][1].'</a>';

			}

			else

			{

				$str.='<li><a style="cursor:pointer">'.$topNav[$i][1].'</a>';

			}

			$temp=0;

			$str.=subNav($subNav,$topNav[$i][0]);

			$str.='</li>';

		}

			 

			   

		$str.="</ul>";

		return $str;

	}

	function subNav($subNav,$parent)

	{

		$str="<ul class=\"subnav\">";

		$temp=0;

		for($i=0;$i<sizeof($subNav);$i++)

		{

			if($subNav[$i][0]==$parent)

			{

				if($subNav[$i][2]!="")

				{

					$str.='<li><a href="'.$subNav[$i][2].'">'.$subNav[$i][1].'</a></li>';

				}

				else

				{

					$str.='<li><a>'.$subNav[$i][1].'</a></li>';

				}

				$temp++;

			}

		}

		$str.="</ul>";

		if($temp==0) $str="";	

		return $str;

	}

	function menuTable()

	{

		$tab=mysql_query("select * from admin where id='".$_SESSION["userId"]."'");

		$row=mysql_fetch_object($tab);

		$str='<table cellpadding="0" cellspacing="0" border="0" style="width:78%;margin:auto" id="adminTable">

				<tr><td colspan="3" height="10"></td></tr>

				<tr>

					<td rowspan="3" width="150">

						<img src="../images/adminMenu/adminImg.png" border="0" height="100"/>

					</td>

					<td rowspan="3" width="20"></td>

					<td style="padding:2px">&bull; Xin chào: <b>'.$row->name.'</b> <a href="php/logout.php">( Thoát... )</a></td>

				</tr>

				<tr>

					<td style="padding:2px">

						&bull; <a href="main.php?cnht=addTool&action=changePass">Đổi mật khẩu</a>

					</td>

				</tr>

				 <tr>

					<td style="padding:2px">

						&bull; <a href="main.php?cnht=addTool&action=addManager">Thêm người quản trị

					</td>

				</tr>

				<tr><td colspan="3" height="10"></td></tr>

			</table>';

		return $str;

	}	

?>



