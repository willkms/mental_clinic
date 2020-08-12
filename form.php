<?php
session_cache_limiter('public');
session_start();

// 暗号学的に安全なランダムなバイナリを生成し、それを16進数に変換することでASCII文字列に変換します
 $toke_byte = openssl_random_pseudo_bytes(16);
 $csrf_token = bin2hex($toke_byte);
 // 生成したトークンをセッションに保存します
 $_SESSION['csrf_token'] = $csrf_token;

// クリックジャッギング対策
header('X-FRAME-OPTIONS: DENY');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="form.css">
  <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-autosize@1.18.18/jquery.autosize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/libphonenumber-js/1.1.10/libphonenumber-js.min.js"></script>
  <script src="form_check.js" charset="utf-8"></script>
  <script src="textarea_auto_resize.js" charset="utf-8"></script>
</head>
<body>
  <p class = "form-title">入力フォーム</p>
  <form action = "confirm.php" id = "form1" method = "post" autocomplete = "off" onsubmit = "return InputCheck()">
    <input type = "hidden" name = "sex" value = "">
    <input type = "hidden" name = "csrf_token" value = "<?= $csrf_token?>">
    <table class = "form-table">
      <tbody>

        <tr>
          <th class = "form-subtitle">お名前(漢字)<span class = "red">必須</span></th> <td>  <input type = "text" name = "last-name" class = "last-name" placeholder = "姓">  <input type = "text" name = "first-name" class = "first-name" placeholder = "名"></td>
        </tr>

        <tr>
          <th class = "form-subtitle">お名前(フリガナ)</th> <td>  <input type = "text" name = "last-name-kana" class = "last-name-kana" placeholder = "姓"> <input type = "text" name = "first-name-kana" class = "first-name-kana" placeholder = "名"> </td>
        </tr>

        <tr>
          <th class = "form-subtitle">メールアドレス<span class = "red">必須</span></th><td><input type = "email" name = "mail-address" class = "mail-address" onchange = "EmailPatternCheck()"></td>
        </tr>
        <tr>
          <th class = "form-subtitle">電話番号<span class = "red">必須</span></th><td><input type = "tel" inputmode = "tel" name = "TEL" class = "TEL" onchange = "TELPatternCheck()"></td>
        </tr>
        <tr>
          <th class = "form-subtitle">性別</th><td><input type = "radio" name = "sex" value = "男">男<input type = "radio" name = "sex" value = "女">女</td>
        </tr>
        <tr>
          <th class = "form-subtitle">年齢</th><td><input type = "number" name = "age" class = "age" value = "20"></td>
        </tr>
        <tr>
          <th class = "form-subtitle">利用規約</th>
          <td>
            <div class = "TOS">
              あいうえお<br>
              かきくけこ<br>
              さしすせそ<br>
              たちつてと<br>
              なにぬねの<br>
              はひふへほ<br>
              まみむめも<br>
              や　ゆ　よ<br>
              らりるれろ<br>
              わ　を　ん
            </div>
            <input type = "checkbox" id = "TOS" value = "同意する">同意します
          </td>
        </tr>
        <tr>
          <th class = "form-subtitle">ご相談内容<span class = "red">必須</span></th><td class = "textarea-cell"><textarea name = "trouble" id = "trouble" placeholder = "ご都合の良いお日にちや時間帯を教えてください。&#13;
                                                                                                                          例：7月28日の16時以降にお願いしたいです。"></textarea></td>
        </tr>

      </tbody>
    </table>

    <div class = "send-submit-wrapper">
      <input class = "send-submit" type = "submit" value = "入力内容を確認する">
    </div>

  </form>
</body>
</html>
