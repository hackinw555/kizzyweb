								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="fas fa-user-circle"></i>&nbsp;</span>Player</h4>
                                    </div>
                                    <div class="card-body">
										<h1 class="text-center" style="margin-top: 80px;">Player List !</h1>
										<h5 class="text-center" style="margin-bottom: 80px;">รายชื่อผู้เล่น !</h5>
										<div class="input-group" style="margin-top: 10px;">
											<div class="input-group-prepend">
												<span class="text-white input-group-text" style="background-color: rgb(52,58,64);">ชื่อผู้เล่น</span>
											</div>
											<input class="form-control" type="text" id="search_player_input" onkeyup="search_player()" placeholder="Search Player...">
											<div class="input-group-append"></div>
										</div>
										<div class="row" style="margin-top:20px;" id="search_player_card">
										<?php
													$query = $pdo->prepare("SELECT `id`, `username`, `point`, `donate` FROM `authme`");
													$query->execute();
													$i = 0;
													while($player = $query->fetch(PDO::FETCH_ASSOC))
													{
														$i++;
												?>
										
												<div class="col-md-4 text-right" style="padding: 10px;">
                                                    <div class="border rounded" style="background-color: rgba(0,0,0,0.03);padding: 20px;">
														<span class="text-white" style="background-color: rgb(52,58,64);text-shadow: -0.5px 0 black, 0 1px black, 0.5px 0 black, 0 -0.5px black;text-shadow: 2px 2px 2px black;padding-left: 10px;padding-right: 10px;padding-top: 2px;padding-bottom: 2px;font-size: 13px;">ผู้เล่นคนที่ <?php echo $i; ?></span>
														<img src="https://minotar.net/armor/bust/<?php echo $player['username']; ?>/190.png" style="display: block;margin-top: 50px;margin-bottom: 50px;margin-left: auto;margin-right: auto;width: 60%;">
														<h5 class="text-center" style="margin-top:20px;margin-bottom:10px;"><?php echo $player['username']; ?></h5>
														<p class="text-center" style="margin-top:0px;margin-bottom:5px;">Point : <?php echo $player['point']; ?></p>
														<p class="text-center" style="margin-top:0px;margin-bottom:20px;">Total : <?php echo $player['donate']; ?></p>
														<button class="btn btn-dark btn-sm btn-block" onclick="edit_player(<?php echo $player['id']; ?>);">แก้ไขข้อมูลผู้เล่น</button>
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
														<h3 class="col text-center">ไม่พบข้อมูลผู้เล่นในระบบ !</h3>
											</div>
										<?php
														}
													}
									?>
										</div>				
                                	</div>
                                </div>
								<div id="result"></div>