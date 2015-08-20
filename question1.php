<?php
	session_start();

	if (!isset($_SESSION['user'])){
		exit('Invalid Access. Please go to the <a href="login.php">login</a> page.');
	}
	$user = $_SESSION['user'];
	$batches = $_SESSION['batch_num'];
?>

<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<title>Twitter Network Survey</title>
<style>
    .table-head{padding-right:17px;background-color:#999;color:#000;}
    .table-body{width:100%; height:300px;overflow-y:scroll;}
    .table-head table,.table-body table{width:100%;}
    .table-body table tr:nth-child(2n+1){background-color:#f2f2f2;}</style>
</head>
</head>
<body>
	<div class="container">
		<?php
			require("conn.php");
			include("lib.php");
			echo "<p>Welcome <b>$user</b></p>";
		?>
		<form class="form-horizontal" action="save.php" method="post">
			<h1 align="middle">Twitter Network Survey</h1>
			<h2 align="middle">Step 1 Out of 9: Label your Friends</h2>

			<p align="middle">Please check which accounts are non personal accounts (i.e. news, company, institution, or group accounts) and accounts that you do not know. 
	Accounts that you do not know are accounts that Twitter automatically follows for you. It also includes the accounts that you have completely forgotten about. 
	If an account does not belong to the two categories, leave the checkboxes empty. We have helped you labelled some of the accounts.</p>
			<p align="middle"><b>
			<?php
				$batch = $_GET['batch'];
				$_SESSION['batch'] = $batch;
				echo "You are at batch ".$batch." out of ".$batches." batches.";
				$js = get_json($user, $batch)['users'];
				$_SESSION['friends'] = $js;
				//echo $js[];
				//var_dump($js);
				$size = sizeof($js);
				$i = 0;
				
				
			?>
			</b></p>
			
		<table class="table table-striped table-bordered">
			<colgroup>
				<col style="width: 80px;" />
	 			<col />
	 		</colgroup>
		<thead>
			<tr ><th>Friends</th> <th>Profile Image</th> <th>Non-Personal Accounts</th><th>I do not know who this account belongs to</th></tr>
		</thead>
			<?php
				foreach ($js as $u) {

					$id = $u['id'];
					$uname = $u['name'];
					$uname = str_replace('(ap)',"\u0027", $uname); 
					$uname = str_replace('(qm)',"\u0022", $uname); 
					$uname = str_replace('(ga)',"\u0060", $uname); 
					$uname = str_replace('(aa)',"\u00B4", $uname); 
					$uname = str_replace('(lsqm)',"\u2018", $uname); 
					$uname = str_replace('(rsqm)',"\u2019", $uname); 
					$uname = str_replace('(ldqm)',"\u201c", $uname); 
					$uname = str_replace('(rdqm)',"\u201d", $uname); 
					$uname = str_replace('(rdqm)',"\u201d", $uname); 
					$uname = str_replace('(r)'," ", $uname);

					$imgid = 'image'.$i;
					$imgurl = $u['profile_background_image_url'];
					$sname = $u['screen_name'];
					$url = "http://www.twitter.com/".$sname;
					$relation = $u['relationship'];
					//$Non_Personalid = $i*2;
					//$Whoisthisid = $i*2+1;
					echo "<tr id='$id'>";
					echo "<td align = 'middle' ><a href='$url'>".$uname."</a></td>";
					echo "<td align = 'middle' > <img src='$imgurl'></td>";
					if ($relation == 'Nonpersonal')
						echo "<td align = 'middle'><input type = 'radio' name = 'radio".$id."' checked = 'check' value = 'Nonpersonal'></td>";
					else
						echo "<td align = 'middle'><input type = 'radio' name = 'radio".$id."' value = 'Nonpersonal'></td>";
					if ($relation == 'Irrelevant')
						echo "<td align = 'middle'><input type = 'radio' name = 'radio".$id." checked = 'check' value = 'Irrelevant'></td>";
					else
						echo "<td align = 'middle'><input type = 'radio' name = 'radio".$id."' value = 'Irrelevant'></td>";
					echo "</tr>";

					$i = $i + 1;
				}
				$from = $batch - 1;
				$to = $batch + 1;
				if ($from == 0){
					$from = 1;
				}
				if ($to == $batches + 1){
					$to = $batches;
				}
				$prebatchurl = "question1.php?batch=".($from);
				$nextbatchurl = "question1.php?batch=".($to);
			?>
		
		</table>
		<nav align = "middle">
			<ul class="pagination">
				<li class='disabled' >
					<a href='#' aria-label="Previous">
						<span aria-hidden="true">Previous Question</span>
					</a>
				</li>
				<!--
				<li class=<?php //if ($batch == 1) echo 'disabled'; else echo 'active'; ?> >
					<a href=<?php //echo $prebatchurl; ?> aria-label="Previous">
						<span aria-hidden="true">Previous Batch</span>
					</a>
				</li>
				-->
				<?php
					for ($i=1; $i <= $batches; $i++) { 
						$url = "question1.php?batch=".$i;
						if ($i == $batch){
							echo "<li><button type = 'button' disabled>$i</li>";
						}else{
							echo "<li><button type = 'submit' name='save' class='btn-link' value='question1_$i'>$i</li>";
						}
						
					}
				?>
				<!--
				<li class=<?php //if ($batch == $batches) echo 'disabled'; else echo 'active'; ?>>
	      			<button type = 'button' class='btn-link'>Next Batch</button>
	      			<a href=<?php //echo $nextbatchurl?> aria-label="Next">
	        			<span aria-hidden="true">Next Batch</span>
	      			</a>
	      			
	    		</li>-->
	    		<li class="active">
	    			<button type='submit' name='save' class="btn btn-primary" value='question1_next'>Next Question</button>
	      			<!--<a href='question2.php?batch=1' aria-label="Next">
	        			<span aria-hidden="true">Next Question</span>
	      			</a>-->
	    		</li>
	  		</ul>
		</nav>
		<div align="middle">
			<button type='submit' name='save' class="btn btn-primary" value='question1_logout'>Logout</button>
		</div>
	</form>
</div>

</body>
</html>