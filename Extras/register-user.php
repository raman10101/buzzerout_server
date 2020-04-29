<?php
define('DB_USERNAME', 'u250918205_raman');
define('DB_PASSWORD', 'Rr8755025488$*');
define('DB_NAME', 'u250918205_buzzerout');
define('DB_HOST', "localhost");
$conn =  mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
$id = $_GET["id"];
$stmt = mysqli_query($conn, "select * from register where activation_link = '" . $id . "' ");
if (mysqli_num_rows($stmt) > 0) {
    // check for the expiry of the activation link.
    while ($row = mysqli_fetch_assoc($stmt)) {
        $old_date = $row["valid_till"];
        $username = $row["username"];
        $password = $row["password"];
        $email = $row["email"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $old_date_Timestamp = strtotime($old_date);

        $current_date_Timestamp = time();

        if ($current_date_Timestamp < $old_date_Timestamp) {
            // Link not expired

            // Add Enrty to User Table
            $stmt2 = mysqli_query($conn, "insert into users(username, email, password, first_name, last_name)
            values('$username','$email','$password','$first_name','$last_name')");
            if ($stmt2) {
                // Clear Register Tale Entry
                $stmt3 = mysqli_query($conn, "DELETE FROM register WHERE activation_link = '" . $id . "'");
                // Go To Website Login Page
                if ($stmt3) {
                    // goto login page
                    header("Location: http://buzzerout.com/sign-in.html");
                } else {
                    echo "user not deleted from register table";
                }
            } else {
                echo "user not inserted into the users table " . mysqli_error($conn);
            }
            echo "You Are Authorised. Redirecting to Website.";
        } else {
            $stmt = mysqli_query($conn, "delete from register where activation_link = '" . $id . "' ");
            if($stmt){
                echo "The link is expired " . $old_date ."please register again";
            }
            else{
                echo "The link is expired.";
            }
        }
    break;
    }
} else {
    // Not Authroised
    echo "You Are Not Authorised. Please Register Again.";
}
