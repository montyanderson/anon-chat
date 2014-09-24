<?php
$base64 = base64_encode(ob_get_contents());
ob_clean();
echo $base64;