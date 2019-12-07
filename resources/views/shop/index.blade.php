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
               味:
               @php old('sort1') @endphp
               <select name="sort1">
					<option value="指定なし" @if(old('sort1')=='指定なし') selected  @endif>指定なし</option>
                  @foreach ($tags as $tag)
                     <option value="{{$tag->id}}" @if(old('sort1')=='{{$tag->id}}') selected @endif>{{$tag->name}}</option>
                  @endforeach
                
               </select>

               並び替え:
               <select name ="sort2">
                  <option value="指定なし" @if(old('sort2')=='指定なし') selected  @endif>指定なし</option>
                  <option value="likeDesc" @if(old('sort2')=='likeDesc') selected  @endif>いいね順</option>
                  <option value="dateDesc" @if(old('sort2')=='dateDesc') selected  @endif>お店更新順</option>
               </select>
				</div>


				<button type="submit" class="btn btn-primary">検索</button>
			</form>
         @if (count($shops) >= 1)
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
                  <small>@foreach ($shop->tags as $tag) # {{$tag->name}} @endforeach </small>
                  <p>{{$shop->point}}</p>
                  <small>{{$shop->station1}}</small>
               </li>
            @endforeach
         @else
            <p>残念ですが、条件に合うお店がありませんでした</p>
         @endif
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
