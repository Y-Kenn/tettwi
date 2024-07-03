<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ランキング') }}
        </h2>
    </x-slot>

    @if(session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif



    <div class="flex justify-around">
        <div>
            <h2 class="text-white">新着</h2>
            <x-tweets.tweets-delay-display :tweets="$new_arrival_tweets" :base_id="'new-arrival'"></x-tweets.tweets-delay-display>
            <div id="new-arrival" class="flex flex-col flex-wrap"></div>
        </div>
        <div>
            <h2 class="text-white">デイリー</h2>
            <x-tweets.tweets-delay-display :tweets="$daily_ranking_tweets" :base_id="'daily-ranking'"></x-tweets.tweets-delay-display>
            <div id="daily-ranking" class="flex flex-col flex-wrap"></div>
        </div>
        <div>
            <h2 class="text-white">ウィークリー</h2>
            <x-tweets.tweets-delay-display :tweets="$weekly_ranking_tweets" :base_id="'weekly-ranking'"></x-tweets.tweets-delay-display>
            <div id="weekly-ranking" class="flex flex-col flex-wrap"></div>
        </div>
    </div>



</x-app-layout>
