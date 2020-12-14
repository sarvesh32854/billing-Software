<div class="content-wrapper">
        
	<div class="row padtop" style="font-family: auto;">
		<div class="col-md-6" style="margin-left: 20%;">
			<?php if($this->session->flashdata('class')):?>
          <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <?php echo $this->session->flashdata('message'); ?>
      </div>
      <?php endif; ?>
      <h3 style="text-align: center;"><strong><u>Add New Product</u></strong></strong></h3>
			<?php echo form_open('Product/AddProduct'); ?>
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Product Name', 'pname'); ?>
						<?php echo form_input(['name'=>'productName','id'=>'pname','class'=>'form-control']); ?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Product Price', 'price'); ?>
						<?php echo form_input(['name'=>'productPrice','id'=>'price','class'=>'form-control']); ?>
					</div>
				</div>
			</div>
			
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Product Quantity', 'qty'); ?>
						<?php echo form_input(['name'=>'productQuantity','id'=>'qty','class'=>'form-control']); ?>
					</div>
					<?php 
						$categoriesOptions = array();
						foreach($categories->result() as $category)
						{
							$categoriesOptions[$category->c_id] = $category->c_title;
						}
					?>
					<div class="col-md-6">
						<?php echo form_label('Product Category', 'category'); ?>
						<?php echo form_dropdown(['name'=>'category','id'=>'category','class'=>'form-control'],$categoriesOptions); ?>
					</div>
				</div>
			</div>
			
			
			<div class="container form-group">
				<div class="row">
					<div class="col-md-12 ">
						<?php echo form_label('Product Description', 'des'); ?>
						<?php echo form_textarea(['name'=>'ProductDescription','cols'=>'40','rows'=>'3','id'=>'des','class'=>'form-control']); ?>
					</div>
				</div>
			</div>
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_submit('Submit', 'Submit',['class'=>'form-control btn btn-success']);?>
					</div>
					<div class="col-md-6">
						<?php echo form_reset('Reset', 'Reset',['class'=>'form-control btn btn-danger']);?>
					</div>
				</div>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>