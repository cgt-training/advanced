$('#modalButton').click(function(){
	$('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
});


 function load_data(event){
      //var url = event.data.url;
      $.ajax({
            url: event.data.url_link, 
            type:"post",

           success: function(result){
            //$.pjax.reload({ container: '#pjax_main_container'});
            $("#pjax_main_container").html(result);
            return false;
        }});
      return false;
  }


  function load_data_new(url_data){
  	$.ajax({
            url: url_data, 
            type:"post",

           success: function(result){
            //$.pjax.reload({ container: '#pjax_main_container'});
            $("#pjax_main_container").html(result);
            return false;
        }});
      return false;	
  }