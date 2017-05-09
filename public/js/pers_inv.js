function deleteRow ($id, $token) {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $.ajax(
	{url: '../add/' + $id,
	 method: 'DELETE',
	 data: {"_token": $token },
	 success: function() { $('#' + $id).remove();
 }});
}

function editRow ($id, $token) {
    $sizeinner = $('#' + $id + '_size').html();
   
    if($sizeinner == 'Minitaure') {
        $('#' + $id + '_size').html('<select id="size_' + $id + '" name="size"><option value="Minitaure">Minitaure</option><option value="Half-Pint">Half-Pint</option><option value="Pint">Pint</option><option value="Fifth">Fifth</option><option value="Liter">Liter</option><option value="Half-Gallon">Half-Gallon</option></select>');
    }
    else if($sizeinner == 'Half-Pint') {
        $('#' + $id + '_size').html('<select id="size_' + $id + '" name="size"><option value="Minitaure">Minitaure</option><option selected value="Half-Pint">Half-Pint</option><option value="Pint">Pint</option><option value="Fifth">Fifth</option><option value="Liter">Liter</option><option value="Half-Gallon">Half-Gallon</option></select>');
    }
    else if($sizeinner == 'Pint') {
        $('#' + $id + '_size').html('<select id="size_' + $id + '" name="size"><option value="Minitaure">Minitaure</option><option value="Half-Pint">Half-Pint</option><option selected value="Pint">Pint</option><option value="Fifth">Fifth</option><option value="Liter">Liter</option><option value="Half-Gallon">Half-Gallon</option></select>');
    }
    else if($sizeinner == 'Fifth') {
        $('#' + $id + '_size').html('<select id="size_' + $id + '" name="size"><option value="Minitaure">Minitaure</option><option value="Half-Pint">Half-Pint</option><option value="Pint">Pint</option><option selected value="Fifth">Fifth</option><option value="Liter">Liter</option><option value="Half-Gallon">Half-Gallon</option></select>');
    }
    else if($sizeinner == 'Liter') {
        $('#' + $id + '_size').html('<select id="size_' + $id + '" name="size"><option value="Minitaure">Minitaure</option><option value="Half-Pint">Half-Pint</option><option value="Pint">Pint</option><option value="Fifth">Fifth</option><option selected value="Liter">Liter</option><option value="Half-Gallon">Half-Gallon</option></select>');
    }
    else {
        $('#' + $id + '_size').html('<select id="size_' + $id + '" name="size"><option value="Minitaure">Minitaure</option><option value="Half-Pint">Half-Pint</option><option value="Pint">Pint</option><option value="Fifth">Fifth</option><option value="Liter">Liter</option><option selected value="Half-Gallon">Half-Gallon</option></select>');
    }
    $priceinner = $('#' + $id + '_price').html();
    $priceinner = $priceinner.replace('$', '');
    $('#' + $id + '_price').html('<div class="form-group"><div class="input-group"><span class="input-group-addon">$</span><input type="text" id="price_' + $id + '" name="price" value = "' + $priceinner + '"></div></div>');
    $('#' + $id + '_edit').html('<input type="hidden" id="token_' + $id + '" name="_token" value="' + $token + '"><button onClick="updateRow(' + $id + ')">Update</button>');
    $('#' + $id + '_instock').removeAttr("disabled");
}

function updateRow ($id) {
    $size = $('#size_' + $id).val();
    $price = $('#price_' + $id).val();
    if(isNaN($price) || $price == '')
{ alert('Please enter a valid price. Do not inculde the dollar sign.') }
else{
    $price = parseFloat($price);
    $price = $price.toFixed(2);
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    
    if ($('#' + $id + '_instock').is(':checked')) {
       $stock = 1;
    }
    else {
       $stock = 0;
    }    
    $token = $('#token_' + $id).val();
    $.ajax(
        {url: '../add/' + $id,
         method: 'PATCH',
         data: {size: $size, price: $price, in_stock: $stock, _token: $token},
         success: function(response) {
             $response = response;
             $('#' + $id + '_size').html($response.size);
             $('#' + $id + '_price').html('$' + $response.price);
             if($response.in_stock == 1){
                 $('#' + $id + '_instock').attr('checked', true);
             }
             else {
                 $('#' + $id + '_instock').attr('checked', false);
             }
             $('#' + $id + '_instock').attr('disabled', true); 
             $('#' + $id + '_edit').html('<button onClick="editRow(' + $id + ', \'' + $token + '\')">Edit</button>');
             }
             
 });
}
}   
