<?php

$conn = mysqli_connect("localhost", "root", "", "egzaminy_probne");

if(isset($_POST['submit'])){
    $lowisko = $_POST['lowisko'];
    $data = $_POST['data'];
    $sedzia = $_POST['sedzia'];

    $sql = "INSERT INTO zawody_wedkarskie VALUES(null, 0, $lowisko, '$data', '$sedzia')"; 
    $result = mysqli_query($conn, $sql);
}

mysqli_close($conn);
