<div class="content-wrapper">   
	<div class="row padtop">
		<div class="col-md-6 col-md-offset-3">
			<?php if($this->session->flashdata('class')):?>
          <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php endif; ?>
      <h3 style="text-align: center;"><strong style="font-family: auto;">Add New Category</strong></h3>
			<?php echo form_open_multipart('Category/AddCategory','',''); ?>
			<?php echo form_label('Category Name', 'CategoryTitle',['style'=>'font-family: auto']);?>
				<div class="form-group">
					<?php echo form_input(['name'=>'categoryName','class'=>'form-control','id'=>'CategoryTitle']);?>
				</div>
				<?php echo form_label('Category Description', 'description',['style'=>'font-family: auto']);?>
				<div class="form-group">
					<?php echo form_textarea(['id'=>'description','cols'=>'73','rows'=>'5','name'=>'description']);?>	
								
				</div>
				<!-- <div class="form-group">
					<?php echo form_upload('catDp','',''); ?>
				</div> -->
				<div class="form-group">

					<?php echo form_submit('Add category','Add category','class="btn btn-primary"',['style'=>'font-family: auto']);?>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>