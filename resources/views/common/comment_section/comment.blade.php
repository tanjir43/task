<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('jquery-nice-select-1.1.0/css/nice-select.css') }}">
<link rel="stylesheet" href="{{ asset('css/frontend-comment.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="row scrollable-div">
    <div class="col-10  mx-auto">
        <div class="mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-1 pr-0">
                                <img class="blog-comment-user-image" src="{{ asset('images/none.png') }}"alt="">
                            </div>
                            <div class="col-10">
                                <form id="comment-form" action="{{ route('frontend-user-comment') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="article_name" value="{{ @$code }}">
                                    <div class="form-group clickField richeditor">
                                        <textarea name="comment" id="" cols="" class="change-border-color note-editable change-placeholder"
                                            placeholder="Join the discussion" style="font-style: italic;width:100%">{{ old('comment') }}</textarea>
                                    </div>
                                    <div class="row showField justify-content-center" style="display: none">
                                        <div class="col-md-6 col-sm-12 mt-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text blog-input-group-text">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    required placeholder="Name*" value="{{ old('name') }}">
                                            </div>

                                            <div class="input-group mt-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text blog-input-group-text">
                                                        <i class="fa fa-envelope"></i>
                                                    </span>
                                                </div>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    required placeholder="Email*" value="{{ old('email') }}">
                                            </div>
                                            <div class="input-group mt-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text blog-input-group-text">
                                                        <i class="fa fa-phone"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                    placeholder="Phone" value="{{ old('phone') }}">
                                            </div>
                                            <div class="input-group mt-2">
                                                <input type="radio" class="btn-sm" name="can_reply" id="can_reply_yes"
                                                    value="1" {{ old('can_reply', '1') == '1' ? 'checked' : '' }}>
                                                <label class="btn-sm-label" for="can_reply_yes">User Can Reply</label>

                                                <input type="radio" class="btn-sm" name="can_reply" id="can_reply_no"
                                                    value="0" {{ old('can_reply') == '0' ? 'checked' : '' }}>
                                                <label class="btn-sm-label" for="can_reply_no">User Cannot Reply</label>
                                            </div>

                                            <div class="input-group mt-2">
                                                <input type="radio" class="btn-sm" name="type" id="comment_type_q"
                                                    value="Q" {{ old('type', 'Q') == 'Q' ? 'checked' : '' }}>
                                                <label class="btn-sm-label" for="comment_type_q">Question Type</label>

                                                <input type="radio" class="btn-sm" name="type" id="comment_type_d"
                                                    value="D" {{ old('type') == 'D' ? 'checked' : '' }}>
                                                <label class="btn-sm-label" for="comment_type_d">Discussion Type</label>
                                            </div>

                                            <button type="submit" class="btn-comment-post mt-3 mb-3">Post
                                                Comment</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <h6 class="mt-3 total-comment-text"> {{ @$all_comments }} Comments <span><img
                                class="user-blog-cog-comment" src="{{ asset('assets/website_icon/profile.png') }}"
                                width="16px !important" alt=""></span></h6>
                    <hr style="border: 1px solid gray">
                    <div class="row" id="comments-container">
                        @include('common.comment_section.render._datas', ['comments' => $comments])
                    </div>

                    <div class="container">
                        <div class="row justify-content-center mt-3">
                            <div class="col-md-3 col-12">
                                <button class="btn custom-btn-bg w-100" id="see-more-btn">See More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('jquery-nice-select-1.1.0/js/jquery.js') }}"></script>
<script src="{{ asset('jquery-nice-select-1.1.0/js/jquery.nice-select.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

<script>
    $(document).on('click', '[class^="text-all-replies-"]', function() {
        var commentId = $(this).data('comment-id');
        $(".reply-div-" + commentId).toggle('slow');
    });
</script>

