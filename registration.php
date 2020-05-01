<!DOCTYPE HTML> 
   <html>
   <head>
    <title>Best Santechnic Zel</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#submit_form').submit(function(e) {
          e.preventDefault();
          $.ajax({
              type: "POST",
              url: 'php_files/reg_check.php',
              data: $(this).serialize(),
               success: function(response)
                {
                var jsonData = JSON.parse(response);
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == 1){
                    var log = jsonData.login;
                    var passw = jsonData.pass;

 //                   $('#result').html('<div>Регистрация прошла успешно</div>');
                    //change user_name in index.php

                      //document.cookie = "user=" + log + ";";
                      //document.cookie = "passw=" + passw + ";";
                      //document.cookie = "valid=" + "1" + ";";
                      localStorage.setItem('username', log);
                      setTimeout(() => { location.href = '/'; }, 2000);
                 }
                    //alert('Неверный логин или пароль!');
                else if (jsonData.success == 2)
                   $('#result').html('<div>Логин указан неверно</div>');
                    //alert('Неверный логин или пароль!');
                else if (jsonData.success == 3)
                  $('#result').html('<div>Пароли не совпадают</div>');
               }
         });
       });
});
</script>

<style>
 .box1 { 
    background: #ffffff; /* Цвет фона */
    width: 400px; /* Ширина блока */
    height: 350px;
    padding: 20px; /* Поля */
    border: 1px solid #ffff; /* Параметры рамки */
    margin-left: 35%;
    margin-top: 10%;
   }
  </style>
   </head>
   <body>  
  <div class = 'box1'>
    <div><label>Регистрация</label></div>
    <form id = "submit_form" method = "post">
    <div class="input-group-prepend">
      <span class="input-group-text"><img src = "svg/user.svg"></span>
      <input type="text" class="form-control" id = 'field1' name = 'login' placeholder="* Email"></input>
    </div>
    <div><label></label></div>
    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><img src = "svg/key.svg"></span>
      <input type="password" class="form-control"  name = 'password' placeholder="* Пароль"></input>
    </div>
        <div><label></label></div>

    <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1"><img src = "svg/key.svg"></span>
      <input type="password" class="form-control"  name = 'password_repeat' placeholder="* Подтвердите пароль"></input>
    </div>
        <div><label></label></div>

    <div>
        <button type="submit" class="btn btn-dark btn-block">Зарегистрироваться</button>
        
          <div><label></label></div>
          <div id = "result"> </div>
    </div>
  </div>
</form>
</body>



</html>
