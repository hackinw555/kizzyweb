								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-server"></i>&nbsp;</span>Server</h4>
                                    </div>
                                    <div class="card-body">
					
								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-server"></i>&nbsp;</span>Create Server</h4>
                                    </div>
                                    <div class="card-body">
											<h1 class="text-center" style="margin-top: 80px;">Create Server !</h1>
											<h5 class="text-center" style="margin-bottom: 80px;">เพิ่มเซิร์ฟเวอร์ !</h5>
										  <div class="form-row">
											<div class="col-md-4 mb-3">
											  <label for="servername">Server Name</label>
											  <input type="text" class="form-control" id="servername" placeholder="Server Name" id="ServerName" required>
											</div>
											<div class="col-md-4 mb-3">
											  <label for="serverip">Server IP</label>
											  <input type="text" class="form-control" id="serverip" placeholder="Server IP" value="127.0.0.1" required>
											</div>
											<div class="col-md-4 mb-3">
											  <label for="queryport">Query Port</label>
											  <input type="number" class="form-control" id="queryport" placeholder="Query Port" required min="1024" max="49151">
											</div>
										  </div>
										  <div class="form-row">
											<div class="col-md-4 mb-3">
											  <label for="rconport">Rcon Port</label>
											  <input type="number" class="form-control" id="rconport" placeholder="Rcon Port" required min="1024" max="49151">
											</div>
											<div class="col-md-4 mb-3">
											  <label for="rconpassword">Rcon Password</label>
											  <input type="password" class="form-control" id="rconpassword" placeholder="Rcon Password" required>
											</div>
										  </div>
										  <button class="btn btn-dark btn-block" onclick="create_server();" style="margin-top: 10px;">เพิ่มเซิร์ฟเวอร์ !</button>
										</div>
									</div>
									<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-server"></i>&nbsp;</span>Server List</h4>
                                    </div>
                                    <div class="card-body">
										<h1 class="text-center" style="margin-top: 80px;">Server List !</h1>
										<h5 class="text-center" style="margin-bottom: 80px;">รายชื่อเซิร์ฟเวอร์ !</h5>
									<div class="row">
										<?php
													$query = $pdo->prepare("SELECT `id`, `name` FROM server");
													$query->execute();
													$i = 0;
													while($server = $query->fetch(PDO::FETCH_ASSOC))
													{
														$i++;
										?>
										<div class="col-md-6 text-right" style="padding: 10px;">
                                                    <div class="border rounded" style="background-color: rgba(0,0,0,0.03);padding: 20px;">
														<span class="text-white" style="background-color: rgb(52,58,64);text-shadow: -0.5px 0 black, 0 1px black, 0.5px 0 black, 0 -0.5px black;text-shadow: 2px 2px 2px black;padding-left: 10px;padding-right: 10px;padding-top: 2px;padding-bottom: 2px;font-size: 13px;">Server ที่ <?php echo $i; ?></span>
														<h3 class="text-center" style="margin-top: 50px;"><i class="fas fa-server" style="font-size:150px;"></i></h3>
														<h3 class="text-center" ><?php echo $server['name']; ?> !</h3>
														<button class="btn btn-outline-dark btn-sm btn-block" onclick="edit_server(<?php echo $server['id']; ?>);">แก้ไขข้อมูลเซิร์ฟเวอร์</button>
														<button class="btn btn-dark btn-sm btn-block" onclick="delete_server(<?php echo $server['id']; ?>, '<?php echo $server['name']; ?>');">ลบเซิร์ฟเวอร์</button>
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
													<h3 class="col text-center">ไม่พบข้อมูล Server ในระบบ !</h3>
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
								<div id="result"></div>