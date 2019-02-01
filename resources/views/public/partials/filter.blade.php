@foreach(config('constants.filter') as $key => $define)
<li class="dropdown">
   <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$key}}<span class="caret"></span></a>
   
    <ul class="dropdown-menu filter-dropdown" 
    @php if ($key == trans('public.filter.price')) {
            echo 'id=filter-price';
        } elseif ($key == trans('public.filter.sort')) {
            echo 'id=sort-by';
        }
    @endphp 
    role="menu">
        @php $id = $parentAccessories->pluck('id','name'); @endphp
        @foreach($define as $query => $val)
        @if($parentAccessories->contains('name', $key))
        <li><a href="{{route('product.filter', ['query' => $query, 'val' => $val, 'parentId' => $id[$key]])}}">{{$val}}</a></li>
        @elseif($key == trans('public.filter.sort'))
        <li><a href="{{route('product.sort', ['query' => $query, 'val' => $val])}}">{{$val}}</a></li>
        @else
        <li><a href="{{route('product.filter', ['query' => $query, 'val' => $val])}}">{{$val}}</a></li>
        @endif
        @endforeach
    </ul>
</li>
@endforeach
