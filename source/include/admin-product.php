												<?php
													$query = $pdo->prepare("SELECT `id`, `image`, `name`, `price`, `pad`, `ispad` FROM product WHERE server = ?");
													$query->execute(array($_GET['server']));
													$i = 0;
													while($product = $query->fetch(PDO::FETCH_ASSOC))
													{
														$i++;
												?>
												<div class="col-md-4 text-right" style="padding: 10px;">
                                                    <div class="border rounded" style="background-color: <?php if($product['ispad'] == 1) echo 'rgba(0,0,0,0.03)'; else echo 'rgba(0,0,0,0.03)'; ?>;padding: 20px;">
														<span class="text-white" style="background-color: <?php if($product['ispad'] == 1) echo '#FFAA00'; else echo 'rgb(52,58,64)'; ?>;text-shadow: -0.5px 0 black, 0 1px black, 0.5px 0 black, 0 -0.5px black;text-shadow: 2px 2px 2px black;padding-left: 10px;padding-right: 10px;padding-top: 2px;padding-bottom: 2px;font-size: 13px;"><?php if($product['ispad'] == 1) echo $product['pad'].' <s>'.$product['price'].'</s>'; else echo $product['price']; ?> THB</span>
														<img src="<?php echo $product['image']; ?>" style="display: block;margin-top: 50px;margin-bottom: 50px;margin-left: auto;margin-right: auto;width: 60%;">
                                                        <p class="text-center"><?php echo $product['name']; ?></p>
														<button class="btn btn-outline-dark btn-block btn-sm" onclick="edit_product(<?php echo $product['id']; ?>);">แก้ไขข้อมูลสินค้า</button>
														<button class="btn btn-dark btn-block btn-sm" onclick="delete_product(<?php echo $product['id']; ?>, '<?php echo $product['name']; ?>', <?php echo $_GET['server']; ?>);">ลบสินค้า</button>
													</div>
                                                </div>
												<?php
													}
													if($i == 0)
													{
												?>
													<div class="col-md-12" style="margin-top:50px;">
																<img src="../assets/img/error.png" alt="Smiley face" height="auto" width="100" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;">
																<h1 class="col text-center">แย่จังงงง ...</h1>
																<h3 class="col text-center">ไม่พบสินค้าในระบบ !</h3>
													</div>
												<?php
													}
												?>
													<button class="btn btn-dark btn-block" onclick="create_product_ui();" style="margin-top:50px;">เพิ่มสินค้า !</button>