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
				<table border=l>
					<tr>
					<th>name</th>
					<th>edit</th>
					<th>station</th>
					<th>point</th>
					<th>likes_count</th>
					</tr>
					@foreach ($shops as $shop)
					<tr>
					<td><a href ="{{route('admin.shop.detail', [$shop->id])}}">{{$shop->name}}</td>
					<td>
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
					</td>
					<td>{{$shop->station1}}</td>
					<td>{{$shop->point}}</td>
					<td>{{$shop->likes_count}}</td>
					</tr>
						@endforeach
					</table>
				</div>
			</div>
		<div>
			<a class="move_page btn btn-primary" href ="{{route('admin.shop.add')}}" role="button">新規店舗登録</a>
		</div>
	</div>
</div>
@endsection