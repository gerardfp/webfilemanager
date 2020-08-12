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
	grid-template-rows: repeat(auto-fill, 250px);
	grid-gap: 1em;
}

.file {
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
}

.file a {
        display: flex;
        flex-direction: column;
        align-items: center;
}

.file p {
	text-align: center;
}

img {
	max-width: 80%;
	max-height: 80%;
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
	/*
	background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACdUlEQVR4nO2bwWoUQRCG52IUDIigORjwtEig2Rn6/4s97wsYg08heIiQR0nEvIRGfQARxIuKGMGIb2AiSMiKrJesB2fC2IxO727P9Gyogv+ydFfX/013bV86SQLFcDi8RHILwHuSY5KTwBqTfAfgQa/Xuxiq7iBB8ibJTw2YrhSAj1mWrcb2nSTJ2ZdvzXxJ+8aYpdj+E5JbEcwX2oztP8nP/FlRIvKY5LXQ61hrr5N86qz1NvQ6U0dFwwtuvog0TVecXvCzqbW8w92W5229zhXU2np5d98E8Ibkj4iNblbNfm/IsmyV5H4HTITSB2vtDS/zxpilc2Z+QnKS/1tdqAUA4H7sYhvUPR8Ar51JT9I0XfHaPh2KqnsDgFe1E0mOypMW0XwRFfeGk9pJ7rZpoc5GY2o/CkABKIBFvPX5alQLQESed6DQRgRgz2cHrJE8jl1sA/o+GAxu+Z6bNQDP6NwJFlQjAHve5itg/JVwpiQtRvB6FYACUAD/TQjgLoBvFc3nSETutD0+BoCq4godtj2+dQBd/V0BKAAFoAAUgAJQAAqgzl9tKAAFoAAUgAJQAApAAcQ2NO3vCkABKAAFoAAUgAJQAHX+asMDwJE7ppC19muE8a0D2CB5WFWciKxHGB8cwK9ywjRNL8+dtKEwxiw7AMZzJyX5pZwUwO0AtTYS+W4pAzgIkfSRA+AzySsB6g0a/X7/asXH2p47sbU2I3nqQhCRdWPMcoDa54p822+45vOa+0EWAbD7r07cVYnIThDzSfLnARWAl7FN+QrAi+APrHMIu+5x6JhORWSn0dfleU94mDfDJp7JT6sxyQMA25zhzP8GTo1ysqKCdsUAAAAASUVORK5CYII=);
	*/
	background-image: url(data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzMwMHB4JyB3aWR0aD0nMzAwcHgnICBmaWxsPSIjMDAwMDAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGRhdGEtbmFtZT0iTGF5ZXIgMSIgdmlld0JveD0iMCAwIDk2IDk2IiB4PSIwcHgiIHk9IjBweCI+PHRpdGxlPkFydGJvYXJkIDY2PC90aXRsZT48cG9seWdvbiBwb2ludHM9IjQwLjc4IDY2IDU1LjIyIDY2IDU3Ljc2IDQ0IDM4LjI0IDQ0IDQwLjc4IDY2Ij48L3BvbHlnb24+PHBvbHlnb24gcG9pbnRzPSI0NC4yNCAzMSA0My4yNCAzMyA1Mi43NiAzMyA1MS43NiAzMSA0NC4yNCAzMSI+PC9wb2x5Z29uPjxwYXRoIGQ9Ik00OCwyQTQ2LDQ2LDAsMSwwLDk0LDQ4LDQ2LDQ2LDAsMCwwLDQ4LDJaTTYyLDQyLjIzbC0zLDI2QTIsMiwwLDAsMSw1Nyw3MEgzOWEyLDIsMCwwLDEtMi0xLjc3bC0zLTI2YTIsMiwwLDAsMSwuNS0xLjU2QTIsMiwwLDAsMSwzNiw0MEg2MGEyLDIsMCwwLDEsMS40OS42N0EyLDIsMCwwLDEsNjIsNDIuMjNaTTYzLDM3SDMzYTIsMiwwLDAsMSwwLTRoNS43NmwyLjQ1LTQuODlBMiwyLDAsMCwxLDQzLDI3SDUzYTIsMiwwLDAsMSwxLjc5LDEuMTFMNTcuMjQsMzNINjNhMiwyLDAsMCwxLDAsNFoiPjwvcGF0aD48L3N2Zz4=);
	background-size: contain;
	width: 30px;
	height: 30px;
	display: block;
	position: relative;
	top: -80px;
	left: -6px;
}

input[type=file] {
	display: none;
}

</style>


<form id="upload-form" enctype="multipart/form-data" action="?" method="POST">
    <input id="file" name="userfile" type="file" onchange="document.getElementById('upload-form').submit()"/>
</form>
<button onclick="document.getElementById('file').click();">Upload file</button>



<?php
move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/' . $_FILES['userfile']['name']);

if(isset($_GET['delete'])){
	unlink('uploads/' . $_GET['delete']);
}
?>


<div class="file-grid">
<?php
if ($handle = opendir('uploads/')) {
	while (($file = readdir($handle)) !== false) {
        	if ($file != "." && $file != "..") {
           		echo "
				<div class='file'>
					<a href='uploads/$file'>
						<img src='uploads/$file'>
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
