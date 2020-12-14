
<div class="content-wrapper">
	
	<div class="row padtop">
		<div class="col-md-10 col-md-offset-3" style="margin-left: 7%;">
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
			<h2 style="text-align: center;font-family: auto"><strong>All Categories</strong></h2>
			<div class="error">
				
			</div>
			<?php if($categories):?>
				<table class="table table-bordered table-hover table-sm">
				<thead style="background-color: #1f4246;font-family: auto;">
					<tr style="color: #ffffff;">
						<th>Sr.No.</th>
						<th>Category Name</th>
						<th>Category Descriptions</th>
						<th colspan="2" class="text-center">Action</th>

					</tr>
				</thead>
				<?php foreach ($categories as $category): ?>
				<tbody style="font-family: auto;">
					<tr class="ccat<?php echo($category->c_id);?>">
						<td><?php echo $category->c_id;?></td>
						<td><?php echo $category->c_title;?></td>
						<td><?php echo $category->c_description;?></td>
						<td>
							<a href="<?php echo site_url('Category/editCategory/'.$category->c_id); ?>" class="btn btn-success btn-xs" title="Edit Record"><i class="fa fa-pen"></i></a>
						</td>
						<td>
							<a href="<?php echo site_url('Category/deleteCategory/'.$category->c_id); ?>" class="btn btn-danger btn-xs" title="Delete Record"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				</tbody>
				<?php endforeach; ?>
				</table>
			<?php echo $link; ?>
			<?php else: ?>
				Category Not Available
			<?php endif; ?>
		</div>
	</div>
</div>