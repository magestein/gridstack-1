<?php
/**
 * Created by PhpStorm.
 * User: user-pc
 * Date: 7/21/2015
 * Time: 10:27 AM
 */
require_once('dbconnect.php');

/*  Load Grid Position Begin */
if(isset($_POST['gridload']) == 'loadingposition')
{
    $select_pos     = "SELECT * FROM homegrid";
    $select_exec    = mysql_query($select_pos);
    $return_data    = array();
    while($dataFromDB = mysql_fetch_assoc($select_exec)) {
        $return_data[]= array(
            "id"           => $dataFromDB['id'],
            "title"        => $dataFromDB['title'],
            "subtitle"     => $dataFromDB['subtitle'],
            "circle"       => $dataFromDB['circle'],
            "text"         => $dataFromDB['text'],
            "price"        => $dataFromDB['price'],
            "pseudo_price" => $dataFromDB['pseudo_price'],
            "link"         => $dataFromDB['link'],
            "color"        => $dataFromDB['color'],
            "column"       => $dataFromDB['columns'],
            "position"     => $dataFromDB['position']
        );
    }
    header('Content-Type: application/json');
    echo json_encode($return_data);
}
/* Load Grid Position End */

/* Get Position onchange Begin */
if(isset($_POST['onchangeData']) == 'updateposition')
{
    //$_POST['positionData']: [{"x":0,"y":0,"width":1,"height":1},{"x":1,"y":0,"width":2,"height":10},{"x":6,"y":0,"width":2,"height":9}] we need to explode this data
    $position              = json_decode($_POST['positionData'], true);
    $i = 1;
    $select_id        = "SELECT id FROM homegrid";
    $select_id_exec   = mysql_query($select_id);
    while($idFromDB = mysql_fetch_assoc($select_id_exec)) {
        $x = $position[$i]['x'];
        $y = $position[$i]['y'];
        $width = $position[$i]['width'];
        $height = $position[$i]['height'];
        $positionjson = json_encode($position[$i]);
        $update = "UPDATE homegrid SET position = '$positionjson' WHERE id = '" . $idFromDB['id'] . "' ";
        mysql_query($update);
        $i++;
    }
}
/* Get Position onchange End */

/* Insert position Add Button Begin */
if(isset($_POST['jsonData']) == 'insertjson')
{
    $explode        = explode('},', $_POST['json']);
    $end            = end($explode); //{"x":0,"y":9,"width":2,"height":9}] All box position is getting. end() is used for getting last box position.
    $position       = trim($end, ']'); //{"x":0,"y":9,"width":2,"height":9} remove ] special character
    $insert         = "INSERT INTO homegrid (position, status) VALUES ('$position', 'offline')";
    $insert_exec    = mysql_query($insert);
    $last_insert_id = mysql_insert_id();
    $select_pos     = "SELECT id, position FROM homegrid WHERE id = '$last_insert_id'";
    $select_exec    = mysql_query($select_pos);
    $array          = mysql_fetch_assoc($select_exec);
    header('Content-type: application/json');
    echo json_encode($array);
}
/* Insert position Add Button End */


/* File Upload and Updating Data Begin */
if (isset($_FILES['image'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
            echo $update = "UPDATE homegrid SET title = '" . $_POST['title'] . "', subtitle = '" . $_POST['subtitle'] . "', circle = '" . $_POST['circle'] . "', text = '" . $_POST['text'] . "', price = '" . $_POST['price'] . "', pseudo_price = '" . $_POST['pseudoprice'] . "', img = '".$target_file."', link = '" . $_POST['link'] . "', color = '" . $_POST['favcolor'] . "', columns = '" . $_POST['column'] . "' WHERE id = '" . $_POST['hiddenid'] . "' ";
            mysql_query($update);

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
/* File Uploading and  Updating Data End */

/* Delete Box & Data Begin */
if(isset($_POST['delForm']) == 'delForm')
{
    $delboxid            = $_POST['delID'];
    $delete         = "DELETE FROM homegrid WHERE id = '$delboxid' ";
    mysql_query($delete);
}
/* Delete Box & Data End */


?>