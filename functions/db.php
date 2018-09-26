<?PHP
$conn=mysqli_connect('localhost','root','','eps');

function row_count($result){
	return mysqli_num_rows($result);
	
}


function escape($string){
	global $conn;
	return mysqli_escape_string($conn,$string);
}

function query($query){
    global $conn;

   return  mysqli_query($conn, $query);

    
}
function confirm($result){
	global $conn;
	if(!$result){
		die("query failed". mysqli_error($conn));
	}

}

function fetch_array($result){
	global $conn;
	return mysqli_fetch_array($result);

}


?>