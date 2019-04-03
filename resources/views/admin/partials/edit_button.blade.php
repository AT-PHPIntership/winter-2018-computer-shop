@if ($permissions->pluck('name')->contains($name))
@foreach ($permissions->where('name', $name)->first()->roles as $role)
@if ($role->id == Auth::user()->role->id)
@if (in_array($action, json_decode($role->pivot->action_pivot)))
@can($name)
<button type="button" class="btn btn-warning btn-lg">
    <a href="admin/{{$route}}/{{$id}}/edit"><i class="ace-icon fa fa-edit"></i></a>
</button>
@endcan
@endif
@endif
@endforeach
@else
<button type="button" class="btn btn-warning btn-lg">
    <a href="admin/{{$route}}/{{$id}}/edit"><i class="ace-icon fa fa-edit"></i></a>
</button>
@endif