<?php
session_start();
require('tw.class.php');
if (isset($_POST['email']) || isset($_POST['password'])) {
  header('Content-type: application/json');
  $i = [
    "status" => "error",
    "msg" => "เกิดข้อผิดพลาด",
    "page" => false,
  ];
  if (!empty($_POST['email']) || !empty($_POST['password'])) {
      $tw = new TrueWallet($_POST['email'], $_POST['password']);
      $tw->RequestLoginOTP();
      if($tw->http_code == "200") {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $data = $tw->data;
        $i['status'] = true;
        $i['msg'] = "กรุณากรอก OTP เพื่อเข้าสู่ระบบต่อไป <small>({$_POST['email']})</small>";
        $i['page'] =
        '
        <script>
        $("#confirm-form").submit(function(e) {
            e.preventDefault();
            var load = \'<i class="fa fa-spinner fa-spin"></i> กำลังโหลด..\';
            var success = \'<i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ\';
            $("#btn").prop("disabled", true);
            $("#btn").html(load);
            $.ajax({
                type: "POST",
                url: "index.php",
                data: $("#confirm-form").serialize(),
                success: function(data) {
                  $("#btn").prop("disabled", false);
                  $("#btn").html(success);
                    if (data.status == "error") {
                        $("#return").html(\'<div class="alert alert-danger">\'+data.msg+\'</div>\');
                    } else {
                          $("#return").html(\'<div class="alert alert-primary copy">\'+data.msg+\'</div>\');
                          $("#page").html(data.page);
                    }
                }
            }, "json");
        });
        </script>
        <form id="confirm-form" method="post" style="margin-top:10px;">
        <div class="text-left mt-1"><i class="fa fa-angle-right"></i> เราได้ส่ง OTP ไปที่เบอร์ '.$data['mobile_number'].' สำเร็จ</div>
        <div class="text-left mt-1"><i class="fa fa-angle-right"></i> OTP : ('.$data['otp_reference'].')</div>
        <div class="input-group">
        <input name="phone" value="'.$data['mobile_number'].'" hidden>
        <input name="otp_ref" value="'.$data['otp_reference'].'" hidden>
        <input class="form-control" style="height: 40px;margin-top:10px;" name="otp" type="password" placeholder="OTP">
        </div>
        <button class="btn btn-success btn-block text-light" id="btn" type="submit" style="margin-top:20px;"><i class="fas fa-check"></i> ยืนยันตัว</button>
        </form>
        ';

      }else {
        $msg = json_decode($tw->response,true);
        $i['msg'] = $msg['messageTh'];
      }
  }else {
    $i['status'] = "error";
    $i['msg'] = "กรุณาอย่าเว้นช่องวาง.";
  }
  echo json_encode($i);
  exit();
}elseif (isset($_POST['otp']) || isset($_POST['phone']) || isset($_POST['otp_ref'])) {
  header('Content-type: application/json');
  if(!empty($_POST['phone']) || !empty($_POST['otp_ref']) || !empty($_POST['otp'])) {
    if(isset($_SESSION['email']) && isset($_SESSION['password'])) {
      $tw = new TrueWallet($_SESSION['email'], $_SESSION['password']);
      $tw->SubmitLoginOTP($_POST['otp'], $_POST['phone'], $_POST['otp_ref']);
    //   print_r($tw);
      if($tw->http_code == "200") {
        $lol = json_encode($tw);
        $lol = base64_encode($lol);
        $script =
        '
          <script>
            function copy() {
              var copyText = $("#copy");
              copyText.select();
              document.execCommand("copy");
              $(".copy").html("คัดลอกสำเร็จ !!");
            }

          </script>
        ';
        $i['msg'] = "นี้คือข้อมูล ส่วนตัวนะคะ <small class='text-danger'>(ห้ามให้ใครเด็ดขาด นอกจากคนไว้ใจได้)</span> !!";
        $i['page'] = $script.'<button class="btn btn-block btn-dark text-light" onclick="copy();"><i class="fas fa-copy"></i> คัดลอก</button> "<textarea style="width:100%;" class="form-control" id="copy">'.$lol.'</textarea>';
      }else {
        $msg = json_decode($tw->response,true);
        $i['msg'] = $msg['messageTh'];
      }
    }else {
      $i['status'] = "error";
      $i['msg'] = "เกิดข้อผิดพลาด <br>กรุณาลองใหม่นะคะ. {$_SESSION['password']}";
    }
  }else {
    $i['status'] = "error";
    $i['msg'] = "กรุณาอย่าเว้นช่องทาง";
  }
  echo json_encode($i);
  exit();
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Get ref_token Wallet</title>
	<link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
	<script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#login-form').submit(function(e) {
            e.preventDefault();
            var load = '<i class="fa fa-spinner fa-spin"></i> กำลังโหลด..';
            var success = '<i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ';
            $("#btn").prop('disabled', true);
            $("#btn").html(load);
            $.ajax({
                type: "POST",
                url: "index.php",
                data: $("#login-form").serialize(),
                success: function(data) {
                  $("#btn").prop('disabled', false);
                  $("#btn").html(success);
                    if (data.status == "error") {
                        $("#return").html('<div class="alert alert-danger">'+data.msg+'</div>');
                    } else {
                          $("#return").html('<div class="alert alert-primary">'+data.msg+'</div>');
                          $("#page").html(data.page);
                    }
                }
            }, "json");
        });
      });
    </script>
    <body>
      <div style="margin-top:10%" class="container d-flex justify-content-center align-items-center">
            <div class="col-md-5" style="margin-bottom: 50px; ">
              <div class="border">
            <div class="card-header border-secondary" style="background: rgba(243, 243, 243,0.98)!important">
            <h2 style="margin-top:3px;"><i class="fas fa-home"></i>&nbsp;Sign in</h2>
            </div>
            <div class="card card-body">
            <div id="return"></div>
            <div id="page">
              <form id="login-form" method="post" style="margin-top:10px;">
              <div class="text-left mt-1"><i class="fa fa-angle-right"></i> อีเมล / เบอร์</div>
              <div class="input-group" style="margin-bottom: 10px;">
              <input class="form-control" style="height: 40px;" name="email" id="email" type="text" placeholder="Email / Phone" autofocus="">
              </div>
              <div class="text-left mt-1"><i class="fa fa-angle-right"></i> รหัสผ่าน / พิน</div>
              <div class="input-group">
              <input class="form-control" style="height: 40px;" name="password" id="password" type="password" placeholder="Password">
              </div>
              <button class="btn btn-success btn-block text-light" id="btn" type="submit" style="margin-top:20px;"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
              </form>
            </div>
            </div>
            </div>
          </div>
      </div>
    </body>
</html>
