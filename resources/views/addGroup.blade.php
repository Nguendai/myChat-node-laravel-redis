@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Thêm kênh <a href="home" style="color:#fff"><button type="button" class="btn btn-primary">Home</button></a></div>

                <div class="panel-body">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        </div>
                    @endif
                    <form action="add_group" method="post">
                    
                        <div class="form-group">
                            <label for="channel">Tên kênh</label>
                            <input type="text" class="form-control" id="channel" aria-describedby="channel" name="channel" placeholder="Enter channel" required >
                            
                        </div>
                        <label for="type">Kiểu kênh</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_group" id="inlineRadio1" value="0" checked>
                            <label class="form-check-label" for="inlineRadio1"> Đơn</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_group" id="inlineRadio2" value="1">
                            <label class="form-check-label" for="inlineRadio2">Nhóm</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </form>
              
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
