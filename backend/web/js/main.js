$('#modalButton').click(function(){
	$('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
});

/*
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
  }*/


  $('#comp_more').click(function(){
      $('#com_div').css("display","block");
      $('#branch_div').css("display","none");
      $('#dept_div').css("display","none");
      $('#cust_div').css("display","none");
  });

  $('#branch_more').click(function(){
      $('#com_div').css("display","none");
      $('#branch_div').css("display","block");
      $('#dept_div').css("display","none");
      $('#cust_div').css("display","none");
  });

  $('#dept_more').click(function(){
      $('#com_div').css("display","none");
      $('#branch_div').css("display","none");
      $('#dept_div').css("display","block");
      $('#cust_div').css("display","none");
  });

  $('#cust_more').click(function(){
      $('#com_div').css("display","none");
      $('#branch_div').css("display","none");
      $('#dept_div').css("display","none");
      $('#cust_div').css("display","block");
  });