<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
	
<div class="container">
	<div class="row">

		<?php if (session('message')): ?>
        <div class="col-lg-12">
            <div class="alert alert-{{session('class')}} alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <div class="alert-icon contrast-alert"><i class="icon-close"></i></div>
              <div class="alert-message"><span>{{session('message')}}</span></div>
            </div>
        </div>
        <?php endif; ?>
        
		<div class="col-md-3"></div>
		<div class="col-md-6 py-4">
			
			<div class="card">
				<div class="card-header">
					<h2 class="bt-dark text-center">Admin Registration</h2>
				</div>
				<div class="card-body">
					<form action="{{url('ragisterloginaction')}}" method="post">
              @csrf
				<div class="form-group">
				<input type="text" name="name" class="form-control" placeholder="Enter your name">
			</div>
			<br>
			<div class="form-group">
				<input type="email" name="email" class="form-control" placeholder="Enter your email">
			</div>
			<br><br>
			<div class="form-group">
				<input type="text" name="address" class="form-control" placeholder="Enter your Address">
			</div><br>
			<div class="form-group">
				<input type="password" name="password" class="form-control" placeholder="Enter your Password">
			</div>
          <br>
            <div class="form-group">
				<input type="password" name="c_password" class="form-control" placeholder="Enter your confirm Password">
			</div>
          <br>
			<div class="form-group">
				<button type="submit" class="btn btn-danger btn-sm form-control"> SUbmit</button>
			</div>
				
			</form>
				</div>
			</div>
			

		</div>
		<div class="col-md-3"></div>
	</div>
</div>

</body>
</html>