<script>
    var reply_id = '';
    $(document).ready(function() {
        ClassicEditor.create(document.querySelector('#ckeditor'));

        $(document).on('click', '.clickField', function() {
            $('.showField').slideDown('slow');
            $("#name").slideDown('slow');
            $("#email").slideDown('slow');
            $("#phone").slideDown('slow');
        });

        $(document).on('click', '.clickReplyField', function(event) {
            event.stopPropagation();
            const comment_id = $(this).data('comment-id');
            showReplyField(comment_id);
        });

        $(document).on('click', '.ReplyshowField', function(event) {
            event.stopPropagation();
        });

        $(document).on('click', function() {
            hideReplyField();
        });
    });

    const initializedEditors = {};

    function showReplyField(comment_id) {
        $('.comment-reply-form-' + comment_id).slideDown('slow');
        reply_id = comment_id;

        if (!initializedEditors[reply_id]) {
            ClassicEditor
                .create(document.querySelector('#ckeditorReply_' + reply_id))
                .then(editor => {
                    initializedEditors[reply_id] = editor;
                })
                .catch(error => {
                    console.error('Error initializing CKEditor:', error);
                });
        }
    }

    function hideReplyField() {
        $('.ReplyshowField').slideUp('slow');
    }
</script>


<script>
    $(document).ready(function() {
        $('#comment-form').on('submit', function(e) {
            e.preventDefault();

            $('.btn-comment-post').prop('disabled', true);

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    toastr.success(response.message);
                    $('#comment-form')[0].reset();
                    $('.ReplyshowField').slideUp('slow');
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON.message || 'An error occurred';
                    toastr.error(errorMessage);
                },
                complete: function() {
                    $('.btn-comment-post').prop('disabled', false);
                }
            });
        });
    });
</script>

{{-- <script>
    
        $('form[id^="reply-form-"]').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            form.find('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    form.find('button[type="submit"]').prop('disabled', false);

                    form[0].reset();

                    form.find('input[type="radio"]').prop('checked', false);

                    $('.showField').slideUp('slow');

                    toastr.success(response.message);
                },
                error: function(xhr) {
                    form.find('button[type="submit"]').prop('disabled', false);

                    var errorMessage = xhr.responseJSON.message || 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        });
   
</script> --}}

<script>
    $(document).ready(function() {
        $(document).on('submit', 'form[id^="reply-form-"]', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = new FormData(form[0]);

            form.find('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    form.find('button[type="submit"]').prop('disabled', false);

                    form[0].reset();

                    form.find('input[type="radio"]').prop('checked', false);

                    form.closest('.ReplyshowField').slideUp('slow');

                    toastr.success(response.message);

                    const commentId = response.comment.article_comment_id;
                    const replyHtml = `
                        <div class="row mt-3 pl-0 ml-0 reply-row-comment">
                            <div class="col-1 pr-1 mt-3">
                                <img class="blog-comment-user-image" src="{{ asset('images/none.png') }}" alt="">
                            </div>
                            <div class="col-11 pl-2 mt-3">
                                <p class="blog-user-name article-reply">${response.comment.name}</p>
                                <p class="blog-time text-all-replies">
                                    <img src="{{ asset('assets/website_icon/conversation.png') }}" class="mr-1" width="12px" style="color: gray" alt="">
                                    <span>Reply to <strong>${response.comment.comment.name}</strong></span> 
                                    <i class="fa fa-clock mr-1 ml-2"></i>
                                    ${new Date(response.comment.created_at).toLocaleString()}
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="posted-blog-comment-reply">${response.comment.reply}</p>
                            </div>
                        </div>`;

                    $('.reply-div-' + commentId).append(replyHtml).show();
                },
                error: function(xhr) {
                    form.find('button[type="submit"]').prop('disabled', false);

                    var errorMessage = xhr.responseJSON.message || 'An error occurred';
                    toastr.error(errorMessage);
                }
            });
        });
    });
</script>


<script>
    let offset = 2;
    const articleId = '{{ $article }}';
    const allComments = '{{ $all_comments }}';

    document.getElementById('see-more-btn').addEventListener('click', function() {
        if (offset >= allComments) {
            document.getElementById('see-more-btn').style.display = 'none';
            return;
        }

        fetch('{{ route('load.more.comments') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    article_id: articleId,
                    offset: offset
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    const container = document.getElementById('comments-container');
                    container.insertAdjacentHTML('beforeend', data.html);
                    offset += 2;
                } else {
                    document.getElementById('see-more-btn').style.display = 'none';
                    container.insertAdjacentHTML('beforeend', '<p>No more comments available.</p>');
                }
            });
    });
</script>
