function config_dashboard()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/dashboard", {title: $('#atitle').val(), logo: $('#alogo').val(), background: $('#abackground').val(), ip: $('#aip').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Backend', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
				return Swal.fire('Backend', 'แก้ไขข้อมูลสำเร็จ !', 'success');
			else
				return Swal.fire('Backend', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function config_topup()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/topup", {topuptype: $('input[type="radio"][name="TopupType"]:checked').val(), merchant: $('#amerchant').val(), tmx: $('#tmx').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Topup', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
				return Swal.fire('Topup', 'แก้ไขข้อมูลสำเร็จ !', 'success');
			else
				return Swal.fire('Topup', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function create_server()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/create_server", {name: $('#servername').val(), ip: $('#serverip').val(), query: $('#queryport').val(), rport: $('#rconport').val(), rpass: $('#rconpassword').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Server', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
			{
				page('admin-server');
				return Swal.fire('Server', 'เพิ่มข้อมูลสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Server', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function delete_server(server, name)
{
	swal.fire({
	  title: 'Server',
	  text: "คุณต้องการลบเซิร์ฟเวอร์ " + name + " ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบเซิร์ฟเวอร์...');
		$.post("action/admin/delete_server", {server: server}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
				{
					page('admin-server');
					Swal.fire('Server', 'ลบเซิร์ฟเวอร์สำเร็จ !', 'success');
				}
				else
					return Swal.fire('Server', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function edit_shop(server, name)
{
	if(server == '')
		return Swal.fire('Shop', 'กรุณาเลือก Server ให้ถูกต้อง !', 'error');
    $('button[class="btn btn-outline-dark server-select active"]').removeClass('active');
    $('#Shop-' + server).addClass("active");
    $("#shoptext").text(name);
	loading('ระบบกำลังเรียกข้อมูล...');
    $("#shop").load('?page=admin-product&server=' + server);
}
function delete_product(id, name, server)
{
	swal.fire({
	  title: 'Product',
	  text: "คุณต้องการลบสินค้า " + name + " ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบสินค้า...');
		$.post("action/admin/delete_product", {id: id}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
				{
					edit_shop(server, $("#shoptext").text());
					Swal.fire('Product', 'ลบสินค้าสำเร็จ !', 'success');
				}
				else
					return Swal.fire('Product', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function edit_product(id)
{
    $("#shop").load('?page=admin-editproduct&product=' + id);
}
function save_product(id, server)
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/save_product", {id: id, image: $('#image').val(), name: $('#name').val(), command: $('#command').val(), price: $('#price').val(), pad: $('#pad').val(), ispad: $('#ispad').prop('checked')}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Product', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
			{
				edit_shop(server, $("#shoptext").text());
				return Swal.fire('Product', 'แก้ไขข้อมูลสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Product', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function edit_server(server)
{
	loading('ระบบกำลังเรียกข้อมูล...');
	$.post("./?page=admin-serverinfo", {server: server}, 
		function(data)
		{
			$('#result').html(data);
			$('#editserver').modal('show')
		}
	);
}
function save_server(server)
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/edit_server", {server: server, name: $('#eservername').val(), ip: $('#eserverip').val(), query: $('#equeryport').val(), rport: $('#erconport').val(), rpass: $('#erconpassword').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Server', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
			{
				$('body').removeClass('modal-open');
				$('.modal-backdrop, .fade, .show').remove();
				page('admin-server');
				return Swal.fire('Server', 'แก้ไขข้อมูลสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Server', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function create_product_ui()
{
    $("#shop").load('?page=admin-createproductui');
}
function create_product()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/create_product", {image: $('#image').val(), name: $('#name').val(), command: $('#command').val(), price: $('#price').val(), pad: $('#pad').val(), ispad: $('#ispad').prop('checked'), server: $('select option:selected').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Product', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
			{
				edit_shop($('select option:selected').val(), $('select option:selected').text());
				return Swal.fire('Product', 'เพิ่มสินค้าสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Product', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function delete_slide(id, image)
{
	swal.fire({
	  title: 'Slide',
	  imageUrl: image,
	  imageAlt: 'Image Slide',
	  text: "คุณต้องการลบภาพด้านบนใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบเซิร์ฟเวอร์...');
		$.post("action/admin/delete_slide", {id: id}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
				{
					page('admin-slide');
					Swal.fire('Slide', 'ลบสไลด์สำเร็จ !', 'success');
				}
				else
					return Swal.fire('Slide', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function create_slide()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/create_slide", {slideimage: $('#slideimage').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Slide', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
			{
				page('admin-slide');
				return Swal.fire('Slide', 'เพิ่มข้อมูลสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Slide', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function edit_player(id)
{
	loading('ระบบกำลังเรียกข้อมูล...');
	$.post("action/admin/getplayer", {id: id}, 
		function(data)
		{
			$('#result').html(data);
			$('#editplayer').modal('show')
		}
	);
}
function save_player(id)
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/edit_player", {id: id, username: $('#eusername').val(), point: $('#epoint').val(), isadmin: $('select option:selected').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Player', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
			{
				$('body').removeClass('modal-open');
				$('.modal-backdrop, .fade, .show').remove();
				page('admin-player');
				return Swal.fire('Player', 'แก้ไขข้อมูลสำเร็จ !', 'success');
			}
			else
				return Swal.fire('Player', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function search_player() {
  var input, filter, card, div, h, i, txtValue;
  input = document.getElementById('search_player_input');
  filter = input.value.toUpperCase();
  card = document.getElementById("search_player_card");
  div = card.getElementsByTagName('div');
  for (i = 0; i <= div.length; i++) {
    h = div[i].getElementsByTagName("h5")[0];
    txtValue = h.textContent || h.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1)
    	div[i].style.display = "";
    else
    	div[i].style.display = "none";
  }
}
function update(version)
{
	swal.fire({
	  title: 'Update',
	  text: "คุณต้องการอัพเดท Webshop เป็นเวอร์ชั่น " + version + " ใช้หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังอัพเดท...');
		$.post("action/admin/update", {}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
				{
					page('admin-dashboard');
					Swal.fire('Update', 'Update เว็บไซต์เป็นเวอร์ชั่น ' + version + ' สำเร็จ !', 'success');
				}
				else
					return Swal.fire('Update', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function conf_tw()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/truewallet", {tw_key: $('#tw_key').val(), tw_tel: $('#tw_tel').val(), twx: $('#twx').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Topup', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
				return Swal.fire('Topup', 'แก้ไขข้อมูลสำเร็จ !', 'success');
			else
				return Swal.fire('Topup', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function create_redeem()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/create_redeem", {redeem: $('#redeem').val(), command: $('#command').val(), used: $('#used').val(), server: $('select option:selected').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Redeem', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'use')
				return Swal.fire('Redeem', 'Redeem นี้ถูกใช้งานแล้ว !', 'error');
			else if(data == 'success')
				return page('admin-redeem');
			else
				return Swal.fire('Redeem', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function create_checkin_ui()
{
    $("#main").load('?page=admin-createcheckin');
}
function create_checkin()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/create_checkin", {image: $('#image').val(), name: $('#name').val(), command: $('#command').val(), price: $('#price').val(), server: $('select option:selected').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Check In', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
				return page('admin-checkin');
			else
				return Swal.fire('Check In', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function delete_checkin(id, name)
{
	swal.fire({
	  title: 'Product',
	  text: "คุณต้องการลบสินค้า " + name + " ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบสินค้า...');
		$.post("action/admin/delete_checkin", {id: id}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
					return page('admin-checkin');
				else
					return Swal.fire('Check In', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function edit_checkin(id)
{
    $("#main").load('?page=admin-editcheckin&id=' + id);
}
function save_checkin(id)
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/save_checkin", {id: id, image: $('#image').val(), name: $('#name').val(), command: $('#command').val(), price: $('#price').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('Check In', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
				return page('admin-checkin');
			else
				return Swal.fire('Check In', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function copyinput(id) {
  var copyText = document.getElementById(id);
  copyText.select(); 
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
}
function delete_redeem(id, redeem)
{
	swal.fire({
	  title: 'Redeem',
	  text: "คุณต้องการลบ Redeem " + redeem + " ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบ Redeem...');
		$.post("action/admin/delete_redeem", {id: id}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
					return page('admin-redeem');
				else
					return Swal.fire('Redeem', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}
function create_news()
{
	loading('ระบบกำลังบันทึกข้อมูล...');
	$.post("action/admin/create_news", {news: $('#news').val()}, 
		function(data)
		{
			if(data == 'login')
				checklogin();
			else if(data == 'parameter')
				return Swal.fire('News', 'กรุณาใส่ข้อมูลให้ครบ !', 'error');
			else if(data == 'success')
				return page('admin-news');
			else
				return Swal.fire('News', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
		}
	);
}
function delete_news(id)
{
	swal.fire({
	  title: 'Redeem',
	  text: "คุณต้องการลบประกาศนี้ใช่หรือไม่ ?",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'ใช่',
	  cancelButtonText: 'ไม่ใช่'
	}).then((result) => {
	  if (result.value) {
		loading('ระบบกำลังลบประกาศ...');
		$.post("action/admin/delete_news", {id: id}, 
			function(data)
			{
				if(data == 'login')
					checklogin();
				else if(data == 'success')
					return page('admin-news');
				else
					return Swal.fire('News', 'เกิดข้อผิดพลาดไม่ทราบสาเหตุ !', 'error');
			}
		);
	  }
	})
}