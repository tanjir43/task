@extends('layouts.app')

@section('body')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

<aside role="complementary">
    <div class="csh-aside">
        <div class="csh-article-category csh-navigation"><a
                href="../../category/project-settings-9h49uj/index.html" role="link"
                class="csh-navigation-back csh-navigation-back-item"><span
                    style="background-color: #000000;" data-has-category="true"
                    class="csh-category-badge csh-font-sans-medium">Back</span></a></div>
        {{-- <p class="csh-aside-title csh-text-wrap csh-font-sans-bold">Related articles</p>
        <ul role="list">
            <li role="listitem"><a href="{{ route('zero.return.certificate') }}" role="link"
                    class="csh-aside-spaced csh-text-wrap csh-font-sans-regular">Zero Tax Return
                    (e-Reurn)</a></li>
        </ul> --}}
    </div>
</aside>
<div role="main" class="csh-article-content csh-article-content-split">
    <div class="csh-article-content-wrap">
        <article class="csh-text-wrap">
            <div role="heading" class="csh-article-content-header">
                {{-- <div class="csh-article-content-header-metas">
                    <div class="csh-article-content-header-metas-category csh-font-sans-regular">
                        Articles on:<span> </span><a
                            href="../../category/project-settings-9h49uj/index.html"
                            role="link">TIN Certificate</a></div>
                </div> --}}
                <div class="csh-article-content-header-metas-category csh-font-sans-regular">
   
                    <a href="" class="custom-header-breadcumb-text" role="link">Poland</a> <span class="custom-breadcumb-header-distance"> &gt; </span>  
                    <a href="" class="custom-header-breadcumb-text" role="link">Universities</a> <span class="custom-breadcumb-header-distance"> &gt; </span>  
                    <a href="" class="custom-header-breadcumb-text" role="link">Wrocław University of Science and Technology</a>
               </div>
               <br class="csh-new-line" /> <br class="csh-new-line" />
                <h1 class="csh-font-sans-bold">Wrocław University of Science and Technology</h1>
            </div>
            <div role="article" class="csh-article-content-text csh-article-content-text-large">

                <span data-type="|||" class="csh-markdown csh-markdown-emphasis csh-font-sans-medium">
                    This Site Currently On Under Development Mode. We Are Updating Data to enhance more User Experience. Sorry For the  inconvenience. It Will be Ready Soon. 
                </span>
                <br class="csh-new-line" /><br class="csh-new-line" />
                <ul class="csh-footer-ask-buttons text-center">
                    <li class="d-inline-block">
                        <a aria-label="Chat with us" href="#" role="button"
                           class="csh-button csh-button-accent csh-button-icon-chat csh-button-has-left-icon csh-font-sans-regular"
                           id="becomeMemberButton">
                            <input type="hidden" id="page-value" name="page" value="university-details">
                            <span class="become_a_member_text">Become A Member</span>
                        </a>
                    </li>
                </ul>
       
                <div id="modal-placeholder"></div>
                <div id="success-modal-placeholder"></div>

                <script>
                    $(document).ready(function() {
                        $('#becomeMemberButton').click(function() {
                            var pageValue = $('#page-value').val();
                            console.log('Button clicked, pageValue:', pageValue);
                
                            $.ajax({
                                url: "{{ route('become.a.member.modal.open') }}",
                                type: "POST",
                                data: {
                                    page_value: pageValue,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    console.log('AJAX success, response:', response);
                
                                    $('#modal-placeholder').html(response.modalHtml);
                
                                    var myModal = new bootstrap.Modal(document.getElementById('becomeMemberModal'));
                                    $('#pageValue').val(pageValue);
                                    myModal.show();
                                },
                                error: function(xhr, status, error) {
                                    console.error('AJAX error:', status, error);
                                }
                            });
                        });
                
                        $(document).on('submit', '#memberForm', function(e) {
                            e.preventDefault();
                            var name = $('#memberName').val();
                            var phone = $('#memberPhone').val();
                            var email = $('#memberEmail').val();
                            var page = $('#pageValue').val();
                
                            console.log('Form submitted, page:', page);
                
                            $.ajax({
                                type: "POST",
                                url: "{{ route('become.a.member') }}",
                                data: {
                                    name: name,
                                    phone: phone,
                                    email: email,
                                    page: page,
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    console.log('Form submission success, response:', response);
                
                                    if (response.success) {
                                        $('#becomeMemberModal').modal('hide');
                                        $('#memberForm').trigger('reset');
                
                                        setTimeout(function() {
                                            $('#success-modal-placeholder').html(`
                                                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-succes">
                                                                <h5 class="modal-title" id="successModalLabel">Success</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Thank you for your membership request. We will verify your information and send a confirmation email to the provided address upon approval.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `);
                
                                            // Show the success modal
                                            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                            successModal.show();
                                        }, 1000);
                                    } else {
                                        alert('Something went wrong!');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Form submission error:', status, error);
                                }
                            });
                        });
                    });
                </script>
               <br class="csh-new-line" />
                <span data-type="|" class="csh-markdown csh-markdown-emphasis csh-font-sans-medium">
                    To Get More Information About This University, Please Visit Official Website of <a href="https://pwr.edu.pl/en/" target="_blank">Wrocław University of Science and Technology</a>
                </span>

                <br class="csh-new-line" /><br class="csh-new-line" />
                <span data-type="|" class="csh-markdown csh-markdown-emphasis csh-font-sans-medium">
                    Apply for Admission: <a href="https://irk.usos.pwr.edu.pl/en-gb/" target="_blank">Click Here</a>
                </span>
               
               

                <span
                    class="csh-markdown csh-markdown-line csh-article-content-separate csh-article-content-separate-top"></span>
                <p class="csh-article-content-updated csh-text-wrap csh-font-sans-light">Updated on:
                    13/03/2023</p><span
                    class="csh-markdown csh-markdown-line csh-article-content-separate csh-article-content-separate-bottom"></span>
            </div>
        </article>
        <section data-has-answer="false" role="none" class="csh-article-rate">
            <div class="csh-article-rate-ask csh-text-wrap">
                <p class="csh-article-rate-title csh-font-sans-medium">Was this article helpful?</p>
                <ul>
                    <li><a href="#" role="button" aria-label="Yes"
                            onclick="CrispHelpdeskArticle.answer_feedback(true); return false;"
                            class="csh-button csh-button-grey csh-button-small csh-font-sans-medium">Yes</a>
                    </li>
                    <li><a href="#" role="button" aria-label="No"
                            onclick="CrispHelpdeskArticle.answer_feedback(false); return false;"
                            class="csh-button csh-button-grey csh-button-small csh-font-sans-medium">No</a>
                    </li>
                </ul>
            </div>
            <div data-is-open="false" class="csh-article-rate-feedback-wrap">
                <div data-had-error="false" class="csh-article-rate-feedback-container">
                    <form
                        action="https://help.teleporthq.io/en/article/how-we-manage-project-and-data-privacy-c3kr7l/feedback/"
                        method="post"
                        onsubmit="CrispHelpdeskArticle.send_feedback_comment(this); return false;"
                        data-is-locked="false" class="csh-article-rate-feedback">
                        <p class="csh-article-rate-feedback-title csh-font-sans-bold">Share your
                            feedback</p>
                        <textarea name="feedback_comment" cols="1" rows="1" maxlength="200"
                            placeholder="Explain shortly what you think about this article.
                            We may get back to you."
                            onkeyup="CrispHelpdeskArticle.type_feedback_comment(event)"
                            class="csh-article-rate-feedback-field csh-font-sans-regular"></textarea>
                        <div class="csh-article-rate-feedback-actions"><button type="submit"
                                role="button" aria-label="Send My Feedback" data-action="send"
                                class="csh-button csh-button-accent csh-font-sans-medium">Send My
                                Feedback</button><a href="#" role="button" aria-label="Cancel"
                                onclick="CrispHelpdeskArticle.cancel_feedback_comment(); return false;"
                                data-action="cancel"
                                class="csh-button csh-button-grey csh-font-sans-medium">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <div data-is-satisfied="true" class="csh-article-rate-thanks">
                <p class="csh-article-rate-title csh-article-rate-thanks-title csh-font-sans-semibold">
                    Thank you!</p>
                <div class="csh-article-rate-thanks-smiley csh-article-rate-thanks-smiley-satisfied">
                    <span data-size="large" data-name="blushing" class="csh-smiley"></span>
                </div>
                <div
                    class="csh-article-rate-thanks-smiley csh-article-rate-thanks-smiley-dissatisfied">
                    <span data-size="large" data-name="thumbs-up" class="csh-smiley"></span>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection