<x-layout>
@include('partials._hero')
@include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
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
                <x-listing-card :listing='$listing' />
            @endforeach
        @else
            <p>No lising found</p>
        @endunless

    </div>

</x-layout>