
@extends('Layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>
                <div class="panel-body">
                    <table class="table form-controller">
                        @foreach($posts as $p)
                        <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->name}}</td>
                            <td>{{$p->created_at}}</td>
                            <td>{{$p->updated_at}}</td>
                            <td><button class="btn btn-info"><a href="posts/{{ $p->id }}" >詳細</a></button></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="panel-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection