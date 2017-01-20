<!--Welcome Back~-->
<p>
    {{ $greeting }} {{ $name or '' }}. Welcome Back~
</p>


{{-- foreach --}}
<ul>
    @foreach($items as $item)
        <li>{{ $item }}</li>
    @endforeach
</ul>

{{-- if else --}}
@if($itemCount = count($items))
        <p>There are {{ $itemCount }} items !</p>
@else
        <p>There is no item !</p>
@endif


{{-- for else --}}
@forelse($items as $item)
        <p>The item is {{ $item }}</p>
@empty
        <p>There is no item !</p>
@endforelse