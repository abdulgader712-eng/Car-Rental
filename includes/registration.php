<style>
  .succWrap {
  padding: 10px;
  margin: 10px 0;
  background: #dff0d8;
  border-left: 4px solid #3c763d;
  color: #3c763d;
}
.errorWrap {
  padding: 10px;
  margin: 10px 0;
  background: #f2dede;
  border-left: 4px solid #a94442;
  color: #a94442;
}

</style>

<?php
//error_reporting(0);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$msg = ""; $error = "";

if(isset($_POST['signup'])) {
        $fname=$_POST['fullname'];
        $email=$_POST['emailid']; 
        $mobile=$_POST['mobileno'];
        $nationalid = $_POST['nationalid'];
        $license    = $_POST['license'];
        $password=md5($_POST['password']); 
        $sql = "INSERT INTO tblusers (FullName, EmailId, ContactNo, NationalID, LicenseNo, Password) 
                VALUES (:fname, :email, :mobile, :nationalid, :license, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':nationalid', $nationalid, PDO::PARAM_STR);
        $query->bindParam(':license', $license, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);

        $query->execute(); 
        $lastInsertId = $dbh->lastInsertId();

        if($lastInsertId)
          {
            // PHPMailer email sending
            $mail = new PHPMailer(true);
            try {
              // Server settings
              $mail->isSMTP();
              $mail->Host       = 'smtp.hostinger.com';  // Change to your SMTP server
              $mail->SMTPAuth   = true;
              $mail->Username   = 'balex@balexinfotech.com'; // Your email
              $mail->Password   = 'Balex@22Mak';    // App password
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
              $mail->Port       = 587;

              // Recipients
              $mail->setFrom('balex@balexinfotech.com', 'SECMS Admin');
              $mail->addAddress($email, $fname);

              // Content
              $mail->isHTML(true);
              $mail->Subject = 'Welcome to SECMS!';
              $mail->Body    = "Hi <strong>$fname</strong>,<br><br>Thank you for registering with Secure Electronic Car Rental Management System.<br><br>You can now login and book vehicles.<br><br>Regards,<br>SECMS Team";

              $mail->send();
              $msg = "Registration successful. Confirmation email sent!";
            } catch (Exception $e) {
              $msg = "Registration successful but email not sent. Mailer Error: {$mail->ErrorInfo}";
            }
          }
          else {
            $error = "Something went wrong. Please try again.";
          }
}


?>


<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
<script type="text/javascript">
function valid()
{
if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}
</script>
<div class="modal fade" id="signupform">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Sign Up</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="signup_wrap">
            <div class="col-md-12 col-sm-6">

              <?php if($msg): ?>
                    <div class="succWrap">
                      <strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?>
                    </div>
                  <?php elseif($error): ?>
                    <div class="errorWrap">
                      <strong>ERROR</strong>: <?php echo htmlentities($error); ?>
                    </div>
              <?php endif; ?>










              <form  method="post" name="signup" onSubmit="return valid();">
                <div class="form-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Full Name" required="required">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="mobileno" placeholder="Mobile Number" maxlength="10" required="required">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="nationalid" placeholder="National ID Number" required="required">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="license" placeholder="Driving License Number" required="required">
                </div>


                <div class="form-group">
                  <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="Email Address" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                </div>

                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" required="required">
                </div>

                <div class="form-group checkbox">
                  <input type="checkbox" id="terms_agree" required="required" checked="">
                  <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                </div>

                <div class="form-group">
                  <input type="submit" value="Sign Up" name="signup" id="submit" class="btn btn-block">
                </div>

              </form>
            </div>
            
          </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <p>Already got an account? <a href="#loginform" data-toggle="modal" data-dismiss="modal">Login Here</a></p>
      </div>
    </div>
  </div>
</div>
<script>
  setTimeout(function() {
    $(".alert").fadeOut("slow");
  }, 4000);
</script>
