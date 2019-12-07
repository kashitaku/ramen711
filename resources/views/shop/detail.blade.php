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
                     <p>@foreach ($shop->tags as $tag) #{{ $tag->name }} @endforeach</p> 
						<p>{{$shop->point}}</p>
					</div>
         <div class="row">
            <div class="col-md-8 offset-md-2">
            <h4> レビュー計 {{$reviews->total()}} 件</h4>
            <p> {{count($reviews)}}件表示</p>
              @foreach ($reviews as $review)
                 <div class="card">
                    <div class="image_part detail_user">
                        @if($review->image_url == null)
                           <img src="../../storage/user_images/no_image_user.jpg">
                        @else
                           <img src="{{str_replace('public/', '../../storage/', $review->image_url)}}">
                        @endif
                       <small><a href="{{route('user.detail', [$review->user_id])}}">{{$review->name}}</a></small>
                    </div>
                    <div class="text_part">
                       <p>{{$review->title}}</p>
                       <p>{{$review->review}}</p>
                       <small>{{$review->created_at}}</small>
                       @if (Auth::user()->id === $review->user_id)
						<div class="edit_delete">
							<form action ="{{route('shop.review.delete', [$review->id, $review->shop_id])}}" method="post">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-warning btn-sm btn-dell">削除</button>
							</form>
						</div>
						@endif
					</div>
				</div>
				@endforeach
				@if (count($errors) >0 )
				<div>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
				{{ $reviews->links() }}
				<form action="{{route('shop.review', [$shop->id])}}" method="post">
                     {{ csrf_field() }}
                    <input type="text" name="title" value="{{old('title')}}" placeholder="タイトル(30文字以内)">  
                    <input type="text" name="review" value="{{old('review')}}" placeholder="レビュー(140文字以内)"> 
                    <input type="submit" value="コメントする"> 
                </form>
            </div>
         </div>
                </div>
            </div>
            <a class="move_page btn btn-primary" href ="{{route('shop.index')}}" role="button">ラーメン屋さん一覧ページへ</a>
        </div>
    </div>
</div>
@endsection
