load_cart();
function load_cart(){
    $.ajax({
        url:"fetch_card.php",
        method:"POST",
        dataType:"json",
        success:function(data)
        { 
          $('.cart-dropdown').html(data.cart_details);
          $('#prix').text(data.total_price);
          $('.qty').text(data.total_item);           		           
        }
    });
}
/* --------------------------------------- */
$(document).on('click', '.btn-success', function(){
      var product_id = $(this).attr("id");
      var product_name = $('#name'+product_id+'').val();
      var product_price = $('#price'+product_id+'').val();
      var product_quantity = $('#quantity'+product_id).val();
      var product_photo = $('#photo'+product_id).val();
      var action = "add";	
        if(product_quantity>0)
        {	
            $.ajax({
                url:"traitement.php",
                method:"POST",
                data:{product_id:product_id,product_photo:product_photo,product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
                success:function(data)
                {
                    load_cart();
                    toastr["success"]("Item was added to the cart");
                }
             });
        }
        else
        {
          toastr["error"]("Please make a valid order!");
        }
});
/* --------------------------------------- */
$( '#view_cart' ).on( "click", ".btn-danger", function() { 
  var product_id = $(this).attr("id");
    var action = "remove";
      if(confirm("Are you sure you want to remove this product?"))
      {
          $.ajax({
              url:"traitement.php",
              method:"POST",
              data:{product_id:product_id,action:action},
                success:function()
                {
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

      }else{
           return false;
      }
});
/* --------------------------------------- */
    load();
    function load(x)
    {
      $.ajax({
        url:"search.php",
        method:"POST",
        data:{x:x},
        success:function(data){
          $('#view_cart').html('<div id="go" style="" ></div>');
          $("#fetch").fadeIn(500).html(data);
        },
        error:function(err){
          alert("Something happened");
          console.log(err);
        }
      });
    }

    $("#typing").keyup(function(){
      var look=$(this).val();
      if(look!==''){
        load(look);
      }else{
        load();
      }
    });


    