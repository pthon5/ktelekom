<?php

//function for check serial number at DB
function checkSerialAtBase($serial) {
    global $connection;
    $query = mysqli_query($connection, "SELECT `id` FROM `device` WHERE `serial` = '$serial'");
    return ($query->num_rows > 0 ? false: true);
}

//function for get mask by device type
function getMaskByDevType($devType) {
    global $connection;
    $query = mysqli_query($connection, "SELECT `mask` FROM `devType` WHERE `id` = $devType");
    if ($query->num_rows > 0) {
        $query = mysqli_fetch_assoc($query);
        return $query['mask'];
    }
}

//function for check serial number mask
function checkSerialMask($serial, $mask) {
    if (strlen($serial) != strlen($mask)) 
        return false;

    $regx = array(
        "N" => "[0-9]",
        "A" => "[A-Z]",
        "a" => "[a-z]",
        "X" => "[A-Z0-9]",
        "Z" => "[-|_|@]"
    );

    //make chars array from mask
    $maskChars = str_split($mask);

    //generating target regex
    $outputRegex = "/^";
    foreach ($maskChars as $char) {
        $outputRegex .= $regx[$char];
    }
    $outputRegex .= "/";

    return (preg_match($outputRegex, $serial) > 0 ? true: false);
}


function addDevice($serials, $devType) {
    global $connection;
    if ($serials == "" || $devType == null) die("Что-то не заполнено");


    //split serials by \r\n
    $serials = explode("\r\n", $serials);
    //get mask by device type
    $mask = getMaskByDevType($devType);
    
    //proccessing every serial number
    foreach ($serials as $serial) {
        
        $checkSerial = false;
        $checkMask = false;
    
        //Check SN at base
        if (checkSerialAtBase($serial)) {
            $checkSerial = true;
        } else { 
            echo "Серийный номер ($serial) уже существует в базе.<br>";
        }
        //Check serial by mask
        if (checkSerialMask($serial, $mask)) {
            $checkMask = true;
        } else {
            echo "Серийный номер ($serial) не соответствует маске ($mask)<br>";
        }
    
        if ($checkSerial && $checkMask) {
            //add record to DB
            mysqli_query($connection, "INSERT INTO `device` (`idType`, `serial`) VALUES ($devType, '$serial')");
        }
    }
    
}
