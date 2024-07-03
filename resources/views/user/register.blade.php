@include('partials.__header')

	<div id="particles-js"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="/store" method="POST">
					@csrf
					<span class="login100-form-title">
						Member Registration
					</span>

					<div class="wrap-input100 validate-input" data-validate="First name is required">
						<input class="input100" type="text" name="first_name"  id="first_name" placeholder="First Name" value={{old('first_name')}}>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
					@error('first_name')
                            <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                        @enderror

					<div class="wrap-input100 validate-input" data-validate="Last name is required">
						<input class="input100" type="text" name="last_name" id="last_name" placeholder="Last Name" value="{{old('last_name')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
						@error('last_name')
						<p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
					@enderror
					</div>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" value="{{old('email')}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden=""></i>
						</span>
					</div>
					@error('email')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror
					
				<div class="wrap-input100 validate-input" data-validate = "Valid phone_number is required: ex@abc.xyz">
					<input class="input100" type="text" name="phone_number" placeholder="Phone Number" value="{{old('phone_number')}}">
					<span class="focus-input100"></span>
					<span class="symbol-input100">
						<i class="fa fa-envelope" aria-hidden=""></i>
					</span>
				</div>
				@error('phone_number')
				<p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
			@enderror


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					@error('password')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror
					
					<div class="wrap-input100 validate-input" data-validate="Confirm password is required">
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password" id="password_confirmation">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					@error('password_confirmation')
                    <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                @enderror

					<div class="spacer"></div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Register
						</button>
					</div>
					
					<div class="text-center p-t-20">
						<a class="txt2" href="/login">
							Already have an account? Login
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

@include('partials.__footer')
