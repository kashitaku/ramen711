@extends('layouts.app')

@section('content')
<div class="conA">
	<div class="container">
		<h1>次に行くラーメン屋さんがきっとみつかる。</h1>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-body">
		<ul class="box-list">
			<form class="form_serch form-inline" action="{{route('shop.index')}}">
				<input type="text" name="keyword" value="{{$keyword}}" placeholder="店名を入力">
				<input type="text" name="keyword_station" value="{{$keyword_station}}" placeholder="駅名を入力">
				<div>
					<input class="checkbox" type="checkbox" name="sort" value="likeDesc" @if ($sort==="likeDesc") checked @endif><label for="likeDesc">いいね順</label>
				</div>
				<button type="submit" class="btn btn-primary">検索</button>
			</form>
			@foreach ($shops as $shop)
				<li>
				<div class="indexImage">
					@if($shop->image_url == null)
						<img src="storage/shop_images/no_image.png">
					@else
						<img src="{{ str_replace('public/', 'storage/', $shop->image_url)}}">
					@endif
				</div>
					<h2><a href ="{{route('shop.detail', [$shop->id])}}">{{$shop->name}}</a></h2>
					<p>{{$shop->point}}</p>
					<small>{{$shop->station1}}</small>
				</li>
			@endforeach
		</ul>
		  {{ $shops->links() }}
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
