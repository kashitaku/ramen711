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
