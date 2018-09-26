<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Seller | Dashboard</title>
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet"> 
	<!-- Theme Custom CSS -->
		<script src="js/jquery.js"></script>
	<!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
</head> 
<body id="home">
<?php
include_once("includes/headerss.php");
?>
<?php 
     
      if(logged_in()){

       echo "Logged In as ";

      }else{

        redirect("../index.php");

      }

       echo $_SESSION['email'];  

       include_once("includes/side_bar.php");

 ?>




<?php include_once("includes/side_bar.php"); ?>

<div class="col-lg-10">

	 <!--////// users area -/////-->
	 <!-- profile settings-->

<div class="dropdown pull-right">
  <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Actions
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dLabel">
    ...
  </ul>
</div>


	  <div class="col-lg-12 main_content_area">
                <h1>Manage Categories.</h1>
                 <div>
                     <?php display_message();?>
                </div>
                <div>
                    <form action="categories.php" method="post">
                     
                            
                            <div class="form-group input-group-lg">
                                <label for="cat_name"><span class="fieldInfor">Category Name:</span></label>
                            <input class="form-control" type="text" name="category" id="cat_name" placeholder="Name">
                             </div> 
                            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Add New Category">
                            <br />    <br />
           
           
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Sr No</th>
                            <th>Date</th>
                            <th>Category Name</th>
                            <th>Authhor Name</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        global $connect_db;
                        $sql_query="SELECT * FROM categories ORDER BY date_time DESC";
                        $run_query=query($sql_query);
                        $srNo=0;
                        
                        while($mysql_rows=fetch_array($run_query)){
                            $cat_id=$mysql_rows["cat_id"];
                            $date_time=$mysql_rows["date_time"];
                            $category=$mysql_rows["category"];
                            $author=$mysql_rows["author"];
                            $srNo++;
                        
                        
                        ?>
                        <tr>
                            <td><?php echo $srNo; ?></td>
                            <td><?php echo $date_time; ?></td>
                            <td><?php echo $category; ?></td>
                            <td><?php echo $author; ?></td>
                            <td>
                            <a href="editCat.php?edit_id=<?php echo $cat_id; ?>"><span class="btn btn-danger">Edit</span></a>
                            <a href="delcat.php?del_id=<?php echo $cat_id; ?>"><span class="btn btn-danger">Delete</span></a>    
                            </td>
                           
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>  		
	 <!--////// 2nd to div starts here --/////-->
</div>
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>