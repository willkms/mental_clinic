<?php

session_start();

if(isset($_POST['last-name'])){
  $last_name = '';
}
if(isset($_POST['first-name'])){
  $first_name = '';
}
if(isset($_POST['last-name-kana'])){
  $last_name_kana = '';
}
if(isset($_POST['first-name-kana'])){
  $first_name_kana = '';
}
if(isset($_POST['mail-address'])){
  $mail_address = '';
}
if(isset($_POST['TEL'])){
  $TEL = '';
}
if(isset($_POST['sex'])){
  $sex = '';
}
if(isset($_POST['age'])){
  $age = '';
}
if(isset($_POST['trouble'])){
  $trouble = '';
}
$last_name = htmlspecialchars($_POST['last-name']);
$first_name = htmlspecialchars($_POST['first-name']);
$last_name_kana = htmlspecialchars($_POST['last-name-kana']);
$first_name_kana = htmlspecialchars($_POST['first-name-kana']);
$mail_address = htmlspecialchars($_POST['mail-address']);
$TEL = htmlspecialchars($_POST['TEL']);
$sex = htmlspecialchars($_POST['sex']);
$age = htmlspecialchars($_POST['age']);
$trouble = htmlspecialchars($_POST['trouble']);

// クリックジャッギング対策
header('X-FRAME-OPTIONS: DENY');

//CSRF対策
// POSTでcsrf_tokenの項目名でパラメーターが送信されていること且つ、
// セッションに保存された値と一致する場合は正常なリクエストとして処理を行います
if (!isset($_POST["csrf_token"])
 || htmlspecialchars($_POST["csrf_token"]) !== htmlspecialchars($_SESSION['csrf_token'])) {

 echo "不正なリクエストです";
 exit();

 }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>内容確認</title>
  <link rel="stylesheet" href="form.css">
</head>
<body>
  <p class = "form-title">入力フォーム内容確認</p>
  <form action = "submit_complete.php" method = "post">
    <table class = "form-table">
      <tbody>
        <tr>
          <th class = "form-subtitle">お名前(漢字)</th> <td> <p class = "p-last-name"><?php echo $last_name;?></p><p class = "p-first-name"><?php echo $first_name;?></p></td>
        </tr>
        <tr>
          <th class = "form-subtitle">お名前(フリガナ)</th> <td> <p class = "p-last-name-kana"><?php echo $last_name_kana;?></p><p class = "p-first-name-kana"><?php echo $first_name_kana;?></p></td>
        </tr>
        <tr>
          <th class = "form-subtitle">メールアドレス</th><td><p class = "p-mail-address"><?php echo $mail_address;?></p></td>
        </tr>
        <tr>
          <th class = "form-subtitle">電話番号</th><td><p class = "p-TEL"><?php echo $TEL;?></p></td>
        </tr>
        <tr>
          <th class = "form-subtitle">性別</th><td><p class = "input-contents"><?php echo $sex;?></p></td>
        </tr>
        <tr>
          <th class = "form-subtitle">年齢</th><td><p class = "input-contents"><?php echo $age;?></p></td>
        </tr>
        <tr>
          <th class = "form-subtitle">ご相談内容</th><td><p class = "p-trouble"><?php echo $trouble; ?></p></td>
        </tr>
      </tbody>
    </table>
    <input type = "hidden" name = "csrf_token" value = "<?= htmlspecialchars($_POST["csrf_token"])?>">
    <input type = "hidden" name = "last-name" class = "last-name" value = "<?php echo $last_name;?>">
    <input type = "hidden" name = "first-name" value = "<?php echo $first_name;?>">
    <input type = "hidden" name = "last-name-kana" class = "last-name-kana" value = "<?php echo $last_name_kana;?>">
    <input type = "hidden" name = "first-name-kana" value = "<?php echo $first_name_kana;?>">
    <input type = "hidden" name = "mail-address" value = "<?php echo $mail_address;?>">
    <input type = "hidden" name = "TEL" value = "<?php echo $TEL;?>">
    <input type = "hidden" name = "sex" value = "<?php echo $sex;?>">
    <input type = "hidden" name = "age" value = "<?php echo $age;?>">
    <input type = "hidden" name = "trouble" value = "<?php echo $trouble; ?>">
    <button type = "button" class = "back" onclick = "history.back()">戻る</button>
    <div class = "submit-wrapper">
      <input class = "submit" type = "submit" value = "上記内容で送信する">
    </div>
  </form>
</body>
</html>
