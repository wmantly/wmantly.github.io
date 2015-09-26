<html>
<head>
	<title>JSON Test Maker</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="../js/ICanHaz.js"></script>
	<script type="text/javascript">
	var removeMe = function ( field ) {
		$( '#'+field).slideUp(function(){
			$( '#'+field).remove();
		});	
	}
	var addField = function( ){
		var append = ich.addField({
			count : count++
		});

		$('.fields').last().after(append);
		//append.after('.field'); // append results to the list
	}
	</script>
</head>
<body>
<script id="addField" type="text/html">
<div id="field<<count>>" class="fields">
	<label>Value</label><br />
	<input type="text" name="<<count>>[value]" /><br />

	<label>Valid</label>
	<input type="checkbox" name="<<count>>[valid]" value="true"/><br />

	<label>Comments</label><br />
	<textarea name="<<count>>[comment]"></textarea><br />

	<button type="button" onclick="removeMe('field<<count>>');">Remove</button>
	<hr />
</div>
</script>


<?php

if($_POST){
	file_put_contents($_GET['ruleName'].'.json' , json_encode($_POST));
}

$ruleName = $_GET['ruleName'] ? $_GET['ruleName'] : '';
$json_data = file_get_contents( './' . $ruleName. '.json' );
$array = json_decode($json_data, true);
echo "<form action='?ruleName=$ruleName' method='post'>";
$count = 0;
foreach ($array as $key => $value) {
	?>
	<div id="field<?=$count?>" class='fields'>
	<label>Value</label><br />
	<input type="text" name="<?=$count?>[value]" value="<?=$value['value']?>" /><br />

	<label>Valid</label>
	<input type="checkbox" name="<?=$count?>[valid]" value="true"  <?=$value['valid'] ? "checked" : '' ?> /><br />

	<label>Comments</label><br />
	<textarea name="<?=$count?>[comment]"><?=$value['comment']?></textarea><br />

	<button type="button" onclick="removeMe('field<?=$count?>');">Remove</button>
	<hr />
	</div>
	<?php
	$count ++ ;
}
?>
<script type="text/javascript">
	var count = <?=$count?>;
</script>
<button type="button" onclick="addField()">Add Field</button><br />
<input type="submit"/>

</form>
</body>
</html>