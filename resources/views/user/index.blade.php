@extends('layouts.app')

@section('content')
<div class="conA">
	<div class="container">
		<h1>次に行くラーメン屋さんがきっとみつかる。</h1>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<ul class="box-list user_box-list">
			@foreach ($users as $user)
				<li>
				<div class="indexImage user_indexImage">
					@if($user->image_url == null && $user->avatar == null)
						<img src="storage/user_images/no_image_user.jpg"> 
					@elseif($user->avatar)
						<img src="{{$user->avatar}}">
					@else
						<img src="{{ str_replace('public/', 'storage/', $user->image_url)}}">
					@endif
				</div>
					<h2><a href ="{{route('user.detail', [$user->id])}}">{{$user->name}}</a></h2>
					@if($user->comment == null)
						<p>コメント未登録</p>
					@else
						<p>{{$user->comment}}</p>
					@endif
				</li>
			@endforeach
		</ul>
		  {{ $users->links() }}
	</div>
	<div class="lineBot_part">
		<div class="container">
			<div class="text-part">
				<h3>\ Line bot 友達登録はこちら /</h3>
				<p>ラーメン博士がLineBotでおすすめのラーメン屋さんを紹介してくれるよ。</p>
				<p><small>「駅名」や「位置情報」送信してね。</small></p>
			</div>
			<div class="img-part">
				<img src="storage/shop_images/ramen711QR.png">
			</div>
		</div>
	</div>
</div>
@endsection
