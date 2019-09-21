@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">編集</div>
					<div class="panel-body">
							@if (count($errors) >0 )
							<div>
								<ul>
									@foreach ($errors->all() as $error)
									<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
							@endif
							<form action="" method="post" enctype="multipart/form-data">
							<table>
								{{ csrf_field() }}
								<input type="hidden" name="id" value="{{$shop->id}}">
								@if ($shop->image_url == null)
								<tr><th>imege</th><td><div class="detail"><img src ="../../../storage/shop_images/no_image.png"></div></td></tr>
								@else
								<tr><th>imege</th><td><div class="detail"><img src ="../../../{{$shop->image_url}}"></div></td></tr>
								@endif
								<tr><th></th><td><input type="file" name="image_url"></td><tr>
								<tr><th>name:</th><td><input type="text" name="name" value="{{$shop->name}}"></td></tr>
								<tr><th>point:</th><td><input type="text" name="point" value="{{$shop->point}}"></td></tr>
								<tr><th>station1:</th><td><input type="text" name="station1" value="{{$shop->station1}}"></td></tr>
								<tr><th>type1:</th><td><input type="text" name="type1" value="{{$shop->type1}}"></td></tr>
								<tr><th>URL:</th><td><input type="text" name="URL" value="{{$shop->URL}}"></td></tr>
								<tr><th></th><td><button type="submit" class="btn btn-primary">更新</button></td></tr>
							</table>
							</form>
					</div>
				</div>
			</div>
		</div>
        <div class="col-md-8 col-md-offset-2">
			<div>
				<a class="move_page btn btn-primary" href ="{{route('admin.index')}}" role="button">一覧ページへ</a>
			</div>
		</div>
	</div>
</div>
@endsection
