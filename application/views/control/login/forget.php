<?php $this->load->view('inc/headerfiles');?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Bus</b>TICKETING <b>System</b></a>
  </div>
  <!-- /.login-logo -->
    <?php $this->load->view('control/inc/message');?>
      <?php $this->load->view('control/inc/validation');?>
  <div class="login-box-body">
    <p class="login-box-msg">Enter your valid email address </p>
     <!-- Error message and validation message -->
    <form method="POST" action="<?php echo base_url('control/login/forget');?>">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
         <a href="<?php echo base_url('control/login');?>">Go to login </a><br>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="forgot" value="forgot" class="btn btn-primary btn-sm btn-block btn-flat">Get</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <!-- /.social-auth-links -->

   

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>


</body>
<?php $this->load->view('inc/footer');?>