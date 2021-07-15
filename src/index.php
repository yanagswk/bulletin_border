<?php 

    session_start();
    
    $error = true;

    // postで送信された場合
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if ($_POST['message']) {
            $text = $_POST['message'] ;
    
            // $_SESSION['bulletin'] = [
                    // [today=>'2021-07-15', message=>'こんにちは'],
                    // [today=>'2021-07-15', message=>'こんにちは'],
                    // [today=>'2021-07-15', message=>'こんにちは']
            // ]
    
            $today = date('Y-m-d H:i:s');
            $messageArray['today'] = $today;
            $messageArray['message'] = $text;
    
            if (strlen($_POST['message']) <= 75) {
                $_SESSION['bulletin'][] = $messageArray;
            } else {
                $error = false;
            }

            // todayだけの配列に対して、"strtotime"を実行する。
            $result = array_map("strtotime", array_column($_SESSION['bulletin'], "today"));
            // 変換されたtodayを降順にソートする。
            array_multisort($result, SORT_DESC, $_SESSION['bulletin']);
            
            // print_r($_SESSION['bulletin']);
        }

        // 削除処理
        // if ($_POST['delete']) {
        //     $index = $_POST['id'];
        //     $_SESSION['bulletin'] = array_splice($_SESSION['bulletin'], $index, 1);
        // }
    }


    // エスケープ処理 
    function h($str) {
        return htmlspecialchars($str);
    }
    

?>




<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡易掲示板</title>
    <style type="text/css">
        *{margin: 0;padding: 0;list-style: none;}
        .wrap {
            width: 600px;
            margin: 0 auto;
            padding: 20px 0 100px 0;
            background: #f1f1f2;
            min-height: 100vh;
        }
        li {
            position: relative;
            padding: 10px 20px;
            margin: 10px 10px 3px 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        span{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            font-size: 12px;
            color: #ccc;
        }
        form{
            position: fixed;
            top: 10%;
            left: 5vw;
        }
        .error_msg {
            font-size: 14px;
            color: #ff0000;
            height: 14px;
        }

    </style>
</head>
<body>

    <div class="wrap">
        <ul>
            <?php if (isset($_SESSION['bulletin'])): ?>
                <?php foreach($_SESSION['bulletin'] as $index=>$message):  ?>
                    <li><?php echo h($message['message']); ?><span><?php echo $message['today']; ?></span></li>
                    <!-- <form action="index.php" method="post"> -->
                        <input type="hidden" name="id" value="<?php echo $index; ?>">
                        <input type="submit" name="delete" value="delete" class="delete-button">
                        <input type="submit" name="update" value="update" class="update-button">
                    <!-- </form> -->
                    <?php endforeach ?>
                <?php endif ?>
            </ul>
    </div>

    <form action="index.php" method="POST">
        <input type="text" name="message">
        <input type="submit" value="送信">
        <?php if (!$error): ?>
            <p class="error_msg">* 文字が多すぎます</p>
        <?php endif ?>
    </form>


</body>
</html>