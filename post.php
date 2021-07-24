<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>掲示板</title>
    </head>
    <body>
        <h1>新規投稿</h1>
        <form action="" method="post">
            <h2>
                <label>タイトル：</label>
                <input type="text" placeholder= "title" name="title">
            </h2>
            <h2>
                <label>書き込み内容：</label>
                <input type="text" placeholder= "contents" name="contents">
            </h2>
            <input type="submit" name="submit" value="     投稿    "><a href="logout.php">ログアウト</a>
    </body>
    <h1>
        <?php
            session_start();
            if ($_SESSION["id"] == null) {
                echo "ログインしてください";
            }else {
                echo  "あなたのIDは".$_SESSION["id"]."です"; 
            }
        ?>
    </h1>
	<h2>投稿内容一覧</h2>
		<?php
            try {
                $pdo = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');

                $stmt = $pdo->prepare("SELECT * FROM posts order by id DESC");
                $stmt->execute();

            } catch (Exception $e) {
                echo "データベースの接続に失敗しました：";
                echo $e->getMessage();
                die();
            }
            foreach($stmt as $loop):?>
            <div>No：<?php echo $loop['id']?></div>
			<div>ID：<?php echo $loop['userid']?></div>
			<div>タイトル：<?php echo $loop['title']?></div>
			<div>投稿内容：<?php echo $loop['contents']?></div>
            <div>投稿内容：<?php echo $loop['time']?></div>
			<div>------------------------------------------</div>
		<?php endforeach;?>
</html>

<?php
ini_set('display_errors',"On");

echo  "UserID".$_SESSION["id"];
$userid = $_SESSION["id"];

if ($_POST) {
    try{
        $pdo = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');
        if ($_POST['title'] != null || $_POST['contents'] != null) {
            $stmt = $pdo->prepare("INSERT INTO posts (userid, title, contents) VALUES (:userid, :title, :contents)");

            $stmt->execute(array(':userid' => $userid,':title' => $_POST['title'],':contents' => $_POST['contents'],));
        }
        header('Location: ./post.php');
        exit();
    }catch(Exception $e){
        echo "データベースの接続に失敗しました：";
        echo $e->getMessage();
        die();
    }
}
?>
