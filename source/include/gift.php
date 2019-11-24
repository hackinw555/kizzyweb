								<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
                                    <div class="card-header">
                                        <h4 class="card-header-title">
											<span><i class="fas fa-history"></i>&nbsp;</span>รับของขวัญ<br>
										</h4>
                                    </div>
                                    <div class="card-body">
                                        	<h1 class="text-center" style="margin-top: 80px;"><b>Gift</b></h1>
											<h5 class="text-center" style="margin-bottom: 80px;">รับของขวัญ</h5>
<?php
	$query = $pdo->prepare("SELECT * FROM gift WHERE reciver = ? ORDER BY `gift`.`id` ASC");
	$query->execute(array($_SESSION['id']));
	if($query->rowCount() == 0)
	{
?>
												<div class="col-md-12" style="margin-top:50px;margin-bottom:50px;">
													<img src="../assets/img/error.png" alt="Smiley face" height="auto" width="100" style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;">
													<h1 class="col text-center">แย่จังงงง ...</h1>
													<h3 class="col text-center">คุณไม่มีของขวัญที่ถูกส่งเข้ามาเลย !</h3>
													<p class="col text-center" style="font-size: 5px;"> เพื่อนไม่คบแล้วหรอ ?</p>
												</div>
<?php
	}
	else
	{
?>
										<div class="col" style="margin-top: 10px;">
											<div class="row" id="shop">
<?php
		$expire = array();
		while($gift = $query->fetch(PDO::FETCH_ASSOC))
		{
			if($gift['expire'] > time())
				array_push($expire, $gift['expire']);
?>
												<div class="col-md-4 text-right" style="padding: 10px;">
                                                    <div class="border rounded" style="background-color: rgba(0,0,0,0.03); padding: 20px;">
														<span class="text-white" id="Expire-<?php echo $gift['expire']; ?>" style="background-color: rgb(52,58,64); text-shadow: -0.5px 0 black, 0 1px black, 0.5px 0 black, 0 -0.5px black;text-shadow: 2px 2px 2px black;padding-left: 10px;padding-right: 10px;padding-top: 2px;padding-bottom: 2px;font-size: 13px;"><?php if($gift['expire'] > time()) echo 'Loading...'; else echo 'ของขวัญหมดอายุ !';?></span>
														<img src="<?php echo $gift['image']; ?>" style="display: block;margin-top: 50px;margin-bottom: 50px;margin-left: auto;margin-right: auto;width: 60%;">
                                                        <p class="text-center"><?php echo $gift['name']; ?></p>
														<?php if($gift['expire'] > time()) echo '<button id="Get-'.$gift['id'].'" class="btn btn-dark btn-block" style="margin-bottom: 10px;" onclick="gift_get('.$gift['id'].');">รับของขวัญ</button>'; ?>
														<button class="btn btn-danger btn-block" style="margin-bottom: 10px;" onclick="gift_delete(<?php echo $gift['id']; ?>);">ลบของขวัญ</button>
													</div>
												</div>
<?php
		}
?>
											</div>
										</div>
	<script>
		function NumberFormat(i) {
		  if (i < 10) {i = "0" + i}; 
		  return i;
		}
	</script>
<?php
		foreach($expire as $value) {
?>
	<script id="Script-<?php echo $value; ?>">
		var countDownDate<?php echo $value; ?> = new Date("<?php echo date("M j, Y H:i:s", $value); ?>").getTime();
		var x<?php echo $value; ?> = setInterval(function() {
		  var now<?php echo $value; ?> = new Date().getTime();
		  var distance<?php echo $value; ?> = countDownDate<?php echo $value; ?> - now<?php echo $value; ?>;
		  var days<?php echo $value; ?> = Math.floor(distance<?php echo $value; ?> / (1000 * 60 * 60 * 24));
		  var hours<?php echo $value; ?> = Math.floor((distance<?php echo $value; ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes<?php echo $value; ?> = Math.floor((distance<?php echo $value; ?> % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds<?php echo $value; ?> = Math.floor((distance<?php echo $value; ?> % (1000 * 60)) / 1000);
		  document.getElementById("Expire-<?php echo $value; ?>").innerHTML = NumberFormat(days<?php echo $value; ?>) + " Days, " + NumberFormat(hours<?php echo $value; ?>) + ":" + NumberFormat(minutes<?php echo $value; ?>) + ":" + NumberFormat(seconds<?php echo $value; ?>);
		  if (distance<?php echo $value; ?> < 0) {
			document.getElementById("Expire-<?php echo $value; ?>").innerHTML = "ของขวัญหมดอายุ !";
			document.getElementById('Script-<?php echo $value; ?>').remove();
			document.getElementById('Get-<?php echo $value; ?>').remove();
			clearInterval(x<?php echo $value; ?>);
		  }
		}, 1000);
	</script>
<?php
		}
	}
?>
                                    </div>
                                </div>