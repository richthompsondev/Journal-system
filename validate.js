function myform(prev_form)
{
	var oForm = document.getElementById(prev_form);

	var name_ok = false;
	var agree_ok = false;

	var msg_str = "Missing Information:\n";

	for(var i=0; i<oForm.elements.length; i++)
		switch(oForm.elements[i].name)
		{
			case 'username':
				if(oForm.elements[i].value != '')
					name_ok = true;
				else {
					msg_str += "Please enter username \n";
				}
			break;
            case 'password':
                if(oForm.elements[i].value != '')
                agree_ok= true;
                else
                msg_str += "please enter password";
                break;
                

			
		};

		if(name_ok == true && agree_ok == true){
			return true;
		}
			
		else {
			alert(msg_str);
			return false;
		}
}
function validatesetting(prev_form){
    var oForm = document.getElementById(prev_form);

	var name_ok = false;
	var agree_ok = false;

	var msg_str = "Missing Information:\n";
    var pass_ok = false;

	for(var i=0; i<oForm.elements.length; i++){
		switch(oForm.elements[i].name)
		{
			case 'username':
				if(oForm.elements[i].value != '')
					name_ok = true;
				else {
					msg_str += "Please enter username \n";
				}
			break;
            case 'password':
                if(oForm.elements[i].value != '')
                agree_ok= true;
                else
                msg_str += "please enter password\n";
                break;
                case 'password_sec':
                    if(oForm.elements[i].value != '')
                    pass_ok = true;
                    else
                    msg_str += "please retype password\n";
                    break;

                

			
		};

       

    }
   

		if(name_ok == true && agree_ok == true && pass_ok == true){
			return true;
		}
			
		else {
			alert(msg_str);
			return false;
		}
   
        
        

}