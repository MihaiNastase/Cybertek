
<?php //used to display errors on the login page
 $alert = "";
 if(count($errors) > 0) {
   $alert = '<div class="errors" id="fail">';
   foreach ($errors as $error) {
     $alert .= $error . "_<br>";
   }
   $alert .= "</div>";
 } else { $alert = '<div class="form_header"> log//in_ </div>'; }
 echo $alert;
?>
