@extends('layouts.app')

@section('content')
<div class="container">
    {{ $inventory->links() }}
    @php $count = 1 @endphp
    @foreach ($inventory as $result)
       @if ($count == 1)
            <div class="row">
            @php $count ++ @endphp
       @else
            @php $count ++ @endphp
       @endif
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  @if ($result->picture == 0)
                    <img src="{{url('images/test.svg')}}" height='200' alt="...">
                  @else
                    <img src="{{url('inventory/images/' . $result->id)}}" style="height:242px" alt="..">
                  @endif
                    <div class="caption">
                    <h3>{{$result->brand}} {{$result->name}}</h3>
                    <p>more information here</p>
                    <p><a href="{{url('inventory/view/' . $result->id)}}" class="btn btn-primary" role="button">View Details</button> <a href="{{url('inventory/add/' . $result->id)}}" class="btn btn-default" role="button">Add to Inventory</a></p>
                    </div>
                 </div>
            </div>
       @if ($count == 4)
           </div>
         @php $count = 1 @endphp
       @endif
    @endforeach

@if($count != 1)
</div>
@endif
{{ $inventory->links() }}
</div>
@endsection

