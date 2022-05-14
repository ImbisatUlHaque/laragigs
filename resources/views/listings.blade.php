<h1>{{ $heading }}</h1>

{{-- Using "IF" condition for no listing available --}}
{{-- @if(count($listings) == 0)
    <p>No lising found</p>
@else
    @foreach($listings as $listing)
    <h2>
        {{$listing['title']; }}
    </h2>
    <p> 
        {{$listing['description']; }}
    </p>
    @endforeach;
@endif --}}

{{-- Using "UNLESS" condition for no listing available --}}

@unless (count($listings) == 0)
    
    @foreach($listings as $listing)
    <h2>
        <a href="/listing/{{$listing['id']}}">{{$listing['title'] }}</a>
    </h2>
    <p> 
        {{$listing['description'] }}
    </p>
    @endforeach
@else
    <p>No lising found</p>
@endunless

