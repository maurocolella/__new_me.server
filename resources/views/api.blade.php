<!doctype html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Api</title>

		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

		<!-- Styles -->
		<style>
			html, body {
				background-color: #fff;
				color: #333b3f;
				font-family: 'Raleway', sans-serif;
				font-size: 90%;
				font-weight: 100;
				margin: 0;
			}

			main {
				padding: 10px 20px;
			}

			table {
				border: 1px solid #939b9f;
				border-collapse: collapse;
				table-layout: auto;
				width: 100%;
			}

			tr:nth-child(even) {
				background-color: #eeefef;
			}

			th {
				background-color: #c3cbcf;
				padding: 10px;
			}

			td {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<main>
			<h1>Api</h1>

			<table>
				<thead>
					<tr>
						<th>
							Route
						</th>
						<th>
							Methods
						</th>
						<th>
							Action
						</th>
						<th>
							Arguments
						</th>
						<th>
							Description
						</th>
					</tr>
				</thead>
				<tbody>
				@foreach($routes as $key => $route)
					<tr>
						<td>
							<strong>
								{{ $route->uri }}
							</strong>
						</td>
						<td>
							<ul>
							@foreach($route->methods as $method)
								<li>
									<strong>
										{{ $method }}
									</strong>
								</li>
							@endforeach
							</ul>
						</td>
						<td>
							{{ $route->action }}
						</td>
						<td>
							<ul>
							@foreach($route->parameters as $parameter)
								<li>
									<strong>
										{{ $parameter->name }} ({{ $parameter->getType() }})
									</strong>
								</li>
							@endforeach
							</ul>
						</td>
						<td>
							<code>
								{{ $route->description }}
							</code>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>

			<pre class="debug">
			</pre>
		</main>
	</body>
</html>
