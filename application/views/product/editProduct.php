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
      <h3 style="text-align: center;"><strong><u>Update <?php echo $product[0]['p_name'];?> Product</u></strong></strong></h3>
			<?php echo form_open('Product/updateProduct'); ?>
			<input type="hidden" name="productId" value="<?php echo $product[0]['p_id'];?>">
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Product Name', 'pname'); ?>
						<?php echo form_input(['name'=>'productName','id'=>'pname','class'=>'form-control','value'=>$product[0]['p_name']]); ?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Product Price', 'price'); ?>
						<?php echo form_input(['name'=>'productPrice','id'=>'price','class'=>'form-control','value'=>$product[0]['p_rate']]); ?>
					</div>
				</div>
			</div>
			
			<div class="container form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Product Quantity', 'qty'); ?>
						<?php echo form_input(['name'=>'productQuantity','id'=>'qty','class'=>'form-control','value'=>$product[0]['p_qty']]); ?>
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
						<?php echo form_textarea(['name'=>'ProductDescription','cols'=>'40','rows'=>'3','id'=>'des','class'=>'form-control','value'=>$product[0]['p_description']]); ?>
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