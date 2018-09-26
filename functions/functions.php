

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

//function to delete subject combination details...
function delete_added_results(){

    if(isset($_SESSION['username']) || isset($_COOKIE['username']) ){
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


//get all declared results...
function getAllDeclaredResults(){                         


    $sql_query="SELECT DISTINCT subject.sub_id,subject.sub_name, teachers.t_id, teachers.username,teachers.fullname,class.class_abbr,class.streams,students.fullname,students.adm_no,students.date_added,students.s_id,postingDate,marks from tblresult join class on class.class_id=tblresult.class_id  join students on students.s_id=tblresult.s_id join teachers on teachers.username=tblresult.posted_by join subject on subject.sub_id=tblresult.sub_id where teachers.username='$_SESSION[username]'";
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
       $subject=$rows['sub_name'];
       $marks=$rows['marks'];
      //$date=substr($date_added,0,5);


     //echo $image=$row['image'];
 
                
              
          
  

$AllTerms= <<<heredoc
       
           
               <tr> 
                <td>{$count}.</td>
                <td>{$class}</td>
                <td>{$stream}</td>
                <td>{$fullname}</td>
                <td>{$adm_no}</td>
                <td>{$subject}</td>
                <td>{$marks}</td>
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
      $gender=clean($_POST['gender']);
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

             if(register_user($first_name,$last_name,$email,$mobile_number,$password,$date_added,$gender)){

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

function register_user($first_name,$last_name,$email,$mobile_number,$password,$date_added,$gender){
      $first_name=escape($first_name);
      $last_name=escape($last_name);
      $email=escape($email);
      $gender=escape($gender);
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;
      $mobile_number=escape($mobile_number);
      $password=escape($password);

      if(email_exists($email)){
          return false;

    }else{
      $password=md5($password);
      $validation_code=md5($email + microtime());
      $sql="INSERT INTO `users`(first_name,last_name,email,mobile_number,password,validation_code,active,date_registered,gender)";
      $sql.= " VALUES('$first_name','$last_name','$email','$mobile_number','$password','$validation_code',0,'$date_added','$gender')";
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
function validateAdCreation(){
     $errors=[];
     $minimum_char=5;
    
 if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit'])){

      $ad_title=clean($_POST['ad_title']);
      $ad_price=clean($_POST['ad_price']);
      $ad_category=clean($_POST['ad_category']);
      $ad_location=clean($_POST['ad_location']);
      $mobile_number=clean($_POST['mobile_number']);
      $ad_description=clean($_POST['ad_description']);
      $date_added=clean($_POST['date_added']);
      $email=clean($_POST['created_by']);
      $ad_status=clean($_POST['ad_status']);
      $ad_code=clean($_POST['ad_code']);
      //$ad_photos=clean($_POST['ad_photos ']);
      $ad_photos=$_FILES["ad_images"]["name"];
      $target="images/".basename($_FILES["ad_images"]["name"]);

     

   if(strlen($ad_title) < $minimum_char){ 
        $errors[]="atleast {$minimum_char} characters are required in your ad title";
       }

  if(strlen($ad_description) < $minimum_char){ 
        $errors[]="Atleast {$minimum_char} characters are required in your description";
       }  

  
 if(!empty($errors)){
        foreach ($errors as $error) {
        
    echo display_validation_errors($error);
        }
}else{
  if(upload_ad($ad_title,$ad_price,$ad_category,$ad_location,$mobile_number,$ad_photos,$ad_description,$date_added,$email,$ad_status,$ad_code)){


    set_messages("<p class='bg-success text-center'>Upload Successful.</p>");

              redirect("createNewAdd.php");

  }else{

set_messages("<p class='bg-danger text-center'>Sorry, we could not upload your ad, try again.</p>");

  //redirect("createNewAdd.php");


  }
}
}
}
}


// function to insert upload the ad
function upload_ad($ad_title,$ad_price,$ad_category,$ad_location,$mobile_number,$ad_photos,$ad_description,$date_added,$email,$ad_status,$ad_code){
      
  if(isset($_SESSION['email']) || isset($_COOKIE['email'])){

    //$first_name=escape($first_name);
      $ad_title=escape($ad_title);
      $ad_price=escape($ad_price);
      $ad_category=escape($ad_category);
      $ad_location=escape($ad_location);
      $mobile_number=escape($mobile_number);
      $ad_photos=escape($ad_photos);
      $ad_description=escape($ad_description);
      $date_added=escape($date_added);
      $email=escape($email);
      $ad_status=escape($ad_status);
      $ad_code=escape($ad_code);
    
      $email=$_SESSION['email'];
      $ad_status="draft";
      $ad_code=(mt_rand(1000,9000));
      date_default_timezone_set("AFRICA/NAIROBI");
      $currentTime=time();
      //$dateTime=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
      $date_added=strftime("%B-%d-%Y %H:%M:%S",$currentTime);
      $date_added;
    
      $ad_photos=$_FILES["ad_images"]["name"];
      $target="images/".basename($_FILES["ad_images"]["name"]);


      if(move_uploaded_file($_FILES["ad_images"]["tmp_name"],$target)){
      
      $sql="INSERT INTO `ads`(ad_title,ad_price,ad_category,ad_location,mobile_number,ad_images,ad_description,date_added,created_by,ad_status,ad_code)";
      $sql.= "VALUES('$ad_title','$ad_price','$ad_category','$ad_location','$mobile_number','$ad_photos','$ad_description','$date_added','$email','$ad_status','$ad_code')";

      


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
    echo mysqli_error();
  }

  }else{
    return false;
  }


}

//get_user_details _for update

function update_user_ads(){
if(isset($_SESSION['email']) || isset($_COOKIE['email'])){  
 if(isset($_GET['ad_id'])){
    $ad_id=clean($_GET['ad_id']);
    $sql_query="SELECT * FROM ads WHERE ad_id='$ad_id' AND created_by='$_SESSION[email]'";
    $result=query($sql_query);
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


$updateAd= <<<heredoc

    

  
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
                                <input id="photos" type="file" name="ad_images"  placeholder="Photos" class="form-control" disabled>
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
                                <button type="submit" class="btn btn-primary btn-lg" name="submit-update">Save Changes</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
  

heredoc;

echo $updateAd;
}

}


}
}

//change ad images
//get_user_details _for update

function update_ad_images(){
if(isset($_SESSION['email']) || isset($_COOKIE['email'])){
 if(isset($_GET['ad_id'])){
    $ad_id=clean($_GET['ad_id']);
    $sql_query="SELECT * FROM ads WHERE ad_id='$ad_id' AND created_by='$_SESSION[email]'";
    $result=query($sql_query);
     //$count=0;
     while($rows=fetch_array($result)){
    $ad_images=$rows['ad_images'];

$updateAd= <<<heredoc

    

  
     <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Update Ad Image.</legend>
                    

                        

                        <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-picture bigicon"></i></span>
                            <div class="col-md-8">
                              <label for="mobile"><span>Current ad image</span></label>
                                <td class="text-center">
                                <img src="../accounts/images/{$rows['ad_images']}" width="350" height="250">
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

                          <input type="hidden" name="ad_code" />
                          <input type="hidden" name="date_added" />
                          <input type="hidden" name="created_by" />
                          <input type="hidden" name="ad_status" />
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit-update-image">Save Image</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
  

heredoc;

echo $updateAd;
}

}


}
}

//function to edit individual user ads
function edit(){
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit-update'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $ads_id=clean($_GET['ad_id']);
    $ad_title=clean($_POST['ad_title']);
    $ad_price=clean($_POST['ad_price']);
    $ad_category=clean($_POST['ad_category']);
    $ad_location=clean($_POST['ad_location']);
    $mobile_number=clean($_POST['mobile_number']);
    
  
    $ad_description=clean($_POST['ad_description']);

    if(empty($ad_title)){
      set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad title cannot be empty.</p>");

     }elseif(empty($ad_price)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad price cannot be empty.</p>");

     // redirect("update_profile.php");
    }elseif(empty($ad_category)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad category cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($mobile_number)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Phone number cannot be empty.</p>");

      //redirect("update_profile.php");
    }elseif(empty($ad_location)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad location cannot be empty.</p>");
    }elseif(empty($ad_description)){
       set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad description cannot be empty.</p>");
    }else{
    $sql_query="UPDATE ads SET ad_title='$ad_title',ad_price='$ad_price',ad_category='$ad_category',ad_location='$ad_location',mobile_number='$mobile_number',ad_description='$ad_description' WHERE ad_id='$ads_id'";
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Ad Changes Saved successfully.</p>");
            //redirect("update_profile.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Ad details could not be updated, please try again</p>");
          // die(mysqli_error($conn)); 
        }

}
}
}
}


