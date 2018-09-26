<?php
session_start();
include('includes/config.php');
if(!empty($_POST["class_id"])) 
{
 $cid=intval($_POST['class_id']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("invalid Class");exit;
 }
 else{
 $stmt = $dbh->prepare("SELECT fullname,s_id FROM students WHERE class_id= :class_id order by fullname");
 $stmt->execute(array(':class_id' => $cid));
 ?><option value="">Select student</option><?php
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {
  ?>
  <option value="<?php echo htmlentities($row['s_id']); ?>"><?php echo htmlentities($row['fullname']); ?></option>
  <?php
 }
}

}
// Code for Subjects
if(!empty($_POST["classid1"])) 
{
 $cid1=intval($_POST['classid1']);
 if(!is_numeric($cid1)){
 
  echo htmlentities("invalid Class");exit;
 }
 else{
if(isset($_SESSION['username'])){
echo "Your username is:" .$_SESSION['username'];	
 $stmt = $dbh->prepare("SELECT teachers.t_id,teachers.username, subject.sub_name,subject.sub_id FROM subjectcombination join  subject on  subject.sub_id=subjectcombination.subject_id join teachers on teachers.t_id=subjectcombination.assigned_teacher_id WHERE teachers.username='$_SESSION[username]' and subjectcombination.class_id=:cid order by subject.sub_name");
 $stmt->execute(array(':cid' => $cid1));
 
 while($row=$stmt->fetch(PDO::FETCH_ASSOC))
 {?>
  <p> <?php echo htmlentities($row['sub_name']); ?><input type="text"  name="marks[]" value="" class="form-control" required="" placeholder="Enter marks out of 100" autocomplete="off"></p>
  
<?php  }
}
 
}
}


?>

<?php

if(!empty($_POST["studclass"])) 
{
 $id= $_POST['studclass'];
 $dta=explode("$",$id);
$id=$dta[0];
$id1=$dta[1];
 $query = $dbh->prepare("SELECT s_id,class_id FROM tblresult WHERE s_id=:id1 and class_id=:id ");
//$query= $dbh -> prepare($sql);
$query-> bindParam(':id1', $id1, PDO::PARAM_STR);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{ ?>
<p>
<?php
echo"<span style='color:red; font-size:18px;'> Results for this student already added, choose another student.</span>";
echo "<script>$('#submit').prop('disabled',true);</script>";
 ?></p>
<?php }


  }?>


