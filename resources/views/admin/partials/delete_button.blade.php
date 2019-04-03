@if ($permissions->pluck('name')->contains($name))
@foreach ($permissions->where('name', $name)->first()->roles as $role)
@if ($role->id == Auth::user()->role->id)
@if (in_array($action, json_decode($role->pivot->action_pivot)))
@can($name)
<form action="admin/{{$route}}/{{$id}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('permission')">
@csrf
@method('DELETE') 
<button type="submit" class="btn btn-danger btn-lg"><i class="ace-icon fa fa-trash"></i></button>
</form>
@endcan
@endif
@endif
@endforeach
@else 
<form action="admin/{{$route}}/{{$id}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('permission')">
@csrf
@method('DELETE') 
<button type="submit" class="btn btn-danger btn-lg"><i class="ace-icon fa fa-trash"></i></button>
</form>
@endif