

<?php

/********* my helpre function ********/


function clean($string){
  return htmlentities($string);
}


function redirect($location){
  return header("location:{$location}");
   
}

function set_messages($message){
  if(!empty($message)){

    $_SESSION['message']= $message;

  }else{
  $message="";
  }
}

function display_message(){
  if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }
}


function token_generator(){
  $token=$_SESSION['token']=md5(uniqid(mt_rand(), true));
  return $token;
}


function send_email($email,$subject,$msg,$headers){
    return mail($email,$subject,$msg,$headers);
}





function email_exists($email){
  $sql_query="SELECT user_id FROM users WHERE email='$email'";
  $result=query($sql_query);

if(row_count($result)==1){
  return true;
}else{
  return false; 
}

}

function teacher_exists($username){
  $sql_query="SELECT  username FROM teachers WHERE username='$username'";
  $result=query($sql_query);

if(row_count($result)==1){
  return true;
}else{
  return false; 
}

}

function admNumber_exists($admission_number){
  $sql_query="SELECT adm_no FROM students WHERE adm_no='$admission_number'";
  $result=query($sql_query);

if(row_count($result)==1){
  return true;
}else{
  return false; 
}

}
//students validation
function tscNumber_exists($tsc_no){
  $sql_query="SELECT t_id FROM teachers WHERE tsc_no='$tsc_no'";
  $result=query($sql_query);

if(row_count($result)==1){
  return true;
}else{
  return false; 
}

}
//function to fetch all the products

function fetchAllProducts(){
  $sql_query="SELECT * FROM admin_panel";
 $result=query($sql_query);

 confirm($result);

 $row=fetch_array($result);
  echo $title=$row['title'];
  echo $image=$row['image'];

}


//function display error messages

function display_validation_errors($error_messages){
  $error_messages= <<<heredoc
       <div class="alert alert-danger alert-dismissible" role="alert">
             <button class="close" type="button" data-dismiss="alert" arial-label="close"><span arial-hidden="true">&times;</span></button>
             <strong>WARNING!</strong>   $error_messages
       </div>
heredoc;

echo $error_messages;
}


//validating users registration process
function validate_user_registration(){
     $errors=[];
     $min=4;
     $max=20;



    if($_SERVER['REQUEST_METHOD']=='POST'){
      $first_name=clean($_POST['first_name']);
      $last_name=clean($_POST['last_name']);
      $email=clean($_POST['email']);
      $mobile_number=clean($_POST['mobile_number']);
      $password=clean($_POST['password']);
      $confirm_password=clean($_POST['confirm_password']);


       if(strlen($first_name) < $min){ 
        $errors[]="atleast {$min} characters are required in your first name";
       }

       if(strlen($first_name) > $max){ 
        $errors[]="Your first name cannot exceed {$min} characters.";
       }

        if(strlen($last_name) < $min){
        $errors[]="atleast {$min} characters are required in your last name";
       }

        if(strlen($last_name) > $max){ 
        $errors[]="Your last name cannot exceed {$min} characters.";
       }

       if(email_exists($email)){
        $errors[]="Sorry that email already exists";
       }

       if($password !==$confirm_password){ 
        $errors[]="Your passwords dont match.";
       }



       if(!empty($errors)){
        foreach ($errors as $error) {
        
       echo display_validation_errors($error);

        }    
        }else{

             if(register_user($first_name,$last_name,$email,$mobile_number,$password)){

              set_messages("<p class='well' style='background:navy; color:#fff; font-size:16px;'>Registration successful, please check your email to activate your account..</p>");

              redirect("user_login.php");
             }else{
              set_messages("<p class='bg-danger text-center'>Sorry, we could not create your account now, try again.</p>");

              redirect("register.php");
             }

       }

    }
}
   
   //register users function.......//

function register_user($first_name,$last_name,$email,$mobile_number,$password){
      $first_name=escape($first_name);
      $last_name=escape($last_name);
      $email=escape($email);
      $mobile_number=escape($mobile_number);
      $password=escape($password);

      if(email_exists($email)){
          return false;

    }else{
      $password=md5($password);
      $validation_code=md5($email + microtime());
      $sql="INSERT INTO `users`(first_name,last_name,email,mobile_number,password,validation_code,active)";
      $sql.= " VALUES('$first_name','$last_name','$email','$mobile_number','$password','$validation_code',0)";
      $result=query($sql);
      confirm($result);

      $subject="Account Activation";
      $msg="Please click the link below to activate your account
      http://localhost/login/activate.php?email=$email&code=$validation_code
      ";
      $headers="From: noreply@mywebsite.com";

      send_email($email,$subject,$msg,$headers);






      return true;
    }
}

//function to validate ad creation
function validateStudentsCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $full_name=clean($_POST['fullname']);
      //$last_name=clean($_POST['lastname']);
      $admission_number=clean($_POST['adm_no']);
      $student_class=clean($_POST['class_id']);
      //$student_stream=clean($_POST['stream_id']);
      //$class=clean($_POST['class']);
      $yearOfAdmission=clean($_POST['yearOfAdmission']);
      $gender=clean($_POST['gender']);
      $profile=$_FILES["profile_photo"]["name"];
      $target="../images/".basename($_FILES["profile_photo"]["name"]);


     

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}elseif(strlen($admission_number)> 4 || strlen($admission_number) < 4){
   set_messages("<p class='bg-danger text-center' style='font-size:18px;'>Admission no must not exceed 4 characters and should not be less than 4 characters</p>");

}elseif(!is_numeric($admission_number)){
   set_messages("<p class='bg-danger text-center' style='font-size:18px;'>Only numbers allowed in adm no.</p>");
}elseif(admNumber_exists($admission_number)){
    set_messages("<p class='bg-danger text-center' style='font-size:18px;'>That admission number already exists.</p>");
}else{
  if(create_student_account($full_name,$admission_number,$student_class,$yearOfAdmission,$gender,$profile)){

  set_messages("<p class='bg-success text-center' style='font-size:18px;'>Student Account Created Successfully.</p>");

      //redirect("add_students.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not create student account, please try again.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}

// function to create student account
function create_student_account($full_name,$admission_number,$student_class,$yearOfAdmission,$gender,$profile){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $full_name=escape($full_name);
      //$last_name=escape($last_name);
      $admission_number=escape($admission_number);
      $student_class=escape($student_class);
      //$student_stream=escape($student_stream);
      $yearOfAdmission=escape($yearOfAdmission);
      $gender=escape($gender);
      $profile=escape($profile);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_updated=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;
      $date_updated;
    
      $profile=$_FILES["profile_photo"]["name"];
      $target="images/".basename($_FILES["profile_photo"]["name"]);


      if(move_uploaded_file($_FILES["profile_photo"]["tmp_name"],$target)){
      
      $sql="INSERT INTO `students`(fullname,adm_no,class_id,yearOfAdmission,gender,profile_photo,date_added,updated_date)";
      $sql.= "VALUES('$full_name','$admission_number','$student_class','$yearOfAdmission','$gender',
      '$profile','$date_added','$date_updated')";

      $result=query($sql);
      confirm($result);

      //$subject="Account Activation";

     // $msg="Your Ad Uploaded successfully and will be approved soon, thanks
      //http://localhost/login/activate.php?email=$email&code=$validation_code
      //";
      //$headers="From: noreply@mywebsite.com";

      //send_email($email,$subject,$msg,$headers);

      return true;
    




  }else{
    return false;
  }

  }else{
    return false;
  }

}

//function to validate teachers account creation
function validateTeachersCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $fullname=clean($_POST['fullname']);
      $username=clean($_POST['username']);
      $tsc_no=clean($_POST['tsc_no']);
      $profile=$_FILES["profile_photo"]["name"];
      $target="../images/".basename($_FILES["profile_photo"]["name"]);
if(empty($fullname)){
   set_messages("<p class='bg-danger text-center' style='font-size:18px;'>Full name field is empty, please fill.</p>");

}elseif(empty($username)){
   set_messages("<p class='bg-danger text-center' style='font-size:18px;'>Username field is empty, please fill.</p>");

}elseif(empty($tsc_no)){
 set_messages("<p class='bg-danger text-center'>tsc no field is empty, please fill.</p>");

}elseif(strlen($tsc_no)> 6 || strlen($tsc_no)< 6){
   set_messages("<p class='bg-danger text-center' style='font-size:18px;'>tsc no must not exceed 6 characters and should not be less than 6 characters</p>");

}elseif(!is_numeric($tsc_no)){
   set_messages("<p class='bg-danger text-center'>Only numbers allowed in tsc no.</p>");
}elseif(teacher_exists($username,$tsc_no)){
  set_messages("<p class='bg-danger text-center' style='font-size:18px;'>That username already exists</p>");

}elseif(tscNumber_exists($tsc_no)){
   set_messages("<p class='bg-danger text-center' style='font-size:18px;'>That tsc number already exists</p>");
}else{
  if(insert_teacher($fullname,$username,$tsc_no,$profile)){


    set_messages("<p class='bg-success text-center' style='font-size:18px;'>Teacher's Account Created Successfully.</p>");

              //redirect("createNewAdd.php");

  }else{

set_messages("<p class='bg-danger text-center' style='font-size:18px;'>Sorry, we could not create teacher's account, please try again.</p>");

  //redirect("createNewAdd.php");
  }
}
}
}
}

/*
  $sql_query ="SELECT username,tsc_no FROM `teachers`";
  $result=query($sql_query);
  if(row_count($result) > 1){
    set_messages("<p class='bg-danger text-center'>That username or tsc number already exists, try another</p>");
*/
// function to insert teachers account
function insert_teacher($fullname,$username,$tsc_no,$profile){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $fullname=escape($fullname);
      $username=escape($username);
      $tsc_no=escape($tsc_no);
      $profile=escape($profile);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;
    
      $profile=$_FILES["profile_photo"]["name"];
      $target="images/".basename($_FILES["profile_photo"]["name"]);
      
      $sql = "SELECT * FROM teachers WHERE username='$username' AND tsc_no='$tsc_no'";
      $result=query($sql);
      if(row_count($result) >0 ){
        set_messages("<p class='bg-danger text-center'>Username and tsc no exist, try another.</p>");
      }elseif(move_uploaded_file($_FILES["profile_photo"]["tmp_name"],$target)){
          
      $sql="INSERT INTO `teachers`(fullname,username,tsc_no,profile_photo,date_added)";
      $sql.= "VALUES('$fullname','$username','$tsc_no','$profile','$date_added')";

      $result=query($sql);     
      confirm($result);
      return true;
  }else{
    return false;
  }

  }else{
    return false;
  }

}