//function to edit individual user ads
function edit_image(){
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['submit-update-image'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $ads_id=clean($_GET['ad_id']);  
    $image=$_FILES["ad_images"]["name"];
    $target="images/".basename($_FILES["ad_images"]["name"]);
   
  if(move_uploaded_file($_FILES["ad_images"]["tmp_name"],$target)){  
    $sql_query="UPDATE ads SET ad_images='$image' WHERE ad_id='$ads_id'";
    $run_query=query($sql_query);
    
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Changes made successfully.</p>");
            //redirect("update_profile.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Changes could not be updated, please try again</p>");
          // die(mysqli_error($conn)); 
        }

}
}
}
}
//user profile fetching...
function get_user_profile(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM users WHERE email='$_SESSION[email]'";
     
     $result=query($sql_query);
     //confirm($result);
     //$count=0;
     $row=fetch_array($result);
   
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $email=$row['email'];
        $mobile_number=$row['mobile_number'];
        $user_id=$row['user_id'];

  

$profile= <<<heredoc

    <div class="panel panel-primary">
     <div class="panel-heading">
     <div class="col-md-3">
         <img src="profile_pics/m1.jpg" width="100%" class="img-thumbnail" alt="danly ads">
     </div>
        <div class="col-md-7">
        <h3><u>{$row['first_name']} {$row['last_name']}</u></h3>
        <h3><u></u></h3>
        <p>Gender: <i class="glyphicon glyphicon-heart"></i> Female</p>
        <p>Phone Number:<i class="glyphicon glyphicon-phone"></i> {$row['mobile_number']}</p>
        <p>Email: <i class="glyphicon glyphicon-envelope"></i> {$row['email']}</p>
     </div>
      <div class="clearfix"></div>
     </div>
  </div>

heredoc;

echo $profile;
}




}



