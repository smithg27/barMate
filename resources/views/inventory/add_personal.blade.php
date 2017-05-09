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
                    <form action="{{url('inventory/add/' . $drink->id)}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="size" class="col-sm-2 control-label">Inventory:</label>
                            <div class="col-sm-10 input-group">
                                {{$drink->brand}} {{$drink->name}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="size" class="col-sm-2 control-label">Size</label>
                            <div class="col-sm-10 input-group">
                                <select name="size"><option value="Minitaure">Minitaure</option><option value="Half-Pint">Half Pint</option><option value="Pint">Pint</option><option value="Fifth">Fifth</option><option value="Liter">Liter</option><option value="Half-Gallon">Half Gallon</option></select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-10 input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" name="price">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="in_stock" class="col-sm-2 control-label">In Stock</label>
                            <div class="col-sm-10 input-group">
                                <input type="checkbox" name="in_stock" value="1" />
                           </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="col-sm-2 control-label">Add to Inventory</button>
                            </div>
                        </div>
                    </form>
</br>
@endsection
