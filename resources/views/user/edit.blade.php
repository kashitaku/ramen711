@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">ユーザー情報編集</div>
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
								<tr><th>imege</th>
								<td><div class="detail_user">
									@if ($user->image_url == null)
										<img src ="../../storage/shop_images/no_image_user.jpg">
									@else
										<img src ="../../{{$user->image_url}}">
									@endif
								</div></td></tr>
								<tr><th></th><td><input type="file" name="image_url"></td><tr>
								<tr><th>name:</th><td>{{ $user->name }}</td></tr>
								<tr><th>email:</th><td>{{ $user->email }}</td></tr>
								<tr><th>comment:</th><td><input type="text" name="comment" value="{{ old('comment', $user->comment )}}"></td></tr>
								<tr><th></th><td><button type="submit" class="btn btn-primary">更新</button></td></tr>
							</table>
							</form>
					</div>
				</div>
			</div>
		</div>
        <div class="col-md-8 col-md-offset-2">
			<div>
				<a class="move_page btn btn-primary" href ="{{route('shop.index')}}" role="button">一覧ページへ</a>
			</div>
		</div>
	</div>
</div>
@endsection