//get the posts associated with the user /user profile fetching...
function getAds(){

    $sql_query="SELECT * FROM ads WHERE ad_status='published' AND ad_category='houses and apartment for sale'";
     $result=query($sql_query);
     while($rows=fetch_array($result)){
       $ad_title=$rows['ad_title'];
       $ad_images=$rows['ad_images'];
       $ad_category=$rows['ad_category'];
       $created_by =$rows['created_by'];
       $ad_description=$rows['ad_description'];
       $ad_description1=substr($ad_description,0,50);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];

     //echo $image=$row['image'];
 
                
              
          
  

$ads= <<<heredoc

    
         <div class="col-md-3">
        
              <div class="center-cropped img-box text-center">
              <a href="listAll.php?cat={$ad_category}">
               <img src="accounts/images/{$rows['ad_images']}" alt="danly properties" class="img-responsive" style="width:320px; height:150px; object-fit: cover;">
            </div>
            <div class="container-hover">
              <div class="box">
                 <h3>{$rows['ad_title']}</h3>
              </div>
            </div>
          </a>
                    
            <div class="inner-class">
                <h5><a href="listAll.php?cat={$ad_category}">{$rows['ad_title']}</a></h5>
         
                <div class="inner-content">
                    <p>
                      {$ad_description1}
                    </p>
                    <hr />
                     <div class="pricing">
                         <span class="unit-pricing"><b>Ksh.{$rows['ad_price']}</b></span>
                        <span class="share-icon"><i class="fa fa-share-alt-square"></i></span>
                    </div>
                </div>
            </div>
                   <br /><br />
        </div>

        
  

heredoc;

echo $ads;

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
       $ad_description=substr($rows['ad_description'],0,50);
       $ad_price=$rows['ad_price'];
       $ad_id=$rows['ad_id'];
       $ad_location=$rows['ad_location'];
       $date_added=$rows['date_added'];

     //echo $image=$row['image'];
 
                
              
          
  

$ads= <<<heredoc



              <div class="col-sm-3 col-lg-3 col-md-3">

                        <a href="listAll.php?cat={$ad_category}"><div class="thumbnail">
                            <img src="accounts/images/{$rows['ad_images']}" alt="danly properties" class="img-responsive" style="width:320px; height:150px; object-fit: cover;">
                            <div class="caption">
                                <h4 class="pull-right">Ksh24.99</h4>
                                <h4>{$rows['ad_title']}</h4>
                                <p>{$ad_description}</p>
                            </div>
                        </div>
                        </a>
                    </div>
              

          


        
  

heredoc;

echo $ads;

}


}








