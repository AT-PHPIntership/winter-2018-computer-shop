<td>
    <a href="{{route('products.show', $id)}}" class="btn btn-info btn-sm">@lang('master.content.action.product.details')</a>
    <a href="{{route('products.edit', $id)}}" class="btn btn-warning btn-sm">@lang('master.content.action.product.edit')</a>
    <form action="{{route('products.destroy', $id)}}" method="POST" class="d-inline" onsubmit="return confirmedDelete('product')">
        @csrf
        @method('DELETE')	                      
        <button type="submit" class="btn btn-danger btn-sm">@lang('master.content.action.product.delete')</button>
    </form>
</td>