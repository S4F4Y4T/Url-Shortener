
@include('inc/header')

<div class="container mx-auto">
    <section class="content">
        <div class="flex justify-center items-center py-20">
            <form class="flex flex-col gap-3 bg-blue-100 p-20" method="POST" action="{{ route('registration') }}">
                @csrf
                <input type="text" name="name" placeholder="Place your name here" class="p-3 rounded-md border-2 border-grey-400" />
                @error('name')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="email" name="email" placeholder="Place your email here" class="p-3 rounded-md border-2 border-grey-400" />
                @error('email')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="password" name="password" placeholder="Place your password here" class="p-3 rounded-md border-2 border-grey-400" />
                @error('password')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="submit" value="Registration" class="p-3 rounded-md m-3 bg-blue-400 text-white cursor-pointer">
            </form>
        </div>
    </section>
</div>
</body>
</html>
