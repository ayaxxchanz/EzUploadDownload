<?php include 'process.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Upload</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
	<link href="css/custom.css" rel="stylesheet">
	<link href="css/simple-sidebar.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading"> </div>
				<div class="list-group list-group-flush">
					<a href="upload.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-upload" aria-hidden="true"></i> Upload</a>
					<a href="files.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-folder-open"></i> Files</a>
					<a href="logout.php" class="list-group-item list-group-item-action bg-light"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
				</div>
			</div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
		<div id="page-content-wrapper">

			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-dark" id="menu-toggle">Toggle Menu</button>
			</nav>

			<div class="container">
				<h1 class="mt-4"></h1>
				<div class="row">
					<div class="col">
						<form action="upload.php" method="post" enctype="multipart/form-data" style="max-width:525px">
							<h5>Upload File</h5>
							<p>.mp3 or .m4a only.</p>
								<input type="file" name="myfile" required> <br>
							
							<br><h5>Artist</h5>
								<select class="form-control" name="artist" required>
									<option>ONE OK ROCK</option>
									<option>Muse</option>
									<option>Maksim</option>
								</select>

							<br><h5>Song Name</h5>
								<input class="form-control" type="text" name="song" required><br>

							<br><button type="submit" name="save" class="btn btn-dark btn-block">Upload</button>
						</form>
					</div>
				</div>
			</div>
		</div>
     <!-- /#page-content-wrapper -->
	</div>
  <!-- /#wrapper -->

	<!-- Menu Toggle Script -->
	<script>
	$("#menu-toggle").click(function(e) {
	  e.preventDefault();
	  $("#wrapper").toggleClass("toggled");
	});
	</script>
	
	<!-- Trigger Modal -->
	<script type="text/javascript">
		$(document).ready(function() {

			if(window.location.href.indexOf('#success') != -1) {
				$('#success').modal('show');
			}
			if(window.location.href.indexOf('#failed') != -1) {
				$('#failed').modal('show');
			}
		});
	</script>
	<!-- Modal Success HTML -->
	<div id="success" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header">
					<div class="icon-box">
						<i class="material-icons">&#xE876;</i>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body text-center">
					<h4>Great!</h4>	
					<p>File uploaded successfully.</p>
					<button class="btn btn-dark" data-dismiss="modal"><span>OK!</span></button>
				</div>
			</div>
		</div>
	</div>     
	<!-- Modal Failed HTML -->
	<div id="failed" class="modal fade">
		<div class="modal-dialog modal-confirm">
			<div class="modal-content">
				<div class="modal-header" style="background:#DC143C;">
					<div class="icon-box">
						<i class="material-icons">close</i>
					</div>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body text-center">
					<h4>Failed to upload!</h4>	
					<p>Your file must not be larger than 20 MB and only in .mp3 or m4a extension. Please try again.</p>
					<button class="btn btn-dark" data-dismiss="modal"><span>I understand.</span></button>
				</div>
			</div>
		</div>
	</div>     
</body>
</html>                                                        