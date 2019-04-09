@if ($permissions->pluck('name')->contains($name))
@if (Auth::user()->role->permissions->pluck('name')->contains($name))
@php $actionPermission = json_decode(Auth::user()->role->permissions->where('name', $name)->first()->pivot->action_pivot) @endphp
@if (in_array($action, $actionPermission))
<button type="button" class="btn btn-warning btn-lg">
    <a href="admin/{{$route}}/{{$id}}/edit"><i class="ace-icon fa fa-edit"></i></a>
</button>
@endif
@endif
@else
<button type="button" class="btn btn-warning btn-lg">
    <a href="admin/{{$route}}/{{$id}}/edit"><i class="ace-icon fa fa-edit"></i></a>
</button>
@endif