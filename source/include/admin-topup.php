<?php
	$topup = $pdo->prepare("SELECT amount FROM topup WHERE time >= ? and amount != '0.00'");
	$topup->execute(array(strtotime('first day of '.date('F Y'))));
	$total = 0;
	while($data = $topup->fetch(PDO::FETCH_ASSOC)['amount'])
		$total = $total + $data;
	$MerchantID = config($pdo, 'merchant');
	$TopupType = config($pdo, 'tm_type');
?>
								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="far fa-money-bill-alt"></i>&nbsp;</span>Topup</h4>
                                    </div>
                                    <div class="card-body">
										<div class="card text-white bg-success">
										  <div class="card-header">ยอดการเติมเงิน (<?php echo date("F"); ?>)</div>
										  <div class="card-body">
											<h5 class="card-title"><?php echo $total; ?> THB</h5>
											<p class="card-text"><?php echo date("j F Y H:i:s"); ?></p>
										  </div>
										</div>
										<hr>
										<div class="row">
											<div class="col-md-12">
												<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
													<div class="card-header">
														<h4 class="card-header-title"><span><i class="far fa-money-bill-alt"></i>&nbsp;</span>TMPay Config !</h4>
													</div>
													<div class="card-body">
													<h1 style="margin-top:80px;" class="text-center">TMPay Config !</h1>
													<h5 style="margin-bottom:80px;" class="text-center">การตั้งค่าการเติมเงินผ่านทางบัตรทรูมันนี่</h5>
													<h5 style="margin-bottom:10px;">ช่องทางการเติมเงินบัตรทรู</h5>
													<div class="custom-control custom-radio custom-control-inline">
													  <input type="radio" id="UseTmpay" name="TopupType" id="topuptype" class="custom-control-input"<?php if($TopupType == 1) echo checked; ?> value="1">
													  <label class="custom-control-label" for="UseTmpay">Tmpay โดนหัก 14.4%</label>
													</div>
														<div class="input-group" style="margin-top: 10px;">
															<div class="input-group-prepend">
																<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">MerchantID</span>
															</div>
															<input class="form-control" type="text" id="amerchant" value="<?php echo $MerchantID; ?>">
															<div class="input-group-append"></div>
														</div>
													<div class="input-group" style="margin-top: 10px;">
														<div class="input-group-prepend">
															<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">เติมเงินคูณ</span>
														</div>
														<input class="form-control" type="text" id="tmx" value="<?php echo config($pdo, 'tmx'); ?>">
														<div class="input-group-append"></div>
													</div>
													<button class="btn btn-dark btn-block" onclick="config_topup();" style="margin-top: 10px;">Save !</button>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
													<div class="card-header">
														<h4 class="card-header-title"><span><i class="far fa-money-bill-alt"></i>&nbsp;</span>TrueWallet Config !</h4>
													</div>
													<div class="card-body">
													<h1 style="margin-top:80px;" class="text-center">TrueWallet Config !</h1>
													<h5 style="margin-bottom:80px;" class="text-center">การตั้งค่าการเติมเงินผ่านทางทรูวอเลท</h5>
													<h5 style="margin-bottom:80px;" class="text-center">ขอ TrueWallet Key ได้ที่ <a  class="btn btn-primary btn-lgk" href="../ref/">Token Ref</a></h5>
													<div class="input-group" style="margin-top: 10px;">
														<div class="input-group-prepend">
															<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">TrueWallet Key</span>
														</div>
														<input class="form-control" onclick="this.select()" type="text" id="tw_key" value="<?php echo config($pdo, 'tw_key'); ?>">
														<div class="input-group-append"></div>
													</div>
													<div class="input-group" style="margin-top: 10px;">
														<div class="input-group-prepend">
															<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">TrueWallet Phone</span>
														</div>
														<input class="form-control" type="text" id="tw_tel" value="<?php echo config($pdo, 'tw_tel'); ?>">
														<div class="input-group-append"></div>
													</div>
													<div class="input-group" style="margin-top: 10px;">
														<div class="input-group-prepend">
															<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">เติมเงินคูณ</span>
														</div>
														<input class="form-control" type="text" id="twx" value="<?php echo config($pdo, 'twx'); ?>">
														<div class="input-group-append"></div>
													</div>
													<button class="btn btn-dark btn-block" onclick="conf_tw();" style="margin-top: 10px;">Save !</button>
													</div>
												</div>
											</div>
										</div>
                                	</div>
