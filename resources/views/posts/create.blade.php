
@extends('Layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Chats</div>

                <div class="panel-body">
                    @include ('posts/_form',['method' => 'post', 'url'=> route('posts.store') ])
                </div>
                <div class="panel-footer">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection