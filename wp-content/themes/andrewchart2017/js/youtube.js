(function() {
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.body.appendChild(tag);
})();

function onYouTubeIframeAPIReady() {

    var videoEmbeds = document.getElementsByClassName('youtube-embed');

    Array.prototype.forEach.call(videoEmbeds, (embed) => {
        let el_id = embed.id;
        let yt_id = embed.dataset.ytId;
        new YT.Player(el_id, {
            videoId: yt_id,
            playerVars: {
                'playsinline': 1,
                'enablejsapi': 1
            }
        });
    });

}

  