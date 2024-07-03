@props([
    'tweets' => null,
    'base_id' => null,
])
@php
    $tweets_json = json_encode($tweets);
    $base_id_json = json_encode($base_id);
@endphp

<script>
    (function(){
        console.log(<?php echo $base_id_json; ?>);
        const tweets =<?php echo $tweets_json; ?>;
        const base_id ='#' + <?php echo $base_id_json; ?>;
        let i = 0
        const interval = setInterval(()=>{

            console.log(i)
            console.log(tweets[i]['tweet_id'])
            const html =
                `<div id="`
                + String(tweets[i]['tweet_id'])
                + `">`
                + `<div>`
                + `<x-tweets.tweet-footer />`
                + `<div class="w-64 h-fit">`
                + tweets[i]['embedded_tweet_html']
                + `</div>`
                + `</div>`
                + `</div>`
            $(base_id).append(html);

            if(i >= tweets.length - 1){
                clearInterval(interval);
                // 誹謗中傷評価
                $('.js-slanderous').on('click', async function (){
                    const id = $(this).parent().parent().parent().attr('id');
                    const url = 'http://localhost/slanderous-eval';
                    const data = { tweet_id: String(id) }
                    axios.post(url, data).then(res =>{
                        // $(element).addClass('text-pink-500');
                        // tweets[index].is_bad = tweets[index].id;
                        alert('ok');
                    }).catch(err => {
                        console.log("error:", err);
                    });
                });

                // 公平評価
                $('.js-fair').on('click', async function (){
                    const id = $(this).parent().parent().parent().attr('id');
                    const url = 'http://localhost/fair-eval';
                    const data = { tweet_id: String(id) }
                    axios.post(url, data).then(res =>{
                        // $(element).addClass('text-pink-500');
                        // tweets[index].is_bad = tweets[index].id;
                        alert('ok');
                    }).catch(err => {
                        console.log("error:", err);
                    });
                });

                // ブックマーク
                $('.js-bookkmark').on('click', async function (){
                    const id = $(this).parent().parent().parent().attr('id');
                    const url = 'http://localhost/bookmark';
                    const data = { tweet_id: String(id) }
                    axios.post(url, data).then(res =>{
                        // $(element).addClass('text-pink-500');
                        // tweets[index].is_bad = tweets[index].id;
                        alert('ok');
                    }).catch(err => {
                        console.log("error:", err);
                    });
                });
            }
            i++;
        }, 500);

    }())
</script>
