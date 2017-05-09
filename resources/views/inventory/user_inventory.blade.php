@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Add Inventory</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Inventory ID</th>
                                <th>Brand</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>In Stock</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drinks as $drink)
                                <tr id="{{$drink->pivot->id}}">
                                    <td>{{$drink->id}}</td>
                                    <td>{{$drink->brand}}</td>
                                    <td>{{$drink->name}}</td>
                                    <td id="{{$drink->pivot->id}}_size">{{$drink->pivot->size}}</td>
                                    <td id="{{$drink->pivot->id}}_price">${{$drink->pivot->price}}</td>
                                    <td><input id="{{$drink->pivot->id}}_instock" value="1" type="checkbox" name="in_stock"
                                        @if($drink->pivot->in_stock == 1)
                                            checked="checked"
                                        @endif
                                        disabled="disabled"></td>
                                    <td id="{{$drink->pivot->id}}_edit"><button onClick="editRow({{$drink->pivot->id}}, '{{csrf_token()}}')">Edit</button></td>
                                    <td><button onClick="deleteRow({{$drink->pivot->id}}, '{{csrf_token()}}')">Delete</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{ URL::asset('js/pers_inv.js') }}"></script>
@endsection