//function to update streams.
function update_streams(){
$errors=[];
$minimum_char=5;

if(isset($_GET['stream_id'])){
   $stream_id=clean($_GET['stream_id']);
   $sql_query="SELECT * FROM streams WHERE stream_id='$stream_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $stream_name=$rows['stream_name'];
     


$UpdateStreams=<<<heredoc
   <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Stream Details.</legend>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="stream name"><span>Stream Name</span></label>
                                <input id="stream_name" name="stream_name" type="text" value={$rows['stream_name']} placeholder="(e.g. F1A, F1B, F2A,F2B, F3A,F4A,F4B etc" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Save Stream</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
heredoc;
echo $UpdateStreams;
   }
}
}

//function to insert stream updates....
function insert_streams_details(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $stream_id=clean($_GET['stream_id']);
    $stream_name=clean($_POST['stream_name']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_added;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($stream_name)){

      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Stream name cannot be empty.</p>");

     }else{
      $sql_query="UPDATE `streams` SET stream_name='$stream_name',date_added='$date_added' WHERE stream_id='$stream_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Stream details updated successfully. Go 
          <a href='manage_streams.php'>back</a></p>");
            //redirect("update_class.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Stream details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}


//function to update classes.
function udate_classes(){
$errors=[];
$minimum_char=5;

if(isset($_GET['class_id'])){
   $class_id=clean($_GET['class_id']);
   $sql_query="SELECT * FROM class WHERE class_id='$class_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $class_abbr=$rows['class_abbr'];
      $stream=$rows['streams'];
      $class_teacher=$rows['class_teacher'];


$editTeachers=<<<heredoc
  <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update class details</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                               <label for="class_abbr "><span>Class Abbreviation</span></label>
                                <input id="class_abbr " name="class_abbr" type="text" placeholder="class Abrr i.e F1, F2" value="{$rows['class_abbr']}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="stream"><span>Class stream</span></label>
                                <input id="stream" name="streams" type="text" placeholder="stream" class="form-control" value="{$rows['streams']}" required>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="class_teacher"><span>Class teacher name</span></label>
                                <input id="class_teacher" name="class_teacher" type="text" placeholder="class_teacher" class="form-control" value="{$rows['class_teacher']}" required>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Save</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

heredoc;
echo $editTeachers;
   }
}
}

//function to insert class updates....
function insert_class_details(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $class_id=clean($_GET['class_id']);
    $class_abbr=clean($_POST['class_abbr']);
    $stream=clean($_POST['streams']);
    $class_teacher=clean($_POST['class_teacher']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_added;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($class_abbr)){

      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Class abbreviation cannot be empty.</p>");

     }elseif(empty($stream)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Stream cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($class_teacher)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Class teacher field cannot be empty.</p>");

      //redirect("update_profile.php");
    }else{
      $sql_query="UPDATE `class` SET class_abbr='$class_abbr',streams='$stream',class_teacher='$class_teacher',date_added='$date_added' WHERE class_id='$class_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Class details updated successfully. Go 
          <a href='newly_posted.php'>back</a></p>");
            //redirect("update_class.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Class details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}


//function to add new class.
function validateClassCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $class_abbr=clean($_POST['class_abbr']);
      $streams=clean($_POST['streams']);
      $class_teacher=clean($_POST['class_teacher']);
      

     

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(add_new_class($class_abbr,$streams,$class_teacher)){


    set_messages("<p class='bg-success text-center'>Class Added Successful.</p>");

              redirect("add_class.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not upload your ad, try again.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}

// function to insert the new class..
function add_new_class($class_abbr,$streams,$class_teacher){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $class_abbr =escape($class_abbr);
      $streams =escape($streams);
      $class_teacher=escape($class_teacher);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;

    $sql="INSERT INTO `class`(class_abbr,streams,class_teacher,date_added)";
    $sql.= "VALUES('$class_abbr','$streams','$class_teacher','$date_added')";

      


        $result=query($sql);

     
      confirm($result);

      //$subject="Account Activation";

     // $msg="Your Ad Uploaded successfully and will be approved soon, thanks
      //http://localhost/login/activate.php?email=$email&code=$validation_code
      //";
      //$headers="From: noreply@mywebsite.com";

      //send_email($email,$subject,$msg,$headers);

      return true;
    




  
  }else{
    return false;
  }

}


//function to validate subject creation..
function validateSubjectCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $subject_name=clean($_POST['sub_name']);
      $sub_code=clean($_POST['sub_code']);
      

      
 if(empty($subject_name)){

    set_messages("<p class='bg-danger text-center'>Please fill subject name field.</p>");

 }
 
 if(empty($sub_code)){

    set_messages("<p class='bg-danger text-center'>Please fill subject code field.</p>");

 }

     

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(create_subject($subject_name,$sub_code)){


    set_messages("<p class='bg-success text-center'>New subject created Successful.</p>");

              redirect("create_subjects.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not add a new term, try again.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}


// function to create new subject..
function create_subject($subject_name,$sub_code){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $subject_name=escape($subject_name);
      $sub_code =escape($sub_code);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_updated=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;
      $date_updated;

    $sql="INSERT INTO `subject`(sub_name,sub_code,date_added,updated_date)";
    $sql.= "VALUES('$subject_name','$sub_code','$date_added','$date_updated')";

      


        $result=query($sql);

     
      confirm($result);

      //$subject="Account Activation";

     // $msg="Your Ad Uploaded successfully and will be approved soon, thanks
      //http://localhost/login/activate.php?email=$email&code=$validation_code
      //";
      //$headers="From: noreply@mywebsite.com";

      //send_email($email,$subject,$msg,$headers);

      return true;
    




  
  }else{
    return false;
  }

}

//function to validate subjectCombination creation....
function validateSubjCombinationCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $class_id=clean($_POST['class_id']);
      //$stream_id=clean($_POST['stream_id']);
      $subject_id=clean($_POST['subject_id']);
      $teacher_assigned=clean($_POST['assigned_teacher_i']);
      

      
 

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(add_subjComb($class_id,$subject_id,$teacher_assigned)){


    set_messages("<p class='bg-success text-center'>Combination Added Successful.</p>");

              redirect("add-subjectcombination.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not add a combination, try again.</p>");
  }
}
}
}
}

// function to insert the new term..
function add_subjComb($class_id,$subject_id,$teacher_assigned){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $class_id=escape($class_id);
      //$stream_id =escape($stream_id);
      $subject_id=escape($subject_id);
      $teacher_assigned=escape($teacher_assigned);

      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_updated=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;
      $date_updated;

    $sql="INSERT INTO `subjectcombination`(class_id,subject_id,   assigned_teacher_id,date_added,updated_date)";
    $sql.= "VALUES('$class_id','$subject_id','$teacher_assigned','$date_added','$date_updated')";

    $result=query($sql);
      confirm($result);
      return true;
  }else{
    return false;
  }

}

