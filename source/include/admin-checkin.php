								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title">
											<span><i class="fas fa-stamp"></i>&nbsp;</span>เช็คชื่อรายวัน<br>
										</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="text-center" style="margin-top: 80px;"><b>Check In</b></h1>
										<h5 class="text-center" style="margin-bottom: 80px;">แก้ไขระบบ</h5>
										<div class="col" style="margin-top: 10px;">
											<div class="row" id="main">
												<?php
													$query = $pdo->prepare("SELECT `id`, `image`, `name`, `price` FROM checkin");
													$query->execute();
													$i = 0;
													while($checkin = $query->fetch(PDO::FETCH_ASSOC))
													{
														$i++;
												?>
												<div class="col-md-4 text-right" style="padding: 10px;">
                                                    <div class="border rounded" style="background-color: rgba(0,0,0,0.03); padding: 20px;">
														<span class="text-white" style="background-color: rgb(52,58,64); text-shadow: -0.5px 0 black, 0 1px black, 0.5px 0 black, 0 -0.5px black;text-shadow: 2px 2px 2px black;padding-left: 10px;padding-right: 10px;padding-top: 2px;padding-bottom: 2px;font-size: 13px;"><?php echo $checkin['price']; ?> Day</span>
														<img src="<?php echo $checkin['image']; ?>" style="display: block;margin-top: 50px;margin-bottom: 50px;margin-left: auto;margin-right: auto;width: 60%;">
                                                        <p class="text-center"><?php echo $checkin['name']; ?></p>
														<button class="btn btn-outline-dark btn-block btn-sm" onclick="edit_checkin(<?php echo $checkin['id']; ?>);">แก้ไขข้อมูลสินค้า</button>
														<button class="btn btn-dark btn-block btn-sm" onclick="delete_checkin(<?php echo $checkin['id']; ?>, '<?php echo $checkin['name']; ?>');">ลบสินค้า</button>
													</div>
                                                </div>
												<?php
													}
													if($i == 0)
													{
												?>
													<div class="col-md-12" style="margin-top:50px;">
																<img src="../assets/img/error.png" alt="Smiley face" height="auto" width="100" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;">
																<h1 class="col text-center">แย่จังงงง ...</h1>
																<h3 class="col text-center">ไม่พบสินค้าในระบบ !</h3>
													</div>
												<?php
													}
												?>
													<button class="btn btn-dark btn-block" onclick="create_checkin_ui();" style="margin-top:50px;">เพิ่มสินค้า !</button>
													</div>
												</div>
											</div>
										</div>
