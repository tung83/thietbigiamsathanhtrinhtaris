function kiemtralogin()

	{

		var frm = document.frmLogin;



		if (frm.HoVaTen.value == "")

		{

			alert("Vui lòng nhập tên đăng nhập");

			frm.HoVaTen.focus();

			return false;

		}

		if (frm.MatKhau.value == "")

		{

			alert("Vui lòng nhập mật khẩu");

			frm.MatKhau.focus();

			return false;

		}

		

				

		return true;

	}





function checkValue( ojSelect, value ) {

	var k ;

	for (k=ojSelect.options.length-1; k>=0; k--) {

		if (ojSelect.options(k).value == value) {

			ojSelect.options(k).selected = true;

			return true;			

		}

	}

	return false;

}

function isNuber(c)

{

	return (c>="0" && c<="9");

}


function operationFrm(id,type)
{
	var frm=document.actionForm;
	switch(type)
		{			
			case "E":
				frm.Edit.value = 1;
				break;
			case "D":
				if(confirm("Bạn có muốn xóa không ?"))
				{
					frm.Del.value = 1;
				}
				else	return;
				break;
			default:
				return;
		}
		frm.idLoad.value = id;
		frm.action="";
		frm.submit();	
}

	

	
function keypress(e){
//Hàm dùng để ngăn người dùng nhập các ký tự khác ký tự số vào TextBox
var keypressed = null;
if (window.event)
{
keypressed = window.event.keyCode; //IE
}
else
{ 
keypressed = e.which; //NON-IE, Standard
}

if (keypressed < 48 || keypressed > 57)
{ //CharCode của 0 là 48 (Theo bảng mã ASCII)
//CharCode của 9 là 57 (Theo bảng mã ASCII)
if (keypressed == 8 || keypressed == 127)
{//Phím Delete và Phím Back
return;
}
return false;
}
}
function delFile(productId,kind)
{
	var a="";
	if(kind==1)
	{
		a="files";	
	}
	else if(kind==2)
	{
		a="eFiles";	
	}
	else
	{
		a="cFiles";	
	}
	var b=confirm("Bạn có thực sự muốn xóa file hướng dẫn này không!");
	if(b==true)
	{
		$.ajax({
			type: "GET",
			url: "task.php",
			data: "varis=1&id="+productId+"&fields="+a,
			success: function(get_data) 
			{
				if(get_data==1) {alert("Xóa thành công!");location.href=location.href;}
				else alert("Có lỗi khi xóa! vui lòng thông báo cho lập trình viên!");
			}
		});		
	
	}
}
