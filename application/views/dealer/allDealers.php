
<div class="content-wrapper">
	
	<div class="row padtop" style="font-family: auto;">
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
			<h2 style="text-align: center;"><strong>All Dealers</strong></h2>
			<div class="error">
				
			</div>
			<?php if($dealers):?>
				<table class="table table-bordered table-hover table-sm">
				<thead style="background-color: #1f4246;text-align: center; color: #ffffff;">
					<tr>
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
					<?php foreach ($dealers as $dealer): ?>
					<tr class="ccat<?php echo($dealer->id);?>">
						<td><?php echo ++$count; ?></td>
						<td><?php echo $dealer->first_name;?></td>
						<td><?php echo $dealer->last_name;?></td>
						<td><?php echo $dealer->contact;?></td>
						<td><?php echo $dealer->email;?></td>
						<td><?php echo $dealer->address;?></td>
						<td>
							<a href="<?php echo site_url('Dealer/editDealer/'.$dealer->id); ?>" class="btn btn-success btn-xs" title="Edit Record"><i class="fa fa-pen"></i></a>
						</td>
						<td>
							<a href="<?php echo site_url('Dealer/deleteDealer/'.$dealer->id); ?>" class="btn btn-danger btn-xs" title="Delete Record"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				</tbody>
				<?php endforeach; ?>
				</table>

			<?php echo $link; ?>
			<?php else: ?>
				Dealer Not Available
			<?php endif; ?>
		</div>
	</div>
</div>