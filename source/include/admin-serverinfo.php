<?php
if($_POST['server'] == '')
	die('parameter');
$server = $pdo->prepare("SELECT * FROM server WHERE id = ?");
$server->execute(array($_POST['server']));
$data = $server->fetch(PDO::FETCH_ASSOC);
if($data['id'] == '')
	die("<script>Swal.fire('Server', 'ไม่พบข้อมูลเซิร์ฟเวอร์ในระบบ !', 'error')</script>");
?>
<div class="modal fade" id="editserver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit <?php echo $data['name']; ?> #<?php echo $data['id']; ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="eservername">Server Name</label>
						<input type="text" class="form-control" id="eservername" placeholder="Server Name" required value="<?php echo $data['name']; ?>">
					</div>
					<div class="col-md-4 mb-3">
						<label for="eserverip">Server IP</label>
						<input type="text" class="form-control" id="eserverip" placeholder="Server IP" required value="<?php echo $data['ip']; ?>">
					</div>
					<div class="col-md-4 mb-3">
						<label for="equeryport">Query Port</label>
						<input type="number" class="form-control" id="equeryport" placeholder="Query Port" required min="1024" max="49151" value="<?php echo $data['qport']; ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label for="erconport">Rcon Port</label>
						<input type="number" class="form-control" id="erconport" placeholder="Rcon Port" required min="1024" max="49151" value="<?php echo $data['rport']; ?>">
					</div>
					<div class="col-md-4 mb-3">
						<label for="erconpassword">Rcon Password</label>
						<input type="password" class="form-control" id="erconpassword" placeholder="Rcon Password" required value="<?php echo $data['rpass']; ?>">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" onclick="save_server(<?php echo $data['id']; ?>);" data-dismiss="modal">Save !</button>
			</div>
		</div>
	</div>
</div>