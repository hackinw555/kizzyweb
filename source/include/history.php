								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title">
											<span><i class="fas fa-history"></i>&nbsp;</span>ประวัติการเติมเงิน<br>
										</h4>
                                    </div>
                                    <div class="card-body">
                                        	<h1 class="text-center" style="margin-top: 80px;"><b>ประวัติการใช้งาน</b></h1>
											<h5 class="text-center" style="margin-bottom: 80px;">การเติมเงิน</h5>
										<div class="table-responsive">
											<div class="table-borderless">
												<table class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>วิธีการเติมเงิน</th>
															<th>เลขอ้างอิง</th>
															<th>จำนวนเงิน</th>
															<th>สถานะการเติมเงิน</th>
															<th>อัพเดทล่าสุด</th>
														</tr>
													</thead>
													<tbody>
													<?php
														include './api/KiznickAPI.php';
														$KiznickAPI = new KiznickAPI();
														$query = $pdo->prepare("SELECT * FROM topup WHERE user = ?");
														$query->execute(array($_SESSION['id']));
														$i = 0;
														while($history = $query->fetch(PDO::FETCH_ASSOC))
														{
															$i++;
															$update = $history['updatetime'];
													?>
														<tr>
															<td><?php echo $KiznickAPI->payment_type($history['type']); ?></td>
															<td><?php if($history['type'] == 1) echo $history['ref']; else echo $history['transaction_id'];  ?></td>
															<td><?php echo $history['amount']; ?></td>
															<td><?php echo $KiznickAPI->payment_status($history['status'], $history['type']); ?></td>
															<td><?php echo date("d/m/Y H:i:s", $update); ?></td>
														</tr>
													<?php
														}
														if($i == 0)
															echo '<tr><td colspan="5"><h5 class="text-center">- ไม่พบข้อมูลในระบบ -</h5></td></tr>';
														if($_SESSION['update'] <= $update && $_SESSION['id'] != '')
														{
															$quser = $pdo->prepare("SELECT point FROM authme WHERE id = ?");
															$quser->execute(array($_SESSION['id']));
															$point = $quser->fetch(PDO::FETCH_ASSOC)['point'];
															$_SESSION['update'] = time();
															$_SESSION['point'] = $point;
															echo '<script>$("#login").load("?page=login");</script>';
														}
													?>
													</tbody>
												</table>
											</div>
										 </div>
                                    </div>
                                </div>