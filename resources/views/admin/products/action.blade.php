<td>
    <a href="{{route('products.show', $id)}}" class="btn btn-info btn-sm">@lang('master.content.action.detail')</a>
    <a href="{{route('products.edit', $id)}}" class="btn btn-warning btn-sm">@lang('master.content.action.edit', ['attribute' => trans('master.content.attribute.Product')])</a>
    <form action="{{route('products.destroy', $id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete()">
        @csrf
        @method('DELETE')	                      
        <button type="submit" class="btn btn-danger btn-sm">@lang('master.content.action.delete', ['attribute' => trans('master.content.attribute.Product')])</button>
    </form>
</td>