//function to fetch ads that are associated with Office,shops and commercial categories.
function getCatsAds2(){

    $sql_query="SELECT * FROM ads WHERE ad_status='published' AND ad_category='land and plots.'";
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
                <img src="accounts/images/{$rows['ad_images']}" alt="Danly Properties" class="img-responsive" style="width:320px; height:150px; object-fit: cover;">
              </div>  
          </a>    
          

        
  

heredoc;

echo $ads;

}


}



function getCatsAd(){

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

    
         <a href="listAll.php?cat={$rows['ad_category']}">
           <div class="owl-items text-center">
                <img src="accounts/images/{$rows['ad_images']}" alt="Danly Properties" class="img-responsive" style="width:320px; height:150px; object-fit: cover;">
              </div>  
          </a>    
          

        
  

heredoc;

echo $ads;

}


}


//function to fetch ads that are associated with Land and plots categories.
function getCatsAds4(){

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
     //echo $image=$row['image'];
 
                
              
          
  

$ads= <<<heredoc
            

         <a href="listAll.php?cat={$ad_category}">
          <div class="owl-carousel">
           <div class="owl-items text-center">
                <img src="accounts/images/{$rows['ad_images']}" alt="Danly Properties" class="img-responsive">
                </div>
              </div>  
          </a>     
        
  

heredoc;

echo $ads;

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





$preview=<<<heredoc


<div class="breadcrumb" style="font-size:15px;color:blue;">Category <span class="glyphicon glyphicon-chevron-right"></span> <a href="listAll.php?cat={$ad_category}">{$rows['ad_category']} <span class="glyphicon glyphicon-ok"></a></span></div>
<div class="row">

    <div class="col-md-7">
      <div class="thumbnail">
       <img class="img-responsive" src="accounts/images/{$rows['ad_images']}" alt="Danly Properties" style="width:100%; object-fit: cover;">
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
         <img src="accounts/profile_pics/avatar.png" width="30%" class="img-circle">
     </div>
     
       <div class="panel-body">
           <table class="table table-condensed">
            
             <tbody>
                <tr>
                <th>Ad Title:</th>
                 <th>{$rows['ad_title']}.</th>
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
                <th>0710617094.</th>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
     </div>
      
        <td>
        <a href="tel:+254710617094"><span class="btn btn-info btn-lg" style="width:100%;">Call us now.</span></a>
        </td><br /><br />
         <td>
        <a href="contact.php"><span class="btn btn-warning btn-lg" style="width:100%;">Send Message.</span></a>
        </td>
   </div>
  


</div><!--Row for Tab Panel-->

    <div class="col-md-12">

        <div class="thumbnail" style="padding: 10px;
margin: 10px;">
         

    <div class="caption-full" style="margin:8px;">
        <h4><a href="#">{$rows['ad_title']}</a> <hr /></h4>
        
        <h4 class="">Ad Price: Ksh{$rows['ad_price']}</h4>

          
        <p>{$rows['ad_description']}</p>


    <div class="panel">
    <div class="" style="font-size:28px; margin-right:80px; padding-top:15px; font-color:red;">
              Share the ad on: 
              <span class="fa fa-facebook" style="color:#3b5998;"></span>
              <a href="#"><span class="fa fa-twitter"></span></a>
              <span style="color:#3f729b;"><i class="fa fa-instagram"></i></span>
              <span style="color:#205081;"><i class="fa fa-bitbucket"></i></span>
    </div>
    </div>
   

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


heredoc;

echo $preview;

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
                    <a href="readMore.php?ad_id={$rows['ad_id']}">
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
                     <img src="images/tour-section/img13.JPG" class="img-responsive">
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
                   <img src="images/tour-section/img14.jpg" class="img-responsive">
                   <div class="hover-overlay">
                        <div class="hover-content">
                            <p>POST YOUR <BR /><BR />AD</p>
                            
                       </div>
                      </div>
                    </a>    
                </div>
                <div class="cat-list col-md-3">
                      <a href="listAll.php?cat={$ad_category}">
                       <img src="images/tour-section/img15.jpg" class="img-responsive">
                      <div class="hover-overlay">
                        <div class="hover-content">
                            <p>GET A <BR /><BR />LAND HERE</p>
                          </div>
                      </div>
                    </a>      
                </div>
                 <div class="cat-list col-md-3">
                   <a href="listAll.php?cat={$ad_category}">
                   <img src="images/tour-section/img16.jpg" class="img-responsive">
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

function get_user_posts(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM ads WHERE created_by='$_SESSION[email]'";
     
     $result=query($sql_query);

      if(row_count($result) ==0){

         echo $errors[]="<p class='alert alert-danger alert-dismissible' role='alert' style='font-size:16px;'>You do not have any posted ad, please upload ad</p>";

     }else{
     //confirm($result);
     //$count=0;
     //$row=fetch_array($result);
     while($row=mysqli_fetch_assoc($result)){


   
       $ad_images=$row['ad_images'];
       $ad_description=$row['ad_description'];
       $ad_description1=substr($ad_description,0,200);
        

  

$profile= <<<heredoc

    <div class="panel panel-primary">
     <div class="panel-heading">
     <div class="col-md-3">
         <img src="images/{$row['ad_images']}" width="100%" class="img-thumbnail">
       
          <h4><a href="change_images.php?ad_id={$row['ad_id']}"><span class="btn btn-success">Update Ad Image</span></a></h4>
     </div>
        <div class="col-md-7">
        <p><b>Ad title:</b> {$row['ad_title']}</p>

        <p><b>Price Ksh:</b> {$row['ad_price']}</p>

        <p><b>Ad category:</b> {$row['ad_category']}</p>

        <p><b>Ad location:</b> {$row['ad_location']}</p>

        <p><b>Ad id: #</b>{$row['ad_code']}</p>
        <p><b>Posted On:</b> {$row['date_added']}</p>
        <p><b>Ad description:</b></i> {$ad_description1}</p>
        
         <td>
          <a href="editAd.php?ad_id={$row['ad_id']}"><span class="btn btn-warning btn-sm" style="width:30%;">Edit Ad.</span></a>
        </td>
         <td>
          <a href="../readMore.php?ad_id={$row['ad_id']}"><span class="btn btn-warning btn-sm" style="width:30%;">View Ad.</span></a>
        </td>
        <td>
        <a href=""><span class="btn btn-danger btn-sm" style="width:30%;">Delete Ad.</span></a>
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

}


//function to get admin profile
function get_users_profile(){
     
    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM users WHERE email='$_SESSION[email]'";
     
     $result=query($sql_query);
     //confirm($result);
     //$count=0;
     $row=fetch_array($result);
   
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $email=$row['email'];
        $mobile_number=$row['mobile_number'];
        $user_id=$row['user_id'];
        $avatar=$row['profile_pic']; 
        if(empty($avatar)){
          
          //echo "hello set your profile picture"; 
           $avatar_holder='
        
         <img src="profile_pics/avatar.png"  class="img-responsive img-thumbnail" alt="danly ads" style="width:100%;">
         ';

        }elseif(!empty($avatar)){

          //echo "hello, update your profile picture";
          $avatar_holder="

              <img src='profile_pics/{$row['profile_pic']}' class='img-responsive img-thumbnail' alt='danly properties' style='width:100%;'>


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
        <p>Phone Number:<i class="glyphicon glyphicon-phone"></i> {$row['mobile_number']}</p>
        <p>Username: <i class="glyphicon glyphicon-envelope"></i> {$row['email']}</p>
        <p>Member Since: <i class="glyphicon glyphicon-calendar"></i> {$row['date_registered']}</p>
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
                <th>Gender</th>
                <th>Date Registered</th>
                <th>Actions</th>
                </tr>
           </thead>
             <tbody>
           
               <tr>
                <td>{$row['user_id']}.</td>
                <td>{$row['first_name']}</td>
                <td>{$row['last_name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['mobile_number']}</td>
                <td>{$row['gender']}</td>
                <td>{$row['date_registered']}</td>
               <td>
                  <a href="update_profile.php?user_id={$row['user_id']}"> <span class="btn btn-info">Update Details</span></a>
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

//function to set user profile picture....
function upload_user_profile(){
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['upload-profile'])){

      $image=clean(@$_POST['profile_pic']);
      $image=$_FILES["profile_pic"]["name"];
      $target="profile_pics/".basename($_FILES["profile_pic"]["name"]);


      if(move_uploaded_file($_FILES["profile_pic"]["tmp_name"],$target)){
      $sql_query="UPDATE users SET profile_pic='$image'";
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

//update admin profile
function update_users_profile(){
if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){ 
 if(isset($_GET['user_id'])){
  $users_profile_id=clean($_GET['user_id']);
  $sql_query="SELECT * FROM users WHERE user_id='$users_profile_id'";
  $result=query($sql_query);
     //confirm($result);
     //$count=0;
     while($row=fetch_array($result)){
   
        $user_id=$row['user_id'];
        $date_time=$row['date_registered'];
        $username=$row['email'];
        $phone_number=$row['mobile_number'];
        $first_name=$row['first_name'];
        $last_name=$row['last_name'];
        $gender=$row['gender'];
        $avatar=$row['profile_pic'];


        
        if(empty($avatar)){
          
          //echo "hello set your profile picture"; 
           $avatar_holder='
        
         <img src="profile_pics/avatar.png"  class="img-responsive img-thumbnail" alt="danly ads" style="width:100%;">
         ';

        }elseif(!empty($avatar)){

          //echo "hello, update your profile picture";
          $avatar_holder="

              <img src='profile_pics/{$row['profile_pic']}' class='img-responsive img-thumbnail' alt='danly properties' style='width:100%;'>


          ";

        }
  

$profile= <<<heredoc

    

  
     <div class="col-lg-12">
       <div class="panel panel-primary">
         <div class="panel-heading">
           <h4>{$row['email']} Profile</h4>
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
                    <input type="text" name="mobile_number" id="phone" tabindex="1" class="form-control" placeholder="Phone Number" value="{$row['mobile_number']}" required >
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="{$row['email']}" required >
                  </div>
                  <div class="form-group">
                    <input type="text" name="gender" id="gender" tabindex="1" class="form-control" placeholder="You gender" value="{$row['gender']}" required >
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" id="update-user-profile" tabindex="4" class="form-control btn btn-register" name="update-user-profile" value="Update Profile">
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
}

//function to update user details
//function to update admin accounts details
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['update-user-profile'])){
   //$admin=clean($_SESSION["UserAdmin"]);
    $update_id=clean($_GET['user_id']);
    $first_name=clean($_POST['first_name']);
    $last_name=clean($_POST['last_name']);
    $username=clean($_POST['email']);
    $phone_number=clean($_POST['mobile_number']);
    $gender=clean($_POST['gender']);
    

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
    $sql_query="UPDATE users SET first_name='$first_name',last_name='$last_name',email='$username',mobile_number='$phone_number',gender='$gender' WHERE user_id='$update_id'";
    $run_query=query($sql_query);
    if($run_query){
         set_messages("<p class='alert alert-success alert-dismissible' role='alert'>Account details updated successfully.</p>");
            //redirect("update_profile.php");
        }else{
           set_messages("<p class='alert alert-danger alert-dismissible' role='alert'>Account details could not be updated, please try again</p>");

              redirect("update_profile.php?user_id={$update_id}");
        }
}
}
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

//function to get the drafted posts
function get_user_drafted_posts(){

    if(isset($_SESSION['email']) || isset($_COOKIE['email']) || isset($_SESSION['first_name'])){
    //echo  $email=$_SESSION['email'];
   // echo  $name=$_SESSION['first_name'];
     $sql_query="SELECT * FROM ads WHERE created_by='$_SESSION[email]' AND ad_status='draft'";
   
     
     $result=query($sql_query);

     if(row_count($result) ==0){

         echo $errors[]="<p class='alert alert-danger alert-dismissible' role='alert' style='font-size:16px;'>You do not have any ad waiting for approval, upload ad</p>";

     }else{


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
         <img src="images/{$row['ad_images']}" width="100%" class="img-thumbnail">
       
          <h4><a href="change_images.php?ad_id={$row['ad_id']}"><span class="btn btn-success">Update Ad Image</span></a></h4>
     </div>
        <div class="col-md-7">
        <p><b>Ad title:</b> {$row['ad_title']}</p>

        <p><b>Price Ksh:</b> {$row['ad_price']}</p>

        <p><b>Ad status:</b> {$row['ad_status']}</p>


        <p><b>Ad category:</b> {$row['ad_category']}</p>

        <p><b>Ad location:</b> {$row['ad_location']}</p>

        <p><b>Ad id: #</b>{$row['ad_code']}</p>
        <p><b>Posted On:</b> {$row['date_added']}</p>
        <p><b>Ad description:</b></i> {$row['ad_description']}</p>
        
         <td>
          <a href="editAd.php?ad_id={$row['ad_id']}"><span class="btn btn-warning btn-sm" style="width:30%;">Edit Ad.</span></a>
        </td>
         <td>
          <a href="../readMore.php?ad_id={$row['ad_id']}"><span class="btn btn-warning btn-sm" style="width:30%;">View Ad.</span></a>
        </td>
        <td>
        <a href=""><span class="btn btn-danger btn-sm" style="width:30%;">Delete Ad.</span></a>
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
    if(isset($_GET['email'])){
       $email=clean($_GET['email']);
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
function validate_user_login(){
$errors=[];
if($_SERVER['REQUEST_METHOD']=="POST"){
if(isset($_POST['login-submit'])){
      $username=clean($_POST['username']);
      $password=clean($_POST['tsc_no']);
      //$remember=isset($_POST['remember']);

      if(empty($username)){
        $errors[]="<span style='font-size:16px;'>username field cannot be empty</span>";
      }
      if(empty($password)){
        $errors[]="<span style='font-size:16px;'>Password field cannot be empty<span>";         
        }else{

            if(user_login($username,$password)){

              redirect("accounts/index.php");

            }else{

              echo $errors[]="<p class='alert alert-danger alert-dismissible' role='alert' style='font-size:16px;'>Your credentials are not correct.</p>";
            }
       }




     }
}
}

//user login function

function user_login($username,$password){

$sql="SELECT * FROM `teachers` WHERE username='$username' AND tsc_no='$password' LIMIT 1";
$result=query($sql);

  if(row_count($result) ==1){
       $_SESSION['username']=$username;
       //$_SESSION['tsc_no']=$password;
    return true;
  }else{

   return false;
  }

  

 }


///function to keep us logged in
 function loggedIn(){

  if(isset($_SESSION['username']) || isset($_COOKIE['username'])){
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