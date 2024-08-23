@props(["route"=>"#", "icon"=>"", "title"=>"", "type"=>"", "position"=>"first"])
@if($position == 'first')
    <a href="{{ $route }}" class="breadcrumb-item relative hover:text-primary">{{ $slot }}</a>
@elseif($position == 'middle')
    <a href="{{ $route }}" class="breadcrumb-item relative hover:text-primary">{{ $slot }}</a>
@elseif($position == 'last')
    <span class="breadcrumb-item relative">{{ $slot }}</span>
@else
    <span class="breadcrumb-item relative">{{ $slot }}</span>
@endif
