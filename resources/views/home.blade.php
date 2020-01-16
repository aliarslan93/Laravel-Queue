<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{{ asset ('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset ('css/style.css') }}" rel="stylesheet">

</head>
<body>
	<div class="row main-container">
		<div class="col-sm-6">
			<form method="POST" action="{{ route('get-images') }}">
				{{ csrf_field() }}
				<div class="row form-screen">


					<div class="col-sm-6">

						<div class="form-group">

							<label>From</label>
							<input type="date" name="start_date" id="start_date" class="form-control" @if(isset($start_date)) value="{{$start_date}}" @endif>	
							<button class="btn btn-sm btn-warning flush-btn" name="submitButton" value="flush" type="submit">FLUSH</button>			
						</div>
					</div>
					<div class="col-sm-6">
						
						<div class="form-group">

							<label>To</label>
							<input type="date" name="end_date" id="end_date" class="form-control"@if(isset($end_date)) value="{{$end_date}}" @endif>
							<button class="btn btn-sm import-btn"  name="submitButton" value="import" onclick="GetCellValues()">IMPORT</button>			
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="col-sm-6">
			<table class="table table-bordered" id="mytable">
				<thead>
					<tr>
						<th scope="col">From-To-id</th>
						<th scope="col">Day</th>
						<th scope="col">Status</th>

					</tr>
				</thead>
				<tbody>
					@if(isset($images))
					@foreach($images as $image)
					<tr>
						<td scope="row">{{$image->source_id}}</td>
						<td>{{ ((strtotime($image->earth_date)-strtotime(@$start_date))/86400)+1 }}</td>
						<td>
							@if(@App\Image::getStatus($image->img_src)->img_src)
							<span class="btn-success">Imported</span>
							@else
							<span class="btn-warning">Waiting</span>
							@endif
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td>Empty</td>
						<td>Empty</td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>


		</div>

	</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>

	</html>