//function to validate creation..
function validateTermsCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $name=clean($_POST['name']);
      $year=clean($_POST['year']);
      

      
 if(empty($type)){

    set_messages("<p class='bg-danger text-center'>Please fill exam type field.</p>");

 }
 
 if(empty($exam_code)){

    set_messages("<p class='bg-danger text-center'>Please fill exam code field.</p>");

 }

 if(empty($max_mark)){

    set_messages("<p class='bg-danger text-center'>Please fill max mark field.</p>");

 }
    
        

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(add_new_term($name,$year)){


    set_messages("<p class='bg-success text-center'>New Term Added Successful.</p>");

              redirect("add_terms.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not add a new term, try again.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}
// function to insert the new term..
function add_new_term($name,$year){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $name=escape($name);
      $year =escape($year);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;

    $sql="INSERT INTO `terms`(name,year,date_added)";
    $sql.= "VALUES('$name','$year','$date_added')";

      


        $result=query($sql);

     
      confirm($result);

      //$subject="Account Activation";

     // $msg="Your Ad Uploaded successfully and will be approved soon, thanks
      //http://localhost/login/activate.php?email=$email&code=$validation_code
      //";
      //$headers="From: noreply@mywebsite.com";

      //send_email($email,$subject,$msg,$headers);

      return true;
    




  
  }else{
    return false;
  }

}



//function to add exams
function validateExamsCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $type=clean($_POST['type']);
      $exam_code=clean($_POST['exam_code']);
      $max_mark =clean($_POST['max_mark']);
      //$max_mark =clean($_POST['max_mark']);

      
 if(empty($type)){

    set_messages("<p class='bg-danger text-center'>Please fill exam type field.</p>");

 }
 
 if(empty($exam_code)){

    set_messages("<p class='bg-danger text-center'>Please fill exam code field.</p>");

 }

 if(empty($max_mark)){

    set_messages("<p class='bg-danger text-center'>Please fill max mark field.</p>");

 }
    
        

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(add_new_exam($type,$exam_code,$max_mark)){


    set_messages("<p class='bg-success text-center'>Exams Added Successful.</p>");

              redirect("add_exams.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not add a new exam, try again.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}
// function to insert the new exams..
function add_new_exam($type,$exam_code,$max_mark){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $type =escape($type);
      $exam_code =escape($exam_code);
      $max_mark=escape($max_mark);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;

    $sql="INSERT INTO `exams`(type,exam_code,max_mark,date_added)";
    $sql.= "VALUES('$type','$exam_code','$max_mark','$date_added')";

      


        $result=query($sql);

     
      confirm($result);

      //$subject="Account Activation";

     // $msg="Your Ad Uploaded successfully and will be approved soon, thanks
      //http://localhost/login/activate.php?email=$email&code=$validation_code
      //";
      //$headers="From: noreply@mywebsite.com";

      //send_email($email,$subject,$msg,$headers);

      return true;
    




  
  }else{
    return false;
  }

}

//function to add new stream.
function validateStreamCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $stream_name=clean($_POST['stream_name']);
     
      

     

 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(add_new_stream($stream_name)){


    set_messages("<p class='bg-success text-center'>New stream Added Successfully.</p>");

              redirect("add_streams.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not create a new stream.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}
// function to insert the new stream..
function add_new_stream($stream_name){
       if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
     //$first_name=escape($first_name);
      $stream_name =escape($stream_name);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;

    $sql="INSERT INTO `streams`(stream_name,date_added)";
    $sql.= "VALUES('$stream_name','$date_added')";

      


        $result=query($sql);

     
      confirm($result);

      //$subject="Account Activation";

     // $msg="Your Ad Uploaded successfully and will be approved soon, thanks
      //http://localhost/login/activate.php?email=$email&code=$validation_code
      //";
      //$headers="From: noreply@mywebsite.com";

      //send_email($email,$subject,$msg,$headers);

      return true;
    




  
  }else{
    return false;
  }

}
//update ads details
function update_ad(){
  
     $errors=[];
     $minimum_char=5;
 
  if(isset($_GET['ad_id'])){

    $ads_id=clean($_GET['ad_id']);
    $sql_query="SELECT * FROM ads WHERE ad_id='$ads_id'";
    $result=query($sql_query);
     //confirm($result);
     //$count=0;
     while($rows=fetch_array($result)){
   
      $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $title=substr($ad_title,0,5);
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];
      $date=substr($date_added,0,5);
      $ad_status=$rows['ad_status'];


$editAd= <<<heredoc

    

  
     <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Ad Details.</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                               <label for="title"><span>Ad Title</span></label>
                                <input id="title" name="ad_title" type="text" placeholder="Ad title" class="form-control" value="{$rows['ad_title']}">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="price"><span>Price</span></label>
                                <input id="price" name="ad_price" type="text" placeholder="Ad price" class="form-control" value="{$rows['ad_price']}" DISABLED>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="category"><span>Category</span></label>
                                <select name="ad_category" id="category" DISABLED>
                                  <option>{$rows['ad_category']}</option>
                                  <option>Select category</option>
                                  <option>furnished and holiday rentals.</option>
                                  <option>office,shops and commercial.</option>
                                  <option>houses and apartment for sale</option>
                                  <option>land and plots.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="location"><span>Location</span></label>
                                <input id="location" name="ad_location" type="text" placeholder="Ads location" class="form-control" value="{$rows['ad_location']}" DISABLED>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Mobile Number</span></label>
                                <input id="phone" name="mobile_number" type="text" placeholder="Phone Number" class="form-control" value="{$rows['mobile_number']}" DISABLED>

                            </div>
                        </div>


                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Current ad image</span></label>
                                <td class="text-center">
                                <img src="../accounts/images/{$rows['ad_images']}" width="200" height="150">
                                </td>

                            </div>
                        </div>


                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="ad_photos"><span>Upload Photos</span></label>
                                <input id="photos" type="file" name="ad_images"  placeholder="Photos" class="form-control" DISABLED>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="description"><span>Ad Description</span></label>
                                <textarea class="form-control" id="description" name="ad_description" placeholder="Ad description." rows="7">{$rows['ad_description']}</textarea>
                            </div>
                        </div>
                          <input type="hidden" name="ad_code" />
                          <input type="hidden" name="date_added" />
                          <input type="hidden" name="created_by" />
                          <input type="hidden" name="ad_status" />
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit-update">Update Ad</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
  

heredoc;

echo $editAd;

}
}
}


//function to edit individual ad posts
function  update_ur_ad(){
  
     $errors=[];
     $minimum_char=5;
 
  if(isset($_GET['ad_id'])){

    $ads_id=clean($_GET['ad_id']);
    $sql_query="SELECT * FROM ads WHERE ad_id='$ads_id'";
    $result=query($sql_query);
     //confirm($result);
     //$count=0;
     while($rows=fetch_array($result)){
   
      $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $title=substr($ad_title,0,5);
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];
      $date=substr($date_added,0,5);
      $ad_status=$rows['ad_status'];


$editAd= <<<heredoc

    

  
     <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Ad Details.</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                               <label for="title"><span>Ad Title</span></label>
                                <input id="title" name="ad_title" type="text" placeholder="Ad title" class="form-control" value="{$rows['ad_title']}">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="price"><span>Price</span></label>
                                <input id="price" name="ad_price" type="text" placeholder="Ad price" class="form-control" value="{$rows['ad_price']}">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="category"><span>Category</span></label>
                                <select name="ad_category" id="category">
                                  <option>{$rows['ad_category']}</option>
                                  <option>Select category</option>
                                  <option>furnished and holiday rentals.</option>
                                  <option>office,shops and commercial.</option>
                                  <option>houses and apartment for sale</option>
                                  <option>land and plots.</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="location"><span>Location</span></label>
                                <input id="location" name="ad_location" type="text" placeholder="Ads location" class="form-control" value="{$rows['ad_location']}">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Mobile Number</span></label>
                                <input id="phone" name="mobile_number" type="text" placeholder="Phone Number" class="form-control" value="{$rows['mobile_number']}">

                            </div>
                        </div>


                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Current ad image</span></label>
                                <td class="text-center">
                                <img src="../accounts/images/{$rows['ad_images']}" width="200" height="150">
                                </td>

                            </div>
                        </div>


                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="ad_photos"><span>Upload Photos</span></label>
                                <input id="photos" type="file" name="ad_images"  placeholder="Photos" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="description"><span>Ad Description</span></label>
                                <textarea class="form-control" id="description" name="ad_description" placeholder="Ad description." rows="7">{$rows['ad_description']}</textarea>
                            </div>
                        </div>
                          <input type="hidden" name="ad_code" />
                          <input type="hidden" name="date_added" />
                          <input type="hidden" name="created_by" />
                          <input type="hidden" name="ad_status" />
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit-update">Update Ad</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
  

heredoc;

echo $editAd;

}
}
}


//user profile fetching...
function get_users_profile(){
 
 if(isset($_GET['u_id'])){
  $user_id=$_GET['u_id'];
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM users WHERE user_id='$user_id'";
     
     $result=query($sql_query);
     //confirm($result);
     //$count=0;
     $row=fetch_array($result);
        $user_id=$row['user_id'];
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $email=$row['email'];
        $mobile_number=$row['mobile_number'];
        $user_id=$row['user_id'];
        $date_registered=$row['date_registered'];
        $active=$row['active'];
        $avatar=$row['profile_pic'];

        if($active==1){

           $activate="<span> <i class='glyphicon glyphicon-ok-sign'></i>  Active</span>";

        }else{
          $activate="<span> <i class='glyphicon glyphicon-ban-circle'></i>  Inactive</span>";
        }
        

        if(empty($avatar)){
          
          //echo "hello set your profile picture"; 
           $avatar_holder='
        
         <img src="../accounts/profile_pics/avatar.png"  class="img-responsive img-thumbnail" alt="danly ads" style="width:100%;">
         ';

        }elseif(!empty($avatar)){

          //echo "hello, update your profile picture";
          $avatar_holder="

              <img src='../accounts/profile_pics/{$row['profile_pic']}' class='img-responsive img-thumbnail' alt='danly properties' style='width:100%;'>


          ";

        }
  

$profile= <<<heredoc

    <div class="panel panel-primary">
     <div class="panel-heading">
     <div class="col-md-3">
         {$avatar_holder}
     </div>
        <div class="col-md-7">
        <h3><u>{$row['first_name']} {$row['last_name']}</u></h3>
        <h3><u></u></h3>
        <p>Gender: <i class="glyphicon glyphicon-user"></i> {$row['gender']}</p>
        <p>Phone Number:<i class="glyphicon glyphicon-phone"></i> {$row['mobile_number']}</p>
        <p>Email: <i class="glyphicon glyphicon-envelope"></i> {$row['email']}</p>
        <p>
          Account Status: {$activate}
        </p>
        <p>joined: <i class="glyphicon glyphicon-calendar"></i> {$date_registered}</p>
         <p>Last Seen: <i class="glyphicon glyphicon-eye-open"></i> yesterday at 10pm</p>
     </div>
      <div class="clearfix"></div>
     </div>
  </div>

  </div>

  
     <div class="col-lg-12">
       <div class="panel panel-primary">
         <div class="panel-heading">
           <h4>{$row['email']} Profile</h4>
       </div>
       <div class="panel-body">
           <table class="table table-striped">
             <thead>
               <tr>
                <th>User Id.</th>
                <th>First Name.</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date Registered</th>
                <th>Actions</th>
                </tr>
           </thead>
             <tbody>
           
               <tr>
                <td>{$row['user_id']}</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['mobile_number']}</td>
                <td>{$row['date_registered']}</td>
               <td>
                
                 <a href="activate_user.php?u_id={$row["user_id"]}"><span class="btn btn-info">Activate User</span></a>


                  <a href="deactivate_user.php?u_id={$row["user_id"]}"><span class="btn btn-danger">Deactivate User</span></a>
               </td>
              
            </tr>
    
           </tbody>
         </table>
       </div>
     </div>
   </div>
  

heredoc;

echo $profile;
}




}

