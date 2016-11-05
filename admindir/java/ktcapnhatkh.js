/*------------------------------------------
Ngay tao :  17:49:13   09/05/2006 
Cong ty : Ky Nang Viet		Du an   : Sieu thi FG
------------------------Terexa--------------*/

function ktCapNhatKH(fname)
{   
		//alert("Xin ban vui long nhap ten");
		var frdk = document[fname];
		//alert("Xin ban vui long nhap ten");
		
		if( ! isEmail(frdk.Email.value)){
				alert("Invalid Email ");
				frdk.Email.focus();
				return false;
		}

		if( ! laMatKhau(frdk.MatKhau.value)){
			alert("please check password");
			frdk.MatKhau.focus();
			return false;
		}
		
		if( frdk.MatKhau.value != frdk.MatKhau2.value){
			alert("password is not similar");
			frdk.MatKhau.focus();
			return false;
		}
		
	return true;
}
	// JavaScript Document