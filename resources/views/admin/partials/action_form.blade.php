@if ($permissions->pluck('name')->contains($name))
@foreach ($permissions->where('name', $name)->first()->roles as $role)
@if ($role->id == Auth::user()->role->id)
@if (in_array($edit, json_decode($role->pivot->action_pivot)) || in_array($delete, json_decode($role->pivot->action_pivot)) )
@can($name)
<th>@lang('master.content.table.action')</th>
@endcan
@endif
@endif
@endforeach
@else
<th>@lang('master.content.table.action')</th>
@endif