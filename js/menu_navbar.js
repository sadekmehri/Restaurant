$("#111a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $('#fetch').html('<div id="go" style="" ></div>');
      $("#view_cart").hide();   
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
                     $("#fetch").fadeIn(500).html(data);                		               
                    }
               });
          }
  });

  $("#222a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $("#view_cart").hide();  
      $('#fetch').html('<div id="go" style="" ></div>');
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
                    $("#fetch").fadeIn(500).html(data);                		               
                   }
               });
          }
  });

  $("#333a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $("#view_cart").hide();  
      $('#fetch').html('<div id="go" style="" ></div>');
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
              $("#fetch").fadeIn(500).html(data);                		               
             }
               });
          }
  });

  $("#444a").click(function(){ 
    load_jus();
      function load_jus(){
        $("#view_cart").hide();  
        $('#fetch').html('<div id="go" style="" ></div>');
          $.ajax({
            url:"jus.php",
            method:"POST",
            beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
            success:function(data){ 
              $("#fetch").fadeIn(500).html(data);                		               
            }
          });
      }    
  });


  $("#555a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $("#view_cart").hide();  
      $('#fetch').html('<div id="go" style="" ></div>');
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
              $("#fetch").fadeIn(500).html(data);                		               
             }
               });
          }
  });

  $("#666a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $("#view_cart").hide();  
      $('#fetch').html('<div id="go" style="" ></div>');
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
              $("#fetch").fadeIn(500).html(data);                		               
             }
               });
          }
  });

  $("#777a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $("#view_cart").hide();  
      $('#fetch').html('<div id="go" style="" ></div>');
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
              $("#fetch").fadeIn(500).html(data);                		               
             }
               });
          }
  });

  $("#888a").click(function(){ 
    load_pizza();
    function load_pizza(){
      $("#view_cart").hide();  
      $('#fetch').html('<div id="go" style="" ></div>');
               $.ajax({
                   url:"pizza.php",
                   method:"POST",
                   beforeSend: function() {
                   $('#fetch').html('<div id="load"></div>');
                },
                   success:function(data){ 
              $("#fetch").fadeIn(500).html(data);                		               
             }
               });
          }
  });

