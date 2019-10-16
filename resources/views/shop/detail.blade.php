@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">店舗詳細</div>
                <div class="panel-body">
					<div class="box-list">
						<div class="detail_ramen">
							@if($shop->image_url == null)
								<img src="../../storage/shop_images/no_image.png">
							@else
								<img src="../../{{$shop->image_url}}">
							@endif
						</div>
						<h2>{{$shop->name}}</h2>
							<div class="heart_part">
								@if ($like)
									<form action="{{route('shop.like.destroy', [$shop->id, $like->id])}}" method="post">
										{{ csrf_field() }}
									<button type="submit">
										<img src="../../storage/shop_images/heart_like.png">
										like {{$shop->likes_count}}
									</button>
									</form>
								@else
									<form action="{{route('shop.like.store', [$shop->id])}}" method="post">
										{{ csrf_field() }}
										<button type="submit">
											<img src="../../storage/shop_images/heart_dislike.png">
											like {{$shop->likes_count}}
										</button>
									</form>
								@endif
							</div>
						<small>{{$shop->station1}}</small>
						<p>{{$shop->point}}</p>
					</div>
                </div>
            </div>
			<a class="move_page btn btn-primary" href ="{{route('shop.index')}}" role="button">ラーメン屋さん一覧ページへ</a>
        </div>
    </div>
</div>
@endsection
