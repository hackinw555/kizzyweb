								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-server"></i>&nbsp;</span>Server</h4>
                                    </div>
                                    <div class="card-body">
										<div class="row">
										
										<div class="col-md-12">
										<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
										<div class="card-header">
											<h4 class="card-header-title"><span><i class="fas fa-server"></i>&nbsp;</span>Create Slide</h4>
										</div>
										<div class="card-body">
										<h1 class="text-center" style="margin-top: 80px;">Create Slide !</h1>
										<h5 class="text-center" style="margin-bottom: 80px;">เพิ่มสไลด์ !</h5>
											<div class="input-group" style="margin-top: 10px;">
												<div class="input-group-prepend">
													<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ลิ้ง URL รูปภาพ</span>
												</div>
												<input class="form-control" type="url" id="slideimage">
											</div>
										<button class="btn btn-dark btn-block" onclick="create_slide();" style="margin-top: 10px;">เพิ่มรูปภาพ !</button>
										</div>
										</div>
										</div>
										
										<div class="col-md-12">
										<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
										<div class="card-header">
											<h4 class="card-header-title"><span><i class="fas fa-server"></i>&nbsp;</span>Slide List</h4>
										</div>
										<div class="card-body">
										<h1 class="text-center" style="margin-top: 80px;">Slide List !</h1>
										<h5 class="text-center" style="margin-bottom: 80px;">สไลด์ทั้งหมด !</h5>
										
											
											
											
											
											
									<div class="row">
									<?php
													$query = $pdo->prepare("SELECT * FROM slide");
													$query->execute();
													$i = 0;
													while($slide = $query->fetch(PDO::FETCH_ASSOC))
													{
														$i++;
									?>	
									   <div class="col-md-4 text-right" style="padding: 10px;">
                                                    <div class="border rounded" style="background-color: rgba(0,0,0,0.03);padding: 20px;">
														<span class="text-white" style="background-color: rgb(52,58,64);text-shadow: -0.5px 0 black, 0 1px black, 0.5px 0 black, 0 -0.5px black;text-shadow: 2px 2px 2px black;padding-left: 10px;padding-right: 10px;padding-top: 2px;padding-bottom: 2px;font-size: 13px;">รูปภาพสไลด์ที่ <?php echo $i; ?></span>
														<img src="<?php echo $slide['image']; ?>" style="display: block;margin-top: 50px;margin-bottom: 50px;margin-left: auto;margin-right: auto;width: 90%;">
														<button class="btn btn-dark btn-sm btn-block" onclick="delete_slide(<?php echo $slide['id']; ?>, '<?php echo $slide['image']; ?>');">ลบรูปภาพ</button>
													</div>
                                       </div>
									<?php
													}
													if($i == 0){
														{
															?>
										<div class="col-md-12" style="margin-top:50px;margin-bottom:50px;">
													<img src="../assets/img/error.png" alt="Smiley face" height="auto" width="100" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;">
													<h1 class="col text-center">แย่จังงงง ...</h1>
													<h3 class="col text-center">ไม่พบรูปภาพในระบบ !</h3>
										</div>
										<?php
														}
													}
									?>
									</div>
										</div>
										</div>
										</div>
                                	</div>
									</div>
                                </div>