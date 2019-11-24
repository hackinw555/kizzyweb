<?php
	$config = [
		'title' => config($pdo, 'title'),
		'logo' => config($pdo, 'logo'),
		'background' => config($pdo, 'background'),
		'ip' => config($pdo, 'ip')
	];
?>
								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-chart-line"></i>&nbsp;</span>Dashboard</h4>
                                    </div>
                                    <div class="card-body">
										<div class="card mb-3" style="margin-top: 30px;margin-bottom: 30px;">
										  <div class="card-header"><i class="fas fa-cog"></i> Webshop Config</div>
										  <div class="card-body">
												<h1 class="card-title text-center" style="margin-top: 50px;">Config Webshop</h1>
												<h5 class="card-title text-center">การตั้งค่าร้านค้า</h5>
												<div class="input-group" style="margin-top: 50px;">
													<div class="input-group-prepend">
														<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">หัวข้อเว็บ</span>
													</div>
													<input class="form-control" type="text" id="atitle" value="<?php echo $config['title']; ?>">
												</div>
												<div class="input-group" style="margin-top: 10px;">
													<div class="input-group-prepend">
														<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">โลโก้เว็บ</span>
													</div>
													<input class="form-control" type="text" id="alogo" value="<?php echo $config['logo']; ?>">
												</div>
												<div class="input-group" style="margin-top: 10px;">
													<div class="input-group-prepend">
														<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ภาพพื้นหลังเว็บ</span>
													</div>
													<input class="form-control" type="text" id="abackground" value="<?php echo $config['background']; ?>">
												</div>
												<div class="input-group" style="margin-top: 10px;">
													<div class="input-group-prepend">
														<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">Server IP</span>
													</div>
													<input class="form-control" type="text" id="aip" value="<?php echo $config['ip']; ?>">
												</div>
												<button class="btn btn-dark btn-block" onclick="config_dashboard();" style="margin-top: 10px;">บันทึกข้อมูล !</button>
											  </div>
											</div>
											<div class="card mb-3" style="margin-top: 30px;margin-bottom: 30px;" id="update">
												<script>$("#update").load('?page=admin-update');</script>
												<div class="card-header">
													<i class="fas fa-edit"></i> Webshop Update...
												</div>
												<div class="card-body">
													<h1 class="card-title text-center">กรุณารอสักครู่... ระบบกำลังเช็คการ Update</h1>
												</div>
											</div>
                                	</div>