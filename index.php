<style>
html {
	font-family: sans;
}

a {
	text-decoration: none;
	color: inherit;
}

.file-grid {
	display: grid;
	grid-template-columns: repeat(auto-fill, 200px);
	grid-gap: 1em;
}

.file p {
	text-align: center;
}

img {
	width: 100%;
	box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}

button {
	background-color: #746be2;
	color: white;
	border: 0px;
	border-radius: 4px;
	padding: 16px;
	margin-bottom: 24px;
}

.trash {
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACdUlEQVR4nO2bwWoUQRCG52IUDIigORjwtEig2Rn6/4s97wsYg08heIiQR0nEvIRGfQARxIuKGMGIb2AiSMiKrJesB2fC2IxO727P9Gyogv+ydFfX/013bV86SQLFcDi8RHILwHuSY5KTwBqTfAfgQa/Xuxiq7iBB8ibJTw2YrhSAj1mWrcb2nSTJ2ZdvzXxJ+8aYpdj+E5JbEcwX2oztP8nP/FlRIvKY5LXQ61hrr5N86qz1NvQ6U0dFwwtuvog0TVecXvCzqbW8w92W5229zhXU2np5d98E8Ibkj4iNblbNfm/IsmyV5H4HTITSB2vtDS/zxpilc2Z+QnKS/1tdqAUA4H7sYhvUPR8Ar51JT9I0XfHaPh2KqnsDgFe1E0mOypMW0XwRFfeGk9pJ7rZpoc5GY2o/CkABKIBFvPX5alQLQESed6DQRgRgz2cHrJE8jl1sA/o+GAxu+Z6bNQDP6NwJFlQjAHve5itg/JVwpiQtRvB6FYACUAD/TQjgLoBvFc3nSETutD0+BoCq4godtj2+dQBd/V0BKAAFoAAUgAJQAAqgzl9tKAAFoAAUgAJQAApAAcQ2NO3vCkABKAAFoAAUgAJQAHX+asMDwJE7ppC19muE8a0D2CB5WFWciKxHGB8cwK9ywjRNL8+dtKEwxiw7AMZzJyX5pZwUwO0AtTYS+W4pAzgIkfSRA+AzySsB6g0a/X7/asXH2p47sbU2I3nqQhCRdWPMcoDa54p822+45vOa+0EWAbD7r07cVYnIThDzSfLnARWAl7FN+QrAi+APrHMIu+5x6JhORWSn0dfleU94mDfDJp7JT6sxyQMA25zhzP8GTo1ysqKCdsUAAAAASUVORK5CYII=);
	background-size: contain;
	width: 20px;
	height: 20px;
	display: inline-block;
}
</style>


<form id="upload-form" enctype="multipart/form-data" action="index.php" method="POST">
    <input id="file" name="userfile" type="file" value="upload" style="display: none" onchange="document.getElementById('upload-form').submit()"/>
</form>
<button onclick="document.getElementById('file').click();">Upload file</button>


<div class="file-grid">

<?php
$uploaddir = 'uploads/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);

if(isset($_GET['delete'])){
	unlink($uploaddir . $_GET['delete']);
}

if ($handle = opendir($uploaddir)) {

	while (($file = readdir($handle)) !== false) {

        	if ($file != "." && $file != "..") {

           		echo "
				<div class='file'>
					<a href='$uploaddir$file'>
						<img src='$uploaddir$file'>
						<p>$file</p>
					</a>
					<a class='trash' href='?delete=$file'></a>
				</div>
			";
        	}
    	}

    	closedir($handle);
}
?>
</div>
