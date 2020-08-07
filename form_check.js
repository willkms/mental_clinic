function NullCheck(){

  const msg_array = ["お名前(漢字)の姓が未入力です",
  "お名前(漢字)の名が未入力です",
  "メールアドレスが未入力です",
  "電話番号が未入力です",
  "ご相談内容が未入力です"];

  var element_last_name = "";
  element_last_name = document.querySelector('.last-name');
  const value_last_name = element_last_name.value;

  var element_first_name = "";
  element_first_name = document.querySelector('.first-name');
  const value_first_name = element_first_name.value;

  var element_mail = "";
  element_mail = document.querySelector('.mail-address');
  const value_mail = element_mail.value;

  var element_TEL = "";
  element_TEL = document.querySelector('.TEL');
  const value_TEL = element_TEL.value;

  var element_trouble = "";
  element_trouble = document.getElementById('trouble');
  const value_trouble = element_trouble.value;

  if(value_last_name == ""){

    alert(msg_array[0]);

    setTimeout(function(){

      element_last_name.focus();

    }, 1);

    return false;

  }else{

    if(value_first_name == ""){

      alert(msg_array[1]);

      setTimeout(function(){

        element_first_name.focus();

      }, 1);

      return false;

    }else{

      if(value_mail == ""){

        alert(msg_array[2]);

        setTimeout(function(){

          element_mail.focus();

        }, 1);

        return false;

      }else{

        if(value_TEL == ""){

          alert(msg_array[3]);

          setTimeout(function(){

            element_TEL.focus();

          }, 1);

          return false;

        }else{

          if(value_trouble == ""){

            alert(msg_array[4]);

            setTimeout(function(){

              element_trouble.focus();

            }, 1);

            return false;

          }

        }

      }

    }

  }

  return true;

}

function EmailPatternCheck(){

 const element_mail = document.querySelector('.mail-address');
 const value_mail = element_mail.value;

 if(!value_mail.match(/^([a-z0-9_\.\-])+@([a-z0-9_\.\-])+[^.]$/i)){

  alert("メールアドレスを再入力してください");

  setTimeout(function(){

   element_mail.focus();

  }, 1);
  return false;

 }

 return true;

}

function TELPatternCheck(){

 const element_TEL = document.querySelector('.TEL');
 var value_TEL =  element_TEL.value;

 // バリデーション関数
 var validateTelNeo = function (value) {
  return /^[0０]/.test(value) && libphonenumber.isValidNumber(value, 'JP');
 }

 // 整形関数
 var formatTel = function (value) {
  return new libphonenumber.AsYouType('JP').input(value);
 }

 var main = function (tel) {
  if (!validateTelNeo(tel)) {
    alert("電話番号を再入力してください");

    setTimeout(function(){

	element_TEL.focus();

   }, 1);

    return false;
  }

  var formattedTel = formatTel(tel);
  document.querySelector('.TEL').value = formattedTel;
  return true;

 }

 if(!main(value_TEL)){

  return false;

 }else{

  return true;

 }

}

function InputCheck(){

 if(NullCheck()){
  if(EmailPatternCheck()){
   if(TELPatternCheck()){

    return true;

   }

  }

 }

 return false;

}
