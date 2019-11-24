<?php
error_reporting(0);
session_start();
include '../../api/KiznickAPI.php';
$KiznickAPI = new KiznickAPI();
if(!$KiznickAPI->CheckAdmin())
	die('login');
if($_POST['id'] == '')
	die("<script>Swal.fire('Player', 'กรุณาใส่ข้อมูลให้ครบถ้วน !', 'error')</script>");
include '../../config.php';
$server = $pdo->prepare("SELECT `id`, `username`, `point`, `isadmin` FROM `authme` WHERE id = ?");
$server->execute(array($_POST['id']));
$data = $server->fetch(PDO::FETCH_ASSOC);
if($data['id'] == '')
	die("<script>Swal.fire('Player', 'ไม่พบข้อมูลผู้เล่นในระบบ !', 'error')</script>");
?>
<script>swal.close();</script>
<div class="modal fade" id="editplayer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit <?php
error_reporting(0); echo $data['username']; ?> #<?php
error_reporting(0); echo $data['id']; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="eservername">Username</label>
						<input type="text" class="form-control" id="eusername"  placeholder="Username" required value="<?php
error_reporting(0); echo $data['username']; ?>">
					</div>
					<div class="col-md-12 mb-3">
						<label for="eserverip">Point</label>
						<input type="number" class="form-control" id="epoint" placeholder="Point" value="<?php
error_reporting(0); echo $data['point']; ?>">
					</div>
					<div class="col-md-12 mb-3">
						<label for="eserverip">Player Role</label>
						<div class="input-group">
							<select class="custom-select" id="isadmin">
								<option value="0">User</option>
								<option value="1"<?php
error_reporting(0); if($data['isadmin'] == 1) echo selected; ?>>Admin</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" onclick="save_player(<?php
error_reporting(0); echo $data['id']; ?>);" data-dismiss="modal">Save !</button>
			</div>
		</div>
	</div>
</div>