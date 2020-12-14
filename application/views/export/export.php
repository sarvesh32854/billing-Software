<!DOCTYPE html>
<html lang="en">  
<head>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<title>How to export data in Codeigniter using PHPExcel Library</title>
<body>
 
<div class="table-responsive">
    <h1><?php echo $title; ?></h1>
    <table class="table table-hover tablesorter">
        <thead>
            <tr>
                <th class="header">Sr. No.</th>
                <th class="header">Model No.</th>
                <th class="header">Mobile Name</th> 
                <th class="header">Price</th>
                <th class="header">Company</th>                      
                <th class="header">Category</th>
            </tr>
        </thead>
        <a class="pull-right btn btn-warning btn-large" style="margin-right:40px" href="<?php echo site_url('Export/createXLS'); ?>">Export Data</a>
        <tbody>

            <?php
            if (isset($excelData) && !empty($excelData)) 
            {
                $serial =0;
                foreach ($excelData as $key => $val) 
                {
                    $serial++;
                    ?>

                    <tr>
                        <td><?php echo $serial; ?></td>
                        <td><?php echo $val->model_no; ?></td>   
                        <td><?php echo $val->mobile_name; ?></td> 
                        <td><?php echo $val->price; ?></td>
                        <td><?php echo $val->company; ?></td>                       
                        <td><?php echo $val->mobile_category; ?></td>
                    </tr>
                    <?php
                }
            } 
            else 
            {
                ?>
                <tr>
                    <td colspan="5" class="alert alert-danger">No Records founds</td>    
                </tr>
            <?php 
            } 
            ?>
 
        </tbody>
    </table>
    
</div> 
</body>
</html>
