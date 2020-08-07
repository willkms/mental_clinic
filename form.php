<?php
session_cache_limiter('public');
session_start();

// 暗号学的に安全なランダムなバイナリを生成し、それを16進数に変換することでASCII文字列に変換します
 $toke_byte = openssl_random_pseudo_bytes(16);
 $csrf_token = bin2hex($toke_byte);
 // 生成したトークンをセッションに保存します
 $_SESSION['csrf_token'] = $csrf_token;

 // echo $_SESSION['csrf_token'];

$month = 0;
$year = 0;

  if (isset($_GET['y'])) {
    $year = intval($_GET['y']);
  }else{
    $year = date('Y');
  }

  if (isset($_GET['m'])) {
    $month = intval($_GET['m']);
  }else{
    $month = date('n');
  }

$i = 1;   /*  カレンダーの数字変数  */
$j = date('w', mktime(0, 0, 0, $month, 1, $year)); /*  カレンダーの曜日変数  */
$prev_last_day = date('d', mktime(0, 0, 0, $month, 0, $year));   /*  先月末日  */
$this_last_day = date('d', mktime(0, 0, 0, $month + 1, 0, $year));   /*  今月末日  */
$yp = 0;    /*  先月の年  */
$ya = 0;    /*  来月の年  */
$mp = 0;    /*  先月  */
$ma = 0;    /*  来月  */

if($month - 1 != 0){
  $yp = $year;
  $mp = $month - 1;
}else{
  $yp = $year - 1;
  $mp = 12;
}

if($month + 1 != 13){
  $ya = $year;
  $ma = $month + 1;
}else{
  $ya = $year + 1;
  $ma = 1;
}

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
  <script src="calendar.js" charset="utf-8"></script>
</head>
<body>
  <p class = "form-title">入力フォーム</p>
  <form action = "confirm.php" method = "post" autocomplete = "off" onsubmit = "return InputCheck()">
    <input type = "hidden" name = "sex" value = "">
    <input type = "hidden" name = "csrf_token" value = "<?= $csrf_token?>">
    <table class = "form-table">
      <tbody>
        <!--
        <tr>
          <th class = "form-subtitle">ご希望日<span class = "red">必須</span></th></td> <td><input type = "text" name = "date" class = "date"> <table class = "calendar">
            <tr>
              <td><a href = "test.php?y=<?= $yp ?>&m=<?= $mp ?>" class = "prev-month"><</a></td>
              <td colspan = "5"><p class = "calendar-title" id=<?= strval($year).'/'.strval($month)?>><?= $year ?>年<?= $month ?>月</p></td>
              <td><a href = "test.php?y=<?= $ya ?>&m=<?= $ma ?>" class = "after-month">></a></td>
            </tr>
            <tr>
              <th class = "holiday-header">日</th>
              <th class = "weekday-header">月</th>
              <th class = "weekday-header">火</th>
              <th class = "weekday-header">水</th>
              <th class = "weekday-header">木</th>
              <th class = "weekday-header">金</th>
              <th class = "saturday-header">土</th>
            </tr>
            <tr>
            <?php

            for($k=$j;$k>0;$k--){

              echo '<td class = "not-this-month">'.($prev_last_day - $k + 1).'</td>';

            }

            while($i <= $this_last_day){

              if($j == 0){

                if($year < date('Y') ||
                   ($year == date('Y') && $month < date('n')) ||
                   ($year == date('Y') && $month == date('n') && $i < date('d'))){

                     echo '<tr><td class = "disabled" id='.$i.'>'.$i.'</td>';

                }else{

                  echo '<tr><td class = "holiday" id='.$i.'>'.$i.'</td>';

                }

              }else if($j == 6){

                if($year < date('Y') ||
                   ($year == date('Y') && $month < date('n')) ||
                   ($year == date('Y') && $month == date('n') && $i < date('d'))){

                     echo '<td class = "disabled" id='.$i.'>'.$i.'</td></tr>';

                }else{

                  echo '<td class = "saturday" id='.$i.'>'.$i.'</td></tr>';

                }

                $j = -1;

              }else{

                if($year < date('Y') ||
                   ($year == date('Y') && $month < date('n')) ||
                   ($year == date('Y') && $month == date('n') && $i < date('d'))){

                     echo '<td class = "disabled" id='.$i.'>'.$i.'</td>';

                }else{

                  echo '<td  class = "weekday" id='.$i.'>'.$i.'</td>';

                }

              }

              $i++;
              $j++;

            }

            if($j != 0){

              for($l=1;$j<=6;$l++){

                echo '<td class = "not-this-month">'.$l.'</td>';
                $j++;

              }

            }

             ?>
           </tr>
          </table></td>
        </tr>
      -->
        <tr>
          <th class = "form-subtitle">お名前(漢字)<span class = "red">必須</span></th> <td>  <input type = "text" name = "last-name" class = "last-name" placeholder = "姓">  <input type = "text" name = "first-name" class = "first-name" placeholder = "名"></td>
        </tr>

        <tr>
          <th class = "form-subtitle">お名前(フリガナ)</th> <td>  <input type = "text" name = "last-name-kana" class = "last-name-kana" placeholder = "姓"> <input type = "text" name = "first-name-kana" class = "first-name-kana" placeholder = "名"> </td>
        </tr>

        <tr>
          <th class = "form-subtitle">メールアドレス<span class = "red">必須</span></th><td><input type = "email" name = "mail-address" class = "mail-address" onchange = "EmailPatternCheck()"></td>
          <!--<td class = "textarea-cell"><textarea  name = "mail-address" class = "mail-address" onchange = "EmailPatternCheck()"></textarea></td>-->
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
