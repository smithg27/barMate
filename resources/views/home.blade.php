@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h3>Inventory</h3>
                    <ul>
                        <li><a href="{{ url('/inventory/view_all') }}">View Global Inventory</a>
<ul>
  <li><a href="{{url('/inventory/view_all/wiskey') }}">Whiskey</a></li>
  <li><a href="{{url('/inventory/view_all/vodka') }}">Vodka</li>
  <li><a href="{{url('/inventory/view_all/tequila') }}">Tequila</li>
  <li><a href="{{url('/inventory/view_all/gin') }}">Gin</li>
</ul>
</li>
                     <li><a href="{{ url('/inventory/user/' . Auth::user()->id) }}">Your Inventory</a></li>
                        <li><a href="{{ url('/inventory/add_inventory') }}">Add Inventory</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
