
@extends('Layouts.app')

@section('content')

<div class="container">
<dl class="row">
        <dt class="col-md-2">名前:</dt>
        <dd class="col-md-10">
                {{ $post[0]->name }}
        </dd>
        <dt class="col-md-2">タイトル:</dt>
        <dd class="col-md-10">
                {{ $post[0]->title }}
        </dd>
        <dt class="col-md-2">カテゴリ:</dt>
        <dd class="col-md-10">
                {{ $post[0]->type }}
        </dd>
        <dt class="col-md-2">{{ __('Created') }}:</dt>
        <dd class="col-md-10">
            <time itemprop="dateCreated" datetime="{{ $post[0]->created_at }}">
                {{ $post[0]->created_at }}
            </time>
        </dd>
        <dt class="col-md-2">{{ __('Updated') }}:</dt>
        <dd class="col-md-10">
            <time itemprop="dateModified" datetime="{{ $post[0]->updated_at }}">
                {{ $post[0]->updated_at }}
            </time>
        </dd>
        <dt class="col-md-2">内容:</dt>
        <dd class="col-md-10">
                {{ $post[0]->text }}
        </dd>
        <button class="btn btn-info"><a href='{{ url( "posts/". $post[0]->id ."/edit") }}' >編集</a></button>
</div>
@endsection