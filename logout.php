<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ログアウト</title>
    </head>
    <body>
        <div>
            <?php
                $_SESSION = array();
                if (isset($_COOKIE[session_name()])) {
                    setcookie(session_name(), '', time()-42000, '/');
                }
                session_destroy();
                echo "ログアウトしました。";
            ?>
            <a href="login.php">ログインへ</a>
        </div>
    </body>
</html>