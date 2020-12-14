
<div class="content-wrapper">
	
	<div class="row padtop" style="font-family: auto">
		<div class="col-md-10 col-md-offset-3" style="margin-left: 8%;">
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
			<h2 style="text-align: center;"><strong>All Customers</strong></h2>
			<div class="error">
				
			</div>
			<?php if($customers):?>
				<table class="table table-bordered table-hover table-sm">
				<thead style="background-color: #1f4246;">
					<tr style="color: #ffffff;">
						<th>Sr.No.</th>
						<th>Fisrt Name</th>
						<th>Last Name</th>
						<th>Contact</th>
						<th>Email</th>
						<th>Address</th>
						<th colspan="2" class="text-center">Action</th>

					</tr>
				</thead>
				
				<tbody>
					<?php   
					$count = $this->uri->segment(3);
					?>
					<?php foreach ($customers as $customer): ?>
					<tr class="ccat<?php echo($customer->cus_id);?>">
						<td><?php echo ++$count; ?></td>
						<td><?php echo $customer->cus_firstName;?></td>
						<td><?php echo $customer->cus_laststName;?></td>
						<td><?php echo $customer->cus_mobile;?></td>
						<td><?php echo $customer->cus_email;?></td>
						<td><?php echo $customer->cus_address;?></td>
						<td>
							<a href="<?php echo site_url('Customer/editCustomer/'.$customer->cus_id); ?>" class="btn btn-success btn-xs" title="Delete Record"><i class="fa fa-pen"></i></a>
						</td>
						<td>
							<a href="<?php echo site_url('Customer/deleteCustomer/'.$customer->cus_id); ?>" class="btn btn-danger btn-xs" title="Delete Record"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				</tbody>
				<?php endforeach; ?>
				</table>
				<!-- <ul class="pagination">
					<li><a href=""><</a></li>
					<li><a href="">1</a></li>
					<li><a href="">2</a></li>
					<li><a href="">3</a></li>
					<li class="active"><a href="">4</a></li>
					<li><a href="">5</a></li>
					<li><a href="">></a></li>
				</ul> -->



			<?php echo $link; ?>
			<?php else: ?>
				Customer Not Available
			<?php endif; ?>
		</div>
	</div>
</div>