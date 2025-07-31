<x-app-layout>
    <x-slot name="header">Your Videos</x-slot>
    <a href="{{ route('videos.create') }}">Upload New</a>
    <ul>
        @foreach($videos as $video)
            <li>
                {{ $video->title }} - {{ $video->status }}
            </li>
        @endforeach
    </ul>
</x-app-layout>
