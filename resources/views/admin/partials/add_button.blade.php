@if ($permissions->pluck('name')->contains($name))
@foreach ($permissions->where('name', $name)->first()->roles as $role)
@if ($role->id == Auth::user()->role->id)
@if (in_array($action, json_decode($role->pivot->action_pivot)))
@can($name)
<a href="admin/{{$route}}/create">
    <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'Permission'])</button>
</a>
@endcan
@endif
@endif
@endforeach
@else
<a href="admin/{{$route}}/create">
    <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => 'Permission'])</button>
</a>
@endif