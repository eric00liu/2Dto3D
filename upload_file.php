<?php
session_start();
if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/png")
            || ($_FILES["file"]["type"] == "video/mp4")
            || ($_FILES["file"]["type"] == "image/pjpeg"))
            && ($_FILES["file"]["size"] < 2000000000))
{
    $file_array = explode('.', $_FILES["file"]["name"]);
    $_FILES["file"]["name"] = time() . "." . $file_array[1];

    $input_file = "upload/" . $_FILES["file"]["name"];
    $output_file_1 = "trans/1_" .  time() . "." . "gif";
    $output_file_2 = "trans/2_" .  time() . "." . "gif";

    if ($_FILES["file"]["error"] > 0)
    {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else
    {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
//        echo "Type: " . $_FILES["file"]["type"] . "<br />";
//        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
//        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

        if (file_exists("upload/" . $_FILES["file"]["name"]))
        {
            echo $_FILES["file"]["name"] . " already exists. ";
        }
        else
        {
            $output = array();
            $tmpfile = $_FILES["file"]["name"];

            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);

            $command = '/usr/bin/python python/new_2dto3d.py ' . $input_file . " " . $output_file_1. " " . $output_file_2;
            //$command ="/usr/bin/python python/new_2dto3d.py upload/1429333820.mp4 trans/1_1429333820.gif trans/2_1429333820.gif ";
            //$command ="/usr/bin/python python/cp.py upload/1429333820.mp4 upload/1429333820.gif";
            $command = "ls";
            $result = exec($command, $output);
        }
    }

//    header("input:$input_file"); 
 //   header("output:$output_file");
//    echo $command;
 //   var_dump($output);
//    header("location: show.php?input=$input_file&output=$output_file); 
    header("location: myshow.php"); 
}
else
{
    echo "Invalid file";
}

?>

