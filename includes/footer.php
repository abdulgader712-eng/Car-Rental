<?php
if(isset($_POST['emailsubscibe']))
{
$subscriberemail=$_POST['subscriberemail'];
$sql ="SELECT SubscriberEmail FROM tblsubscribers WHERE SubscriberEmail=:subscriberemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<script>alert('Already Subscribed.');</script>";
}
else{
$sql="INSERT INTO  tblsubscribers(SubscriberEmail) VALUES(:subscriberemail)";
$query = $dbh->prepare($sql);
$query->bindParam(':subscriberemail',$subscriberemail,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Subscribed successfully.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}
?>

<footer style="background-color: #6acdf1;">
  <div class="footer-top">
    <div class="container">
      <div class="row">
      
        <div class="col-md-6">
          <h6>About Us</h6>
          <hr />
          <p>
            SECURE ELECTRONIC CAR RENTAL MANAGEENT SYSTEM is one of the kind in Kampala,<br /> to provide you with the best services in accessing rides  within the city.
          </p>          
        </div>
  
        <div class="col-md-6 col-sm-6">
          <div class="row">
          <h6> Newsletter Subscription</h6>
          <hr />
          <div class="newsletter-form">
            <form method="post">
              <div class="col-md-6">
                 <div class="form-group">
                    <input type="email" name="subscriberemail" class="form-control newsletter-input" required placeholder="Enter Email Address" />
                  </div>
              </div>

              <div class="col-md-6">
                <button type="submit" name="emailsubscibe" class="btn btn-block">Subscribe <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
              </div>
             
              
              </form>
              <br />
              <div class="col-md-6">
                  <p class="subscribed-text">
                      Receive the latest updates from us regarding our Technology and Products.
                  </p>
              </div>
            </div>
          </div>
      </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-push-6 text-right">
          <div class="footer_widget">
            <p>Connect with Us:</p>
            <ul>
              <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li> 
            </ul>
          </div>
        </div>
        <div class="col-md-6 col-md-pull-6">
          <p class="copy-right">&copy; 2025 Secure Electronic Car Rental Mgmt System. All Rights Reserved <a href="admin/">Admin</a></p>

        </div>
      </div>
    </div>
  </div>
</footer>