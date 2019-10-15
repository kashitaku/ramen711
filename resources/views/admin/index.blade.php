@extends('layouts.app_admin')

@section('script')
	<script>
	$(function() {
		$(".btn-dell").click(function() {
			if(confirm("本当に削除しますか？")) {
			} else {
				return false;
			}
		});
	});
	</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">店舗一覧</div>
			<div class="panel-body">
			<form class="form_serch form-inline" action="{{route('admin.index')}}">
				<input type="text" name="keyword" value="{{$keyword}}" placeholder="店名を入力">
				<input type="text" name="keyword_station" value="{{$keyword_station}}" placeholder="駅名を入力">
				<div>
					<input class="checkbox" type="checkbox" name="sort" value="likeDesc" @if ($sort==="likeDesc") checked @endif><label for="likeDesc">いいね順</label>
				</div>
				<button type="submit" class="btn btn-primary">検索</button>
			</form>
				<table border=l>
					<tr>
					<th>editor</th>
					<th>name</th>
					<th>edit</th>
					<th>station</th>
					<th>point</th>
					<th>likes</th>
					</tr>
					@foreach ($shops as $shop)
					<tr>
					<td>{{$shop->admin->name}}</td>
					<td><a href ="{{route('admin.shop.detail', [$shop->id])}}">{{$shop->name}}</td>
					<td>
						@if ($shop->admin_id === Auth::user()->id)
							<div class="edit_delete">
								<form action ="{{route('admin.shop.edit', [$shop->id])}}" method="get">
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary btn-sm">編集</button>
								</form>
								<form action ="{{route('admin.shop.delete', [$shop->id])}}" method="post">
									{{ csrf_field() }}
									<button type="submit" class="btn btn-warning btn-sm btn-dell">削除</button>
								</form>
							</div>
						@endif
					</td>
					<td>{{$shop->station1}}</td>
					<td>{{$shop->point}}</td>
					<td>{{$shop->likes_count}}</td>
					</tr>
					@endforeach
				</table>
				{{ $shops->links() }}
			</div>
			</div>
		<div>
			<a class="move_page btn btn-primary" href ="{{route('admin.shop.add')}}" role="button">新規店舗登録</a>
		</div>
	</div>
</div>
@endsection
