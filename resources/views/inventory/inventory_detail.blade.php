@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading" id="brand_name_heading">{{$inventory->brand}} {{$inventory->name}}</div>
        <div class="panel-body">                 
          <div class="media">
            <div class="media-left media-middle">
              @if ($inventory->picture == 0)
                <img src="{{url('images/test.svg')}}" width='242' height='200' alt="...">
              @else
                <img src="{{url('inventory/images/' . $inventory->id)}}" width='242' height='200' alt="..">
              @endif
            </div>
            <div class="media-body" id="media_body">
              <h4 class="media-heading" id="brand_name">{{$inventory->brand}} {{$inventory->name}}</h4>
              <p>Type: {{$inventory->type}}</p>
              <p>Size: <select id="price_select" onchange="changePrice()"><option value="mini_price">Minitaure</option><option value="hp_price">Half-Pint</option><option value="pint_price">Pint</option><option value="fifth_price">Fifth</option><option value="liter_price">Liter</option><option value="hg_price">Half-Gallon</option></select></p>
              <p id="hidden_price">{{$inventory->price}}</p>
                
              <p id='price'>Price: </p>
              <form action="{{url('inventory/add_inventory/' . $inventory->id)}}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <button type="submit" class="btn btn-danger">Delete</button>
            </form></br>
              <button class="btn btn-success" onClick="editInv({{$inventory->id}}, '{{$inventory->brand}}', '{{$inventory->name}}', '{{$inventory->type}}', '{{ csrf_token() }}', {{$inventory->price}})">Edit</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<link rel="stylesheet" href="{{ URL::asset('css/inv_details.css') }}" />    
<script type="text/javascript" src="{{ URL::asset('js/inv_details.js') }}"></script>
@endsection
