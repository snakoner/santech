
    function onload_page(){
        
          $("#basket_val").html(localStorage.getItem('in_basket'));
          calculate_n_pages();
          create_page_bar();
          if (localStorage.getItem('was_sort_chosen') != '1'){
            next_page('btn_' + localStorage.getItem('btn_pressed'))
          }
          curr_page = localStorage.getItem('curr_page');
          if (localStorage.getItem('sort_type') == null){
            localStorage.setItem('sort_type', 1);
          }

          disable_sort_a(localStorage.getItem('sort_type'));
          load_data(curr_page, localStorage.getItem('sort_type'));
          sidebar_params = ['brand', 'types'];
          localStorage.setItem('next_block_shift', 0);
          for(i = 0; i < sidebar_params.length; i++){ 
            if (localStorage.getItem('checked_' + sidebar_params[i]) != null){
                localStorage.setItem('checked_' + sidebar_params[i], '');
            }
          }
          for(let i = 0; i < sidebar_params.length; i++){
            side_bar_create(sidebar_params[i]);
          }
          localStorage.setItem('was_sort_chosen', 0);
    }

    function calculate_n_pages(){
        let type_id = 1;
        $.ajax({
              type: "POST",
              url: 'php_files/calc_pages.php',
              data: { 
                id: type_id,
              },
               success: function(response)
                {
                  let jsonData = JSON.parse(response);
                  document.querySelector('#found_items').innerHTML = jsonData.name;
                  localStorage.setItem('n_pages', Math.ceil(Number(jsonData.name)/28));
                // user is logged in successfully in the back-end
                // let's redirect
               }
         });
    }
    function create_page_bar(){
        let n_pages = localStorage.getItem('n_pages');
        html_code = '';
        if (n_pages == 1){
          html_code = '';
        }

        html_code += '<nav aria-label="Page navigation example">'+
          '<ul class="pagination">'+
            '<div id = \'prev_btn\'><a href = \'\' style = \'width: 100px;\' id = \'prev_href\'><button class = \'btn-primary pages_button\' id = \'btn_begin\' style = \'width: 120px;\' onclick="change_page_num(this.id)">В начало</button></a></div>'+
            '<div id = \'prev_btn\'><a href = \'\' id = \'prev_href\'><button class = \'btn-primary pages_button\' style = \'width: 120px;\' id = \'btn_0\' onclick="change_page_num(this.id)">Назад</button></a></div>'+
            '<a href = \'\'><button class = \'btn-primary pages_button\' id = \'btn_1\' onclick="change_page_num(this.id)">1</button></a>'+
            '<a href = \'\'><button class = \'btn-primary pages_button\' id = \'btn_2\' onclick="change_page_num(this.id)">2</button></a>';
          if (n_pages == 3){
              html_code += '<a href = \'\'><button class = \'btn-primary pages_button\' id = \'btn_3\' onclick="change_page_num(this.id)">3</button></a>';
          }
          html_code += '<a href = \'\'><button class = \'btn-primary pages_last_btn\' id = \'btn_5\' onclick="change_page_num(this.id)">Вперед</button></a>'+
          '</ul>'+
        '</nav>';
        document.querySelector('.page_div').innerHTML = html_code;
    }

    function next_page(this_button){
        let next_page_num = this_button.split('_')[1];
        let next_page_vec = [];
        let tmp = localStorage.getItem('btn1'); //document.querySelector('#btn_1').innerHTML;
        next_page_vec.push(tmp);
        tmp = localStorage.getItem('btn2');//document.querySelector('#btn_2').innerHTML;
        next_page_vec.push(tmp);
        tmp = localStorage.getItem('btn3');//document.querySelector('#btn_3').innerHTML;
        next_page_vec.push(tmp);
        //alert((localStorage.getItem('btn1')));
        // 0 - в начало
        // 1 - назад
        // 2 - первая
        //3 - вторая
        //4 - третья 
        //5 - вперед
        if (next_page_num == '0'){
          if (next_page_vec[0] != '1')
            for(let i = 0; i < 3; i++)
                next_page_vec[i] = (Number(next_page_vec[i]) - 1).toString();
        }
        else if ((next_page_num == '5')){
              for(let i = 0; i < 3; i++){
                next_page_vec[i] = (Number(next_page_vec[i]) + 1).toString();
              }
        }

        else if ((next_page_num == '2')){
              for(let i = 0; i < 3; i++){
                next_page_vec[i] = (Number(next_page_vec[i]) + 1).toString();
              }
        }
        else if (next_page_num == '3'){
              for(let i = 0; i < 3; i++){
                next_page_vec[i] = (Number(next_page_vec[i]) + 2).toString();
          }
        }
        else if (next_page_num == 'begin'){
              next_page_vec[0] = '1';
              next_page_vec[1] = '2';
              next_page_vec[2] = '3';
        }
        if (localStorage.getItem('n_pages') == next_page_vec[3]){
              next_page_vec[0] = '1';
              next_page_vec[1] = '2';
              next_page_vec[2] = '3';
        }
        if (next_page_vec[0] == '1'){
            let elem =  document.querySelector('#btn_begin');
            elem.disabled = true;
            //document.querySelector('#btn_begin').disabled = true;
            elem.style.opacity = '0.5';
            elem.classList.remove('pages_button');
          }
        else{
            document.querySelector('#btn_begin').disabled = false;
        }
        if (localStorage.getItem('n_pages') == next_page_vec[2]){
            btn1 = document.querySelector('#btn_1').innerHTML;
            btn2 = document.querySelector('#btn_2').innerHTML;
            btn3 = document.querySelector('#btn_3').innerHTML;
        }
        document.querySelector('#btn_1').innerHTML = next_page_vec[0];
        document.querySelector('#btn_2').innerHTML = next_page_vec[1];
        document.querySelector('#btn_3').innerHTML = next_page_vec[2];
        document.querySelector('#btn_1').setAttribute('style', 'background-color:#1E90FF; color: white;')
        localStorage.setItem('curr_page', next_page_vec[0]);
    }

  function load_data(curr_page, sort){
        $.ajax({
              type: "get",
              url: 'php_files/get_urls_from_db.php',
              data: { 
                page: curr_page,
                sort_type: sort,
              },
               success: function(response)
                {
                  let jsonData = JSON.parse(response);

                  let ids = jsonData.ids.split('=');
                  let names = jsonData.names.split('=');
                  let urls = jsonData.urls.split('=');
                  let prices = jsonData.prices.split('=');
                  //let urls_vector = document.querySelectorAll('#photo_place');
                  //let names_vector = document.querySelectorAll('#name_place');
                  //let div_id_vector = document.querySelectorAll('.btn_div');

                  let items_on_page = jsonData.items_on_page;
                  let size = ids.length;
                  let katalog_n = Math.floor(size/4);
                  let no_full_kat = size%4;
                  let html_code = '';
                  let initial_margin_top = 110;
                  let delta_margin_top = 550;
                  let delta_margin_page_div = 40;
                  let margin_top = initial_margin_top;

                  let index = 0;
                  for(let i = 0; i < katalog_n; i++){
                      html_code += create_catalog_div(ids.slice(4*i, 4*(i+1)), 4, margin_top.toString());
                      margin_top += delta_margin_top;
                      index = i;
                  }

                  if (no_full_kat){
                      html_code += create_catalog_div(ids.slice(katalog_n,-1), no_full_kat, margin_top.toString());
                      margin_top += delta_margin_top;
                  }
                  document.querySelector('#php_res').innerHTML = html_code;
                  let urls_vector = document.querySelectorAll('#photo_place');
                  let names_vector = document.querySelectorAll('#name_place');
                  let prices_vector = document.querySelectorAll('#price_name');
                  let div_id_vector = document.querySelectorAll('.btn_div');
                  //let change_wishlist_vector = document.querySelectorAll('');
                  prices = prices_to_string(prices);
                  for(let i = 0; i < size; i++){
                        urls_vector[i].setAttribute('src', urls[i]);
                        names_vector[i].innerHTML = names[i];
                        div_id_vector[i].setAttribute('id', 'id_' + ids[i]);
                        prices_vector[i].innerHTML = prices[i] + '<span>  &#8381;  </span>';

                        //button_id_vector[i].setAttribute('id', 'add_' + ids[i]);
                    }
                    margin_top = (Number(margin_top) + delta_margin_page_div).toString();
                    localStorage.setItem('bottom_margin', margin_top);
                  document.querySelector('#page_id').setAttribute('style', 'margin-top: '+ margin_top +'px;');
                
                  if (katalog_n < 7){
                    let margin_from_page = 0;
                    if (no_full_kat == 0){
                         margin_from_page = katalog_n*620;
                    }
                    else{
                          margin_from_page = (katalog_n + 1)*620;
                    }
                    document.querySelector('.body_main').setAttribute('style', 'height: '+  margin_from_page.toString()+ 'px;');
                  }
                // user is logged in successfully in the back-end
                // let's redirect
               }
         });
    }

    function sort_func(id){
      sort_type = 0;
      alert(1);
      if (id == 'popular'){
        sort_type = 1;
      }
      else if (id == 'deshevle'){
        sort_type = 2;
      }
      else if (id == 'doroje'){
        sort_type = 3;
      }
      localStorage.setItem('sort_type', sort_type);
      localStorage.setItem('curr_page', 1);
      localStorage.setItem('was_sort_chosen', 1);


    }
    function disable_sort_a(id){
        a_name = '';
        if (id == '1')
          a_name = '#a_popular';
        else if (id == '2')
          a_name = '#a_desevle';
        else if (id == '3')
          a_name = '#a_doroje';
        document.querySelector(a_name).setAttribute('class','disabled');

    }

    function prices_to_string(prices){
        for(let i = 0; i < prices.length; i++){
          let size = prices[i].length;
          if (size > 3){
              prices[i] = prices[i].slice(0, size - 3) + ' ' + prices[i].slice(prices[i].length - 4, -1);
          }
        }
        return prices;
    }

    function create_catalog_div(ids, prod_number, margin_top){
      let html_data = '<div class = "katalog_div" style = "margin-top: '+ margin_top +'px;">';
      for(i = 0; i < prod_number; i++){
        html_data += create_product_main_div(ids[i]);
      }
      html_data += '</div>';
      return html_data;
    }

    function create_product_main_div(id){
      let html_data = '<div class = "product-main">'+'<div class="image_box" >'+'<a href="#" class = "image"><img id = "photo_place" src = "" style = "width: 100%"/></a>'+"</div>"+
    "<div class = 'product-name-box'>"+
    "<div class = 'add_to_favorite'><img onclick = 'change_wishlist(this.id)' class = 'heart' id = 'heart_" + id;
    let in_wishlist = localStorage.getItem('wishlist').search('#' + id + '#');
    //alert(in_wishlist);
    if (in_wishlist == -1){
        html_data += "' src = 'svg/heart_empty.png'/></div>";
    }
    else{
        html_data += "' src = 'svg/heart.png'/></div>";
    }
    html_data+= "<div class = 'product-name'><a href=\"#\" id = 'name_place' style = 'color: black;'>   </a>" + 
      "</div>" + 
    "</div>"+ 
    "<div><label></label></div>"+
    "<div class = 'under_pic_area'>"+
    "<div class = 'price_box'>" +
    "<p class = 'price' id = 'price_name'>9990 <span>  &#8381;  </span></p></div>"+ 
    "<div class = 'buy_block'>"+ 
      "<form method=\"post\">"+ 
     "<div id = 'id_0' class = 'btn_div'>" +  
     "<button onclick = 'add_to_basket_func(this)' id = 'add' class = 'btn-primary' style = 'margin-left: 20px; width: 100px; height:30px;'>В корзину</button>"+ 
      "</div>"+ 
      "<div class = 'old_price'><p style = 'text-decoration: line-through; color:grey;'>20349<span>  &#8381;  </span></p></div>"+
    "</form>"+ 
    "</div>"+ 
    "</div>"+
  "</div>";
  return html_data;
}

    function change_wishlist(val){
        if (localStorage.getItem('username')==null){

        }
        if (localStorage.getItem('wishlist') == null){
          localStorage.setItem('wishlist', '');
        }
        let wishlist = localStorage.getItem('wishlist');
        let id_num = val.split('_')[1];
        let alred_in_list = wishlist.search('#' + id_num + '#');
        if (alred_in_list == -1){
            wishlist += '#' + id_num + '#';
            document.querySelector('#heart_' + id_num).setAttribute('src', 'svg/heart.png');
        }
        else{ 
            wishlist = wishlist.replace('#' + id_num + '#', '');
            localStorage.setItem('wishlist', wishlist);
            document.querySelector('#heart_' + id_num).setAttribute('src', 'svg/heart_empty.png');
        }
        localStorage.setItem('wishlist', wishlist);
    }
    function change_page_num(val){
      let num_page = val.split('_')[1];
      localStorage.setItem('btn_pressed', num_page);
      localStorage.setItem('btn1',  document.querySelector('#btn_1').innerHTML);
      localStorage.setItem('btn2',  document.querySelector('#btn_2').innerHTML);
      localStorage.setItem('btn3',  document.querySelector('#btn_3').innerHTML);
    }



  function add_to_basket_func(elem){
      let elem_id = $(elem).closest('div').attr('id');
      var purchases = localStorage.getItem('purchases');
      let tmp_purch = '';
      if ((typeof purchases == 'undefined') || (purchases == null)){
          localStorage.setItem('purchases', '');
      }

      purchases = localStorage.getItem('purchases');
      tmp_purch += '#'+elem_id.split('_')[1];
      tmp_purch += purchases;
      localStorage.setItem('purchases', tmp_purch);
      let n_items_in_basket = localStorage.getItem('in_basket');
      n_items_in_basket++;
      $("#basket_val").html(n_items_in_basket);
      localStorage.setItem('in_basket', n_items_in_basket);
  }


  function side_bar_create(param_for, margin_top){
        $.ajax({
              type: "POST",
              url: 'php_files/calc_distinct.php',
              async:false,
              data: { 
                id: param_for,
              },
               success: function(response)
                {
                  let jsonData = JSON.parse(response);
                  let sub_types = [];
                  if (jsonData.sub_types){
                      sub_types = jsonData.sub_types.split('#');
                  }
                  sub_types = sub_types.sort();
                  russian_name = '';
                  height = 50*(sub_types.length) + 30;
                  margin_top = Number(localStorage.getItem('next_block_shift'));
                  
                  if (param_for == 'brand')
                      russian_name = 'Бренды';
                  else if (param_for == 'types')
                      russian_name = 'Материал';
                  html_data = '<div class = \'new_side_bar_div\'' +'style = "margin-top: ' + (margin_top) +'px;'+ '">'+
                        "<div class = 'new_side_bar_div' "+ 'style = "height: ' + (margin_top + height) +'px;"'+ ">" +
                        "<span class = 'new_side_bar_brands_logo'>"+russian_name+"</span>"+
                        "<div><label></label></div>"+
                        "<div><label></label></div>"+
                        "<div href=\"#\" data-toggle=\"popover\" id = 'show_n_items_" + param_for + "' data-html=\"true\" data-content=\"\">"+
                        "<div class = 'new_side_bar_brands_type'>";
                  checked_brands = localStorage.getItem('checked_'+param_for).slice(1).split('#');

                  for (let i = 0; i < sub_types.length; i++){
                      html_data += '<div class = "types">';
                      if (checked_brands.includes(param_for + sub_types[i])){
                          html_data += '<input type="checkbox" id = "'+param_for+'_'+sub_types[i]+'" onclick = "click_brand_tensor(this.id)"' + 'checked'+'>';
                      }
                      else
                          html_data += '<input type="checkbox" id = "'+param_for+'_'+sub_types[i]+'" onclick = "click_brand_tensor(this.id)">';
                      html_data += '<span> ' + sub_types[i] + ' </span>';
                      html_data += '</div>';
                  }
                  html_data +=   "</div>"+"</div>"+"</div>";
                  localStorage.setItem('next_block_shift', height + margin_top);
                  document.querySelector('.main_side_bar').innerHTML = document.querySelector('.main_side_bar').innerHTML + html_data;
                  
                // user is logged in successfully in the back-end
                // let's redirect
               }
         });
  }

