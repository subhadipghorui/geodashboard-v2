@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-10 mt-4">
            <div class="mb-3">
                <h1>User's all maps</h1>
            </div>
            <hr>
           <div class="row">
            @if (!empty($data['maps']))
            @foreach ($data['maps'] as $map)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{$map->g_label}}</h5>
                    <p class="card-text">
                        <b>Template: </b>{{$map->g_template}}<br>
                        <p>
                        @foreach ($map->groups() as $item)
                        <span class="badge bg-warning text-dark">{{$item->g_label}}</span>
                        @endforeach 
                        </p> 
                        @if ($map->status == 1)
                            <span class="badge bg-success text-light">Published</span><br>  
                        @else
                            <span class="badge bg-secondary text-light">Draft</span><br>  
                        @endif
                    
                    </p>
                    <a href="{{route('app.dashboard.view', $map->g_uuid)}}" class="btn btn-dark">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <h3>No maps available...</h3>  
        @endif
           </div>
          
        </div>
    </div>
</div>
@endsection