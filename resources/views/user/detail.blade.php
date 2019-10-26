@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				@if ($user->id === Auth::user()->id)
					マイページ
				@else
					ユーザー詳細
				@endif
			</div>
		<div class="panel-body">
			<div class="box-list">
				<div class="detail_user">
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
				@if ($user->id === Auth::user()->id)
					<form action ="{{route('user.edit', [$user->id])}}" method="get">
					{{ csrf_field() }}
					<button type="submit" class="btn btn-primary btn-sm">編集</button>
					</form>
				@endif
			</div>
			<ul class="box-list">
				<h3>- いいねしたラーメン屋さん {{count($shops)}}件 -</h3>
				@if(($shops))
					@foreach ($shops as $shop)
						<li>
						<div class="indexImage">
							@if($shop->image_url == null)
								<img src="../../storage/shop_images/no_image.png">
							@else
								<img src="{{ str_replace('public/', '../../storage/', $shop->image_url)}}">
							@endif
						</div>
							<h2><a href ="{{route('shop.detail', [$shop->shop_id])}}">{{$shop->name}}</a></h2>
							<p>{{$shop->point}}</p>
							<small>{{$shop->station1}}</small>
						</li>
					@endforeach
				@endif
			</ul>
			{{ $shops->links() }}
			<ul class="box-list">
				<h3>- レビューしたラーメン屋さん {{count($reviews)}}件 -</h3>
				@if(($reviews))
					@foreach ($reviews as $review)
						<li>
						<div class="indexImage">
							@if($review->image_url == null)
								<img src="../../storage/shop_images/no_image.png">
							@else
								<img src="{{ str_replace('public/', '../../storage/', $review->image_url)}}">
							@endif
						</div>
							<h2><a href ="{{route('shop.detail', [$review->shop_id])}}">{{$review->name}}</a></h2>
							<small>{{$review->station1}}</small>
						</li>
					@endforeach
				@endif
			</ul>
			{{ $reviews->links() }}
			</div>
		</div>
		<a class="move_page btn btn-primary" href ="{{route('shop.index')}}" role="button">ラーメン屋さん一覧ページへ</a>
		<a class="move_page btn btn-primary" href ="{{route('user.index')}}" role="button">ユーザー一覧ページへ</a>
	</div>
</div>
@endsection
