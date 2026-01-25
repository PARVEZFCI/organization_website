@include('frontend.header');

<div class="container">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					
				</div>
				<div class="card-body">

                     <form method="POST" action="{{url('storeUser')}}">
                     	@csrf
                       <div class="form-group">
                       	 
                       	 <label for="">Name</label>
                       	 <input type="text" name="name" placeholder="Enter your name" class="form-control">

                       </div>
                       <div class="form-group">
                       	 
                       	 <label for="">Email</label>
                       	 <input type="email" name="email" placeholder="Enter your name" class="form-control">

                       </div>
                       <div class="form-group">
                       	 
                       	 <label for="">User Name</label>
                       	 <input type="text" name="username" placeholder="Enter your name" class="form-control">

                       </div>
                       <div class="form-group">
                       	 
                       	 <label for="">Number</label>
                       	 <input type="number" name="number" placeholder="Enter your user name" class="form-control">

                       </div>

                       <div class="form-group">
                       	 
                       	 <label for="">Address</label>
                       	 <input type="text" name="address" placeholder="Enter your name" class="form-control">

                       </div>

                       <div class="form-group">
                         
                         <label for="">Password</label>
                         <input type="password" name="password" placeholder="Enter your password" class="form-control">

                       </div>

                       <div class="form-group">
                         
                         <label for="">Confirm Password</label>
                         <input type="password" name="c_password" placeholder="Enter your Confirm password" class="form-control">

                       </div>

                       <div class="form-group">
                         
                         <button type="submit">SUbmit</button>

                       </div>

                     </form>
					
				</div>
				<div class="card-footer">
					
				</div>
			</div>
		</div>
	
	</div>
</div>

@include('frontend.footer')