//function to get admin profile
function get_admin_profile(){
     $sql_query="SELECT * FROM admins";
     
     $result=query($sql_query);
     //confirm($result);
     //$count=0;
     $row=fetch_array($result);
        $admin_id_id=$row['admin_id'];
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $username=$row['username'];
        $phone_number=$row['phone_number'];
        $date_time=$row['date_time'];
        $avatar=$row['profile_pic'];     

        if(empty($avatar)){
          
          //echo "hello set your profile picture"; 
           $avatar_holder='
        
         <img src="profile_pic/avatar.png"  class="img-responsive img-thumbnail" alt="danly ads" style="width:100%;">
         ';

        }elseif(!empty($avatar)){

          //echo "hello, update your profile picture";
          $avatar_holder="

              <img src='profile_pic/{$row['profile_pic']}' class='img-responsive img-thumbnail' alt='danly properties' style='width:100%;'>


          ";

        }
  

$profile= <<<heredoc

    <div class="panel panel-primary">
     <div class="panel-heading">
     <div class="col-md-3">
         {$avatar_holder}
         <h4><span class="btn btn-danger">Update profile picture</span></h4>
         <p class="panel">
           
           <form method="POST" role="form" enctype="multipart/form-data">
               <div class="form-group">

                  <input type="file" name="profile_pic" id="profile-pic" tabindex="1" class="form-control" required>
                </div>
                <div class="form-group">
                    
                        <input type="submit" id="upload-image" tabindex="4" class="form-control btn btn-block btn-register" name="upload-profile" value="Upload Image">
                </div>
                
           </form>

         </p>
     
     
     
     
     </div>
        <div class="col-md-7">
        <h3><u>{$row['first_name']}</u></h3>
        <h3><u></u></h3>
        <p>Phone Number:<i class="glyphicon glyphicon-phone"></i> {$row['phone_number']}</p>
        <p>Username: <i class="glyphicon glyphicon-envelope"></i> {$row['username']}</p>
        <p>Admin Since: <i class="glyphicon glyphicon-calendar"></i> {$date_time}</p>
         <p>Last Seen: <i class="glyphicon glyphicon-eye-open"></i> yesterday at 10pm</p>
     </div>
      <div class="clearfix"></div>
     </div>
  </div>

  </div>

  
     <div class="col-lg-12">
       <div class="panel panel-primary">
         <div class="panel-heading">
           <h4>{$row['username']} Profile</h4>
       </div>
       <div class="panel-body">
           <table class="table table-striped">
             <thead>
               <tr>
                <th>User Id.</th>
                <th>First Name.</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Date Registered</th>
                <th>Actions</th>
                </tr>
           </thead>
             <tbody>
           
               <tr>
                <td>{$row['admin_id']}.</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['username']}</td>
                <td>{$row['phone_number']}</td>
                <td>{$row['date_time']}</td>
               <td>
                  <a href="update_profile.php?admin_id={$row['admin_id']}"> <span class="btn btn-info">Update Details</span></a>
               </td>
              
            </tr>
    
           </tbody>
         </table>
       </div>
     </div>
   </div>
  

heredoc;

echo $profile;
}


//function to set admin profile picture....
function upload_profile_pic(){
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['upload-profile'])){

      $image=clean(@$_POST['profile_pic']);
      $image=$_FILES["profile_pic"]["name"];
      $target="profile_pic/".basename($_FILES["profile_pic"]["name"]);


      if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"],$target)){
      $sql_query="UPDATE admins SET profile_pic='$image'";
      $result=query($sql_query);
       if($result){
        set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Profile picture set successfully.</p>");
      }else{
        set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Profile picture could not be set.</p>");
      }

      }else{
        return false;
      }
    }
  }
}

//function to update ad
if($_SERVER['REQUEST_METHOD']=='POST'){
if(isset($_POST['submit-update'])){

    $ads_id=$_GET['ad_id'];
    $ad_title=$_POST['ad_title'];
    $ad_description=$_POST['ad_description'];

    

    $updateQuery="UPDATE ads SET ad_title='$ad_title', ad_description='$ad_description' WHERE ad_id='29'"; 

    $result=query($updateQuery);

    if($result){
      set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Ad details updated successfully</p>");
    }else{ 
     die(mysqli_error($conn)); 
    }
}
}

//function to update admin accounts details
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['update-admin-profile'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $update_id=clean($_GET['admin_id']);
    $first_name=clean($_POST['first_name']);
    $last_name=clean($_POST['last_name']);
    $username=clean($_POST['username']);
    $phone_number=clean($_POST['phone_number']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
    //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $dateTime=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $dateTime;

    if(empty($first_name)){
      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>First name cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($last_name)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Last name cannot be empty.</p>");

     // redirect("update_profile.php");
    }elseif(empty($username)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Username cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($phone_number)){
       set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Phone number cannot be empty.</p>");

      //redirect("update_profile.php");
    }else{
    $sql_query="UPDATE admins SET first_name='$first_name',last_name='$last_name',username='$username',phone_number='$phone_number',date_time='$dateTime' WHERE admin_id='$update_id'";
    $run_query=query($sql_query);
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Account details updated successfully.</p>");
            //redirect("update_profile.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Account details could not be updated, please try again</p>");

              redirect("update_profile.php?admin_id={$update_id}");
        }
}
}
}
//update admin profile
function update_admin_profile(){
 if(isset($_GET['admin_id'])){
  $admin_profile_id=clean($_GET['admin_id']);
  $sql_query="SELECT * FROM admins WHERE admin_id='$admin_profile_id'";
  $result=query($sql_query);
     //confirm($result);
     //$count=0;
     while($row=fetch_array($result)){
   
        $admin_id=$row['admin_id'];
        $date_time=$row['date_time'];
        $username=$row['username'];
        $phone_number=$row['phone_number'];
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $avatar=$row['profile_pic'];


        
        if(empty($avatar)){
          
          //echo "hello set your profile picture"; 
           $avatar_holder='
        
         <img src="profile_pic/avatar.png"  class="img-responsive img-thumbnail" alt="danly ads" style="width:100%;">
         ';

        }elseif(!empty($avatar)){

          //echo "hello, update your profile picture";
          $avatar_holder="

              <img src='profile_pic/{$row['profile_pic']}' class='img-responsive img-thumbnail' alt='danly properties' style='width:100%;'>


          ";

        }
  

$profile= <<<heredoc

    

  
     <div class="col-lg-12">
       <div class="panel panel-primary">
         <div class="panel-heading">
           <h4>{$row['username']} Profile</h4>
       </div>
       <div class="panel-body">
      <form id="register-form" method="post" role="form" style="color:red;">

                  <div class="form-group">
                    <input type="text" name="first_name" id="First Name" tabindex="1" class="form-control" placeholder="First Name" value="{$row['first_name']}">
                  </div>
                  <div class="form-group">
                    <input type="text" name="last_name" id="last_name" tabindex="1" class="form-control" placeholder="Last Name" value="{$row['last_name']}" required >
                  </div>
                  <div class="form-group">
                    <input type="text" name="phone_number" id="phone" tabindex="1" class="form-control" placeholder="Phone Number" value="{$row['phone_number']}" required >
                  </div>
                  <div class="form-group">
                    <input type="email" name="username" id="register_email" tabindex="1" class="form-control" placeholder="Email Address" value="{$row['username']}" required >
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" id="update-admin-profile" tabindex="4" class="form-control btn btn-register" name="update-admin-profile" value="Update Profile">
                      </div>
                    </div>
                  </div>
                </form>
       </div>
     </div>
   </div>
  

heredoc;

echo $profile;
}

}


}

//function to update streams.
function update_students(){
$errors=[];
$minimum_char=5;

if(isset($_GET['s_id'])){
   $s_id=clean($_GET['s_id']);

   $sql_query="SELECT students.s_id,students.fullname,students.adm_no,students.yearOfAdmission,students.gender,students.profile_photo,students.date_added,students.updated_date,class.class_abbr,class.class_id,class.streams FROM students JOIN class on class.class_id=students.class_id WHERE s_id='$s_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $full_name=$rows['fullname'];
      //$lastname=$rows['lastname'];
      $adm_no=$rows['adm_no'];
      $class=$rows['class_abbr'];
      $stream=$rows['streams'];
      $yearOfAdmission=$rows['yearOfAdmission'];
      $gender=$rows['gender'];




$editTeachers=<<<heredoc
     <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update student account.</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                               <label for="firstname"><span>Full Name</span></label>
                                <input id="fullname" name="fullname" type="text" value="{$rows['fullname']}" placeholder="Full Name" class="form-control" required>
                            </div>
                        </div>
                                               
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="Admission number"><span>Admission number</span></label>
                                <input id="admission_no" name="adm_no" type="text" value="{$rows['adm_no']}" placeholder="Admission number" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="class"><span>Student's Class</span></label>
                                <input id="class" name="class_id" value="{$rows['class_abbr']}" type="text" placeholder="student class" class="form-control" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="student stream"><span>Student Stream</span></label>
                                <input id="stream" name="stream_id" type="text" value="{$rows['streams']}" placeholder="Student stream" class="form-control" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="category"><span>Category</span></label>
                                <select name="class_id" id="gender">
                                  <option value="{$rows['class_id']}">{$rows['class_abbr']}</option>
                                
                                                                  
                                </select>
                            </div>
                        </div>




                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="yearOfAdmission"><span>Year of admission</span></label>
                                <input id="yearOfAdmission" name="yearOfAdmission" type="text" value="{$rows['yearOfAdmission']}"placeholder="Year of admission" class="form-control" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="category"><span>Category</span></label>
                                <select name="gender" id="gender">
                                  <option>{$rows['gender']}</option>
                                 
                                  <option>male</option>
                                  <option>female</option>
                                  <option>other</option>
                                  
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Current Profile Photo.</span></label>
                                <td class="text-center">
                                <img src="./images/{$rows['profile_photo']}" width="200" height="150">
                                </td>

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="p_photo"><span>Profile Photo</span></label>
                                <input id="p_photo" type="file" name="profile_photo"  placeholder="Profile photo" class="form-control" required disabled>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit_updates">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
heredoc;
echo $editTeachers;
   }
}
}

