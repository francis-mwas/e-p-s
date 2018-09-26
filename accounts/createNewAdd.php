<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Francis Mwangi">
    <title>Seller|Dashboard</title>
	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet"> 
	<!-- Theme Custom CSS -->
		<script src="js/jquery.js"></script>
	<!-- Custom CSS -->
    <link href="css/custom.css" rel="stylesheet">
    <style>
    	.header {
    color: #36A0FF;
    font-size: 27px;
    padding: 10px;
}

.bigicon {
    font-size: 20px;
    color: #36A0FF;
}
.form-horizontal .form-group{
	margin-right: -10px;

}
    </style>
}
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


<div class="col-lg-10">
<?php display_message();?>
    <div class="row">
           <?php 
           validateAdCreation();

           ?>
         
            <div class="well well-sm">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="text-center header">Create new ad for free.</legend>
                        <div class="form-group">
                        <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                             <div class="col-md-8">
                                 <label for="Business name"><span>Business Name</span></label>
                                <input id="business_name" name="business_name" type="text" placeholder="business name" class="form-control">
                            </div>
                         </div>  
                       
                        <div class="form-group">
                           
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-hand-right bigicon"></i></span>
                            <div class="col-md-8">
                            	 <label for="title"><span>Ad Title</span></label>
                                <input id="title" name="ad_title" type="text" placeholder="Ad title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-bullhorn bigicon"></i></span>
                            <div class="col-md-8">
                            	<label for="price"><span>Price</span></label>
                                <input id="price" name="ad_price" type="text" placeholder="Ad price" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-random bigicon"></i></span>
                            <div class="col-md-8">
                            	<label for="category"><span>Category</span></label>
                               <select class="form-control" id="categorySelect" name="ad_category"> 
                                <option>select category</option>
                                        
                        <?php 
                        global $conn;
                        $query="SELECT * FROM categories";
                         $result=query($query);
                         //$count=0;
                         while($rows=fetch_array($result)){
                            $ad_cat_id=$rows["cat_id"];
                            $ad_category=$rows["cat_title"];
                        
                         ?>
                        
                                
                                <option><?php echo $ad_category; ?></option>
                           
                       <?php } ?>
                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="glyphicon glyphicon-map-marker bigicon"></i></span>
                            <div class="col-md-8">
                            	<label for="address"><span>Location</span></label>
                                <input id="autocomplete" name="address" type="text" placeholder="strat typing location to select from options provided" class="form-control"  onFocus="geolocate()">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                            	<label for="mobile"><span>Mobile Number</span></label>
                                <input id="phone" name="mobile_number" type="text" placeholder="Phone Number" class="form-control">

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
                                <textarea class="form-control" id="description" name="ad_description" placeholder="Ad description." rows="7"></textarea>
                            </div>
                        </div>
                          <input type="hidden" name="ad_code" />
                          <input type="hidden" name="lat" />
                          <input type="hidden" name="lng" />
                          <input type="hidden" name="date_added" />
                          <input type="hidden" name="created_by" />
                          <input type="hidden" name="ad_status" />
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

     <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
 <!--bootstrap js-->
  
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnoikfJ1OKTULs40vi6sJpIQyg5H38gWA&libraries=places&callback=initAutocomplete"
        async defer></script>
 <div style="clear: both;"></div>
 <?php include("includes/footer1.php"); ?> 
</body>
</html>