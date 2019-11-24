$(document).ready(function() {
	$('#promote').modal('show');
});
function loading(text)
{
	swal.fire({
		title: 'กรุณารอสักครู่...',
		text: text,
		type: 'warning',
		allowOutsideClick: false,
		allowEscapeKey: false,
		allowEnterKey: false,
  		showConfirmButton: false,
		showCancelButton: false
	})
}
function page(name)
{
	loading('ระบบกำลังเรียกข้อมูล...');
    $("#app").load('?page=' + name)
    $('.menu, .active').removeClass('active');
	$('#Menu-' + name).addClass("active");
}
function login()
{
    $('input').removeClass('input-error');
	if($('#username').val() == '' || $('#password').val() == '')
	{
		if($('#username').val() == '')
    		$('#username').addClass("input-error");
		if($('#password').val() == '')
    		$('#password').addClass("input-error");
		return Swal.fire('Login', 'กรุณาใส่ Username และ Password ให้ครบถ้วน !', 'error');
	}
	loading('ระบบตรวจสอบข้อมูลของคุณ...');
	$.post("action/login", {username: $('#username').val(), password: $('#password').val()},
		function(data)
		{
			if(data == 'Parameter')
				return Swal.fire('Login', 'กรุณาใส่ Username และ Password ให้ครบถ้วน !', 'error');
            if(data == 'Error')
                    return Swal.fire('Login', 'Username หรือ Password ไม่ถูกต้อง !', 'error');
            if(data == 'Login')
                return location.reload();
			if(data == 'Logged')
			{
				$("#login").load('?page=login');
				page('home');
			}
  		}
 	);
}
function register()
{
    $('input').removeClass('input-error');
	if($('#rusername').val() == '' || $('#rpass').val() == '' || $('#rcpass').val() == '')
	{
		if($('#rusername').val() == '')
    		$('#rusername').addClass("input-error");
        if($('#rpass').val() == '')
            $('#rpass').addClass("input-error");
        if($('#rcpass').val() == '')
            $('#rcpass').addClass("input-error");
		return Swal.fire('Register', 'กรุณาใส่ Username, Password, Confirm Password ให้ครบถ้วน !', 'error');
    }
    if($('#rpass').val() != $('#rcpass').val())
        return Swal.fire('Register', 'กรุณาใส่รหัสผ่านให้ตรงกัน !', 'error');
	loading('ระบบตรวจสอบข้อมูลของคุณ...');
	$.post("action/register", {username: $('#rusername').val(), password: $('#rpass').val()},
		function(data)
		{
			if(data == 'Parameter')
                return Swal.fire('Register', 'กรุณาใส่ Username, Password, Confirm Password ให้ครบถ้วน !', 'error');
            if(data == 'Use')
                return Swal.fire('Register', 'Username นี้ถูกใช้งานแล้ว !', 'error');
			if(data == 'Username')
				return Swal.fire('Register', 'Username ใช้ได้เฉพาะ A-z, 0-9 และ _ เท่านั้น !', 'error');
            if(data == 'Login')
                return location.reload();
            if(data == 'Error')
                return Swal.fire('Register', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			if(data == 'Success')
            {
                Swal.fire('Register', 'สมัครสมาชิกสำเร็จ !', 'success');
                $('#register').modal('hide')
            }
  		}
 	);
}
function shop(server, name)
{
	if(server == '')
		return Swal.fire('Shop', 'กรุณาเลือก Server ให้ถูกต้อง !', 'error');
    $('button[class="btn btn-outline-dark server-select active"]').removeClass('active');
    $('#Shop-' + server).addClass("active");
    $("#shoptext").text(name);
	loading('ระบบกำลังเรียกข้อมูล...');
    $("#shop").load('?shop=' + server);
}
function buy(id, name, price)
{
	swal.fire({
	  title: 'Shop',
	  text: "คุณต้องการซื้อ " + name + " ในราคา " + price + " ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังสั่งซื้อ...');
		$.post("action/buy", {id: id},
			function(data)
			{
				if(data == 'Product')
					return Swal.fire('Shop', 'ไม่พบสินค้าที่ท่านต้องการ !', 'error');
				else if(data == 'Login')
					return checklogin();
				else if(data == 'GLogin')
					return Swal.fire('Shop', 'กรุณาเข้าสู่ระบบในเซิร์ฟเวอร์ !', 'error');
				else if(data == 'Server')
					return Swal.fire('Shop', 'Server Offline !', 'error');
				else if(data == 'Point')
					return Swal.fire('Shop', 'ท่านมีเงินในระบบไม่พอ !', 'error');
				else if(data == 'Online')
					return Swal.fire('Shop', 'กรุณาออนไลน์ในเซิร์ฟเวอร์ !', 'error');
				else
				{
					$('#Point').text(data);
					Swal.fire('Shop', 'ส่งของสำเร็จแล้ว !', 'success');
				}
			}
		);
	  }
	})
}
function checklogin(u)
{
	if($('#player_username').text() != u)
	{
		$("#login").load('?page=login');
		page('home');
		Swal.fire('Login', 'กรุณา Login ใหม่อีกครั้ง !', 'warning');
	}
	else
		return swal.close();
}
function logout()
{
	loading('กำลังออกจากระบบ..');
	$.post("action/logout", {},
		function(data)
		{
			$("#login").load('?page=login');
			page('home');
			Swal.fire('Logout', 'ออกจากระบบสำเร็จ !', 'success');
		}
	);
}
function topup(type)
{
	if(type == 1)
	{
		if($('#tcard').val() == '')
			return Swal.fire('Topup', 'กรุณากรอกข้อมูลให้ครบถ้วน !', 'error');
		loading('ระบบกำลังใช้งานบัตรเติมเงิน..');
		$.post("action/topup/truemoney", {username: $('#tusername').val(), card: $('#tcard').val()},
			function(data)
			{
				if(data == 'username')
					return Swal.fire('Topup', 'ไม่พบ Username ' + $('#tusername').val() + ' ในระบบ !', 'error');
				else if(data == 'card')
					return Swal.fire('Topup', 'รหัสบัตรทรูมันนี้ไม่ถูกต้อง !.', 'error');
				else if(data == 'used')
					return Swal.fire('Topup', 'บัตรนี้ถูกใช้งานแล้ว !', 'error');
				else if(data == 'process')
					return Swal.fire('Topup', 'บัตรนี้อยู่ในขั้นตอนการตรวจสอบ !', 'error');
				else if(data == 'merchant')
					return Swal.fire('Topup', 'ไม่พบรหัสร้านค้า !', 'error');
				else if(data == 'success')
				{
					setTimeout(function(){ page('history'); }, 3000);
					Swal.fire('Topup', 'กรุณารอระบบตรวจสอบบัตรสักครู่ ระบบจะแจ้งในหน้าประวัติการเติมเงิน !', 'success');
				}
				else
					return Swal.fire('Topup', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	}
	else if(type == 2)
	{
		if($('#TransactionID').val() == '')
			return Swal.fire('Topup', 'กรุณากรอกข้อมูลให้ครบถ้วน !', 'error');
		loading('ระบบกำลังตรวจสอบข้อมูล..');
		$.post("action/topup/truewallet", {username: $('#wusername').val(), TransactionID: $('#TransactionID').val()},
			function(data)
			{
				if(data == 'username')
					return Swal.fire('Topup', 'ไม่พบ Username ' + $('#tusername').val() + ' ในระบบ !', 'error');
				if(data == 'TransactionID')
					return Swal.fire('Topup', 'กรอกเลขอ้างอิงให้ถูกต้อง', 'error');
				else if(data == 'used')
					return Swal.fire('Topup', 'เลขอ้างอิงถูกใช้ไปแล้ว', 'error');
				else if(data == '404')
					return Swal.fire('Topup', 'ไม่พบเลขอ้างอิงที่กรอกมา', 'error')
				else if(data.split('|')[0] == 'success')
				{
					Swal.fire('Topup', 'เติมเงินสำเร็จ<br>จำนวนเงิน '+ data.split('|')[1] +' บาท !!', 'success');
					setTimeout(function(){ page('history'); }, 3000);
				}
				else
					return Swal.fire('Topup', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	}
	else
		return Swal.fire('Topup', 'ไม่พบวิธีการเติมเงินที่ต้องการ !', 'error');
}
var mybutton = document.getElementById("topButton");
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

function checkin()
{
	loading('ระบบกำลังบันทึกข้อมูล..');
	$.post("action/checkin", {},
		function(data)
		{
			if(data == 'login')
				return checklogin();
			else if(data == 'date')
				return Swal.fire('Check In', 'คุณได้เช็คชื่อไปแล้ว !', 'error');
			else if(data == 'success')
			{
				page('checkin');
				Swal.fire('Check In', 'เช็คชื่อสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Check In', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function get_checkin(id, name, price)
{
	swal.fire({
	  title: 'Check In',
	  text: "คุณต้องแลก " + name + " ด้วย " + price + " วันใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังแลก...');
		$.post("action/get_checkin", {id: id},
			function(data)
			{
				if(data == 'Product')
					return Swal.fire('Check In', 'ไม่พบสินค้าที่ท่านต้องการ !', 'error');
				else if(data == 'Login')
					return checklogin();
				else if(data == 'GLogin')
					return Swal.fire('Check In', 'กรุณาเข้าสู่ระบบในเซิร์ฟเวอร์ !', 'error');
				else if(data == 'Server')
					return Swal.fire('Check In', 'Server Offline !', 'error');
				else if(data == 'Point')
					return Swal.fire('Check In', 'คุณมีวันที่สะสมไม่พอ !', 'error');
				else if(data == 'Online')
					return Swal.fire('Check In', 'กรุณาออนไลน์ในเซิร์ฟเวอร์ !', 'error');
				else
				{
					$('#checkintext').text(data);
					Swal.fire('Check In', 'ส่งของสำเร็จแล้ว !', 'success');
				}
			}
		);
	  }
	})
}
function redeem()
{
	loading('ระบบตรวจสอบข้อมูล...');
	$.post("action/redeem", {redeem: $('#Redeem').val()},
		function(data)
		{
			if(data == 'Redeem')
				return Swal.fire('Redeem', 'ไม่พบรหัสของขวัญ !', 'error');
			else if(data == 'Login')
				return checklogin();
			else if(data == 'GLogin')
				return Swal.fire('Redeem', 'กรุณาเข้าสู่ระบบในเซิร์ฟเวอร์ !', 'error');
			else if(data == 'Server')
				return Swal.fire('Redeem', 'Server Offline !', 'error');
			else if(data == 'Online')
				return Swal.fire('Redeem', 'กรุณาออนไลน์ในเซิร์ฟเวอร์ !', 'error');
			else if(data == 'Used')
				return Swal.fire('Redeem', 'คุณใช้รหัสของขวัญนี้แล้ว !', 'error');
			else if(data == 'Limite')
				return Swal.fire('Redeem', 'บัตรของขวัญใบนี้ถูกใช้สิทธิ์เต็มแล้ว !', 'error');
			else if(data == 'Success')
			{
				$('#Redeem').val('');
				Swal.fire('Redeem', 'แลกของขวัญสำเร็จแล้ว !', 'success');
			}
			else
				return Swal.fire('Redeem', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
  		}
 	);
}
function gift_send(id, name, price)
{
	Swal.mixin({
		input: 'text',
		confirmButtonText: 'ต่อไป &rarr;',
		showCancelButton: true
	}).queue([
		{
			title: 'Gift',
			text: 'กรุณาใส่ Username ที่ต้องการส่งของให้'
		}
	]).then((result) => {
		if (result.value)
		{
			if(result.value == '')
				return Swal.fire('Gift', 'กรุณากรอก Username !', 'error');
			var reciver = result.value[0];
			Swal.fire({
			  title: 'Gift',
			  text: "คุณต้องการส่ง " + name + " ให้ " + reciver + " ในราคา " + price + " ใช่หรือไม่ ?",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'ใช่',
			  cancelButtonText: 'ไม่ใช่'
			}).then((result) => {
			  if (result.value) {
				loading('ระบบกำลังส่งของขวัญ...');
				$.post("action/gift_send", {id: id, reciver: reciver},
					function(data)
					{
						if(data == 'Parameter')
							return Swal.fire('Gift', 'กรุณาใส่ข้อมูลให้ถูกต้อง !', 'error');
						else if(data == 'Login')
							return checklogin();
						else if(data == 'Reciver')
							return Swal.fire('Gift', 'ไม่พบบัญชี ' + reciver + ' ในระบบ !', 'error');
						else if(data == 'Product')
							return Swal.fire('Gift', 'ไม่พบสินค้านี้ในระบบ !', 'error');
						else if(data == 'Point')
							return Swal.fire('Gift', 'คุณมีเงินไม่พอในการส่งของขวัญ !', 'error');
						else if(data == 'Error')
							return Swal.fire('Gift', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
						else
						{
							$('#Point').text(data);
							Swal.fire('Gift', 'ส่งของขวัญสำเร็จ !', 'success');
						}
					}
				);
			  }
			})
		}
	})
}
function gift_delete(id)
{
	swal.fire({
	  title: 'Gift',
	  text: "คุณต้องการลบของขวัญชิ้นนี้ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบของขวัญ..');
		$.post("action/gift_delete", {id: id}, 
			function(data)
			{
				if(data == 'Login')
					checklogin();
				else if(data == 'Success')
				{
					page('gift');
					Swal.fire('Gift', 'ลบของขวัญสำเร็จ !', 'success');
				}
				else
					return Swal.fire('Gift', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function gift_get(id)
{
		loading('กำลังแกะของขวัญ...');
		$.post("action/gift_get", {id: id},
			function(data)
			{
				if(data == 'Product')
					return Swal.fire('Gift', 'แย่จัง... ของขวัญในกล่องไม่มีในร้านค้าแล้ว !', 'error');
				else if(data == 'Login')
					return checklogin();
				else if(data == 'GLogin')
					return Swal.fire('Gift', 'แย่จัง... เปิดของขวัญไม่ได้ ต้องใส่รหัสในเกมก่อน !', 'error');
				else if(data == 'Server')
					return Swal.fire('Gift', 'แย่จัง... เซิร์ฟเวอร์ส่งของขวัญไม่ทำงาน !', 'error');
				else if(data == 'Expire')
					return Swal.fire('Gift', 'แย่จัง... หมดเวลาเปิดกล่องของขวัญแล้ว !', 'error');
				else if(data == 'Gift')
					return Swal.fire('Gift', 'แย่จัง... ของขวัญหายไปแล้ว !', 'error');
				else if(data == 'Online')
					return Swal.fire('Gift', 'แย่จัง... ลืมของไว้ในเซิร์ฟ กลับเข้าไปเอาหน่อยสิ !', 'error');
				else if(data == 'Success')
					return Swal.fire('Gift', 'เปิดของขวัญสำเร็จแล้ว !', 'success');
				else
					return Swal.fire('Gift', 'แย่จัง... เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
}
function changepassword()
{
	Swal.mixin({
		input: 'text',
		confirmButtonText: 'ต่อไป &rarr;',
		showCancelButton: true,
		progressSteps: ['1', '2', '3']
	}).queue([
		{
			title: 'Changepassword',
			text: 'ใส่รหัสผ่านเก่า'
		},
		{
			title: 'Changepassword',
			text: 'ใส่รหัสผ่านใหม่'
		},
		{
			title: 'Changepassword',
			text: 'ยืนยันรหัสผ่านใหม่'
		},
	]).then((result) => {
		if(result.value)
		{
			if(result.value[1] != result.value[2])
				return Swal.fire('Changepassword', 'กรุณาใส่รหัสผ่านให้เหมือนกัน !', 'error');
			$.post("action/changepassword", {oldpass: result.value[0], newpass: result.value[1]},
				function(data)
				{
					if(data == 'Parameter')
						return Swal.fire('Changepassword', 'กรุณาใส่รหัสให้ถูกต้อง !', 'error');
					else if(data == 'Login')
						return checklogin();
					else if(data == 'Password')
						return Swal.fire('Changepassword', 'รหัสผ่านไม่ถูกต้อง !', 'error');
					else if(data == 'Success')
						return Swal.fire('Changepassword', 'เปลี่ยนรหัสผ่านสำเร็จ !', 'success');
					else 
						return Swal.fire('Changepassword', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
				}
			);
		}
	})
}