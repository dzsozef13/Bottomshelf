<div class="post-card-container" id="container">
    <!-- Post Image -->
    <div class="post-card-img">
        <img class="img" src="data:image/*;charset=utf8;base64,{{imageBlob}}" />
    </div>
    <!-- Post Body -->
    <div class="post-card-body">

        <!-- Post Header -->
        <div class="post-card-header">
            <h3 class="post-card-title">{{title}}</h3>
            <p class="post-card-user">by @{{username}}</p>
        </div>
        <!-- Post Comment -->

        <div class="post-card-comment-wrapper">
            <div class="small-logo">
                <i class="las la-smile text-background-primary-900 text-xl"></i>
            </div>
            <div class="post-card-comment">
                {{latestComment}}
            </div>
        </div>

        <!-- Post Reactions -->
        <div class="post-card-reactions-wrapper">
            🌸 ✅ 👀
        </div>
    </div>
</div>