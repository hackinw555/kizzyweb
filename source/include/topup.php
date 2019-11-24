<?php
	$query = $pdo->prepare("SELECT `value` FROM `config` WHERE `name` = ?");
    $query->execute(array('tw_tel'));
	$tw_tel = $query->fetch(PDO::FETCH_ASSOC)['value'];
?>
								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title">
											<span><i class="fas fa-money-check"></i>&nbsp;</span>เติมเงิน<br>
										</h4>
                                    </div>
                                    <div class="card-body">
										<div class="row">
											<div class="col-md-12">
												<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
													<div class="card-header">
														<h4 class="card-header-title">
															<span><i class="fas fa-money-check"></i>&nbsp;</span>เติมเงินด้วย Truemoney<br>
														</h4>
													</div>
													<div class="card-body">
														<h2 class="text-center" style="margin-top: 50px;">
															<strong>เติมเงินด้วย</strong>
														</h2>
														<h5 class="text-center">Truemoney</h5>
														<h5 class="text-center" style="margin-bottom: 50px;">เติมเงินคูณ X<?php echo config($pdo, 'tmx') ?></h5>
														<div class="table-borderless">
															<table class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th>จำนวนที่เติม</th>
																		<th>จำนวนที่ได้</th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>50 บาท</td>
																		<td><?php echo 50*config($pdo, 'tmx') ?> บาท<br></td>
																	</tr>
																	<tr>
																		<td>90 บาท</td>
																		<td><?php echo 90*config($pdo, 'tmx') ?> บาท<br></td>
																	</tr>
																	<tr>
																		<td>150 บาท</td>
																		<td><?php echo 150*config($pdo, 'tmx') ?> บาท<br></td>
																	</tr>
																	<tr>
																		<td>300 บาท</td>
																		<td><?php echo 300*config($pdo, 'tmx') ?> บาท<br></td>
																	</tr>
																	<tr>
																		<td>500 บาท</td>
																		<td><?php echo 500*config($pdo, 'tmx') ?> บาท<br></td>
																	</tr>
																	<tr>
																		<td>1000 บาท</td>
																		<td><?php echo 1000*config($pdo, 'tmx') ?> บาท<br></td>
																	</tr>
																</tbody>
															</table>
														</div>
														<div class="form-group">
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ชื่อผู้ใช้</span>
																</div>
																<input class="form-control" type="text" value="<?php echo $_SESSION['username']; ?>" id="tusername">
																<div class="input-group-append"></div>
															</div>
															<div class="input-group" style="margin-top: 10px;">
																<div class="input-group-prepend">
																	<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">รหัสบัตรทรูมันนี่</span>
																</div>
																<input class="form-control" type="text" id="tcard">
																<div class="input-group-append"></div>
															</div>
															<button class="btn btn-dark btn-block" onclick="topup(1);" style="margin-top: 10px;">เติมเงิน !</button>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
													<div class="card-header">
														<h4 class="card-header-title">
															<span><i class="fas fa-money-check"></i>&nbsp;</span>เติมเงินด้วย TrueWallet<br>
														</h4>
													</div>
													<div class="card-body">
														<h2 class="text-center" style="margin-top: 50px;">
															<strong>เติมเงินด้วย</strong>
														</h2>
														<h5 class="text-center">TrueWallet</h5>
														<h5 class="text-center">เติมเงินคูณ X<?php echo config($pdo, 'twx') ?></h5>
														<h5 class="text-center" style="margin-bottom: 50px;"><?php echo config($pdo, 'tw_tel') ?></h5>
														<div class="form-group">
															<div class="input-group">
																<div class="input-group-prepend">
																	<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ชื่อผู้ใช้</span>
																</div>
																<input class="form-control" type="text" value="<?php echo $_SESSION['username']; ?>" id="wusername">
																<div class="input-group-append"></div>
															</div>
															<div class="input-group" style="margin-top: 10px;">
																<div class="input-group-prepend">
																	<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">เลขอ้างอิง</span>
																</div>
																<input class="form-control" type="text" id="TransactionID">
																<div class="input-group-append"></div>
															</div>
															<button class="btn btn-dark btn-block" onclick="topup(2);" style="margin-top: 10px;">เติมเงิน !</button>
														</div>
													</div>
												</div>
											</div>
										</div>
                             		</div>
                          		</div>