//function to insert teachers update....
function insertStudentsUpdates(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit_updates'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $s_id=clean($_GET['s_id']);
    $full_name=clean($_POST['fullname']);
    //$lastname=clean($_POST['lastname']);
    $adm_no=clean($_POST['adm_no']);
    //$tsc_no=clean($_POST['tsc_no']);
    $class=clean($_POST['class_id']);
    $stream=clean($_POST['stream_id']);
    $yearOfAdmission=clean($_POST['yearOfAdmission']);
    $gender=clean($_POST['gender']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_updated=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_updated;
    $date_added;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($full_name)){
      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Full name cannot be empty.</p>");

     }elseif(empty($adm_no)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Admission number cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($class)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Class cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($stream)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Stream field cannot be empty.</p>");
    }else{
      $sql_query="UPDATE `students` SET fullname='$full_name',adm_no='$adm_no',class_id='$class',stream_id='$stream',yearOfAdmission='$yearOfAdmission',gender='$gender',updated_date='$date_updated' WHERE s_id='$s_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Student account details updated successfully. Go <a href='manage_students.php'>Back</a></p>");
            //redirect("manage_teachers.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Student account details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}


//get all ads...
function getAllStudents(){



    $sql_query="SELECT students.s_id,students.fullname,students.adm_no,students.yearOfAdmission,students.gender,students.profile_photo,students.date_added,students.updated_date,class.class_abbr,class.streams FROM students JOIN class on class.class_id=students.class_id";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $full_name=$rows['fullname'];
       //$lastname=$rows['lastname'];
       $admission_number=$rows['adm_no'];
       $class=$rows['class_abbr'];
       $stream=$rows['streams'];
       //$stream=$rows['stream'];
       $yearOfAdmission=$rows['yearOfAdmission'];
       $gender=$rows['gender'];
       $profile=$rows['profile_photo'];
       $date_added=$rows['date_added'];
       $updated_date=$rows['updated_date'];
       $updated=substr($updated_date,0,15);

      

     //echo $image=$row['image'];
 
                
              
          
  
$AllStudents= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$full_name}</td>
                <td>{$gender}</td>
                <td>{$admission_number}</td>
                <td>{$class}</td>
                <td>{$stream}</td>
                <td>{$yearOfAdmission}</td> 
                <td>{$date_added}</td> 
                <td>{$updated}</td>
               <td><img src="./images/{$rows['profile_photo']}" width="70" height="70">
               </td>
               
              <td>
                  <a href="update_students.php?s_id={$rows['s_id']}"><span class="btn btn-warning btn-xs">Edit</span></a>
                  <a href="manage_students.php?del={$rows['s_id']}" onClick='return Delete();'><span class="btn btn-danger btn-xs">Del</span></a>
               </td>

               </tr>
    
           
heredoc;

echo $AllStudents;

}


}

//function to delete student details account...
function delete_student_account(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_student_id=$_GET['del'];

    $sql_query="Delete FROM `students` WHERE s_id='$delete_student_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Student details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}

//function preview ad_details
function previewAdDetails(){

if(isset($_GET['ad_id'])){
  $adId=$_GET['ad_id'];

  $sql_query="SELECT * FROM ads WHERE ad_id='$adId'";
  $result=query($sql_query);
  $rows=fetch_array($result);

      $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $title=substr($ad_title,0,5);
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];
      $date=substr($date_added,0,5);

      $ad_status=$rows['ad_status'];

      if($ad_status===1){
        $status="<a href='preview_details.php?ad_id={$rows['ad_id']}'><span class='btn btn-warning disabled'>Publish Ad</span></a>";
      }



$preview=<<<heredoc



<div class="row">

    <div class="col-md-7">
      <div class="thumbnail">
       <img class="img-responsive" src="../accounts/images/{$rows['ad_images']}" alt="">
       </div>
    </div>
    <!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">
   <!-- profile settings-->
    <div class="col-lg-4">
     <div class="panel panel-primary">
     <div class="panel-heading">
             <div class="col-md-7">
        <div class="page-header">
          <h4>{$rows['created_by']}.</h4>
        </div>
     </div>
     <div class="col-md8">
         <img src="images/m1.jpg" width="30%" class="img-circle">
     </div>
     
       <div class="panel-body">
           <table class="table table-condensed">
            
             <tbody>
                <tr>
                <th>Ad Title:</th>
                 <th>{$rows['ad_title']}.</th>
             </tr>
             <tr>
                <th>Ad Status:</th>
                 <th>{$rows['ad_status']}.</th>
             </tr>
               <tr>
                <th>Ad Category:</th>
                <th>{$rows['ad_category']}</th>
             </tr>
              <tr>
                <th>Posted On:</th>
                <th>{$rows['date_added']}.</th>
             </tr>
             <tr>
                <th>Ad Location:</th>
                <th>{$rows['ad_location']}.</th>
             </tr>
             <tr>
                <th>Ad Id:</th>
                <th>#{$rows['ad_code']}.</th>
             </tr>
             <tr>
                <th>Contact:</th>
                <th>{$rows['mobile_number']}.</th>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
  
     </div>
   </div>
   <div class="clearfix"></div>


</div><!--Row for Tab Panel-->

    <div class="col-md-12">

        <div class="thumbnail" style="padding: 10px;
margin: 10px;">
         

    <div class="caption-full" style="margin:8px;">
        <h4><a href="#">{$rows['ad_title']}</a> </h4>
        <hr>
        <h4 class="">Ad Price: Ksh{$rows['ad_price']}</h4>

          
        <p>{$rows['ad_description']}</p>

   
    <form action="#">
        <div class="form-group">
            
              <td>
                  <a href="publish_preview_details.php?ad_id={$rows['ad_id']}"><span class="btn btn-success">Publish Ad</span></a>
            </td>


             <td>
                  <a href="draft_preview_details.php?ad_id={$rows['ad_id']}"><span class="btn btn-danger">Draft Ad</span></a>
            </td>
        </div>
    </form>

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


heredoc;

echo $preview;

}



}


//function preview newly posted ads
//function preview ad_details
function previewDraftAd(){

if(isset($_GET['ad_id'])){
  $adId=$_GET['ad_id'];

  $sql_query="SELECT * FROM ads WHERE ad_id='$adId'";
  $result=query($sql_query);
  $rows=fetch_array($result);

      $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $title=substr($ad_title,0,5);
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];
      $date=substr($date_added,0,5);


$previewdraft=<<<heredoc



<div class="row">

    <div class="col-md-7">
      <div class="thumbnail">
       <img class="img-responsive" src="../accounts/images/{$rows['ad_images']}" alt="">
       </div>
    </div>
    <!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">
   <!-- profile settings-->
    <div class="col-lg-4">
     <div class="panel panel-primary">
     <div class="panel-heading">
             <div class="col-md-7">
        <div class="page-header">
          <h4>{$rows['created_by']}.</h4>
        </div>
     </div>
     <div class="col-md8">
         <img src="images/m1.jpg" width="30%" class="img-circle">
     </div>
     
       <div class="panel-body">
           <table class="table table-condensed">
            
             <tbody>
                <tr>
                <th>Ad Title:</th>
                 <th>{$rows['ad_title']}.</th>
             </tr>
             <tr>
                <th>Ad Status:</th>
                 <th>{$rows['ad_status']}.</th>
             </tr>
               <tr>
                <th>Ad Category:</th>
                <th>{$rows['ad_category']}</th>
             </tr>
              <tr>
                <th>Posted On:</th>
                <th>{$rows['date_added']}.</th>
             </tr>
             <tr>
                <th>Ad Location:</th>
                <th>{$rows['ad_location']}.</th>
             </tr>
             <tr>
                <th>Ad Id:</th>
                <th>#{$rows['ad_code']}.</th>
             </tr>
             <tr>
                <th>Contact:</th>
                <th>{$rows['mobile_number']}.</th>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
  
     </div>
   </div>
   <div class="clearfix"></div>


</div><!--Row for Tab Panel-->

    <div class="col-md-12">

        <div class="thumbnail" style="padding: 10px;
margin: 10px;">
         

    <div class="caption-full" style="margin:8px;">
        <h4><a href="#">{$rows['ad_title']}</a> </h4>
        <hr>
        <h4 class="">Ad Price: Ksh{$rows['ad_price']}</h4>

          
        <p>{$rows['ad_description']}</p>

   <br />
    <form action="#">
        <div class="form-group">
            
             <td>
                  <a href="publish_ad.php?ad_id={$rows['ad_id']}"><span class="btn btn-success">Publish Ad</span></a>
            </td>


             <td>
                  <a href="draft_ad.php?ad_id={$rows['ad_id']}"><span class="btn btn-danger">Draft Ad</span></a>
            </td>
             <td>
                  <a href="edit_ad.php?ad_id={$rows['ad_id']}"><span class="btn btn-warning">Edit Ad</span></a>
            </td>
             
        </div>
    </form>

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


heredoc;

echo $previewdraft;

}



}




//get all exams...
function getExams(){

    $sql_query="SELECT * FROM exams";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $type=$rows['type'];
       $exam_code=$rows['exam_code'];
       $max_mark=$rows['max_mark'];
       $date_added=$rows['date_added'];
    


     //echo $image=$row['image'];
 
                
              
          
  

$AllExams= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$type}</td>
                <td>{$exam_code}</td>
                <td>{$max_mark}</td>
                <td>{$date_added}</td>
                <td>
                <a href="update_exams.php?exam_id={$rows['exam_id']}"><span class="btn btn-warning btn-sm">Edit</span></a>
                <a href="exams.php?del={$rows['exam_id']}" onClick='return Delete();'><span class="btn btn-danger btn-sm">Delete</span></a>
               </td>

               </tr>
    
           
heredoc;

echo $AllExams;

}


}
//function to delete exam's details...
function delete_exam_details(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_exam_id=$_GET['del'];

     $sql_query="Delete FROM `exams` WHERE exam_id='$delete_exam_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Exams details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}

//function to update exams.
function update_exams(){
$errors=[];
$minimum_char=5;

if(isset($_GET['exam_id'])){
   $exam_id=clean($_GET['exam_id']);
   $sql_query="SELECT * FROM exams WHERE exam_id='$exam_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $type=$rows['type'];
      $exam_code=$rows['exam_code'];
      $max_mark=$rows['max_mark'];


$editTeachers=<<<heredoc
  
            <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Exam Details</legend>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="stream name"><span>Exam Type</span></label>
                                <input id="examtype" name="type" type="text" value="{$rows['type']}" placeholder="Exam type i.e CAT" class="form-control" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="exam code"><span>Exam Code.</span></label>
                                <input id="exam_code" name="exam_code" type="text"  value="{$rows['exam_code']}" placeholder="Exam code" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="max mark"><span>Max mark.</span></label>
                                <input id="max_mark" name="max_mark" type="text"  value="{$rows['max_mark']}" placeholder="Max mark" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Save</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
heredoc;
echo $editTeachers;
   }
}
}

