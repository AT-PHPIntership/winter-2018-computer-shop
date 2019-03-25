
@foreach($parentAccessories as $parentAccessory)
<li class="dropdown">
    @if($parentAccessory->name != 'GPU')
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$parentAccessory->name}}<span class="caret"></span></a>
   @endif
    @if($parentAccessory->name == 'CPU')
    <ul class="dropdown-menu filter-dropdown cpu" role="menu">
    @elseif($parentAccessory->name == 'HDD')
    <ul class="dropdown-menu filter-dropdown hdd" role="menu">
    @else 
    <ul class="dropdown-menu filter-dropdown" role="menu">
    @endif
        @foreach($accessories as $childrenAccessory)
            @if($childrenAccessory->parent_id ==  $parentAccessory->id)
                <li><a class='filter-product' data-query={{$childrenAccessory->id}} data-type={{$parentAccessory->name}}>{{$childrenAccessory->name}}</a></li>
            @endif
        @endforeach
    </ul>
</li>
@endforeach
@foreach(config('constants.filter') as $key => $define)
<li class="dropdown">
   <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$key}}<span class="caret"></span></a>
   
    <ul class="dropdown-menu filter-dropdown" 
    @php 
        if ($key == trans('public.filter.price')) {
            echo 'id=filter-price';
        } elseif ($key == trans('public.filter.sort')) {
            echo 'id=sort-by';
        }
    @endphp 
    role="menu">
        @foreach($define as $query => $val)
            @if($key == trans('public.filter.sort'))
                <li><a class='filter-product' data-query={{$query}} data-type={{$key}}>{{$val}}</a></li>
            @else
                <li><a class='filter-product' data-query={{$query}} data-type={{$key}}>{{$val}}</a></li>
            @endif
        @endforeach
    </ul>
</li>
@endforeach
