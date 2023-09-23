<x-mail::message>
# Introduction

{{ __('Hi ') }}
{{ $comment->name }}

{{ 'Roberto Manna' }} {{ __(' replied to your comment on a recipe') }}

{{-- <x-mail::button :url="''"> --}}
<x-mail::button :url="'http://localhost/recipes/' . $post->slug . '#reply-comment-form-' . $comment->id">
    {{ __('Look at Roberto\'s response') }}
</x-mail::button>

{{ __('You recieved this email because the author ') }}

{{ __('If you didn\'t write the comment at Dinner with Roberto site, ignore this email.') }}



{{ __('Kind regards') }},<br>
{{ config('app.name') }}
</x-mail::message>
