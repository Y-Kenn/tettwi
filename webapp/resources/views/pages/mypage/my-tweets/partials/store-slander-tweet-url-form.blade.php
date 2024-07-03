<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('ツイートURL') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("登録するツイートのURLを入力してください") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('my-tweets.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="slander_tweet_url" :value="__('URL')" />
            <x-text-input id="slander_tweet_url" name="slander_tweet_url" type="text" class="mt-1 block w-full" required autofocus autocomplete="slander-tweet-url" />
            <x-input-error class="mt-2" :messages="$errors->get('slander_tweet_url')" />
        </div>
    </form>
</section>
