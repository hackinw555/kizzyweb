<?php
$query = $pdo->prepare("SELECT * FROM checkin WHERE id = ?");
$query->execute(array($_GET['id']));
$checkin = $query->fetch(PDO::FETCH_ASSOC);
?>
										<div class="form-row">
											<div class="col-md-12 mb-3">
											  <label for="servername">Image</label>
											  <input class="form-control" type="url" value="<?php echo $checkin['image']; ?>" placeholder="Image Url" id="image">
											</div>
											<div class="col-md-12 mb-3">
											  <label for="serverip">Name</label>
											  <input class="form-control" type="text" value="<?php echo $checkin['name']; ?>" placeholder="Name" id="name">
											</div>
											<div class="col-md-12 mb-3">
											  <label for="queryport">Command *** คำแนะนำ ใส่ &lt;player&gt; หากต้องการชื่อ Player *** </label>
											  <input class="form-control" type="text" value="<?php echo $checkin['command']; ?>" placeholder="Command" id="command">
											</div>
											<div class="col-md-12 mb-3">
											  <label for="websenderport">จำนวนวันที่ใช้ในการแลก</label>
											  <input class="form-control" type="number" value="<?php echo $checkin['price']; ?>" placeholder="Price" id="price">
											</div>
										  </div>
										<button class="btn btn-dark btn-block" onclick="save_checkin(<?php echo $_GET['id']; ?>);" style="margin-top: 10px;">บันทึกข้อมูล !</button>