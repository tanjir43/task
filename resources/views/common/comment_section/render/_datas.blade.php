<style>
    .row>* {
        padding-right: 0px !important;
    }
</style>
@foreach($comments as $comment)
    <div class="row align-items-center justify-content-between">
        <div class="row justify-content-between">
            <div class="col-1">
                <img class="blog-comment-user-image" src="{{ asset('images/none.png') }}" alt="">
            </div>
            <div class="col-7">
                <p class="blog-user-name article-user-name">{{ $comment->name }} <br>
                    <span class="blog-time article-comment-time">
                        <i class="fa fa-clock mr-1"></i>
                        {{ commonDateFormat($comment->created_at) }}
                    </span>
                </p>
            </div>
            <div class="col-3" style="text-align: right">
                {!! $comment->type === 'Q' ? '<span class="badge bg-danger">Question</span>' : '<span class="badge bg-secondary">Discussion</span>' !!}
            </div>
        </div>
        <div class="col-12 pt-1 justify-class">
            <p class="posted-blog-comment article-main-comment" style="text-align: justify">{{ $comment->comment }}</p>
            <div class="d-flex justify-content-between">
                <div>
                    @if($comment->replies->count() > 0)
                        <p style="font-size: 11px; font-style: italic;text-decoration: underline; cursor: pointer; color: #62a18b;" class="text-all-replies-{{ $comment->id }}" data-comment-id="{{ $comment->id }}">See {{ $comment->replies->count() }} Replies</p>
                    @endif
                </div>
                <div>
                    @if($comment->can_reply === 1 || is_admin())
                        <span class="clickReplyField" onclick="showReplyField({{ $comment->id }})" style="cursor: pointer;">
                            <i class="fa-solid fa-comment-dots"></i>
                            <span class="blog-reply-button" style="padding-top: 0px; color: gray; font-size: 11px;">Reply</span>
                        </span>
                    @else
                        <span style="cursor: pointer" title="This is a protected comment. Only Admin can comment"><img src="{{ asset('images/lock.png') }}" width="20px" alt="">
                            <span class="blog-reply-button" style="padding-top: 0px; color: gray; font-size: 11px;"> Reply</span>
                        </span>
                    @endif
                </div>
            </div>
            <hr style="border: 1px solid gray">
            <div class="reply-div-{{ $comment->id }}" style="display: none">
                @foreach($comment->replies as $reply)
                    <div class="row mt-3 pl-0 ml-0 reply-row-comment">
                        <div class="col-1 mt-3">
                            <img class="blog-comment-user-image" src="{{ asset('images/none.png') }}" alt="">
                        </div>
                        <div class="col-8 mt-3">
                            <p class="blog-user-name article-reply-name">{{ $reply->name }}</p>
                            <p class="blog-time text-all-replies">
                                <img src="{{ asset('assets/website_icon/conversation.png') }}" class="mr-1" width="12px" style="color: gray" alt="">
                                <span>Reply to <strong>{{ $comment->name }}</strong></span> 
                                 <i class="fa fa-clock mr-1 ml-2"></i>
                                 {{ commonDateFormat($reply->created_at) }}
                            </p>
                            <p class="blog-user-name article-reply">{{ $reply->reply }}</p>
                        </div>
                        <div class="col-2" style="text-align: right">
                            {!! $reply->type == 'D' ? '<span class="badge bg-secondary">Discussion</span>' : '<span class="badge bg-success">Answer</span>' !!}
                        </div>
                        <div class="col-12">
                            <p class="posted-blog-comment-reply">{{ $reply->comment }}</p>
                        </div>
                    </div>
                @endforeach
                <p class="clickReplyField" onclick="showReplyField({{ $comment->id }})" style="cursor: pointer;">
                    <i class="fa-solid fa-comment-dots"></i> <span class="blog-reply-button" style="padding-top: 0px;color:gray;font-size:11px;">Reply</span>
                </p>
            </div>
        </div>
        <div class="ReplyshowField comment-reply-form-{{ $comment->id }}" style="display: none">
            <form id="reply-form-{{ $comment->id }}" action="{{ route('frontend-user-comment-reply') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row bg-color-gray">
                    <div class="col-1 pr-0">
                        <img class="blog-comment-user-image" src="{{ asset('images/none.png') }}" alt="">
                    </div>
                    <div class="col-11">
                        <div class="row justify-content-center">
                            <div class="form-group richeditor" style="width: 96%">
                                <textarea name="reply" cols="30" class="form-control note-editable change-border-color" placeholder="Join the discussion">{{ old('reply') }}</textarea>
                            </div>
                            <div class="col-6 pl-0 mt-3 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text blog-input-group-text">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="name" class="form-control" placeholder="Name*" value="{{ old('name') }}">
                                    <input type="hidden" name="article_comment_id" required class="form-control" value="{{ $comment->id }}">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text blog-input-group-text">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" class="form-control" required placeholder="Email*" value="{{ old('email') }}">
                                </div>
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text blog-input-group-text">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="tel" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}">
                                </div>
                                <div class="input-group mt-2">
                                    <input type="radio" class="btn-sm" name="type" id="reply_type_d" value="D" {{ old('type', 'D') == 'D' ? 'checked' : '' }}>
                                    <label class="btn-sm-label" for="reply_type_d">Discussion Type</label>
                                    <input type="radio" class="btn-sm" name="type" id="reply_type_a" value="A" {{ old('type') == 'A' ? 'checked' : '' }}>
                                    <label class="btn-sm-label" for="reply_type_a">Answer Type</label>
                                </div>
                                <button type="submit" class="btn-comment-post mt-3">Article Comment Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <hr style="border: 1px solid gray">
    </div>
@endforeach
