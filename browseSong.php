<?php
	include_once("header.php");
	include_once("config.php");
	
	$sq1 = $op->prepare("SELECT title,composer,arr,loc,id FROM songs ORDER BY title LIMIT 20");
	$sq1->execute();
	echo $sq1->error;
	$sq1->bind_result($v['title'],$v['composer'],$v['arr'],$v['loc'],$v['id']);
	
?>
	<link rel="stylesheet" media="screen" href="css/browseSong.css"/>
	<div class="row">
		<div class="centered twelve columns field" align="center">
			<div class="field">
				<input type="text" class="search input" id="searchSongs" placeholder="Search your songs by typing here..."/>
			</div>
		</div>
		<div class="centered twelve columns" align="center">
			<table border='1'>
				<thead id="songHeader">
					<tr>
						<td>Title</td>
						<td>Composer</td>
						<td>Arranger</td>
						<td>View Online</td>
						<td>Download File</td>
						<?php
							if(isset($_SESSION["username"])){
								echo "<td>Edit file</td>";
							}
							if(isset($_SESSION["role"]) && ($_SESSION["role"] == 1 || $_SESSION["role"] == 0)){
								echo "<td>Delete file</td>";
							}
						?>
					</tr>
				</thead>
				<tbody id="songContent">
		
<?php
	while($sq1->fetch()){
		$title = $v['title'];
		$composer = $v['composer'];
		$arranger = $v['arr'];
		$location = $v['loc'];
		$id = $v['id'];
		echo "<tr>";
		echo "<td>".$title."</td>";
		echo "<td>".$composer."</td>";
		echo "<td>".$arranger."</td>";
		echo "<td class='view'><a href='viewSong.php?id=".$id."'><i class='icon-eye'></i>View</a></td>";
		echo "<td class='download'><a href='".$location."'><i class='icon-download'></i>Download</a></td>";
		if(isset($_SESSION["username"])){
			echo "<td class='edit'><a href='editSong.php?id=".$id."'><i class='icon-pencil'></i>Edit</a></td>";
		}
		if(isset($_SESSION["role"]) && ($_SESSION["role"] == 1 || $_SESSION["role"] == 0)){
			echo "<td class='delete'><a href='deleteSong.php?id=".$id."'><i class='icon-trash'></i>Delete</a></td>";
		}
		echo "</tr>";			
	}
?> 
			</tbody>
			</table>
		</div>
	</div>
	<br/>
<?php
	include_once 'footer.php';
?>
<script src="js/browseSong.js"></script>
