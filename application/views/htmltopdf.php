<!DOCTYPE html>
<html>
<head>
	<title>Generate PDF</title>
	<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<h3>Convert Html to Pdf in codeigniter using Dompdf library.</h3>

<?php
if(isset($employees_data))
{
	?>
	<table>
		<tr>
			<th>Employee Id</th>
			<th>Name</th>
			<th>Skills</th>
			<th>Address</th>
			<th>Designation</th>
			<th>Age</th>
			<th colspan="2">Pdf</th>

		</tr>

	<?php
	foreach ($employees_data->result() as $row) 
	{
		$details = base_url('index.php/htmltopdf/details/').$row->id;
		$pdfdetails = base_url('index.php/htmltopdf/pdfdetails/').$row->id;
		
		echo "<tr>
				<td>$row->id</td>
				<td>$row->name</td>
				<td>$row->skills</td>
				<td>$row->address</td>
				<td>$row->designation</td>
				<td>$row->age</td>
				<td><a href='$details'>View</a></td>
				<td><a href='$pdfdetails'>View in PDF</a></td>
			 </tr>";
	}
	?>
</table>
	<?php
}

if(isset($employee_details))
{
	echo $employee_details;
}

?>


</body>
</html>