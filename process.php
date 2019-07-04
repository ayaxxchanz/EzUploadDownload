<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
?>
<?php
// connect to database
$conn = mysqli_connect('localhost', 'root', '', 'music-upload');

$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $artist = $_POST['artist'];
    $song = $_POST['song'];

    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
	
    if (!in_array($extension, ['mp3','m4a'])) {
		header('Location: upload.php#failed');
    } elseif ($_FILES['myfile']['size'] > 20000000) { // file shouldn't be larger than 20Megabyte
        header('Location: upload.php#failed');
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files (name, size, artist, song, downloads) VALUES ('$filename', $size, '$artist', '$song', 0)";
            if (mysqli_query($conn, $sql)) {
				header('Location: upload.php#success');
            }
        } else {
			header('Location: upload.php#failed');
        }
    }
}

// Downloads files
if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];

    // fetch file to download from database
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    $file = mysqli_fetch_assoc($result);
    $filepath = 'uploads/' . $file['name'];

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);

        // Now update downloads count
        $newCount = $file['downloads'] + 1;
        $updateQuery = "UPDATE files SET downloads=$newCount WHERE id=$id";
        mysqli_query($conn, $updateQuery);
        exit;
    }

}

//Delete files
if(isset($_GET['delete_id']))
{
    $id = $_GET['delete_id'];
	
    $sql = "SELECT * FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
	unlink("uploads/".$row['name']);
	
	$sql = "DELETE FROM files WHERE id=$id";
    $result = mysqli_query($conn, $sql);
	
    header("Location: files.php");
}

?>