<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>投稿完了</title>
</head>
<body>

<?php
		try {
			$comment_input = $_POST['comment-input'];
			$category = $_POST['category'];

			if (!$category) {
				header('Location: ./valid_error.php?comment-input=' . $comment_input . '&category=' . $category);
				exit();
			}
			
			// $kaiin_name = htmlspecialchars($kaiin_name);

			$dsn = 'mysql:dbname=kensho_db;host=localhost;';
			$user = 'an';
			$password = 'password';
			$db = new PDO($dsn, $user, $password);
			$db->query('set names utf8');

			$sql = 'insert into comment(comment) values(?)';
			$stmt = $db->prepare($sql);
			$data = [$comment_input];

			$stmt->execute($data);

			$db = null;

			header('Location: ./index.php');

		} catch (Exception $e) {
			print 'system error!!';
			exit();

		}
?>
</body>
</html>