@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add Inventory</div>

                <div class="panel-body">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <form class="form-horizontal" action="add_inventory" method="post" id="add_form" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10 input-group">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="Brand" class="col-sm-2 control-label">Brand</label>
    <div class="col-sm-10 input-group">
      <input type="text" class="form-control" id="brand" name="brand" placeholder="Brand">
    </div>
  </div>
  <div class="form-group">
        <label for="Brand" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-10 input-group">
      <input type="text" class="form-control" id="type" name="type" placeholder="Type (Whiskey, Vodka, etc)">
    </div>
  </div>
    <div class="form-group">
        <label for="mini_price" class="col-sm-2 control-label">Minature Price</label>
    <div class="col-sm-10 input-group">
      <span class="input-group-addon">$</span>
      <input type="text" class="form-control" id="mini_price" name="mini_price" placeholder="0.00">
    </div>
  </div>
    <div class="form-group">
        <label for="hp_price" class="col-sm-2 control-label">Half-Pint Price</label>
    <div class="col-sm-10 input-group">
      <span class="input-group-addon">$</span>
      <input type="text" class="form-control" id="hp_price" name="hp_price" placeholder="0.00">
    </div>
  </div>
    <div class="form-group">
        <label for="pint_price" class="col-sm-2 control-label">Pint Price</label>
    <div class="col-sm-10 input-group">
      <span class="input-group-addon">$</span>
      <input type="text" class="form-control" id="pint_price" name="print_price" placeholder="0.00">
    </div>
  </div>
    <div class="form-group">
        <label for="fifth_price" class="col-sm-2 control-label">Fifth Price</label>
    <div class="col-sm-10 input-group">
      <span class="input-group-addon">$</span>
      <input type="text" class="form-control" id="fifth_price" name="fifth_price" placeholder="0.00">
    </div>
  </div>
    <div class="form-group">
        <label for="liter_price" class="col-sm-2 control-label">Liter Price</label>
    <div class="col-sm-10 input-group">
      <span class="input-group-addon">$</span>
      <input type="text" class="form-control" id="liter_price" name="liter_price" placeholder="0.00" aria-describedby="basic-addon1">
    </div>
  </div>
    <div class="form-group">
        <label for="hg_price" class="col-sm-2 control-label">Half Gallon Price</label>
    <div class="col-sm-10 input-group">
      <span class="input-group-addon">$</span>
      <input type="text" class="form-control" aria-describedby="basic-addon1" id="hg_price" name="hg_price" placeholder="0.00">
    </div>
  </div>
  <div class="form-group">
        <label for="picture" class="col-sm-2 control-label">Picture</label>
    <div>
      <input type="file" id="picture" name="picture">
    </div>
  </div>  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Add Item</button>
    </div>
  </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{ URL::asset('js/add_inv.js') }}"></script>
@endsection
