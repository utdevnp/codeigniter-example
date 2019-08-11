<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- jAngular js -->
<script src="<?php echo base_url('assets/costume/js/angular.min.js');?>"></script>
<script src="<?php echo base_url('assets/costume/js/1.4.0-angular-messages.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/app.min.js');?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/plugins/sparkline/jquery.sparkline.min.js');?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');?>"></script>

<script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js');?>"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
<!-- select2.full.min -->
<script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js');?>"></script>

<script src="<?php echo base_url('assets/dist/js/demo.js');?>"></script>
<?php if($this->uri->segment(2)=='dashboard'){
  include('chart.php');
  } ?>

<script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js');?>"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>

<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>

<!-- bootstrap time picker -->
<script src="<?php echo base_url('assets/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>

<script src="<?php echo base_url('assets/plugins/bootstrap-confirmation/bootstrap-confirmation.js');?>"></script>
 <script  src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.min.js"></script>
<script src="<?php echo base_url('assets/plugins/formvalidation/formvalidation.js');?>"></script>
<script src="<?php echo base_url('assets/costume/js/script.js');?>"></script>


</body>

<script>
  jQuery(function() {
//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
  });
</script>

<script >
 //Initialize Select2 Elements
    $(".select2").select2({
        placeholder: "Select an option",
        allowClear: true,
        minimumResultsForSearch: 20
    });

    //Money Euro
    $("[data-mask]").inputmask();
    
	 //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });
     $('.datepickerdest').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
    });

      //Timepicker
    $(".timepicker").timepicker({
      showInputs: true
    });
    $(".timepicker1").timepicker({
      showInputs: true
    });
    // confermation
    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        btnOkClass : 'btn-xs btn-success',
        btnCancelClass : 'btn-xs btn-danger',
  // other options
});

    $('[data-toggle="popover"]').popover();


</script>




</html>