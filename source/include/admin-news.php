								<div class="card" style="margin-top: 10px; margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title"><span><i class="far fa-newspaper"></i>&nbsp;</span>News</h4>
                                    </div>
                                    <div class="card-body">
										<h1 class="text-center" style="margin-top: 80px;"><b>News</b></h1>
										<h5 class="text-center" style="margin-bottom: 80px;">ประกาศข่าวสาร</h5>
										<div class="input-group" style="margin-top: 10px;">
											<div class="form-row">
												<div class="col-md-12 mb-3">
												  <label for="news">ข้อความประกาศ</label>
												  <input class="form-control" type="text" placeholder="News..." id="news">
												</div>
											</div>
											<button class="btn btn-dark btn-block" onclick="create_news();" style="margin-top: 10px;">บันทึกข้อมูล !</button>
										</div>
										<?php
											$query = $pdo->prepare("SELECT * FROM news");
											$query->execute();
											if($query->rowCount() != 0)
											{
										?>
										<div class="table-responsive" style="margin-top: 10px;">
											<div class="table-borderless">
												<table class="table table-striped table-bordered">
													<thead>
														<tr>
															<th>ข้อความ</th>
															<th>เวลา</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$query = $pdo->prepare("SELECT * FROM news");
														$query->execute();
														while($news = $query->fetch(PDO::FETCH_ASSOC))
														{
													?>
														<tr>
															<td><?php echo $news['text']; ?></td>
															<td><?php echo date('d/m/Y H:i:s', $news['time']); ?></td>
															<td><button class="btn btn-danger" onclick="delete_news(<?php echo $news['id'];?>);">Delete !</button></td>
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