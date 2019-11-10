$('.cart-dropdown' ).on( "click", "#view", function() {  
  $('#fetch').html('<div id="go" style="" ></div>');
    $.ajax({
      url:"view_cart.php",
      method:"POST",
      success:function(data){  
        $("#view_cart").fadeIn(500).html(data);                                          
      }
    });
});
/* --------------------------------------- */
$( '.cart-dropdown ' ).on( "click", "#check", function() {  
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"check_out.php",
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data); 
                                               
        }
      });
});
/* --------------------------------------- */
$( '#view_cart' ).on( "click", "#check_out", function() { 
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"check_out.php",
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data);
          toastr["success"]("Your order list is almost ready");
        }  
      });
});
/* --------------------------------------- */
$( '#view_cart' ).on( "click", "#checkAll", function() { 
    if(this.checked){
        $('.checkbox').each(function(){
            this.checked = true;
        });   
    }else{
        $('.checkbox').each(function(){
            this.checked = false;
         });
    } 
});

$( '#view_cart' ).on( "click", "#delete", function() { 
    var dataArr  = new Array();
      if($('input:checkbox:checked').length > 0){
          $('input:checkbox:checked').each(function(){
              dataArr.push($(this).attr('id'));
              $(this).closest('tr').remove();
              sendResponse(dataArr);
              
          });
          sendResponse(dataArr);
          toastr["error"]("Item(s) was/were successfully deleted !");
       }else{
         toastr["info"]("Please select an Item !");
       }
});  

function sendResponse(dataArr){
     $.ajax({
      type:'POST',
      url: 'traitement.php',  
      data: {'data' : dataArr},
      success : function(data){    
        load_cart();                                
        setTimeout(load,500);                 
          function load(){
            $.ajax({
              url:"view_cart.php",
              method:"POST",
              success:function(data){      
                $("#view_cart").fadeIn(500).html(data);                                          
              }
            });
          }     
      }                         
    });
}
/* --------------------------------------- */
$( '#check1' ).click(function() {  
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"check_out.php",
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data);                                      
        }
      });
});
/* --------------------------------------- */
$( '#check2' ).click(function() {  
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"get_password.php",
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data);                                      
        }
      });
});
/* --------------------------------------- */
$( '#recent' ).click(function() {  
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"recent.php",
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data);                                      
        }
      });
});
/* --------------------------------------- */
$( '#order' ).click(function() {  
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"order.php",
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data);                                      
        }
      });
});
/* --------------------------------------- */
$('#btn').click(function() { 
  var code = $("#code").val();
  var action ="submit";
  $('#fetch').html('<div id="go" style="" ></div>');
      $.ajax({
        url:"consulting.php",
        data:{action:action,code:code},
        method:"POST",
        success:function(data){      
          $("#view_cart").fadeIn(500).html(data);                                      
        }
      });
});
/* --------------------------------------- */
$(document).on('click', '.btn-info', function(){
  $('#view_cart').html('<div id="go" style="" ></div>');
    var product_id = $(this).attr("id"); 
    var action = "view";
      $.ajax({
				url:"traitement.php",
				method:"POST",
				data:{action:action,product_id:product_id},
				success:function(data){		
          setTimeout(load,500);     
          function load(){
              $.ajax({
                url:"view_product.php",
                method:"POST",
                  success:function(data){      
                    $("#fetch").fadeIn(500).html(data);                                   
                  }
              });
          }       
				}
      });      
});
/* --------------------------------------- */
$( '#view_cart' ).on( "click", "#submit", function() { 
  $('#fetch').html('<div id="go"></div>');
    var nom = $("#nom").val();
    var prenom = $("#prenom").val();
    var list = $("#list").val();
    var submit = "submit"; 
    $.ajax({
      method:"POST",
      url:"verification.php",
      data:{submit:submit,nom:nom,prenom:prenom,list:list},
      success:function(data){    
        $("#view_cart").fadeIn(500).html(data);
      }   
    });
});
/* --------------------------------------- */
$( '#view_cart' ).on( "click", ".btn-warning", function() {  
  var product_id = $(this).attr("id");
  var product_name = $('#name'+product_id+'').val();
  var product_price = $('#price'+product_id+'').val();
  var product_quantity = $('#quantity'+product_id).val();
  var product_photo = $('#photo'+product_id).val();
  var action = "update";	
    if(product_quantity>0)
    {	
      $.ajax({
        url:"traitement.php",
        method:"POST",
        data:{product_id:product_id,product_photo:product_photo,product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
          success:function(data)
          {
            load_cart();
            toastr["info"]("Item was reloaded");
              setTimeout(load,500);     
              function load(){
                $.ajax({
                  url:"view_cart.php",
                  method:"POST",
                  success:function(data){      
                    $("#view_cart").fadeIn(500).html(data);                                   
                  }
                });
              }
          }
        });
    }
    else
    {
      toastr["error"]("Please make a valid order!");
    }
});
/* --------------------------------------- */
$( '#fetch,#view_cart').on( "click", ':input[type="number"]', function() { 
  $(this).on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
 });
/* --------------------------------------- */