//function to insert exam updates....
function insert_exam_details(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $exam_id=clean($_GET['exam_id']);
    $type=clean($_POST['type']);
    $exam_code=clean($_POST['exam_code']);
    $max_mark=clean($_POST['max_mark']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_added;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($type)){

      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Exam type field cannot be empty.</p>");

     }elseif(empty($exam_code)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Exam code cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($max_mark)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Max mark field cannot be empty.</p>");

      //redirect("update_profile.php");
    }else{
      $sql_query="UPDATE `exams` SET type='$type',exam_code='$exam_code',max_mark='$max_mark',date_added='$date_added' WHERE exam_id='$exam_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Exam details updated successfully. Go 
          <a href='exams.php'>back</a></p>");
            //redirect("update_class.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Exam details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}


//function to get all teachers
function getAllTeachers(){
     $sql_query="SELECT * FROM `teachers`";
     $result=query($sql_query);
     $count=0;
     //$t=mysqli_num_rows($result);
     while($rows=fetch_array($result)){
      $count++;
       $fullname=$rows['fullname'];
       $username=$rows['username'];
       $tsc_no =$rows['tsc_no'];
       $profile_photo =$rows['profile_photo'];
       $date_added=$rows['date_added'];

          
$AllTeachers=<<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$fullname}</td>
                <td>{$username}</td>
                <td>{$tsc_no}</td>
                <td><img src="./images/{$rows['profile_photo']}" width="90" height="80">
               </td>
                <td>{$date_added}</td>               
               <td>
                    <a href="edit_teachers.php?t_id={$rows['t_id']}" ><span  class="btn btn-warning btn-xs">Edit</span>
                    <a href="manage_teachers.php?del={$rows['t_id']}" onClick='return Delete("Are you sure you want to delete?");'><span  class="btn btn-danger btn-xs">Delete</span>
                </td>
               </tr>
    
           
heredoc;

echo $AllTeachers;

     
     //echo $image=$row['image'];
 
                

}


}
//function udate teachers details....
function udate_teachers(){
$errors=[];
$minimum_char=5;

if(isset($_GET['t_id'])){
   $t_id=clean($_GET['t_id']);
   $sql_query="SELECT * FROM `teachers` where t_id='$t_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $fullname=$rows['fullname'];

      //$lastname=$rows['lastname'];

$editTeachers=<<<heredoc
   <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Teacher's Account Information.</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                               <label for="fullname"><span>First name</span></label>
                                <input id="firstname" value="{$rows['fullname']}" name="fullname" type="text" placeholder="Fisrt Name" class="form-control" required>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="username"><span>Username</span></label>
                                <input id="username" value="{$rows['username']}" name="username" type="text" placeholder="Username" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Current Profile Photo.</span></label>
                                <td class="text-center">
                                <img src="./images/{$rows['profile_photo']}" width="200" height="150">
                                </td>

                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="p_photo"><span>Choose another Profile Photo</span></label>
                                <input id="p_photo" type="file" name="profile_photo"  placeholder="Profile photo" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="update">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

heredoc;
echo $editTeachers;
   }
}
}
//function to insert teachers update....
function insertTeachersUpdates(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['update'])){
   //$admin=clean($_SESSION["UserAdmin"]);
  
    $t_id=clean($_GET['t_id']);
    $fullname=clean($_POST['fullname']);
    //$lastname=clean($_POST['lastname']);
    $username=clean($_POST['username']);
    //$subject_taught=clean($_POST['subject_taught']);
    //$tsc_no=clean($_POST['tsc_no']);
    //$stream=clean($_POST['stream']);
    //$profile_photo=clean($_POST['profile_photo']);
    //$stream=clean($_POST['stream']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_added;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($fullname)){
      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>fullname cannot be empty.</p>");

     }elseif(empty($username)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>username cannot be empty.</p>");

      //redirect("update_profile.php");
    }else{
      $sql_query="UPDATE `teachers` SET fullname='$fullname',username='$username',date_added='$date_added' WHERE t_id='$t_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Teacher details updated successfully. Go <a href='manage_teachers.php'>Back</a></p>");
            //redirect("manage_teachers.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Teacher's details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}


//function to delete teachers account...
function delete_teacher_account(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_teachers_id=$_GET['del'];

     $sql_query="Delete FROM `teachers` WHERE t_id='$delete_teachers_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Teacher's account deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}

//get all terms.
function getAllTerms(){                         


    $sql_query="SELECT * FROM terms";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $term_id=$rows['term_id'];
       $name=$rows['name'];
       $year=$rows['year'];
       $date_added=$rows['date_added'];
      //$date=substr($date_added,0,5);


     //echo $image=$row['image'];
 
                
              
          
  

$AllTerms= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$name}</td>
                <td>{$year}</td>
                <td>{$date_added}</td>               
               <td>
               <a href="update_terms.php?term_id={$rows['term_id']}"><span  class="btn btn-warning btn-sm">Edit</span>
               <a href="manage_terms.php?del={$rows['term_id']}" onClick='return Delete();'><span  class="btn btn-danger btn-sm">Delete</span>
               </td>
               </tr>
    
           
heredoc;

echo $AllTerms;

}


}


//get all subjects
function getAllSubjects(){                         


    $sql_query="SELECT * FROM `subject`";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $sub_id=$rows['sub_id'];
       $sub_name=$rows['sub_name'];
       $sub_code=$rows['sub_code'];
       $date_added=$rows['date_added'];
       $date_updated=$rows['updated_date'];
      //$date=substr($date_added,0,5);


     //echo $image=$row['image'];
 
                
              
          
  

$AllTerms= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$sub_name}</td>
                <td>{$sub_code}</td>
                <td>{$date_added}</td>
                <td>{$date_updated}</td>               
               <td>
               <a href="update_subjects.php?sub_id={$rows['sub_id']}"><span  class="btn btn-warning btn-sm">Edit</span>
               <a href="manage_subjects.php?del={$rows['sub_id']}" onClick='return Delete();'><span  class="btn btn-danger btn-sm">Delete</span>
               </td>
               </tr>
    
           
heredoc;

echo $AllTerms;

}


}


//get all subjects combination
function getAllSubjectCombination(){                         


    $sql_query="SELECT teachers.t_id,teachers.fullname,teachers.tsc_no,class.class_abbr,class.streams,subject.sub_name,subject.sub_code,subjectcombination.c_id, subjectcombination.date_added from subjectcombination join class on class.class_id=subjectcombination.class_id  join subject on subject.sub_id=subjectcombination.subject_id join teachers on teachers.t_id=subjectcombination.assigned_teacher_id";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $c_id=$rows['c_id'];
       
       $date_added=$rows['date_added'];
       $class=$rows['class_abbr'];
       $stream=$rows['streams'];
       $subject=$rows['sub_name'];
       $sub_code=$rows['sub_code'];
       $teacher=$rows['fullname'];
       $tsc=$rows['tsc_no'];
      //$date=substr($date_added,0,5);


     //echo $image=$row['image'];
 
                
              
          
  

$AllTerms= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$class}</td>
                <td>{$stream}</td>
                <td>{$subject}</td>
                <td>{$sub_code}</td>
                <td>{$teacher}</td>
                <td>{$tsc}</td>
                <td>{$date_added}</td>              
               <td>
               <a href="update_subjects.php?c_id={$rows['c_id']}"><span  class="btn btn-warning btn-sm">Edit</span>
               <a href="manage_subject_combination.php?del={$rows['c_id']}" onClick='return Delete();'><span  class="btn btn-danger btn-sm">Delete</span>
               </td>
               </tr>
    
           
heredoc;

echo $AllTerms;

}


}

//function to delete subject combination details...
function delete_subject_combination(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_id=$_GET['del'];

     $sql_query="Delete FROM `subjectcombination` WHERE c_id='$delete_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Subject combination details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}





//get all declared results...
function getAllDeclaredResults(){                         


    $sql_query="SELECT DISTINCT class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,postingDate from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       //$c_id=$rows['c_id']; 
       //$date_added=$rows['date_added'];
      $s_id=$rows['s_id'];
       $class=$rows['class_abbr'];
       $stream=$rows['streams'];
       $fullname=$rows['fullname'];
       $adm_no=$rows['adm_no'];
       $posting_date=$rows['postingDate'];
      //$date=substr($date_added,0,5);


     //echo $image=$row['image'];
 
                
              
          
  

$AllTerms= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$class}</td>
                <td>{$stream}</td>
                <td>{$fullname}</td>
                <td>{$adm_no}</td>
                <td>{$posting_date}</td>              
               <td>
               <a href="results_report.php?adm={$rows['adm_no']}"><span  class="btn btn-warning btn-sm">View Results</span>
               <a href="manage_results.php?del={$rows['s_id']}" onClick='return Delete();'><span  class="btn btn-danger btn-sm">Delete</span>
               </td>
               </tr>
    
           
heredoc;

echo $AllTerms;

}


}




//function to delete subject combination details...
function delete_added_results(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_id=$_GET['del'];

     $sql_query="Delete FROM `tblresult` WHERE s_id='$delete_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Results details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}




//function to update subjects.
function update_subjects(){
$errors=[];
$minimum_char=5;

if(isset($_GET['sub_id'])){
   $sub_id=clean($_GET['sub_id']);
   $sql_query="SELECT * FROM `subject` WHERE sub_id='$sub_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $sub_name=$rows['sub_name'];
      $sub_code=$rows['sub_code'];
      //$max_mark=$rows['max_mark'];


$editSubjects=<<<heredoc
    <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Subject Details</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                                 <label for="term"><span>Subject name</span></label>
                                <input id="sub_name" name="sub_name" value="{$rows['sub_name']}" type="text" placeholder="Subject Name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="stream"><span>Subject code</span></label>
                                <input id="sub_code" name="sub_code" value="{$rows['sub_code']}" type="text" placeholder="Subject code" class="form-control" required>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Save</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
             
heredoc;
echo $editSubjects;
   }
}
}

