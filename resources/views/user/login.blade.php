@include('partials.__header')
	<div id="particles-js"></div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form"  action="/login/process" method="POST">
					@csrf
					<span class="login100-form-title">
						TSG Member Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" id="email" value={{old('email')}}>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden=""></i>
						</span>
						
					</div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    	@enderror

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" id="password" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						
					</div>
					@error('password')
                        <p class="text-red-500 text-xs mt-2 italic p-1">{{ $message }}</p>
                    	@enderror
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
					

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-136">
						<a class="txt2" href="/register">
							Create Member Registration
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