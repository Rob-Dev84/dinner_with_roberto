{{-- Meta recipe robots --}}
@section('article_published')
{{-- in the published==true, next to 'follow,index' consider also placing:  
            max-image-preview:large, max-snippet:-1, max-video-preview:-1'  --}}
    {{ ($post->published ? 'follow,index' : 'noindex') }}
@endsection

{{-- Meta recipe title --}}
@section('article_meta_title')
    {{ $post->title }}
@endsection

{{-- Meta recipe description --}}
@section('article_meta_description')
    {{ $post->meta_description }}
@endsection

{{-- Meta url --}}
@section('article_meta_url')
    {{ url('/recipes/'.$post->slug) }}
@endsection

{{-- Meta site name --}}
@section('meta_site_name')
    {{ 'Dinner With Roberto' }}
@endsection

{{-- Meta published time --}}
@section('article_meta_published_time')
    {{ $metaPublishedTime }}
@endsection

{{-- Meta updated time --}}
@section('article_meta_modified_time')
    {{ $metaUpdatedTime }}
@endsection

{{-- Meta image --}}
@section('article_meta_image')
    {{ url('/'.$post->postImages->first()->path) }}
@endsection

{{-- //TODO: use intervention/image libray to autodetect image size stored in the post_images; 
                the values refear to the most representive image of the recipe --}}
{{-- Meta image width --}}
@section('meta_image_width')
    {{ '2400' }}
    {{-- {{ url('/'.$post->postImages->first()->width) }} --}}
@endsection

{{-- Meta image height --}}
@section('meta_image_height')
    {{ '1200' }}
    {{-- {{ url('/'.$post->postImages->first()->height) }} --}}
@endsection

{{-- Meta canonical --}}
@section('article_meta_canonical')
    {{ url('/recipes/'.$post->slug) }}
@endsection

{{-- JSON-LD --}}
@section('jsonld')
    <script type="application/ld+json">
        {!! $jsonLd !!}
    </script>
@endsection