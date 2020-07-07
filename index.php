<?php
$hostingUrl = "http://sangu.be/tests/";

$success = false;
// if ($_SERVER["SERVER_ADDR"] === "::1")
// {
// 	$mysqli = new mysqli("localhost", "root", "", "test");
// }
// else
// {
$mysqli = new mysqli("mysql", "root", "my-secret-pw", "woutrunforlive");
// }

if (isset($_POST['done']))
{
	if (!$mysqli->connect_errno)
	{
		if ($stmt = $mysqli->prepare("insert into sponsors (name, email, amount) values (?, ?, ?)"))
		{
			$amount = floatval($_POST['amount']);
			$stmt->bind_param("ssd", $_POST['name'], $_POST['email'], $amount);
			$stmt->execute();

			$success = true;
		}
	}
	else
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
}
?>
<!doctype html>
<html>
<head>
<title>Run For Life</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="script.js"></script>

<script type='text/javascript'>
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>

<meta property="og:url" content="<?=$hostingUrl?>" />
<meta property="og:title" content="Run For Life" />
<meta property="og:image" content="<?=$hostingUrl?>images/facebook.png" />
<meta property="og:description" content="Help Wout Music For Life te sponseren!" />
<meta property="og:image:url" content="<?=$hostingUrl?>images/facebook.png" />
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/nl_BE/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header class="navbar navbar-default">
	<table><tr>
		<td width="1%"><img src='images/stubrulogo.png' style="max-width: 220px; max-height: 124px"></td>
		<td width="99%" style="padding-left: 3px">
			<h1>Run For Life</h1>
			<h2>Help <a href='https://www.facebook.com/Woutvda'>Wout</a> Music For Life te sponseren!</h2>

			€0.25/km voor elke Super Mario sponser-sprong.<br>
			Voor alle praktische informatie en meer info over het gesteunde goede doel, <a href="help.php">klik hier</a>.
		</td>
	</tr></table>
</header>

<?php
if ($success)
{
	?>
	<div class='alert alert-success'>
		<?=$_POST['name']?> sponsert €<?=$_POST['amount']?> / km. Wheee!<br>

		<!--<a href="https://www.facebook.com/dialog/feed?app_id=1438439249728371&display=popup&caption={caption}&link=http://sangu.be/tests/&description={description}&redirect_uri={redirect-url-to-your-site}">grrrr</a>-->

		<div class="fb-share-button" data-href="<?=$hostingUrl?>" data-layout="button"></div>
	</div>
	<?php
}
?>

<div class="container">

<div id='gamebox' class="col-xs-6">
	<div class="pull-right">
		<div id='amountbox'>€ <span id='amount'>0.00</span> <img src="images/resetamount-start.gif" id="resetamount" data-toggle="tooltip" data-placement="right" title="Klik om het bedrag te resetten!"></div>
		<div id='mario-start'>
			<img src='images/animation-start.gif'>
		</div>
		<div id='mario-animation'>
			<img src='images/animation.gif' id='mario-animation-img'>
		</div>

		<div id='jumperbox'>
			<button type="button" class="btn btn-lg btn-warning" id='jumper' data-toggle="tooltip" data-placement="right" title="Klik om het sponserbedrag te verhogen!">Sponseren!</button>
		</div>
	</div>
</div>

<div id='form' class="col-xs-6">
<form method='post'>

<br><br><br><br><br><br><br><br><br><br><br><br>

	<input type='hidden' name='amount' id='savedAmount'>
	<div class="form-group">
		<label>Naam *</label>
		<input type='text' name='name' class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type='text' name='email' class="form-control">
	</div>

	<button type='submit' name='done' class="btn btn-primary" disabled>Ik ben klaar</button>
</form>

</div>

</div>



<div id="sponsorOpener">
	<hr>
	<button class="btn btn-default" id="openSponsors">Wie sponsert er al?</button>
</div>

<div id='currentSponsors' class="hidden">
	<hr>
	<table class="table table-striped">
	<thead>
		<tr><th colspan='2'>Wie sponsert er al?</th></tr>
	</thead>
	<thead>
		<tr><th>Naam</th><th>€ / km</th></tr>
	</thead>
	<tbody>
		<?php
		if ($result = $mysqli->query("select name, amount from sponsors")) {
			$totalAmount = 0;
			while ($row = $result->fetch_assoc()) {
				$amount = floatval($row["amount"]);
				printf("<tr><td>%s</td><td align='right'>€%s</td></tr>", $row["name"], $amount);
				$totalAmount += $amount;
			}

			$result->free();

			printf("<tr><td colspan='2' align='right'><b>€%s / km</b></td></tr>", $totalAmount);
		}
		?>
	</tbody>
	</table>
</div>

</body>
</html>
<?php
$mysqli->close();
?>
