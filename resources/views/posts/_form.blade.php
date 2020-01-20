<form action="{{ $url }}" method="post" >
@csrf
@method($method)

    <div class="form-group">
        <label for="area">名前
        </label>
        <input type="text" class="form-control" name="name" value="{{ old('name', isset($post) ? $post[0]->name : '') }}"/>
        @include ('layouts.error', ['field' => 'name'])
    </div>
    <div class="form-group">
        <label for="category">カテゴリ</label>
            <select class="form-control" name="type_id" id="category">
                {!! type_options(old('type_id', isset($post) ? $post[0]->type : '')) !!}
            </select>
            @include ('layouts.error', ['field' => 'area'])
    </div>
    <div class="form-group">
        <label for="title">タイトル
        </label>
        <input type="text" class="form-control" name="title" value="{{ old('title', isset($post) ? $post[0]->title : '') }}"/>
        @include ('layouts.error', ['field' => 'title'])
    </div>
    <div class="form-group">
        <label for="article">内容</label>
            <textarea name="text" id="article" class="form-control">{{ old('text', isset($post) ? $post[0]->text : '') }}</textarea>
            @include ('layouts.error', ['field' => 'area'])
    </div>
    <!-- <button class="btn btn-info"><a href="posts/{{ $post[0]->id }}/edit" >編集</a></button> -->
    <a href="{{ route('posts.index') }}">戻る</a>
    <input type="submit" value="登録" class="btn btn-primary" />
</form>
