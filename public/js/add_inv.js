$('#add_form').submit(function(e){
    e.preventDefault();
    if ($('#name').val() == '') {
        alert('Please enter a valid name');
    }
    else if ($('#brand').val() == '') {
        alert('Please enter a valid brand. If unkown enter N/A');
    }
    else if ($('#type').val() == '') {
        alert('Please enter a valid type. If unkown enter N/A');
    }
    else if(isNaN($('#mini_price').val()))
        { alert('Please enter a valid mini price. Do not inculde the dollar sign.') }
    else if(isNaN($('#hp_price').val()))
        { alert('Please enter a valid half pint price. Do not inculde the dollar sign.') }
    else if(isNaN($('#pint_price').val()))
        { alert('Please enter a valid pint price. Do not inculde the dollar sign.') }
    else if(isNaN($('#fifth_price').val()))
        { alert('Please enter a valid fifth price. Do not inculde the dollar sign.') }
    else if(isNaN($('#liter_price').val()))
        { alert('Please enter a valid liter price. Do not inculde the dollar sign.') }
    else if(isNaN($('#hg_price').val()))
        { alert('Please enter a valid half price. Do not inculde the dollar sign.') }
    else{
       $('#add_form').submit();   
   }

});
