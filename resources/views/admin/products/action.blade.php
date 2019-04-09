<td>
    @include('admin.partials.detail_button', ['route' => trans('master.content.attribute.product'), 'id' => $id])
    @include('admin.partials.edit_button', ['name' => config('constants.permissions.5'), 'action' => config('constants.permission-actions.2'), 'route' => trans('master.content.attribute.product'), 'id' => $id])
    @include('admin.partials.delete_button', ['name' => config('constants.permissions.5'), 'action' => config('constants.permission-actions.3'), 'route' => trans('master.content.attribute.product'), 'id' => $id])
</td>