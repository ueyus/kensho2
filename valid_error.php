<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>error</title>
</head>
<body onload="document.error_form.submit();">
	<form action="./index.php" method="post" name="error_form">
		<input type="hidden" name="comment-input" value="<?php print $_GET['comment-input']; ?>">
		<input type="hidden" name="category" value="<?php print $_GET['category']; ?>">
	</form>
</body>
</html>