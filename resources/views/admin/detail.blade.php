@extends('layouts.app_admin')

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

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">店舗詳細</div>
					<div class="panel-body">
						<ul>
							<div class="detail">
								@if($shop->image_url == null)
									<img src="../../../storage/shop_images/no_image.png">
								@else
									<img src="../../../{{$shop->image_url}}">
								@endif
							</div>
							<div>
								<p>name:{{$shop->name}}</p>
								<p>point:{{$shop->point}}</p>
								<p>likes_count:{{$shop->likes_count}}</p>
								<form action ="{{route('admin.shop.edit', [$shop->id])}}" method="get">
									{{ csrf_field() }}
									<button type="submit" class="btn btn-primary btn-sm">編集</button>
								</form>
								<form action ="{{route('admin.shop.delete', [$shop->id])}}" method="post">
									{{ csrf_field() }}
									<button type="submit" class="btn btn-warning btn-sm btn-dell">削除</button>
								</form>
							</div>
						</ul>
					</div>
            </div>
		</div>
        <div class="col-md-8 col-md-offset-2">
			<div>
				<a class="move_page btn btn-primary" href ="{{route('admin.shop.add')}}" role="button">新規店舗登録</a>
				<a class="move_page btn btn-primary" href ="{{route('admin.index')}}" role="button">一覧ページへ</a>
			</div>
		</div>
	</div>
</div>
@endsection
