  function exit_func(){
    localStorage.removeItem('username');
    $('#navbar_enter_tag').html('<img src = "home.svg"><a class="nav-link" href="login_page.php" id = \'enter_a\'>Войти</a>');
    location.href = '/';
}
  function update_page(){
    localStorage.setItem('curr_page',1);
    localStorage.setItem('btn_pressed',1);
    localStorage.setItem('btn1',  1);
    localStorage.setItem('btn2',  2);
    localStorage.setItem('btn3',  3);
    localStorage.setItem('was_sort_chosen', 0);

  }

    var current_slide = 1;
   var max_num_of_slides = 3;
   setTimeout(nextSlide, 5000);
    function nextSlide(){
        var slide = document.getElementById('slide' + current_slide);
        slide.setAttribute('class', 'slide');
        if (current_slide == max_num_of_slides){
              current_slide = 1;
        }
        else{
          current_slide ++;
        }
        slide = document.getElementById('slide' + (current_slide));
        slide.setAttribute('class', 'slide change');
        setTimeout(nextSlide, 5000);
  }


  


      function onload_page(){
      //basket num set
      //localStorage.removeItem('purchases');

      let n_items = localStorage.getItem('in_basket');
      if ((typeof n_items == 'undefined') || (typeof n_items == 'null')){
        localStorage.setItem('in_basket', 0);
      }
      $("#basket_val").html(localStorage.getItem('in_basket'));
      //calculate num of items in cat
      $.ajax({
              type: "POST",
              url: 'php_files/calc_sidebar.php',
              data: $(this).serialize(),
              success: function(response)
                {
                  var jsonData = JSON.parse(response);
                // user is logged in successfully in the back-end
                // let's redirect
               }
         });      

      //set username
      let x = localStorage.getItem('username');
      if (x){
        $('#navbar_enter_tag').html('<img src = "home.svg"><a class="nav-link" href="lich_kab.php" id = \'enter_id\'>'+ x +'</a>'
          + '<button onclick="exit_func()" class="btn btn-primary"> Выйти </button>');
      }
      update_page();
  }



  function call_me_back_show(){
    let html_code = "<div class = 'call_back_div'>" +
          "<button class = 'btn btn-light' onclick = 'close_call_back()' style = 'margin-left: 87%; border: none;'><span><img src = 'svg/x.svg'></span></button>"+
          "<div><label></label></div>"+
          "<form id = \"submit_form\" method = \"post\">"+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text" id="basic-addon1"><img src = "svg/user.svg"></span>'+
                  '<input type="text" class="form-control" name = \'login\' placeholder="* Имя"></input>'+
                '</div>'+
                '<div><label></label></div>'+
                '<div class="input-group-prepend">'+
                  '<span class="input-group-text" id="basic-addon1"><img src = "svg/phone.svg"></span>'+
                  '<input type="tel" class="form-control"  name = \'password\' placeholder="* Номер телефона"></input>'+
                '</div>'+
                    '<div><label></label></div>'+
                '<div>'+
                    '<button type="submit" class="btn btn-light btn-block">Заказать звонок</button>'+
                    '<div id = "result"> </div>'+
                '</div>'+
              '</div>'+
      '</form>'+
      '</div>';

      document.querySelector('.place-for-callback').innerHTML = html_code;
  }
  

  function close_call_back(){
            document.querySelector('.place-for-callback').innerHTML = '';

      }
  

  document.addEventListener('DOMContentLoaded', onload_page);
