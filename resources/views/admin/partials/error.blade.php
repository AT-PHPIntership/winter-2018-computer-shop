@if ($errors->has($err))
<span class="help-block col-sm-9">
    <strong class="col-xs-10 col-sm-5 text-danger">{{$errors->first($err)}}</strong>
</span>
@endif
