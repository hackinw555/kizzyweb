<?php
	include './api/KiznickAPI.php';
	$KiznickAPI = new KiznickAPI();
	$version = config($pdo, 'version');
	$lastversion = file_get_contents('https://client.dritestudio.in.th/product/webshop/version.php');
?>
										    <div class="card-header">
												<i class="fas fa-edit"></i> Webshop History <b>Last Release <u><?php echo $version; ?></u></b>
											</div>
										        <div class="card-body">
											  	<?php
													if($KiznickAPI->version($lastversion) > $KiznickAPI->version($version))
													{
												?>
													<div class="alert alert-primary" role="alert">
													  Webshop เวอร์ชั่น <?php echo $lastversion; ?> พร้อมใช้งานแล้ว, กรุณาอัพเดทเวอร์ชั่นใหม่
													</div>
													<button class="btn btn-primary btn-block" onclick="update();" style="margin-top: 10px;margin-bottom: 10px;">อัพเดทเป็นเวอร์ชั่น <?php echo $lastversion; ?> !</button>
												<?php
													}
													else
													{
												?>
													<div class="alert alert-success" role="alert">
														<p class="mt-3">Webshop ของคุณเป็นเวอร์ชั่น ล่าสุดแล้ว เวอร์ชั่น : <?php echo $version; ?><br>ไม่จำเป็นต้องทำการ Update ใดๆ</p>
													</div>
											  	<?php
													}
												?>
											<h3 class="card-title">Release 3.0.1</h3>
                                                <p>➔ แก้ไขปัญหาข้อมูลการเติมเงิน</p>
											<h3 class="card-title">Release 3.0.0</h3>
                                                <p>➔ แก้ไขปัญหาเช็คผู้เล่นออนไลน์</p>
                                                <p>➔ แก้ไขระบบ Update</p>
											<h3 class="card-title">Release 2.1.1</h3>
                                                <p>➔ แก้ไขปัญหาการแก้ไขเซิร์ฟเวอร์</p>
                                                <p>➔ แก้ไขจำนวนวัน Checkin ไม่ขึ้น</p>
											<h3 class="card-title">Release 2.1</h3>
                                                <p>➔ เพิ่มระบบส่งของขวัญ</p>
                                                <p>➔ เพิ่มระบบ Redeem</p>
												<p>➔ เพิ่มระบบประกาศข่าวสาร</p>
												<p>➔ เพิ่มระบบเติมเงิน</p>
												<p>➔ แก้ไขปัญหาอื่นๆ</p>
                                            <h3 class="card-title">Release 2.0.4</h3>
                                                <p>➔ แก้ไขระบบตรวจสอบผู้เล่นออนไลน์</p>
											<h3 class="card-title">Release 2.0.3</h3>
											    <p>➔ แก้ไข Bug Truewallet</p>
											    <p>➔ ยกเลิกการใช้งาน Websender, เปลี่ยนไปใช้งาน Rcon</p>
											<h3 class="card-title">Release 2.0.2</h3>
											    <p>➔ เพิ่มระบบ Server Status</p>
											<h3 class="card-title">Release 2.0.1</h3>
											    <p>➔ แก้ไข Login ค้าง</p>
											<h3 class="card-title">Release 2.0.0</h3>
											    <p>➔ เพิ่มระบบ Auto Update</p>
											    <p>➔ แก้ไข UI</p>
											    <p>➔ เพิ่มระบบ Truemoney Wallet</p>
											<h3 class="card-title">Release 1.0.1</h3>
											    <p>➔ แก้ไข UI</p>
											    <p>➔ เพิ่มระบบ Slide</p>
											<h3 class="card-title">Release 1.0.0</h3>
											    <p>➔ เพิ่มระบบพื้นฐาน</p>
										    </div>