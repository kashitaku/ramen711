@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ユーザー詳細</div>
			<div class="panel-body">
				<div class="box-list">
					<div class="detail">
						@if($user->image_url == null)
							<img src="../../storage/user_images/no_image_user.jpg">
						@else
							<img src="../../{{$user->image_url}}">
						@endif
					</div>
					<h2>{{$user->name}}</h2>
					@if($user->comment == null)
						<p>コメント未登録</p>
					@else
						<p>{{$user->comment}}</p>
					@endif
				</div>
					@if ($user->id === Auth::user()->id)
						<form action ="{{route('user.edit', [$user->id])}}" method="get">
						{{ csrf_field() }}
						<button type="submit" class="btn btn-primary btn-sm">編集</button>
						</form>
					@endif
				</div>
			</div>
		<a class="move_page btn btn-primary" href ="{{route('shop.index')}}" role="button">ラーメン屋さん一覧ページへ</a>
		<a class="move_page btn btn-primary" href ="{{route('user.index')}}" role="button">ユーザー一覧ページへ</a>
        </div>
    </div>
</div>
@endsection
