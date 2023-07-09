 
  $(document).ready(function(){
  
  
	$( ".click_appoinment_letter" ).click(function() {
	  var id = this.id;
		$.ajax({
          type: 'POST',
          url: "user/appoinmentletter",
          data: {id:id},
          success: function(response){
			  var obj = jQuery.parseJSON(response);
			  $('#appoinment_letter_details').html(obj.bod[0].popdescription);
		  }
        });
	});
	

    
  });