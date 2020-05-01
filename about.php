
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

    function onload_page(){
          $("#basket_val").html(localStorage.getItem('in_basket'));
    }
</script>



<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', onload_page);
</script>


<style>

  .nav_bar_div{
    margin-left: 100px;
    margin-right: 100px;
    float: left;
  }

  .nav_input_search_div{
    width: 300px;
    height: 20px;
  }
  .katalog_div{
      width: 850px;
      height: 500px;
      margin-top: 160px;
      margin-left: 400px;
      margin-right: 0px;
      position: absolute;
      border: 0px solid #a0a0a0; /* Параметры рамки */
      background: #ffffff;
  }

.katalog_div1{
      width: 850px;
      height: 420px;
      margin-top: 500px;
      margin-left: 400px;
      margin-right: 0px;
      position: absolute;
      border: 1px solid #a0a0a0; /* Параметры рамки */
      background: #ffffff;
  }

.image {
  width: 100%;
 }

.image img {
 -moz-transition: all 1s ease-out;
 -o-transition: all 1s ease-out;
 -webkit-transition: all 1s ease-out;
 }
 
.image img:hover{
 -webkit-transform: scale(1.7);
 -moz-transform: scale(1.7);
 -o-transform: scale(1.7);
 }
.image_box{
margin-top:5px; 
margin-left: 5px; 
overflow: hidden; 
width: 237px; 
 height: 270px;
}


.product-main:hover{
    -moz-box-shadow: 0 0 10px #000;
    -webkit-box-shadow: 0 0 10px #000;
    box-shadow:0 0 10px #000; 
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    transition: all 0.5s ease;
  }
.product-main{
    float: left;
    background: #ffffff;
    width: 250px;
    height: 430px;
    border: 1px solid #d1d1d1; /* Параметры рамки */
    margin-top: 50px;
    position: relative;
    margin-left: 20px;
  }
  .product-name-box{
    width: 200px;
    height: 30px;
    margin-left: 20px;
  }
  .product-name{
    font-size: 14px;
    margin-left: 10px;
  }

  .price{
  font-family: 'Impact';
  font-style: italic;
    font-size: 25px;
    margin-left: 90px;
  }
  .button_style_cat{
    margin-left: 10px;
  }
  .buy_block{
    width: 210px;
  }
 

/*
essential styles:
these make the slideshow work
*/
#slides{
  position: relative;
  height: 200px;
  padding: 0px;
  margin: 0px;
  list-style-type: none;
}

.slide{
  position: absolute;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  opacity: 0;
  overflow: hidden;
  -webkit-transition: opacity 1s;
  -moz-transition: opacity 1s;
  -o-transition: opacity 1s;
  transition: opacity 1s;
}


.change{
  opacity: 1;
} 



/*
non-essential styles:
just for appearance; change whatever you want
*/



.carousel_div{
  margin-left: 30px;
  margin-top: 10px;
  margin-bottom: 20px;
  width: 1000px;
  height: 200px;
}



.slide{
  background: #000000;
  color: #ffffff;
}


.choose_price_div{
    margin-left: 100px;
    margin-top: 600px;
    float: left;
    width: 250px;
    position: absolute;
    height: 400px;
    background: white;
}

.sidebar_div{
    margin-left: 100px;
    margin-top: 150px;
    float: left;
    width: 250px;
    height: 400px;
    position: absolute;
    background: white;
  }

  .sidebar_href{
    margin-left: 20px;
    margin-top: 5px;
    position: relative;
    text-decoration: none;
  }
  .sidebar_href:hover{
    text-decoration: none;
  }

  .page_div{
    position: absolute;
    margin-top: 1700px;
    margin-left: 600px;

  }
  .button_pages{
    background-color: white;
    color: black;
  }
  </style>

   </head>
   <body>
    <!-- Image and text -->

<div class = 'nav_bar_div'>
<!-- First nav bar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src = 'images/logo.jpg'/ style = 'width: 100px;'></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
         
        <li class="nav-item active">
          <a class="nav-link" href="about.php">О компании<span class="sr-only">(current)</span> </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="dostavka.php">Доставка</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="oplata.php">Оплата</a>
        </li>   
        <li class="nav-item">
          <a class="nav-link" href="contacts.php">Контакты</a>
        </li>
      </ul>
    </div>
    <div>
      +7 (999) 984-70-53
    </div>
  </nav>




<!-- Second nav bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <div class="input-group-prepend">
              <a href="katalog.php"><button type="submit" class="btn btn-dark  my-2 my-sm-0" style = 'width: 170px; background-color: #0000ff; border: none;'>Каталог товаров</button></a>
        </div>

      <div class="input-group-prepend">
        <input type="text" class="form-control mr-sm-2" id = 'field1' name = 'login' placeholder="Например, смесители" style="margin-left: 20px; width: 520px;">
        <button type="submit" class="btn btn-dark  my-2 my-sm-0">Найти</button>
      </div>

      <!--<ul class="nav justify-content-end" id = 'navbar_enter_tag' style = 'margin-left: 280px;'>
              <img src = "home.svg">
              <a class="nav-link" href="login_page.php" id = 'enter_a'>Войти</a>
      </ul> -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown" style = 'margin-left: 10px;'>
           <div class="input-group-prepend">
              <a href = 'login_page.php' style = 'text-decoration: none; color: white;'><button type="submit" class="btn btn-dark  my-2 my-sm-0" style = 'width: 150px; background-color: #0000ff; border: none;'>Личный кабинет</button></a>
          </div>
    </div>

    <div class="collapse navbar-collapse" id="navbarNavDropdown" style = 'margin-left: 10px;'>

           <div class="input-group-prepend">
              <form action = 'basket.php'>
                <button type="submit" class="btn btn-dark  my-2 my-sm-0" style = 'width: 170px; background-color: #0000ff; border: none;'>Корзина <span class="badge badge-primary badge-pill" style = 'background-color: white; color: black;' id = 'basket_val'>0</span></button>
              </form>
          </div>
    </div>
  </div>
  </nav>
</div>


<!--
<div class = 'carousel_div'>
<ul id="slides">
  <li class="slide change" id = 'slide1'><img src = 'slide1.jpg'/></li>
  <li class="slide"  id = 'slide2'><img src = 'slide2.jpg'/></li>
  <li class="slide" id = 'slide3'><img src = 'slide1.jpg'/></li>
</ul>
</div>
-->

<!-- Картинки-->

</body>



</html>
