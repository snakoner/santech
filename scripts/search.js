     function onload(){
         if(decodeURI(location.href).split('q=')[1] == ''){
            localStorage.setItem('search_ids', '-');
         }
         else
         $.ajax({
            type: "POST",
            url: '../php_files/search_script.php',
            async:false,
            data: { 
              'id': decodeURI(location.href).split('q=')[1],
                  },
                   success: function(response)
                    {
                      //alert(decodeURI(location.href).split('q=')[1]);
                      let jsonData = JSON.parse(response);
                      localStorage.setItem('search_ids', jsonData.data);
                    // user is logged in successfully in the back-end
                    // let's redirect
                   }
             });
       load_data('1', localStorage.getItem('sort_type'));
     }
  


  document.addEventListener('DOMContentLoaded', onload);
    



  function load_data(curr_page, sort){
        let search_res = localStorage.getItem('search_ids');
        if (search_res != '-'){
             let size = search_res.split('#').length;
             document.querySelector('#found_items').innerHTML = size;
             document.querySelector('.title_type_div').innerHTML = 'Поиск по запросу «' + decodeURI(location.href).split('q=')[1] + '»';
             document.getElementById('no_res').remove();
             $.ajax({
                        type: "POST",
                        url: '../php_files/get_urls_by_ids.php',
                        data: { 
                          'ids': search_res.split('#'),
                          'curr_page' : '1',
                        },
                         async:false,
                         success: function(response)
                          {
                             var jsonData = JSON.parse(response);
                                let ids = search_res.split('#');
                                let names = jsonData.names.split('=');
                                let urls = jsonData.urls.split('=');
                                let prices = jsonData.prices.split('=');
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
                                document.querySelector('#php_res').innerHTML = html_code;
                                let urls_vector = document.querySelectorAll('#photo_place');
                                let names_vector = document.querySelectorAll('#name_place');
                                let prices_vector = document.querySelectorAll('#price_name');
                                let div_id_vector = document.querySelectorAll('.btn_div_search');
                                //let change_wishlist_vector = document.querySelectorAll('');
                                for(let i = 0; i < size; i++){
                                      urls_vector[i].setAttribute('src', '../' + urls[i]);
                                      names_vector[i].innerHTML = names[i];
                                      div_id_vector[i].setAttribute('id', 'id_' + ids[i]);
                                      prices_vector[i].innerHTML = prices[i] + '<span>  &#8381;  </span>';

                                      //button_id_vector[i].setAttribute('id', 'add_' + ids[i]);
                                  }
                         }
                   });
            let margin_bottom = (Math.floor(search_res.split('#').length/4))*600;
            if ((search_res.split('#').length%4) != 0)
              margin_bottom += 800;
            document.querySelector('.body_main').setAttribute('style', 'height: ' + margin_bottom.toString() + 'px;') 
            document.getElementById('bot_div').setAttribute('style', 'margin-top: ' + '0' + 'px;');
        }
        else{
          document.querySelector('.body_main').remove();
          height = Number(window.screen.height);
          height = height*(1-0.5);
          document.querySelector('.bottom_to_paste').setAttribute('style', 'margin-top: ' + height.toString() + 'px;');
          document.querySelector('#field1').setAttribute('value', decodeURI(location.href).split('q=')[1]);
        }
     
    }


   function create_catalog_div(ids, prod_number, margin_top){
      let html_data = '<div class = "katalog_div_search" style = "margin-top: '+ margin_top +'px;">';
      for(i = 0; i < prod_number; i++){
        html_data += create_product_main_div(ids[i]);
      }
      html_data += '</div>';
      return html_data;
    }

    function create_product_main_div(id){
      let html_data = '<div class = "product-main_search">'+'<div class="image_box_search" >'+'<a href="#" class = "image_search"><img id = "photo_place" src = "" style = "width: 100%"/></a>'+"</div>"+
    "<div class = 'product-name-box_search'>"+
    "<div class = 'add_to_favorite_search'><img onclick = 'change_wishlist(this.id)' class = 'heart' id = 'heart_" + id;
    let in_wishlist = localStorage.getItem('wishlist').search('#' + id + '#');
    //alert(in_wishlist);
    if (in_wishlist == -1){
        html_data += "' src = '../svg/heart_empty.png'/></div>";
    }
    else{
        html_data += "' src = '../svg/heart.png'/></div>";
    }
    html_data+= "<div class = 'product-name_search'><a href=\"#\" id = 'name_place' style = 'color: black;'>   </a>" + 
      "</div>" + 
    "</div>"+ 
    "<div><label></label></div>"+
    "<div class = 'under_pic_area_search'>"+
    "<div class = 'price_box_search'>" +
    "<p class = 'price_search' id = 'price_name'>9990 <span>  &#8381;  </span></p></div>"+ 
    "<div class = 'buy_block_search'>"+ 
      "<form method=\"post\">"+ 
     "<div id = 'id_0' class = 'btn_div_search'>" +  
     "<button onclick = 'add_to_basket_func(this)' id = 'add' class = 'btn-primary' style = 'margin-left: 20px; width: 170px; height:30px;'>В корзину</button>"+ 
      "</div>"+ 
      "<div class = 'old_price_search'><p style = 'text-decoration: line-through; color:grey;'>20349<span>  &#8381;  </span></p></div>"+
    "</form>"+ 
    "</div>"+ 
    "</div>"+
  "</div>";
  return html_data;
}

