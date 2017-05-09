$price = JSON.parse(document.getElementById('hidden_price').innerHTML);
var $domprice = document.getElementById('price');
$domprice.innerHTML = "Price: $" + $price.mini_price.toFixed(2);

function changePrice() {
    var x = document.getElementById("price_select").value;
    document.getElementById('price').innerHTML = "Price: $" + $price[x].toFixed(2);
    
}

function editInv($id, $brand, $name, $type, $token, $price) {
   $('#media_body').html('<form class="form-horizontal" id="edit"><input type="hidden" name="_token" value="' + $token + '"><div class="form-group">    <label for="name" class="col-sm-2 control-label">Name</label>    <div class="col-sm-10 input-group">      <input type="text" class="form-control" id="name" name="name" value="' + $name + '">    </div>  </div>  <div class="form-group">    <label for="Brand" class="col-sm-2 control-label">Brand</label>    <div class="col-sm-10 input-group">      <input type="text" class="form-control" id="brand" name="brand" value="' + $brand + '">    </div>  </div>  <div class="form-group">        <label for="Brand" class="col-sm-2 control-label">Type</label>    <div class="col-sm-10 input-group">      <input type="text" class="form-control" id="type" name="type" value="' + $type + '">    </div>  </div>    <div class="form-group">        <label for="mini_price" class="col-sm-2 control-label">Minature Price</label>    <div class="col-sm-10 input-group">      <span class="input-group-addon">$</span>      <input type="text" class="form-control" id="mini_price" name="mini_price" value="' + $price.mini_price + '">    </div>  </div>    <div class="form-group">        <label for="hp_price" class="col-sm-2 control-label">Half-Pint Price</label>    <div class="col-sm-10 input-group">      <span class="input-group-addon">$</span>      <input type="text" class="form-control" id="hp_price" name="hp_price" value="' + $price.hp_price + '">    </div>  </div>    <div class="form-group">        <label for="pint_price" class="col-sm-2 control-label">Pint Price</label>    <div class="col-sm-10 input-group">      <span class="input-group-addon">$</span>      <input type="text" class="form-control" id="pint_price" name="pint_price" value="' + $price.pint_price + '">    </div>  </div>    <div class="form-group">        <label for="fifth_price" class="col-sm-2 control-label">Fifth Price</label>    <div class="col-sm-10 input-group">      <span class="input-group-addon">$</span>      <input type="text" class="form-control" id="fifth_price" name="fifth_price" value="' + $price.fifth_price + '">    </div>  </div>    <div class="form-group">        <label for="liter_price" class="col-sm-2 control-label">Liter Price</label>    <div class="col-sm-10 input-group">      <span class="input-group-addon">$</span>      <input type="text" class="form-control" id="liter_price" name="liter_price" value="' + $price.liter_price + '" aria-describedby="basic-addon1">    </div>  </div>    <div class="form-group">        <label for="hg_price" class="col-sm-2 control-label">Half Gallon Price</label>    <div class="col-sm-10 input-group">      <span class="input-group-addon">$</span>      <input type="text" class="form-control" aria-describedby="basic-addon1" id="hg_price" value="' + $price.hg_price + '" name="hg_price">    </div>  </div>    <div class="form-group">    <div class="col-sm-offset-2 col-sm-10">      <button onClick="updateItem(' + $id + ')" type="button" class="btn btn-default">Update Item</button> </div></div></form>');
}

function updateItem($id){
    var $input = $('#edit :input');
    var values = {};
    $input.each(function() {
        values[this.name] = $(this).val();
     });
     var data = {};
     for (var key in values) {
         if(key == ''){
             continue;
         }
         else{
            data[key] = values[key];
         }
     }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
     $.ajax(
	{url: '../add_inventory/' + $id,
	 method: 'PATCH',
	 data: data,
	 success: function(response) {
         $price = jQuery.parseJSON(response['price']);
         price_string = response.price;
         price_string = price_string.replace(/"/g, "&quot;");
         $('#media_body').html('<h4 class="media-heading" id="brand_name">' + response.brand + ' ' + response.name + '</h4><p>Type: ' + response.type + '</p><p>Size: <select id="price_select" onchange="changePrice()"><option value="mini_price">Minitaure</option><option value="hp_price">Half-Pint</option><option value="pint_price">Pint</option><option value="fifth_price">Fifth</option><option value="liter_price">Liter</option><option value="hg_price">Half-Gallon</option></select></p><p id="hidden_price">' + response.price + '</p><p id="price" value="' + $price.mini_price + '">Price: $' + $price.mini_price + '</p><form action="delete/' + response.id + '" method="POST"><input type="hidden" name="_method" value="DELETE"><input type="hidden" name="_token" value="' + data.token + '"><button type="submit" class="btn btn-danger">Delete</button></form></br><button class="btn btn-success" onClick="editInv(\'' + $id + '\', \'' + response.brand + '\', \'' + response.name + '\', \'' + response.type + '\', \'' + data._token + '\', ' + price_string + ')">Edit</button>');
    }});
};
