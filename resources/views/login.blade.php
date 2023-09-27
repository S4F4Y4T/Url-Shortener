
@include('inc/header')

<div class="container mx-auto">
    <section class="content">
        <div class="flex justify-center items-center py-20">
            <form class="flex flex-col gap-3 bg-blue-100 p-20" method="post" action="{{ route('login') }}">
                @csrf
                @if(session('success'))
                    <div class="text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('login'))
                    <div class="text-red-500">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <input type="email" name="email" placeholder="Place your email here" class="p-3 rounded-md border-2 border-grey-400" value="{{ old('email') }}" />
                @error('email')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <input type="password" name="password" placeholder="Place your password here" class="p-3 rounded-md border-2 border-grey-400" />
                @error('password')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
                <!-- Remember Me Checkbox -->
                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember" class="p-3 rounded-md border-2 border-grey-400" {{ old('remember') ? 'checked' : '' }}>
                    <label class="cursor-pointer" for="remember">Remember Me</label>
                </div>
                <input type="submit" value="Login" class="p-3 rounded-md m-3 bg-blue-400 text-white cursor-pointer">
            </form>
        </div>
    </section>
</div>
</body>
</html>