function calc_n_items_tensor(param, data){
      $.ajax({
              type: "POST",
              url: 'php_files/calc_items_for_params.php',
              async: false,
              data: { 
                param_t: param,
                param_d: data,
              },
               success: function(response)
                {
                  let jsonData = JSON.parse(response);
                  localStorage.setItem('n_items', jsonData.data);
                  while(localStorage.getItem('n_items')!=jsonData.data){
                    
                  }
               // alert('1'+localStorage.getItem('res'));

               }
         });
      //alert(result);
  }



  function click_brand_tensor(val){
      let param_type = val.split('_')[0];
      let param_data = val.split('_')[1];
      let checked_tensor = [];
      let checked_types = [];
      let val_to_set = '';
      let is_plus = false;
      let empty_query = 0;
      sidebar_params = ['brand', 'types'];
      for(i = 0; i < sidebar_params.length; i++){
        tmp = localStorage.getItem('checked_' + sidebar_params[i]);
        checked_tensor.push(tmp);
        checked_types.push(sidebar_params[i]);
        if ((sidebar_params[i] == param_type)){
              if (tmp.search(val) == -1){
                      checked_tensor[i] += '#' + val;
                      is_plus = true;
              }
              else{
                      checked_tensor[i] = checked_tensor[i].replace('#' + val, '');
                      is_plus = false;
                }
        }
        localStorage.setItem('checked_' + sidebar_params[i], checked_tensor[i]);
      }
 
      final_type = [];
      final_tensor = [];
      for(i = 0; i < sidebar_params.length; i++){
        if (checked_tensor[i] !=''){
          final_tensor.push(checked_tensor[i]);
          final_type.push(checked_types[i]);
        }
        else {
          empty_query += 1;
        }
      }
      if (empty_query!=sidebar_params.length){
          for(i = 0; i < final_tensor.length;i++){
            remastered = '';
            tmp = final_tensor[i].slice(1).split('#');
            for(j = 0; j < tmp.length; j++){
              remastered += '#' + tmp[j].split('_')[1];
            }
            final_tensor[i] = remastered.slice(1);
          }
          calc_n_items_tensor(final_type, final_tensor);
          }
      else{
        localStorage.setItem('n_items',  document.querySelector('#found_items').innerHTML);
      }
      if (is_plus){
          $('[data-toggle="popover"]').popover('hide');   
          document.querySelector('#show_n_items_' + param_type).setAttribute('data-content', "<a href = 'xxx'>Показать "+ localStorage.getItem('n_items') +
            " товаров</a>");
          $('[data-toggle="popover"]').popover('enable');   

      }
      else{
          document.querySelector('#show_n_items_' + param_type).setAttribute('data-content', "<a href = 'xxx'>Показать "+ localStorage.getItem('n_items') +
            " товаров</a>");           
          $('[data-toggle="popover"]').popover('hide');   

      }
  }



