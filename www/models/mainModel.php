<?php

//return HTML options of every type device
function getDevicesAtOptions() {
    //make mysql connection variable global
    global $connection;
    //query devices type
    $query = mysqli_query($connection, "SELECT `id`, `name` FROM `devType`");
    if (!$query)
        return null;
    $queryAll = mysqli_fetch_all($query);
    $output = null;
    foreach ($queryAll as $item) {
        /* Indexes
        0 = id
        1 = name
        2 = mask
        */
        $id = $item[0];
        $name = $item[1];
        
        $output .= "<option value='$id'>$name</option>";
    }
    return $output;
}