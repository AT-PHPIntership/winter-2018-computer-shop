<td>
	<a href="" class="btn btn-info btn-sm">@lang('master.content.action.detail')</a>
	<a href="{{route('categories.edit', $id)}}" class="btn btn-warning btn-sm">@lang('master.content.action.edit', ['attribute' => trans('master.content.attribute.Category')])</a>
	<form action="{{route('categories.destroy', $id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete()">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">@lang('master.content.action.delete', ['attribute' => trans('master.content.attribute.Category')])</button>
    </form>
</td>