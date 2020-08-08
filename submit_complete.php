<?php

session_start();

require 'C:\xampp\lib\PHPMailer-master\src\Exception.php';
require 'C:\xampp\lib\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\lib\PHPMailer-master\src\SMTP.php';
require 'setting.php';

use PHPMailer\PHPMailer\PHPMailer;

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
//メールヘッダインジェクション対策に改行を削除する
//XSS対策にエスケープ処理を行う

$last_name = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['last-name']) );
$first_name = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['first-name']) );
$last_name_kana = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['last-name-kana']) );
$first_name_kana = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['first-name-kana']) );
$mail_address = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['mail-address']) );
$TEL = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['TEL']) );
$sex = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['sex']) );
$age = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['age']) );
$trouble = str_replace( array("\r\n", "\r", "\n"), '' , htmlspecialchars($_POST['trouble']) );

/** メールの送信テスト */

/// メーラーインスタンス作成
$mailer = new PHPMailer();

/// 文字コード
$mailer->CharSet = 'UTF-8';
$mailer->Encoding = '7bit';

/// SMTPサーバーを利用する
$mailer->IsSMTP();
$mailer->SMTPAuth = true;

/// SMTPサーバー
$mailer->Host = MAIL_HOST;
/// 送信元のユーザー名
$mailer->Username = MAIL_USERNAME;
/// 送信元のパスワード
$mailer->Password = MAIL_PASSWORD;
/// TLS暗号化を有効にし、SSLも受け入れる
$mailer->SMTPSecure = MAIL_ENCRPT;
/// ポート番号
$mailer->Port = SMTP_PORT;

/// 送信元メルアド
$mailer->From = MAIL_FROM;
/// 送信者名
$mailer->FromName = MAIL_FROM_NAME;

/// 送信先と件名・本文を設定してテスト送信
/// 送信先アドレス
$mailer->addAddress( $mail_address );
/// メール件名
$mailer->Subject = MAIL_SUBJECT;
/// メール本文
$body = '';
$body .= 'こんにちは。受信テスト送信です。'."\r\n";
$body .= 'お名前(漢字)：'.$last_name.$first_name."\r\n";
$body .= 'お名前(フリガナ)：'.$last_name_kana.$first_name_kana."\r\n";
$body .= 'メールアドレス'.$mail_address."\r\n";
$body .= '電話番号：'.$TEL."\r\n";
$body .= '性別：'.$sex."\r\n";
$body .= '年齢：'.$age."\r\n";
$body .= 'ご相談内容：'.$trouble."\r\n";

$mailer->Body = $body;

/// メール送信
$result = $mailer->send();

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
  <title>送信完了</title>
  <link rel="stylesheet" href="form.css">
</head>
<body>
  <p class = "form-title">送信が完了しました。</p>
  <div class = "send-submit-wrapper">
    <a href = "mental_clinic.php" class = "back-to-mental">戻る</a>
  </div>

</body>
</html>
