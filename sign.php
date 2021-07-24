<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>会員登録</title>
    </head>
    <body>
        <h1>サインイン</h1>
        <form action="" method="post">
            <p>
                <label>メールアドレス：</label>
                <input type="text" placeholder= "email" name="email">
            </p>

            <p>
                <label>パスワード：</label>
                <input type="password" placeholder="password" name="pass">
            </p>

            <input type="submit" name="submit" value="　　　登録　　　">
        </form>
        <a href="login.php">ログインへ</a>
    </body>
</html>

<?php
ini_set('display_errors',"On");

if ($_POST) {
    try {
        $pdo = new PDO('mysql:dbname=mydb;host=localhost;charset=utf8', 'root', 'root');
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $stmt->execute(array(':email' => $_POST['email'],':password' => password_hash($_POST['pass'], PASSWORD_DEFAULT)));
        
        header('Location: ./login.php');
        exit();
    }catch(Exception $e){
        echo "データベースの接続に失敗しました：";
        echo $e->getMessage();
        die();
    }
}
?>