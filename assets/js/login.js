(function ($) {
    "use strict";


$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  //console.log('JS')
  
  $('.validate-form .input100').each(function(){
           hideValidate(this);
		   document.getElementById('files').innerHTML = "";
        
    });
  
  var target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(800);
  
});
  
  
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;
		
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
		
		var files = document.getElementById('file-upload');
		if('files' in files)
		{
			if(files.files.length == 0)
			{
				document.getElementById('files').innerHTML = "<b style='color:red;'>Debes adjuntar documentación</b>";
			}
		}

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) 
	{
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
		if($(input).attr('type') == 'checkbox')
		{
			if($(input).prop('checked') == false)
			{
				return false;
			}
		}
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
	

})(jQuery);


function cambiar()
{
	var files = document.getElementById('file-upload');
	if('files' in files)
	{
		if(files.files.length == 0)
		{
			document.getElementById('files').innerHTML = "<b style='color:red;'>Debes adjuntar documentación</b>";
		}
		else
		{
			document.getElementById('files').innerHTML = files.files[0].name;
		}
	}
	
	console.log(files);
	console.log(typeof(files));
	
}

