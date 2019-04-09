@if ($permissions->pluck('name')->contains($name))
@if (Auth::user()->role->permissions->pluck('name')->contains($name))
@php $actionPermission = json_decode(Auth::user()->role->permissions->where('name', $name)->first()->pivot->action_pivot) @endphp
@if (in_array($edit, $actionPermission) || in_array($delete, $actionPermission))
<th>@lang('master.content.table.action')</th>
@endif
@endif
@else
<th>@lang('master.content.table.action')</th>
@endif