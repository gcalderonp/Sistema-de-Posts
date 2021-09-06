@props(['post'])

<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">
    @if ($post->image)
        <img class="w-full h-72 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="">
    @else
        <img class="w-full h-72 object-cover object-center" src="https://cdn.pixabay.com/photo/2021/06/20/08/35/ginkgo-6350293__340.jpg" alt="">
    @endif
    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a  href="{{route('post.show', $post)}}">{{$post->name}}</a>
        </h1>
        <div class="text-gray-700 text-base">
            {{-- al usar ck editor al mostrar laravel lo inserta como texto, para que utilice las etiquetas html se debe iniciar y cerrar con signos de exclamacion  --}}
            {!!$post->extract!!}
        </div>
    </div>
    <div class="px-6 pt4 pb-2">
        @foreach ($post->tags as $tag)
            <a class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700 mr-2" href="{{route('post.tag', $tag)}}">{{$tag->name}}</a>
        @endforeach
    </div>
</article>