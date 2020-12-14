<div class="content-wrapper">
        
	<div class="row padtop" style="font-family: auto;">
		<div class="col-md-6 col-md-offset-3" style="margin-left: 25%;">
			<?php if($this->session->flashdata('class')):?>
          <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php endif; ?>
      <h3 style="text-align: center;"><strong>Edit Category</strong></h3>
			<?php echo form_open_multipart('Category/updateCategory','',''); ?>
			<input type="hidden" name="CategoryId" value="<?php echo $category[0]['c_id'] ?>">
			<?php echo form_label('Category Name', 'CategoryTitle');?>
				<div class="form-group">
					<?php echo form_input(['name'=>'categoryName','class'=>'form-control','id'=>'CategoryTitle','value'=>$category[0]['c_title']]);?>
				</div>
				<?php echo form_label('Category Description', 'description');?>
				<div class="form-group">
					<?php echo form_textarea(['id'=>'description','cols'=>'74','rows'=>'5','name'=>'description','value'=>$category[0]['c_description']]);?>	
								
				</div>
				
				<div class="form-group">

					<?php echo form_submit('Update category','Update Category','class="btn btn-primary"');?>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>