//function to insert subject updates....
function insert_subject_updates(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $sub_id=clean($_GET['sub_id']);
    $sub_name=clean($_POST['sub_name']);
    $sub_code=clean($_POST['sub_code']);
    //$max_mark=clean($_POST['max_mark']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_updated=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_updated;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($sub_name)){

      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Subject name field cannot be empty.</p>");

     }elseif(empty($sub_code)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Subject code field cannot be empty.</p>");

      //redirect("update_profile.php");
    }else{
      $sql_query="UPDATE `subject` SET sub_name='$sub_name',sub_code='$sub_code',updated_date='$date_updated' WHERE sub_id='$sub_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Subject details updated successfully. Go 
          <a href='manage_subjects.php'>Back</a></p>");
            //redirect("update_class.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Subject details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}

//function to delete subject details...
function delete_subject_details(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_subject_id=$_GET['del'];

     $sql_query="Delete FROM `subject` WHERE sub_id='$delete_subject_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Subject details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}



//function to delete term's details...
function delete_term_details(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_term_id=$_GET['del'];

     $sql_query="Delete FROM `terms` WHERE term_id='$delete_term_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Term details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}


//function to update terms.
function update_terms(){
$errors=[];
$minimum_char=5;

if(isset($_GET['term_id'])){
   $term_id=clean($_GET['term_id']);
   $sql_query="SELECT * FROM terms WHERE term_id='$term_id'";
   $result=query($sql_query);

   while($rows=fetch_array($result)){
      $name=$rows['name'];
      $year=$rows['year'];
      //$max_mark=$rows['max_mark'];


$editTerms=<<<heredoc
  
             <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update term details</legend>
                       
                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                                 <label for="term"><span>Term name</span></label>
                                <input id="term_name" name="name" type="text" placeholder="Term name" value="{$rows['name']}" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                                <label for="stream"><span>Term year</span></label>
                                <input id="term_year" name="year" type="text" placeholder="Term year" value="{$rows['year']}" class="form-control" required>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Save</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
heredoc;
echo $editTerms;
   }
}
}
//function to insert exam updates....
function insert_term_details(){
  global $conn;
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $term_id=clean($_GET['term_id']);
    $name=clean($_POST['name']);
    $year=clean($_POST['year']);
    //$max_mark=clean($_POST['max_mark']);
    date_default_timezone_set("AFRICA/NAIROBI");
    $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
    $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
    $date_added;
    
     //$profile_photo=$_FILES["profile_photo"]["name"];
   // $target="images/".basename($_FILES["profile_photo"]["name"]);


  


    if(empty($name)){

      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Term name field cannot be empty.</p>");

     }elseif(empty($year)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Term year field cannot be empty.</p>");

      //redirect("update_profile.php");
    }else{
      $sql_query="UPDATE `terms` SET name='$name',year='$year',date_added='$date_added' WHERE term_id='$term_id'";
    
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Term details updated successfully. Go 
          <a href='manage_terms.php'>back</a></p>");
            //redirect("update_class.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Term details could not be updated, please try again</p>");
         die(mysqli_error($conn)); 
        }

}
}
}
}


//get all drafted ads.
function getAllClasses(){

    $sql_query="SELECT * FROM class";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $class_abbr=$rows['class_abbr'];
       $streams=$rows['streams'];
       $class_teacher=$rows['class_teacher'];
       $date_added=$rows['date_added'];
      //$date=substr($date_added,0,5);


     //echo $image=$row['image'];
 
                
              
          
  

$AllClasses= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$class_abbr}</td>
                <td>{$streams}</td>
                <td>{$class_teacher}</td>
                <td>{$date_added}</td>               
               <td>
                <a href="update_class.php?class_id={$rows['class_id']}"><span  class="btn btn-warning btn-sm">Edit</span>

                <a href="newly_posted.php?del={$rows['class_id']}"onClick='return Delete("Are you sure you want to delete?");'><span  class="btn btn-danger btn-sm">Delete</span>
               </td>
               </tr>
    
           
heredoc;

echo $AllClasses;

}


}
//function to delete class details...
function delete_class_account(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_class_id=$_GET['del'];

     $sql_query="Delete FROM `class` WHERE class_id='$delete_class_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Class details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}

//get all users.
function getAllStreams(){

    $sql_query="SELECT * FROM streams";
     $result=query($sql_query);
     $count=0;
     while($rows=fetch_array($result)){
      $count++;
       $stream_id=$rows['stream_id'];
       $stream_name=$rows['stream_name'];
       $date_added=$rows['date_added'];
        
          
  

$AllStreams= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$stream_name}</td>
                <td>{$date_added}</td>
               <td>
               <a href="update_streams.php?stream_id={$rows['stream_id']}"><span class="btn btn-warning btn-sm">Edit</span>

               <a href="manage_streams.php?del={$rows['stream_id']}" onClick='return Delete("Are you sure you want to delete?");'><span class="btn btn-danger btn-sm">Delete</span>
               </td>
               </tr>
    
                </tr>
    
           
heredoc;

echo $AllStreams;

}


}


//function to delete stream details...
function delete_stream_account(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
   if(isset($_GET['del'])){   
    $delete_stream_id=$_GET['del'];

     $sql_query="Delete FROM `streams` WHERE stream_id='$delete_stream_id'";
     
     $result=query($sql_query);

      if(($result)){

         echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Stream details deleted successfully</p>";

         

     }else{
      //echo $errors[]="<p class='alert alert-success alert-dismissible' role='alert' style='font-size:16px;'>Ad not deleted, try again</p>";
      global $conn;
      echo mysqli_error($conn);
         
     }



}

}
}



//function to fetch ads that are associated with Furnished and holiday rentals
function getCatsAds(){

    $sql_query="SELECT * FROM ads WHERE ad_status='published' AND ad_category='furnished and holiday rentals.'";
     $result=query($sql_query);
     while($rows=fetch_array($result)){
       $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];

     //echo $image=$row['image'];
 
                
              
          
  

$ads= <<<heredoc

    
            <!--small col one-->
           <a href="listAll.php?cat={$ad_category}">
          <div class="col-md-3 col-sm-6">
            <div class="img-box">
              
                <img src="accounts/images/{$rows['ad_images']} "class="img-responsive"  alt="Danly Properties">
              </a>
            </div>
          </div>
          </a>
          <!--end small col one-->



        
  

heredoc;

echo $ads;

}


}








//function to fetch ads that are associated with Office,shops and commercial categories.
function getCatsAds2(){

    $sql_query="SELECT * FROM ads WHERE ad_status='published' AND ad_category='Office,shops and commercial.'";
     $result=query($sql_query);
     while($rows=fetch_array($result)){
       $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];

     //echo $image=$row['image'];
 
                
              
          
  

$ads= <<<heredoc

    
         <a href="listAll.php?cat={$ad_category}">
           <div class="owl-items text-center">
                <img src="accounts/images/{$rows['ad_images']}" alt="Danly Properties" class="img-responsive" style="">
              </div>  
          </a>    

        
  

heredoc;

echo $ads;

}


}



//function to fetch ads that are associated with Land and plots categories.
function getCatsAds3(){

    $sql_query="SELECT * FROM ads WHERE ad_status='published' AND ad_category='Office,shops and commercial.'";
     $result=query($sql_query);
     while($rows=fetch_array($result)){
       $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'],0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];

     //echo $image=$row['image'];
 
                
              
          
  

$ads= <<<heredoc
            <a href="listAll.php?cat={$ad_category}">
            <div class="owl-items text-center">
                <img src="accounts/images/{$rows['ad_images']}" alt="Danly Properties" class="img-responsive" style="display: inline;">
              </div>
            </a>  
        
  

heredoc;

echo $ads;

}


}




//function to get the details of the clicked photos.
function fetchAdsDetails(){

   if($_SERVER['REQUEST_METHOD']=="GET"){
   if(isset($_GET['cat'])){
    $cat=clean($_GET['cat']);
    $sql_query="SELECT * FROM ads WHERE ad_category='$cat' AND ad_status='published'";
     $result=query($sql_query);   
     while($rows=fetch_array($result)){
       $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'], 0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];



$adsDetails=<<<heredocs


<li class="cat-styling">
                    <a href="details.php?id={$rows['ad_id']}">
                        <figure class="imaging">
                            <div class="inner-imaging">
                            <img class="top-tourist-img" src="accounts/images/{$rows['ad_images']}" alt="Nairobi" class="img-responsive" style="height:140px; width:270px;" >
                            </div>    
                        </figure>
                     
                    <div class="outer-imaging" style="">
                        <label>Posted on:{$rows['date_added']}</label>
                        <p class="p">KSh {$rows['ad_price']}</p><br />
                        <p class="d">{$rows['ad_description']}</p>
                      </div>
                    </a>    
                    
</li> 
                  
heredocs;

echo $adsDetails;

}
}
}

}


//function to get the details of the clicked categories on the breadcrumb.
function fetchAdsDetails2(){

   if($_SERVER['REQUEST_METHOD']=="GET"){
   if(isset($_GET['cat'])){
    $cat=clean($_GET['cat']);
    $sql_query="SELECT * FROM ads WHERE ad_category='$cat' AND ad_status='published'";
     $result=query($sql_query);
     $total_cats=mysqli_num_rows($result);
     if($total_cats <1){
       echo $no="<span style='font-size:18px; font-weight:300;'>Sorry, no results found on this category</span>";
     }else{

        $rows=fetch_array($result);
       $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $created_by =$rows['created_by'];
       $ad_description=substr($rows['ad_description'], 0,20);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];

     
     


$adCats=<<<heredocs


 <p class="top-headings">{$total_cats} Search results found on {$rows['ad_category']}</p>
                  
heredocs;

echo $adCats;

}
}
}
}
//function to fetch ads categories.
function getAdsCategories(){
if($_SERVER['REQUEST_METHOD']=="GET"){
   if(isset($_GET['cat'])){
    $cat=clean($_GET['cat']);
    $sql_query="SELECT * FROM categories";
    $result=query($sql_query);
     //$total_cats=mysqli_num_rows($result);
     //$rows=fetch_array($result);
    while($rows=fetch_array($result)){
     
     $ad_category=$rows['ad_category']; 
     $cat_id=$rows['cat_id']; 




$adsCategories= <<<heredoc


        <li class="init-h-4">
          <a class="init-h4" href="listAll.php?cat={$ad_category}">{$rows['ad_category']}
          </a>
        </li>
  

heredoc;

echo $adsCategories;

}
}

}
}





