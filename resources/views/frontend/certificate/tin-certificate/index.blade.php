@extends('layouts.app')

@section('body')
<aside role="complementary">
    <div class="csh-aside">
        <div class="csh-article-category csh-navigation"><a
                href="../../category/project-settings-9h49uj/index.html" role="link"
                class="csh-navigation-back csh-navigation-back-item"><span
                    style="background-color: #000000;" data-has-category="true"
                    class="csh-category-badge csh-font-sans-medium">Project settings</span></a></div>
        <p class="csh-aside-title csh-text-wrap csh-font-sans-bold">Related articles</p>
        <ul role="list">
            <li role="listitem"><a
                    href="{{route('zero.return.certificate')}}"
                    role="link" class="csh-aside-spaced csh-text-wrap csh-font-sans-regular">Zero  Tax Return (e-Reurn)</a></li>
        </ul>
    </div>
</aside>
<div role="main" class="csh-article-content csh-article-content-split">
    <div class="csh-article-content-wrap">
        <article class="csh-text-wrap">
            <div role="heading" class="csh-article-content-header">
                <div class="csh-article-content-header-metas">
                    <div class="csh-article-content-header-metas-category csh-font-sans-regular">
                        Articles on:<span> </span><a
                            href="../../category/project-settings-9h49uj/index.html"
                            role="link">TIN Certificate</a></div>
                </div>
                <h1 class="csh-font-sans-bold">Tax Identification Number (TIN)</h1>
            </div>
            <div role="article" class="csh-article-content-text csh-article-content-text-large">TIN Certificate have  several Usages. Mostly in here  Tax Identification Number (TIN) need to get  Credit Card<br class="csh-new-line" /><br class="csh-new-line" />
                
               
                <h2 id="2-data-privacy" data-type="##"
                    onclick="CrispHelpdeskCommon.go_to_anchor(this)"
                    class="csh-markdown csh-markdown-title csh-font-sans-semibold">Registrstion</h2><br
                    class="csh-new-line" /><br class="csh-new-line" /> Go the the registration portal, and create an  account. 
                <br
                    class="csh-new-line" />
                    <a href="https://secure.incometax.gov.bd/Registration/Index" target="_blank">Registration Link</a>
                    <br class="csh-new-line" />
                    <br class="csh-new-line" />

                    <span style="color: rebeccapurple">If complete  the  Registration Process, Please Download the  TIN Certificate.</span> <br class="csh-new-line" />
                            

                    <br class="csh-new-line" />
                    <span data-type="||" class="csh-markdown csh-markdown-emphasis csh-font-sans-medium"> Next Step: <a href="{{route('zero.return.certificate')}}">Zero Return certificate</a> </span>

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
                    <span data-size="large" data-name="blushing" class="csh-smiley"></span></div>
                <div
                    class="csh-article-rate-thanks-smiley csh-article-rate-thanks-smiley-dissatisfied">
                    <span data-size="large" data-name="thumbs-up" class="csh-smiley"></span></div>
            </div>
        </section>
    </div>
</div>
@endsection