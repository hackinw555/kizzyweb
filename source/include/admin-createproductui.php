										<div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="servername">Image</label>
											  <input class="form-control" type="url" value="<?php echo $product['image']; ?>" placeholder="Image Url" id="image">
											</div>
											<div class="col-md-12 mb-3">
											  <label for="serverip">Name</label>
											  <input class="form-control" type="text" value="<?php echo $product['name']; ?>" placeholder="Name" id="name">
											</div>
											<div class="col-md-12 mb-3">
											  <label for="queryport">Command *** คำแนะนำ ใส่ &lt;player&gt; หากต้องการชื่อ Player *** </label>
											  <input class="form-control" type="text" value="<?php echo $product['command']; ?>" placeholder="Command" id="command">
											</div>
											<div class="col-md-12 mb-3">
											  <label for="websenderport">Price</label>
											  <input class="form-control" type="number" value="<?php echo $product['price']; ?>" placeholder="Price" id="price">
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
											<div class="col-md-12 mb-3">
											  <label for="websenderpassword">Discount Product</label>
											 			 <div class="input-group mb-3">
															  <div class="input-group-prepend">
																<div class="input-group-text">
																	<div class="custom-control custom-switch">
																	  <input type="checkbox" class="custom-control-input" id="ispad" <?php if($product['ispad'] == 1) echo checked; ?>>
																	  <label class="custom-control-label" for="ispad"></label>
																	</div>
																</div>
															  </div>
															  <input type="number" class="form-control" value="<?php echo $product['pad']; ?>" placeholder="Price after discount" id="pad">
														</div>
											</div>
										  </div>
										<button class="btn btn-dark btn-block" onclick="create_product();" style="margin-top: 10px;">บันทึกข้อมูล !</button>