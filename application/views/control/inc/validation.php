  <?php  if(validation_errors()){
        ?>
        <div class="alert notice notice-warning">
		<button href="#" type="button" class="close"> <i data-dismiss="alert" class="fa fa-times"></i> </button>
		<strong> <i class="fa fa-exclamation-triangle"></i> Warning !!  </strong> 
	<?php 
		echo validation_errors();
    ?>
	</div>

        <?php }  ?>




