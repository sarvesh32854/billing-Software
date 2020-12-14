<div class="content-wrapper">
        
	<div class="row padtop" style="font-family: auto;">
		<div class="col-md-6" style="margin-left: 25%;">
			<?php if($this->session->flashdata('class')):?>
          <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php endif; ?>
      <h3 style="text-align: center;"><strong>Update <?php echo $customer[0]['cus_firstName']; ?> Customer</strong></h3>
			<?php echo form_open('Customer/updateCustomer'); ?>
			<input type="hidden" name="CustomerId" value="<?php echo $customer[0]['cus_id'] ?>">
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6 ">
						<?php echo form_label('First Name', 'fname'); ?>
						<?php echo form_input(['name'=>'firstName','id'=>'fname','value'=>$customer[0]['cus_firstName'],'class'=>'form-control']); ?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Last Name', 'lname'); ?>
						<?php echo form_input(['name'=>'lastName','id'=>'lname','value'=>$customer[0]['cus_laststName'],'class'=>'form-control']); ?>
					</div>
				</div>
			</div>
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6 ">
						<?php echo form_label('Contact No.', 'mob'); ?>
						<?php echo form_input(['name'=>'mobile','id'=>'mob','value'=>$customer[0]['cus_mobile'],'class'=>'form-control']); ?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Email', 'email'); ?>
						<?php echo form_input(['name'=>'email','id'=>'email','value'=>$customer[0]['cus_email'],'class'=>'form-control']); ?>
					</div>
				</div>
			</div>
			<div class="container form-group">
				<div class="row">
					<div class="col-md-12 ">
						<?php echo form_label('Address.', 'add'); ?>
						<?php echo form_input(['name'=>'address','id'=>'add','value'=>$customer[0]['cus_address'],'class'=>'form-control']); ?>
					</div>
				</div>
			</div>
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6" style="margin-left: 50%;">
						<?php echo form_submit('Submit', 'Update',['class'=>'form-control btn btn-success']);?>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>