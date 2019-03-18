<td>
    <a href="{{route('users.show', $id)}}" class="btn btn-info btn-sm">@lang('master.content.action.detail')</a>
    <a href="{{route('users.edit', $id)}}" class="btn btn-warning btn-sm">@lang('master.content.action.edit', ['attribute' => trans('master.content.attribute.User')])</a>
    <form action="{{route('users.destroy', $id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('user')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">@lang('master.content.action.delete', ['attribute' => trans('master.content.attribute.User')])</button>
    </form>
</td>