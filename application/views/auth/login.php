<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Login - Sistem Informasi</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets/pages/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
		<link href="<?=base_url('assets/pages/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
		<link href="<?=base_url('assets/pages/css/components-md.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url('assets/pages/css/login-2.css');?>" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
		<link rel="shortcut icon" href="<?=base_url('assets/pages/img/kemensos.ico');?>" />
	</head>
    <!-- END HEAD -->

    <body onload="getLocation()" class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <a href="#">
                <img src="<?=base_url('assets/pages/img/kemensos.png');?>" style="height: 60px;" alt="" /> </a>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?= site_url('login_process'); ?>" method="post">
				<?= $this->session->flashdata('error') ?>
				<p id="getLocation"></p>
                <div class="form-title">
                    <span class="form-title">Selamat Datang.</span>
                    <span class="form-subtitle">Silahkan Masuk.</span>
                </div>
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    <span> Masukkan Username dan Password. </span>

                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Nama Pengguna" name="username" /> </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Kata Sandi" name="password" /> </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-block uppercase">Masuk</button>
                </div>
                <div class="form-actions">
                    <div class="pull-left">
                        <label class="rememberme mt-checkbox mt-checkbox-outline">
                            <input type="checkbox" name="remember" value="1" /> Ingat saya
                            <span></span>
                        </label>
                    </div>
                    <div class="pull-right forget-password-block">
                        <a href="javascript:;" id="forget-password" class="forget-password">Masuk sebagai tamu</a>
                    </div>
                </div>
			</form>
			<script>
				var view = document.getElementById("getLocation");
				function getLocation() {
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(showPosition);
					} else {
						view.innerHTML = "";
					}
				}
				function showPosition(position) {
					view.innerHTML = "<input type='hidden' name='location' value='" + position.coords.latitude + "," + position.coords.longitude +"' />";
				}
			</script>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="<?= base_url(); ?>User/guest" method="post">
                <div class="form-title">
                    <!-- <span class="form-title">Forget Password ?</span> -->
                    <span class="form-subtitle">Silahkan lengkapi formulir dibawah ini.</span>
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Nama Lengkap" name="nama" required/><br>
                    <input class="form-control placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" required/>
                </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Kembali</button>
                    <button type="submit" class="btn btn-primary uppercase pull-right">Masuk</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
        </div>
        <div class="copyright"> 2020 © Kemensos RI. </div>
        <!-- END LOGIN -->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?=base_url('assets/pages/script/jquery.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('assets/pages/script/bootstrap.min.js');?>" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url('assets/pages/script/jquery.validate.min.js');?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?=base_url('assets/pages/script/login.min.js');?>" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
    </body>
</html>