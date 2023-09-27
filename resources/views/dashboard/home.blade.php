
@include('../inc/header')

<section class="container mx-auto text-center flex justify-center items-center my-5">
    <h1 class="text-4xl font-bold m-5">Welcome {{Auth::user()->name}}</h1>
</section>
</body>
</html>
