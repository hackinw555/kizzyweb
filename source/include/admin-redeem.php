								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-gift"></i>&nbsp;</span>Redeem</h4>
                                    </div>
                                    <div class="card-body">
										<h1 class="text-center" style="margin-top: 80px;"><b>Redeem</b></h1>
										<h5 class="text-center" style="margin-bottom: 80px;">แลกของขวัญ</h5>
										<div class="input-group" style="margin-top: 10px;">
											<div class="form-row">
												<div class="col-md-12 mb-3">
												  <label for="redeem">Redeem Code [หากไม่ใส่ระบบจะ Random]</label>
												  <input class="form-control" type="text" placeholder="Redeem Code" id="redeem">
												</div>
												<div class="col-md-12 mb-3">
												  <label for="command">Command *** คำแนะนำ ใส่ &lt;player&gt; หากต้องการชื่อ Player *** </label>
												  <input class="form-control" type="text" placeholder="Command" id="command">
												</div>
												<div class="col-md-12 mb-3">
												  <label for="used">จำนวนครั้งที่ใช้ได้</label>
												  <input class="form-control" type="number" min="1"placeholder="จำนวนครั้งที่ใช้ได้" id="used">
												</div>
												<div class="col-md-12 mb-3">
												  <label for="server-select">For Server</label>
													<div class="input-group">
														<select class="custom-select mb-3" id="server">
														<?php
															$query = $pdo->prepare("SELECT `id`, `name` FROM server");
															$query->execute();
															while($server = $query->fetch(PDO::FETCH_ASSOC))
																echo '<option value="'.$server['id'].'">'.$server['name'].'</option>';
														?>
														</select>
													</div>
												</div>
											  </div>
											<button class="btn btn-dark btn-block" onclick="create_redeem();" style="margin-top: 10px;">บันทึกข้อมูล !</button>
										</div>
										<?php
											$query = $pdo->prepare("SELECT * FROM redeem");
											$query->execute();
											if($query->rowCount() != 0)
											{
										?>
										<div class="table-responsive" style="margin-top: 10px;">
											<div class="table-borderless">
												<table class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>Redeem Code</th>
															<th>ใช้แล้ว</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$query = $pdo->prepare("SELECT * FROM redeem");
														$query->execute();
														while($redeem = $query->fetch(PDO::FETCH_ASSOC))
														{
													?>
														<tr>
															<td><div class="input-group mb-3"><input class="form-control" readonly value="<?php echo $redeem['redeem']; ?>" id="<?php echo $redeem['redeem']; ?>"><div class="input-group-append"><button class="btn btn-success" onclick="copyinput('<?php echo $redeem['redeem'];?>');">Copy !</button></div></div></td>
															<td><?php echo $redeem['used'].'/'.$redeem['max']; ?></td>
															<td><button class="btn btn-danger" onclick="delete_redeem(<?php echo $redeem['id'];?>, '<?php echo $redeem['redeem'];?>');">Delete !</button></td>
														</tr>
													<?php
														}
													?>
													</tbody>
												</table>
											</div>
										 </div>
										<?php
											}
										?>
									</div>
								</div>
							</div>