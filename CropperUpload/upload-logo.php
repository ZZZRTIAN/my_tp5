<?php
	$img_file = file_get_contents($_POST['img']);
	$img = base64_encode($img_file);
	
	// 从网上复制过来的，试试吧
	// 要砍掉前面的data:image/png;base64,（如果有的话）
	function base64_to_jpeg( $base64_string, $output_file ) {
	    $ifp = fopen( $output_file, "wb" ); 
	    fwrite( $ifp, base64_decode( $base64_string) ); 
	    fclose( $ifp ); 
	    return( $output_file ); 
	}
	$image = base64_to_jpeg( $img, 'tmp.jpg' );
	
	$arr = array("status"=>"1","img"=>$img);
	echo json_encode($arr);
?>