//function to get the details of the clicked categories on top most section on index.php
function fetchAdsDetail(){

  
    $sql_query="SELECT * FROM categories";
     $result=query($sql_query);
     $total_cats=mysqli_num_rows($result);
      $rows=fetch_array($result);
         
     $ad_category=$rows['ad_category']; 
     $cat_id=$rows['cat_id']; 

     
     


$topadCats=<<<heredocs


                 <div class="cat-listing">
                <div class="cat-list col-md-3">
                    <a href="listAll.php?cat={$ad_category}">
                     <img src="images/tour-section/img12.JPG" class="img-responsive">
                    <div class="hover-overlay">
                        <div class="hover-content">
                            <p>FIND YOUR <BR /><BR />DREAM<BR /><BR /> HOME 
                           </p>
                        </div>
                      </div>
                    </a>    
                </div>
                <div class="cat-list col-md-3">
                    <a href="listAll.php?cat={$ad_category}">
                   <img src="images/tour-section/house3.jpg" class="img-responsive">
                   <div class="hover-overlay">
                        <div class="hover-content">
                            <p>POST YOUR <BR /><BR />AD</p>
                            
                       </div>
                      </div>
                    </a>    
                </div>
                <div class="cat-list col-md-3">
                      <a href="listAll.php?cat={$ad_category}">
                       <img src="images/tour-section/img13.jpg" class="img-responsive">
                      <div class="hover-overlay">
                        <div class="hover-content">
                            <p>GET A <BR /><BR />LAND HERE</p>
                          </div>
                      </div>
                    </a>      
                </div>
                 <div class="cat-list col-md-3">
                   <a href="listAll.php?cat={$ad_category}">
                   <img src="images/tour-section/full-bg-7.jpg" class="img-responsive">
                   <div class="hover-overlay">
                        <div class="hover-content">
                            <p>SELL YOUR <BR /><BR />PROPERTY<BR /><BR />
                            HERE</p>
                      </div>
                </div>
              </a>       
            </div>        
        </div>


                  
heredocs;

echo $topadCats;

}






//function to call the ads on the front-end

function get_admin_posts(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM ads WHERE created_by='$_SESSION[username]'";
     
     $result=query($sql_query);
     //confirm($result);
     //$count=0;
     //$row=fetch_array($result);
     while($row=mysqli_fetch_assoc($result)){


   
       $ad_images=$row['ad_images'];
        

  

$profile= <<<heredoc

    <div class="panel panel-default">
     <div class="panel-heading">
     <div class="col-md-3">
         <img src="../accounts/images/{$row['ad_images']}" width="100%" class="img-thumbnail">
     </div>
        <div class="col-md-7">
       
        <p>Price: <i class="glyphicon glyphicon-heart"></i>{$row['ad_price']}</p>
        <p>Posted On:<i class="glyphicon glyphicon-phone"></i> {$row['date_added']}</p>
        <p>Ad description: <i class="glyphicon glyphicon-envelope"></i> {$row['ad_description']}</p>
        
         <td>
        <a href="edit_ur_ad.php?ad_id={$row['ad_id']}"><span class="btn btn-primary btn-md" style="width:30%;">Edit.</span></a>
        </td>
        <td>
        <a href="delete_ur_ad.php?ad_id={$row['ad_id']}"><span class="btn btn-danger btn-md" style="width:30%;">Delete.</span></a>
        </td>
     </div>
      <div class="clearfix"></div>
     </div>
  </div>

heredoc;

echo $profile;
}


}

}


//function to get the drafted posts

function get_user_drafted_posts(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM ads WHERE created_by='$_SESSION[email]' AND ad_status='draft'";
   
     
     $result=query($sql_query);
     //$total_counts=mysqli_num_rows($result);
     //confirm($result);
     //$count=0;
     //$row=fetch_array($result);
     while($row=mysqli_fetch_assoc($result)){


   
       $ad_images=$row['ad_images'];
        

$profile= <<<heredoc

    <div class="panel panel-primary">
     <div class="panel-heading">
     <div class="col-md-3">
         <img src="images/{$row['ad_images']}" class="img-thumbnail" style="height:200px; width:300px;">
     </div>
        <div class="col-md-7">
       
        <p>Price: <i class="glyphicon glyphicon-heart"></i>{$row['ad_price']}</p>
        <p>Posted On:<i class="glyphicon glyphicon-phone"></i> {$row['date_added']}</p>
        <p>Ad description: <i class="glyphicon glyphicon-envelope"></i> {$row['ad_description']}</p>
     </div>
      <div class="clearfix"></div>
     </div>
  </div>

heredoc;

echo $profile;
}


}

}








//validate if user is login when they click create ad button./////
function postad(){
  if($_SERVER['REQUEST_METHOD']=="GET"){
    
    if(isset($_GET['createAd'])){

      if(logged_in()){

        redirect("accounts/index.php");

      }else{

        redirect("user_login.php");

      }

     
    }else{
      echo "something is wrong";
    }
}

}

function activate_user(){
  if($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['username'])){
       $email=clean($_GET['username']);
       $validation_code=clean($_GET['code']);

       $sql="SELECT user_id FROM `users` WHERE email='".escape($_GET['email'])."' AND validation_code='".escape($_GET['code'])."'";
       $result=query($sql);
       confirm($result);

        if(row_count($result)==1){
          $sql2="UPDATE `users` SET active=1, validation_code=0 WHERE email='".escape($email)."' AND validation_code='".escape($validation_code)."'";
          $result2=query($sql2);
       confirm($result2);

        set_messages("<p class='bg-success'>Your account has been activated successfully, please login.</p>");

        redirect("user_login.php");


        }else{
          set_messages("<p class='bg-danger'>Sorry,Your account could not be activated.</p>");

        redirect("user_login.php");
        }

    }

  }
}
// user login validation function.....
function validate_admin_login(){
     $errors=[];
     

    if($_SERVER['REQUEST_METHOD']=="POST"){

      $username=clean($_POST['email']);
      $password=clean($_POST['password']);
     

      if(empty($username)){
        $errors[]="<span style='font-size:16px;'>Username field cannot be empty</span>";
      }
      if(empty($password)){
        $errors[]="<span style='font-size:16px;'>Password field cannot be empty<span>";
      }

        
       if(!empty($errors)){
        foreach ($errors as $error) {
        
         echo display_validation_errors($error); 

        }
            
        }else{

            if(admin_login($username,$password)){

              redirect("index.php");

            }else{

              echo $errors[]="<p class='alert alert-danger alert-dismissible' role='alert' style='font-size:16px;'>Your username or password not correct.</p>";
            }
       }




     }
}



//user login function

function admin_login($username,$password){

  $sql="SELECT password,admin_id FROM `admins` WHERE email='".escape($username)."'";
  $result=query($sql);

  if(row_count($result) == 1){
   
   $row=fetch_array($result);
   $db_password=$row['password'];
   
   if(md5($password)==$db_password){
   
    $_SESSION['email']=$username;


      return true;

   }else{
    //echo "passwords dont match";
    return false; 

   }


    return true;
  }else{

   return false;
  }

  

 }



///function to keep us logged in


 function logged_in(){

  if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
    return true;
  }else{
    return false;
  }



 }


// function to recover the password--------
 function recover_password(){
 
  if($_SERVER['REQUEST_METHOD']=="POST"){

 if(isset($_POST['cancel_submit'])){
      redirect("user_login.php");

      //echo "is set";

   
    }
    if(isset($_SESSION['token']) && $_POST['token']===$_SESSION['token']){
      
        $email=clean($_POST['email']);

        if(email_exists($email)){

            //generate the token
            $validation_code=md5($email + microtime());

            //setting the cookie so that our code.php page is not always at disposal.

            setcookie('temp_access_code',$validation_code,time()+900);

            $sql="UPDATE `users` SET validation_code='".escape($validation_code)."' WHERE email='".escape($email)."'";
            $result=query($sql);
            confirm($result);
        
            $subject="Please reset ypour password";
            $message="Hello, here is your passwords reset code {$validation_code}, click the link below to reset your password http://localhost/code.php?email=$email&code=$validation_code";

            $headers="From: noreply@my_website.com";

            if(!send_email($email,$subject,$message,$headers)){

               echo $errors[]="<p class='alert alert-danger alert-dismissible' role='alert'>sorry, email could not be send.</p>";

            }

            //set_messages("<p class='bg-success text-center'></p>");
        set_messages("<p class='well' style='background:navy; color:#fff; font-size:16px;'>Please check your email or spam folder for your password reset code..</p>");


            redirect("check_email.php");
          

        }else{

          echo $errors[]="<p class='alert  alert-danger alert-dismissible' role='alert'>That email does'nt exists.</p>";
        }


//if the token is not set, redirect the user to the index.php page.........
  }else{

      redirect("index.php");

  }



 }



}

//=====password reset code validation function======
function code_validation(){

    if(isset($_COOKIE['temp_access_code'])){  

        if(!isset($_GET['email']) && !isset($_GET['code'])){

         // redirect("index.php");
          echo "not set";

        }else if(empty($_GET['email']) || empty($_GET['code'])){

            //redirect("index.php");
            echo"Something went wrong";

        }else{

          if(isset($_POST['code'])){
            //echo"Getting the post from the form";
            $email=clean($_GET['email']);
            $validation_code=clean($_POST['code']);
            $sql="SELECT user_id FROM `users` WHERE validation_code='".escape($validation_code)."' AND email='".escape($email)."'";
            $result=query($sql);
            // confirm($result);
            if(row_count($result)==1){
               setcookie('temp_access_code',$validation_code,time()+300);
              redirect("reset.php?email=$email&code=$validation_code");
            }else{

              echo $errors[]="<p class='alert alert-danger alert-dismissible' role='alert'>Sorry, wrong validation code.</p>";

            }

          }
        }

    }else{
     echo "sorry your cookie has expired";
      redirect("recover.php");

    }
}

//***************** function password reset *******************/

function reset_password(){
  
if(isset($_COOKIE['temp_access_code'])){ 

    if(isset($_GET['email']) && isset($_GET['code'])){

 if(isset($_SESSION['token']) && isset($_POST['token'])){

  if($_POST['token']===$_SESSION['token']){

    if($_POST['password']===$_POST['confirm_password']){
     $updated_password=md5($_POST['password']);

      $sql="UPDATE `users` SET password='".escape($updated_password)."',validation_code=0 WHERE email='".escape($_GET['email'])."'";
      query($sql);

       set_messages("<p class='well' style='background:navy; color:#fff; font-size:16px;'>Your password has been updated, please login</p>");

          redirect("user_login.php");

      }


}
      
    

      
  }

}
}else{

    set_messages("<p class='bg-danger text-center'>Your time has expired</p>");
    redirect("recover.php");



}


}



?>