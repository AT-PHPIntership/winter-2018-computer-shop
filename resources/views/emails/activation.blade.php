<!DOCTYPE html>
<html>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div style="text-align: center;">
	                <h2>@lang('public.email.welcome'), {{ $name }}</h2>
	                <div>
	                	<p>@lang('public.email.click')</p>
	                	<button style="background-color: #008CBA;padding: 15px 32px;text-align: center;display: inline-block;font-size: 16px;border-radius: 12px;"><a href="{{ url('activation', $link)}}" style="text-decoration: none;color: white; ">@lang('public.email.verify')</a></button>
	                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>