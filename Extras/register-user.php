<?php
define('DB_USERNAME', 'u250918205_raman');
define('DB_PASSWORD', 'Rr8755025488$*');
define('DB_NAME', 'u250918205_buzzerout');
define('DB_HOST', "localhost");
$conn =  mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$id = $_GET["id"];
$stmt = mysqli_query($conn, "select * from register where activation_link = '" . $id . "'");
if (mysqli_num_rows($stmt) > 0) {
    // Clear Register Tale Entry
    // Add Enrty to User Table
    // Go To Website Login Page
    echo "You Are Authorised. Redirecting to Website.";
} else {
    // Not Authroised
    echo "You Are Not Authorised. Please Register Again.";
}
