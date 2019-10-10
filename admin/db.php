<?php
// Enter your Host, username, password, database below.
// I left password empty because i do not set password on localhost.
$con = mysqli_connect("localhost","mindspac_bhakthiyogasrilankacom","F4qq6g=#4y3A","mindspac_bhakthiyogasrilankacom");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>