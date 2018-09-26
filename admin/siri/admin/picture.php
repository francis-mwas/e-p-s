<?php include_once 'header.php'; ?>


<div class="container">
   <div class="row">			     
     <div class="col-md-3">
	     <div class="panel panel-info">
		     <div class="panel-heading">
			    <h3 class="panel-title">Dashbord</h3>
			 </div>
			 <div class="panel-body">
			     <a href="index.php">Dashbord</a><br /><br />
			     <a href="picture.php">Pictures</a><br /><br />
	             <a href="users.php">Users</a><br /><br />
			 </div>
		 </div>
     </div> 
	 <div class="col-md-9">
	 <div class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header dashbord">
           <a href="index.php">Home</a>
           <a href="picture.php">	<span class="glyphicon glyphicon-ok">Pictures</span></a>
        </div>

			
     </div>
	  <a href="add-pictures.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Upload New Image</a><br /><br />
	  <table class="table table-bordered table-hover" id="a-products"   cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
			 <tr>
<td colspan='9'><h4 style='font-color:#fff; text-align:center;'>View All Images.</h4></td>
 </tr>
<tr>
 <th>Image ID</th>
 <th>Image</th>
 <th>Delete</th>
  <?php
	include_once 'includes/db.php'; 
	$sql= "SELECT * FROM product_detail";
			$run_query_post=mysql_query($sql);
			while($row =mysql_fetch_array($run_query_post)){
				$img_id = $row['product_id'];
				$img= $row['product_name'];
				

			
			
		?>
			
	<tr>
     <td><?php echo $img_id; ?></td>
     <td><img src="upload/<?php echo $img; ?>" width="70" height="70" /></td>
     <td><a href="delete_pictures.php?delete=<?php echo $img_id ;?>">Delete</a></td>

	 
    </tr>	
			
			
			
		  
	
<?php }  ?>
	
</table>	
	  <script>
	  /*
	 function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getData.php?q="+str,true);
        xmlhttp.send();
    }
}
*/
</script>

   </div>
</div>

