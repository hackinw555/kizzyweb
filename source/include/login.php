<?php
	if($_SESSION['id'] == '')
	{
?>
		<h5 class="text-left">
			สวัสดี <strong>Guest</strong> !
		</h5>
		<h6 class="text-left" style="margin-top: 8px;">
			กรุณา <strong><span style="text-decoration: underline;">Login</span></strong> เพื่อเข้าสู่ระบบ !
		</h6>
		<div class="input-group" style="margin-top: 10px;">
			<div class="input-group-prepend">
				<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ชื่อผู้ใช้</span>
			</div>
			<input class="form-control" type="text" id="username">
			<div class="input-group-append"></div>
		</div>
		<div class="input-group" style="margin-top: 10px;">
			<div class="input-group-prepend">
				<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">รหัสผ่าน</span>
			</div>
			<input class="form-control" type="password" id="password">
			<div class="input-group-append"></div>
		</div>
		<button class="btn btn-dark btn-block" onclick="login();" style="margin-top: 10px;">เข้าสู่ระบบ !</button>
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="input-group-prepend">
                                <span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ชื่อผู้ใช้</span>
                            </div>
                            <input class="form-control" type="text" id="rusername">
                            <div class="input-group-append"></div>
                        </div>
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="input-group-prepend">
                                <span class="text-white input-group-text" style="background-color: rgb(52,58,64);">รหัสผ่าน</span>
                            </div>
                            <input class="form-control" type="password" id="rpass">
                            <div class="input-group-append"></div>
                        </div>
                        <div class="input-group" style="margin-top: 10px;">
                            <div class="input-group-prepend">
                                <span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ยืนยันรหัสผ่าน</span>
                            </div>
                            <input class="form-control" type="password" id="rcpass">
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" onclick="register();">Register</button>
                    </div>
                </div>
            </div>
        </div>
<?php
	}
	else
	{
?>
		<img class="img-fluid" src="https://minotar.net/armor/bust/<?php echo $_SESSION['username']; ?>/190.png" width="100px">
		<h5 class="text-left" style="margin-top: 20px;">
			สวัสดี <strong id="player_username"><?php echo $_SESSION['username']; ?></strong> !
		</h5>
		<h6 class="text-left" style="margin-top: 8px;">
			เงินคงเหลือ : <strong><span style="text-decoration: underline;" id="Point"><?php echo $_SESSION['point']; ?></span></strong> THB
		</h6>
		<a onclick="changepassword();" class="btn btn-dark btn-block btn-sm" style="color:white;"><span><i class="fas fa-key"></i>&nbsp;</span>เปลี่ยนรหัสผ่าน</a>
		<a onclick="logout();" class="btn btn-danger btn-block btn-sm" style="color:white;"><span><i class="fas fa-sign-out-alt"></i>&nbsp;</span>ออกจากระบบ</a>
<?php
	}
?>
				<hr>
				<h5>เมนูทั่วไป</h5>
				<hr>
				<a onclick="page('home');" id="Menu-home" class="btn btn-outline-dark btn-block btn-sm menu active"><span><i class="fas fa-home"></i>&nbsp;</span>หน้าหลัก</a>
				<a onclick="page('shop');" id="Menu-shop" class="btn btn-outline-dark btn-block btn-sm menu"><span><i class="fas fa-shopping-cart"></i>&nbsp;</span>ร้านค้า</a>
				<a onclick="page('topup');" id="Menu-topup" class="btn btn-outline-dark btn-block btn-sm menu"><span><i class="fas fa-money-check"></i>&nbsp;</span>เติมเงิน</a>
				<?php
				if($_SESSION['id'] != '')
				{
				?>
				<a onclick="page('history');" id="Menu-history" class="btn btn-outline-dark btn-block btn-sm menu"><span><i class="fas fa-history"></i>&nbsp;</span>ประวัติการเติมเงิน</a>
				<a onclick="page('redeem');" id="Menu-redeem" class="btn btn-outline-dark btn-block btn-sm menu"><span><i class="fas fa-terminal"></i>&nbsp;</span>แลกรหัสสุ่ม</a>
				<a onclick="page('gift');" id="Menu-gift" class="btn btn-outline-dark btn-block btn-sm menu"><span><i class="fas fa-gift"></i>&nbsp;</span>รับของขวัญ</a>
				<a onclick="page('checkin');" id="Menu-checkin" class="btn btn-outline-dark btn-block btn-sm menu"><span><i class="fas fa-stamp"></i>&nbsp;</span>เช็คชื่อรายวัน</a>
		<?php
		}
		if($_SESSION['isadmin'] == 1)
			include './include/admin-menu.php';
		?>