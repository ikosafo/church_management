<?php
include ('../../../../config.php');
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','mp4','mp3'); // valid extensions
$path = '../../../uploads/slider/'; // upload directory
if(!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image'])
{
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
    $final_image = rand(1000,1000000).$img;
// check's valid format
    if(in_array($ext, $valid_extensions))
    {
        $path = $path.strtolower($final_image);
        if(move_uploaded_file($tmp,$path))
        {
            $pos = 9;
            $newstr = substr_replace($path, 'ms/', $pos, 0);
            echo "<img src='$newstr' style='width:25%'/>";
            $name = $_POST['name'];
            $email = $_POST['email'];
//include database configuration file
            //include_once 'db.php';
//insert form data in the database
            $insert = $mysqli->query("INSERT uploading (name,email,file_name) VALUES ('".$name."','".$email."','".$path."')");
//echo $insert?'ok':'err';
        }
    }

    else
    {
        echo 'invalid';
    }
}
?>