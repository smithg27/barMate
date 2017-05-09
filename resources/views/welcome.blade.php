@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Welcome to barMate, where you can build your own bar inventory! You can view our master list of drinks at any time by clicking <a href="{{url('inventory/view_all')}}">here</a> or clicking "View All" under the "Inventory" drop down. To create your own inventory or add drinks to the master list you will need to sign-up or login.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
