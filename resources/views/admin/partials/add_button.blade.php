@if ($permissions->pluck('name')->contains($name))
@if (Auth::user()->role->permissions->pluck('name')->contains($name))
@php $actionPermission = json_decode(Auth::user()->role->permissions->where('name', $name)->first()->pivot->action_pivot) @endphp
@if (in_array($action, $actionPermission))
<a href="admin/{{$route}}/create">
    <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => $title])</button>
</a>
@endif
@endif
@else
<a href="admin/{{$route}}/create">
    <button type="button" class="btn btn-primary">@lang('master.content.action.add', ['attribute' => $title])</button>
</a>
@endif