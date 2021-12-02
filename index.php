<?php
if (fsockopen('192.168.50.4', 80)) {
    echo('Webserver 1 Reports Online');
} else {
    echo('Webserver 1 Reports Offline');
}
?>
