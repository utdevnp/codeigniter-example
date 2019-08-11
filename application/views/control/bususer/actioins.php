<!-- update modal -->	
<div id="updateModal<?php echo $login['id'];?>" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	<form method="post" action="<?php echo ADMIN_BASE."bususer/usercrud";?>">
	<input type="hidden" name="id" value="<?php echo $login['id'];?>"/>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="font-size:27px;">&times;</span></button>
        <h4 class="modal-title">Update <?php echo $login['fname']." ".$login['lname'];?> [<?php echo $login['email'];?>] &nbsp; &nbsp;  <span class="label label-<?php if($login['verif']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($login['verif']=="Y"){echo "Verified";}else{echo "Unverified";};?></span>
			</h4>
      </div>
      <div class="modal-body" style="overflow:hidden;">
		<?php
			$where = array('id'=>$login['id']);
			$userdtl = $this->dynamic_query->getbywhere('bus_user',$where);
			foreach($userdtl as $dtl){
		?>
	  <div class="clearfix"></div>
        <div class="col-md-3">
			<img src="<?php echo NO_PHOTO_USER_IMAGE_DIR;?>" class="img-responsive" style="height:143px;"/>
		</div>
		<div class="col-md-9">
			<div class="form-group col-md-6">
				<label for="companyname">First Name</label>
				<input type="text" name="fname" value="<?php echo $dtl['fname'];?>" class="form-control" placeholder="First Name">
			</div>
			<div class="form-group col-md-6">
				<label for="companyname">Last Name</label>
				<input type="text" name="lname"  value="<?php echo $dtl['lname'];?>"class="form-control" placeholder="Last Name">
			</div>
			<div class="form-group col-md-6">
				<label for="companyname">Email <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="When you change this user email address the user username  also change. "> <i class="fa fa-info-circle"></i> </a></label>
				<input type="text" name="email" value="<?php echo $dtl['email'];?>" class="form-control" placeholder="Email">
			</div>
			<div class="form-group col-md-6">
				<label for="companyname">Mobile</label>
				<input type="text" name="mobile_no" value="<?php echo $dtl['mobile_no'];?>" class="form-control" placeholder="Mobile No">
			</div>
		</div>
			<?php } ?>
		<div class="clearfix"></div>
		<div class="form-group col-md-6">
			<label for="companyname">Address</label>
			<input type="text" name="address" value="<?php echo $dtl['address'];?>" class="form-control" placeholder="Address">
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" name="updateuser" value="update" class="btn btn-success btn-flat">Save & update </button>
      </div>
	  </form>
    </div>

  </div>
</div>


<!-- view detail modal -->

<div id="viewModal<?php echo $login['id'];?>" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
	
	<input type="hidden" name="id" value="<?php echo $login['id'];?>"/>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="font-size:27px;">&times;</span></button>
        <h4 class="modal-title">View  <?php echo $login['fname']." ".$login['lname'];?> [<?php echo $login['email'];?>] &nbsp; &nbsp;  <span class="label label-<?php if($login['verif']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($login['verif']=="Y"){echo "Verified";}else{echo "Unverified";};?></span>
			</h4>
      </div>
      <div class="modal-body" style="overflow:hidden;">
		<?php
			$where = array('id'=>$login['id']);
			$userdtl = $this->dynamic_query->getbywhere('bus_user',$where);
			foreach($userdtl as $dtl){
		?>
	  <div class="clearfix"></div>
        <div class="col-md-3">
			<img src="<?php echo NO_PHOTO_USER_IMAGE_DIR;?>" class="img-responsive" style="height:143px;"/>
		</div>
		<div class="col-md-9">
			<div class="form-group col-md-6">
				<label for="companyname">First Name</label>
				<p><?php  if(empty($dtl['fname'])){echo "N/A";}else{echo $dtl['fname'];}?></p>
			</div>
			<div class="form-group col-md-6">
				<label for="companyname">Last Name</label>
				<p><?php  if(empty($dtl['lname'])){echo "N/A";}else{echo $dtl['lname'];}?></p>
			</div>
			<div class="form-group col-md-6">
				<label for="companyname">Email <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="When you change this user email address the user username  also change. "> <i class="fa fa-info-circle"></i> </a></label>
				<p><?php echo $dtl['email'];?></p>
			</div>
			<div class="form-group col-md-6">
				<label for="companyname">Mobile</label>
				<p><?php echo $dtl['mobile_no'];?></p>
			</div>
		</div>
			<?php } ?>
		<div class="clearfix"></div>
		<div class="form-group col-md-6">
			<label for="companyname">Address</label>
			<p><?php  if(empty($dtl['address'])){echo "N/A";}else{echo $dtl['address'];}?></p>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
        
      </div>
    </div>

  </div>
</div>



<!-- password change modal -->

<div id="pwchangeModal<?php echo $login['id'];?>" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="font-size:27px;">&times;</span></button>
        <h4 class="modal-title">Change password for <span><?php echo $login['email'];?></span> &nbsp; &nbsp;  <span class="label label-<?php if($login['verif']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($login['verif']=="Y"){echo "Verified";}else{echo "Unverified";};?></span>
			</h4>
      </div>
	  <form method="post" action="<?php echo ADMIN_BASE."bususer/changepassword";?>">
		  <input type="hidden" name="id" value="<?php echo $login['id'];?>"/>
		  <div class="modal-body" style="overflow:hidden;">		
				<div class="col-md-12">
					<div class="form-group col-md-4">
					  <label for="company">Old Password <span class="stricts"> * </span></label>
					  <input type="password"  class="form-control" name="oldpassword" id="fname" placeholder="Old Password">
					</div>
					<div class="form-group col-md-4">
					  <label for="companyname">New Password <span class="stricts"> * </span></label>
					  <input type="password"  class="form-control" id="password" name="password" placeholder="New Password">
					</div>
					 <div class="form-group col-md-4">
					  <label for="companyname">Re enter New Password <span class="stricts"> * </span></label>
					  <input type="password" class="form-control" id="username"  name="repassword" placeholder="Re enter New Password">
					</div>
				  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
			<button type="submit" name="changepass" value="changepass" class="btn btn-primary btn-flat">Change Password</button>
		  </div>
	   </form>
    </div>

  </div>
</div>


<!-- user delete modal -->

<div id="deleteModal<?php echo $login['id'];?>" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header modal-header-danger">
        <button type="button" class="close" data-dismiss="modal"><span style="font-size:27px;">&times;</span></button>
        <h4 class="modal-title">Delete  [<span><?php echo $login['email'];?></span>] &nbsp; &nbsp;  <span class="label label-<?php if($login['verif']=="Y"){echo "success";}else{echo "danger";};?>"><?php if($login['verif']=="Y"){echo "Verified";}else{echo "Unverified";};?></span>
			</h4>
      </div>
	  <form method="post" action="<?php echo ADMIN_BASE."bususer/trash";?>">
		  <input type="hidden" name="id" value="<?php echo $login['id'];?>"/>
		  <div class="modal-body" style="overflow:hidden;">		
				<div class="col-md-12">
						<h3>Are you want to delete <span class="success"><?php echo $login['email'];?></span> ? </h3>
				</div>
		  </div>
		  <div class="modal-footer">		
			<button type="submit" name="deleteuser" value="deleteuser" class="btn btn-success btn-flat">Yes I Want</button>
				<button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">No</button>
		  </div>
	   </form>
    </div>

  </div>
</div>







