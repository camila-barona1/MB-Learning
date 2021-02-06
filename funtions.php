<?php
function get_product($conection, $search_str='')
{
	

	$sql="select course.* from course where course.deleted='0'";

	
	if ($search_str!='') {
		$sql.=" and (course.course_name like '%$search_str%' or course.course_desc like '%$search_str%') ";
	}

	// echo $sql;
	$res=mysqli_query($conection,$sql);
	$data=array();
	while ($row=mysqli_fetch_assoc($res)) {
		$data[]=$row;
	}
	return $data;
}