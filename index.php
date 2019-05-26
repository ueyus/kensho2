<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>XSS stored</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	
	
	<div class="container">
		<h1>掲示板</h1>	
		<div class="comment-box clearfix">
			<img class="account-img" src=1 onerror="this.src='images/no-image.jpg'">
			<form action="submit.php" class="keijiban-form" id="keijiban-form" method="post">
				<textarea class="comment-input" name="comment-input"><?php print isset($_POST['comment-input']) ? $_POST['comment-input'] : ''; ?></textarea>
				<div class="category-pull">カテゴリー<i class="red-font">（必須）</i>：
					<select name="category">
						<option value=""></option>
						<option value="01">全体</option>
						<option value="02">仕事</option>
						<option value="03">趣味</option>
					</select>
				</div>
				<button class="btn" onclick="document.getElementById('keijiban-form').submit();">投稿する</button>
			</form>
		</div>

		<div class="comment-bord">
			
			<?php
			
				try {
					$dsn = 'mysql:dbname=kensho_db;host=localhost;';
					$user = 'an';
					$password = 'password';
					$db = new PDO($dsn, $user, $password);
					$db->query('set names utf8');

					$sql = 'select id, datetime, comment from comment order by datetime desc';
					$stmt = $db->prepare($sql);

					$stmt->execute();

					$db = null;

					while (true) {
						$rec = $stmt->fetch(PDO::FETCH_ASSOC);
						if ($rec == false) {
								break;
						}
						print '<section class="comment">';
						print '<div class="comment-no">No.' . $rec['id'] . '</div>';
						print '<div class="comment-datetime">' . $rec['datetime'] . '</div>';
						print '<hr>';
						print '<div class="comment-text">' . $rec['comment'] . '</div>';
						print '</section>';
					}

				} catch (Exception $e) {
						print 'system error !!!';
						print $e;
						exit();
				} 
			?>
		

		</div>
	</div>
</body>
</html>