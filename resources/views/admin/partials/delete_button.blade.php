@if ($permissions->pluck('name')->contains($name))
@if (Auth::user()->role->permissions->pluck('name')->contains($name))
@php $actionPermission = json_decode(Auth::user()->role->permissions->where('name', $name)->first()->pivot->action_pivot) @endphp
@if (in_array($action, $actionPermission))
<form action="admin/{{$route}}/{{$id}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('permission')">
@csrf
@method('DELETE') 
<button type="submit" class="btn btn-danger btn-lg"><i class="ace-icon fa fa-trash"></i></button>
</form>
@endif
@endif
@else 
<form action="admin/{{$route}}/{{$id}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('permission')">
@csrf
@method('DELETE') 
<button type="submit" class="btn btn-danger btn-lg"><i class="ace-icon fa fa-trash"></i></button>
</form>
@endif