<script>

	$(document).ready(function(){$("#HoVaTen").focus();});

</script>

<STYLE>BODY {

	SCROLLBAR-FACE-COLOR: #ffffff; SCROLLBAR-HIGHLIGHT-COLOR: #000000; SCROLLBAR-SHADOW-COLOR: #000000; SCROLLBAR-3DLIGHT-COLOR: #ffffff; SCROLLBAR-ARROW-COLOR: #000000; SCROLLBAR-TRACK-COLOR: #ffffff; SCROLLBAR-DARKSHADOW-COLOR: #ffffff

}

.link {

	FONT-SIZE: 10px; COLOR: #666666; FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; TEXT-DECORATION: none

}

.lich {

	FONT-WEIGHT: normal; FONT-SIZE: 11px;  FONT-FAMILY: Verdana, Arial, Helvetica, sans-serif; TEXT-DECORATION: none

}

.TTest {color: #4B002F;

font-family:tahoma;

font-size:12px;

font-weight:bold;}

</STYLE>



<BODY leftMargin=0 topMargin=0 marginheight="0" marginwidth="0">

<TABLE height="100%" cellSpacing=0 cellPadding=0 width="100%" border=0>

  <TBODY>

  <TR>

    <TD vAlign=center align=middle>

      <table  width="244" border="0"  cellpadding="0" cellspacing="0">

 

  <tr>

    <td colspan="3" background="../images/adminMenu/detail_top.gif" width="244" height="27"><div align="center" class="TTest">Administration</div></td>

  </tr> 

  <tr bgcolor="#FFE9F6">

    <td width="244" background="../images/adminMenu/detail_middle_left.gif" ></td>

    <td bgcolor="#DFFBE3">

	<div align="left">

          <form name="frmLogin" method="POST" action="main.php" onSubmit="return login();"  style="display: inline">

                        <div class="smallfont">

&nbsp;

<div align="center"><font color="#FF0000">

<?php

if(isset($_POST["Login"]))

{

	$message="";

	$userId=$_POST["HoVaTen"];

	$pwd=$_POST["MatKhau"];

	$result=checkLogin($userId,$pwd);

	if($result==0) echo "Tài khoản này không tồn tại";

	else if($result==1) echo "Tài khoản và mật khẩu không trùng khớp";

	else

	{

		$_SESSION["userId"]=$userId;

		mysql_query("update admin set lastOnl='".date("Y-m-d H:i:s")."' where id='$userId'");

		echo "<script>location.href='".$_SERVER['REQUEST_URI']."'</script>";

	}

	

}



?>

</font></div>

                  </div>

            <fieldset  class="fieldset">

              <legend style="color: #000000; font-style: normal; font-variant: normal; font-weight: normal; font-size: 11px; font-family: tahoma, verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif">

              Login</legend>

              <table cellSpacing="3" cellPadding="0" align="center" border="0">

                <tr>

                  <td style="font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif">

                  Tên đăng nhập:<br>

                  <input name="HoVaTen" class="bginput" id="HoVaTen" accessKey="u" tabIndex="1" style="width:180px;"></td>

                </tr>

                <tr>

                  <td style="font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif">

                  Mật khẩu:<br>

                  <input name="MatKhau" type="password" class="bginput" id="MatKhau" accessKey="p" tabIndex="1" style="width:180px;" autocomplete="off"></td>

                </tr>

                <tr>

                  <td style="font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif">&nbsp;</td>

                </tr>

                <tr>

                  <td align="right" style="font-size: 11px; font-style: normal; font-variant: normal; font-weight: normal; font-family: verdana, geneva, lucida, 'lucida grande', arial, helvetica, sans-serif">

                  <input name="Login" type="submit" class="button" id="Login" accessKey="s" tabIndex="1" value="   Login   ">

                  <input class="button" accessKey="r" tabIndex="1" type="reset" value="Reset">

                  </td>

                </tr>

              </table>

              </fieldset>

             

            </form>

            <!-- / permission error message - user not logged in -->

          </div>

	

	</td>

    <td width="11" background="../images/adminMenu/detail_middle_right.gif"></td>

  </tr>

  <tr>

    <td   width="244" height="13" valign="top" ><img src="../images/adminMenu/detail_bottom_left.gif" width="11" height="13" />

    </td>

    <td ><img src="../images/adminMenu/detail_middle_bottom.gif" width="222" height="13" /></td>

    <td   width="11" height="13" valign="top"><img src="../images/adminMenu/detail_bottom_right.gif" width="11" height="13" />

    </td>

  </tr>

  

</table></TD></TR></TBODY></TABLE>

<DIV></DIV></BODY>

<?php 

	function checkLogin($userId,$pwd)

	{

		$tab=mysql_query("select * from admin where id='$userId'");
		if(mysql_num_rows($tab)!=0)

		{

			$pwd=md5($pwd);

			$row=mysql_fetch_object($tab);

			if($row->pwd!=$pwd) return 1;

			else return 2;

		}

		else return 0;
        

	}



?>

