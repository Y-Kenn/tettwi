<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('誹謗中傷ツイート登録') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('pages.mypage.my-tweets.partials.store-slander-tweet-url-form')
                </div>
            </div>
        </div>
    </div>
    @if(session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif
{{--    @php--}}
{{--        echo print_r($my_slander_tweets, true);--}}
{{--    @endphp--}}

    <x-tweets.tweets-delay-display :tweets="$my_slander_tweets" :base_id="'my-tweets'"></x-tweets.tweets-delay-display>
    <div id="my-tweets" class="flex flex-wrap">


        <tweet-list></tweet-list>
    </div>
</x-app-layout>
