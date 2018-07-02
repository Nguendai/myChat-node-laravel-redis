@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Danh sách kênh <a href="add_group" style="color:#fff"><button type="button" class="btn btn-primary">Thêm Kênh</button></a></div>

                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        </div>
                    @endif
                   
                <ul class="list-group">
                    @foreach($groups as $group)
                    <li class="list-group-item "><a href="join_group/{{$group->id}}">{!!$group->name!!}<a></li>
                   @endforeach
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
