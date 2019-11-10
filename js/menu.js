$( '#fetch' ).on( "click", "#11a", function() {    
      load_pizza();
      function load_pizza(){
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
/* --------------------------------------- */
    $( '#fetch' ).on( "click", "#22a", function() {     
      load_pizza();
      function load_pizza(){
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
  /* --------------------------------------- */
    $( '#fetch' ).on( "click", "#33a", function() {   
      load_pizza();
      function load_pizza(){
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
    /* --------------------------------------- */
    $( '#fetch' ).on( "click", "#44a", function() {
      load_jus();
      function load_jus(){
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
  /* --------------------------------------- */
    $( '#fetch' ).on( "click", "#55a", function() {     
      load_pizza();
      function load_pizza(){
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
   /* --------------------------------------- */
    $( '#fetch' ).on( "click", "#66a", function() {    
      load_pizza();
      function load_pizza(){
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
   /* --------------------------------------- */
    $( '#fetch' ).on( "click", "#77a", function() {    
      load_pizza();
      function load_pizza(){
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
   /* --------------------------------------- */
    $( '#fetch' ).on( "click", " #88a", function() {   
      load_pizza();
      function load_pizza(){
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
