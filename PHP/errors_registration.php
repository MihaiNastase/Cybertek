
<?php
 $alert = "";
 if(count($errors) > 0) {
   $alert = '<div class="errors" id="fail">';
   foreach ($errors as $error) {
     $alert .= $error . "_<br>";
   }
   $alert .= "</div>";
 } else { $alert = '<div class="form_header"> register//here_'; }
 echo $alert;
?>
