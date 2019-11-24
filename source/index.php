<?php
	include 'core.php';
	$config = [
		'title' => config($pdo, 'title'),
		'logo' => config($pdo, 'logo'),
		'background' => config($pdo, 'background'),
		'version' => config($pdo, 'version'),
		'ip' => config($pdo, 'ip')
	];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $config['title']; ?></title>
	<link rel="icon" href="<?php echo $config['logo']; ?>" type="image/icon type" />
    <meta name="twitter:title" content="DriteShop : Home">
    <meta property="og:image" content="assets/img/58625970_815194658863233_7215058884161961984_o.jpg">
    <meta name="description" content="ระบบเว็บซื้อขายของสินค้า By DriteStudio">
    <meta name="twitter:image" content="assets/img/58625970_815194658863233_7215058884161961984_o.jpg">
    <meta name="twitter:description" content="Welcome to my world !">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
</head>
<body style="font-family: Kanit, sans-serif;background-image: url(&quot;<?php echo $config['background']; ?>&quot;);background-size: cover;">
    <div class="container">
        <div class="row" style="margin-top: 50px;margin-bottom: 50px;">
            <div class="col text-center"><img class="img-fluid" src="<?php echo $config['logo']; ?>" width="300px" style="margin-top: 50px;margin-bottom: 50px;"></div>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-bottom: 250px;">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-header-title"><span><i class="fas fa-home"></i>&nbsp;</span>หน้าหลัก</h4>
                    </div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<?php
										$status = json_decode(file_get_contents('https://api.mcsrvstat.us/2/'.$config['ip']));
										if($status->online)
										{
									?>
									<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
										<div class="card-header">
											<h4 class="card-header-title"><span><i class="fas fa-list-alt"></i>&nbsp;</span>สถานะ Server</h4>
										</div>
										<div class="card-body" >
											<h4>สถานะ : <span style="color:green;">ออนไลน์</span></h4>
											<h5>จำนวนผู้เล่น <?php echo $status->players->online.'/'.$status->players->max; ?> คน</h5>
										</div>
									</div>
									<?php
										}
									?>
									<div class="card" style="margin-top: 10px;margin-bottom: 10px;">
										<div class="card-header">
											<h4 class="card-header-title"><span><i class="fas fa-list-alt"></i>&nbsp;</span>เมนู</h4>
										</div>
										<div class="card-body text-center" id="login">
											<?php include './include/login.php'; ?>
										</div>
									</div>
								</div>
								<div class="col-md-9" id="app">
									<?php include './include/home.php';?>
							  </div>
							</div>
						</div>
					<div class="card-footer text-muted text-center">Design By <a href="https://www.facebook.com/dritestudio/">DriteStudio</a> System By <a href="https://kiznick.in.th/">Yoswaris Lawpaiboon</a> <b>Webshop Version <u><?php echo $config['version']; ?></u></b></div>
                </div>
            </div>
        </div>
    </div>
	<button onclick="topFunction()" id="topButton" class="topButton" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/script.min.js"></script>
    <script src="assets/js/app.js"></script>
	<script src="assets/js/admin.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<?php
		$query = $pdo->prepare("SELECT * FROM news ORDER BY `news`.`id` ASC");
		$query->execute();
		while($news = $query->fetch(PDO::FETCH_ASSOC))
			echo '<script>toastr["info"]("'.$news['text'].'", "'.date('d/m/Y H:i:s', $news['time']).'")</script>';
	?>
</body>
</html>