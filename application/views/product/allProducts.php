
<div class="content-wrapper">
	
	<div class="row padtop" style="font-family: auto">
		<div class="col-md-11 col-md-offset-3" style="margin-left: 4%;">
			 <div>
        <?php if($this->session->flashdata('class')):?>
          <div class="alert <?php echo $this->session->flashdata('class');?> alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          <?php echo $this->session->flashdata('message'); ?>
      </div>
        
        <?php endif; ?>
      </div>
			<h2 style="text-align: center;"><strong>All Products</strong></h2>
			<div class="error">

			</div>
			<div class="row">
				<div class="col-md-6 pbtn">
					<a class="btn btn-warning btn-sm pdfbtn" href="<?php echo site_url('Pdf_AllProduct/pdfdetails'); ?>">PDF</a>
					<a class="btn btn-warning btn-sm excelbtn" href="<?php echo site_url('productExport/createXLS'); ?>">Export Data</a>
				</div>
			</div>
			<?php if($products):?>
				<table class="table table-bordered table-hover table-sm" style="font-size: smaller;">
					
					
				<thead style="background-color: #1f4246;">
					<tr style="color: #ffffff;">
						<th>Sr.No.</th>
						<th>Product Name</th>
						<th>Category Name</th>						
						<th>Product Price</th>
						<th>Product Quantity</th>
						<th>Product Description</th>
						<th>Date Added</th>
						<th>Date Updated</th>
						<th colspan="2" class="text-center">Action</th>

					</tr>
				</thead>
				
				<tbody>
					<?php   
					$count = $this->uri->segment(3);
					?>
					<?php foreach ($products as $product): ?>
					<tr class="ccat<?php echo($product->p_id);?>">
						<td><?php echo ++$count; ?></td>
						<td><?php echo $product->p_name;?></td>
						<td><?php echo $product->c_title;?></td>						
						<td><?php echo $product->p_rate;?></td>
						<td><?php echo $product->p_qty;?></td>
						<td><?php echo $product->p_description;?></td>
						<td><?php echo $product->p_date_added;?></td>
						<td><?php echo $product->p_date_updated;?></td>
						<td>
							<a href="<?php echo site_url('product/editproduct/'.$product->p_id); ?>" class="btn btn-success btn-xs" title="Edit Record"><i class="fa fa-pen"></i></a>
						</td>
						<td>
							<a href="<?php echo site_url('product/deleteProduct/'.$product->p_id); ?>" class="btn btn-danger btn-xs" title="Delete Record"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				</tbody>
				<?php endforeach; ?>
				</table>
				

			<?php echo $link; ?>
			<?php else: ?>
				Customer Not Available
			<?php endif; ?>
		</div>
	</div>
</div>