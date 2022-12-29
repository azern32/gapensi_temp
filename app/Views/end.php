<?php 
    foreach ($dependencies as $key => $value) {
        echo "<!--". $key ."-->"."\n"."    <script src='".$value."'></script>";
    }
?>
</body>
</html>