@extends('layouts.app_admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">追加</div>
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
							<table border=l>
								{{ csrf_field() }}
								<tr><th>name:</th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
								<tr><th>point:</th><td><input type="text" name="point" value="{{old('point')}}"></td></tr>
								<tr><th>station1:</th><td><input type="text" name="station1" value="{{old('station1')}}"></td></tr>
								<tr><th>type1:</th><td><input type="text" name="type1" value="{{old('type1')}}"></td></tr>
								<tr><th>URL:</th><td><input type="text" name="URL" value="{{old('URL')}}"></td></tr>
							</table>
							image:<input type="file" name="image_url">
							<button type="submit" class="btn btn-primary">登録</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div>
			<a class="move_page btn btn-primary" href ="{{route('admin.index')}}" role="button">一覧ページへ</a>
		</div>
	</div>
</div>
@endsection
