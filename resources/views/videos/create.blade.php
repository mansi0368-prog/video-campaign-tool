<x-app-layout>
    <x-slot name="header">Upload Video</x-slot>
    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Title</label>
            <input type="text" name="title" required>
        </div>
        <div>
            <label>Video File</label>
            <input type="file" name="video" accept="video/*" required>
        </div>
        <button type="submit">Upload</button>
    </form>
</x-app-layout>
