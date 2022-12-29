<?php
// Get the array from the query parameter
session_start();

    foreach ($_SESSION['descrizione_luogo'] as $key => $value) {
        echo "$key: $value\n";
    }

?>