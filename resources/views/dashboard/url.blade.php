
@include('../inc/header')

<div class="container mx-auto">
    <section class="content">
        <div class="flex justify-center flex-col items-center py-20">
            <form class="flex flex-row gap-3 bg-blue-100 p-20" method="post" action="{{ route('shortend') }}">
                @csrf

                <div>
                    @if(session('success'))
                        <div class="text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                    <textarea type="text" name="long_url" placeholder="Place your long url here" class="p-3 rounded-md border-2 border-grey-400">{{ old('long_url') }}</textarea>
                    @error('long_url')
                    <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <input type="submit" value="Shortend" class="p-3 rounded-md m-3 bg-blue-400 text-white cursor-pointer">
            </form>
        </div>

        <div class="my-20 bg-blue-100 text-center py-8 px-20 rounded-md">
            <h1 class="text-4xl mb-8 font-bold">Your Short URLs</h1>
            <table class="table w-full">
                <thead>
                <tr class="text-left">
                    <th>Short URL</th>
                    <th>Long URL</th>
                    <th class="text-center">Visit Count</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($shortUrls as $shortUrl)
                    <tr class="m-3 p-8 leading-10">
                        <td class="text-left">{{ url('').'/v/'.$shortUrl->short_url }}</td>
                        <td class="text-left">@if (strlen($shortUrl->long_url) > 50)
                                {{ substr($shortUrl->long_url, 0, 50) }}...
                            @else
                                {{ $shortUrl->long_url }}
                            @endif</td>
                        <td class="text-center">{{ $shortUrl->count }}</td>
                        <td>
                            <a class="p-2 rounded-md bg-blue-400 text-white cursor-pointer" href="{{ route('short_url.redirect', $shortUrl->short_url) }}" target="_blank">Visit</a>
                            <a class="p-2 rounded-md text-sm bg-red-400 text-white cursor-pointer" href="{{ route('short_url.delete', $shortUrl->id) }}">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
</body>
</html>
