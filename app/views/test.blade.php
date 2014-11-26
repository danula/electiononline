<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Test</h2>

		<div>
			@foreach($districts as $d)
			<p>{{$d->name}}</p>
			@endforeach
		</div>
	</body>
</html>