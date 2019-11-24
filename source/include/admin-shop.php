								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-edit"></i>&nbsp;</span>Shop</h4>
                                    </div>
                                    <div class="card-body">
										<?php
                                   		 	$query = $pdo->prepare("SELECT `id`, name FROM server");
                                    		$query->execute();
											if($query->rowCount() == 0)
											{
										?>
										<div class="col-md-12" style="margin-top:50px;margin-bottom:50px;">
													<img src="../assets/img/error.png" alt="Smiley face" height="auto" width="100" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;">
													<h1 class="col text-center">แย่จังงงง ...</h1>
													<h3 class="col text-center">ไม่พบข้อมูล Server ในระบบ !</h3>
										</div>
										<?php
											}
											else if($query->rowCount() == 1)
											{
												$server = $query->fetch(PDO::FETCH_ASSOC);
										?>
                                        	<h1 class="text-center" style="margin-top: 80px;">Select Server !</h1>
											<h5 class="text-center" style="margin-bottom: 80px;" id="shoptext"><?php echo $server['name']; ?></h5>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col text-center" style="margin-top: 20px;">
													<script>edit_shop(<?php echo $server['id']; ?>);</script>
												</div>
                                            </div>
                                        </div>
										<?php
											}
											else if($query->rowCount() > 1)
											{
										?>
                                        	<h1 class="text-center" style="margin-top: 80px;">Select Server !</h1>
											<h5 class="text-center" style="margin-bottom: 80px;" id="shoptext">กรุณาเลือกเซิร์ฟเวอร์เพื่อแก้ไขสินค้า !</h5>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col text-center" style="margin-top: 20px;">
													<?php
														while($server = $query->fetch(PDO::FETCH_ASSOC))
															echo '<button class="btn btn-outline-dark server-select" onclick="edit_shop('.$server['id'].', \''.$server['name'].'\');" id="Shop-'.$server['id'].'"><i class="fas fa-server"></i> '.$server['name'].'</button>';
													?>
												</div>
                                            </div>
                                        </div>
										<?php
											}
										?>
										<?php
                                   		 	$query = $pdo->prepare("SELECT `id`, name FROM server");
                                    		$query->execute();
											if($query->rowCount() == 0)
												{
															?>
										<?php
														}
											else if($query->rowCount() >= 1)
											{
										?>
                                        <div class="col" style="margin-top: 10px;">
                                            <div class="row" id="shop">
                                            </div>
                                        </div>
										<?php
											}
										?>
                                    </div>
                                </div>