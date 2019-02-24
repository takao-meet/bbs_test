<?php
require('dbconnect.php');


if (!empty($_POST)) {
    if ($_POST['message'] !== '') {
        $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, reply_message_id=?, created=NOW()');
        $message->execute(array(
            1,
            $_POST['message'],
            0
        ));
    }

    header('Location: index.php');
    exit();
}

$posts = $db->prepare('SELECT * FROM posts');
$posts->execute();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ひとこと掲示板</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
<div id="wrap">
    <div id="head">
    <h1>ひとこと掲示板</h1>
    </div>
    <div id="content">
        <form action="" method="post">
            <textarea name="message" cols="50" rows="5"></textarea>
            <input type="hidden" name="reply_post_id" value="" />
            <div>
                <p>
                <input type="submit" value="投稿する" />
                </p>
            </div>
        </form>
    </div>

<hr />
<?php foreach ($posts as $post): ?>
    <div class="msg">
    <?php print(htmlspecialchars($post['message'], ENT_QUOTES)); ?>
    <hr /></div>
<?php endforeach; ?>



</div>
</body>
</html>
