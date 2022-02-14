<?php

echo '<nav class="navbar navbar-inverse navbar-light bg-light px-3">
<h3 class="navbar-brand">' . $_SESSION['given_name'] . " " . $_SESSION['family_name'] . '</h3>
    <div class="d-flex"><a  href="logout.php"><button class="btn btn-outline-success my-2 my-sm-0" >logout</button></a></div>
    
    
    </div>
   

  </nav>';
