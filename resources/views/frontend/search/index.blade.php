@extends('layouts.app')

@section('body')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
<link rel="stylesheet" href="{{ asset('jquery-nice-select-1.1.0/css/nice-select.css') }}">

<script src="{{ asset('jquery-nice-select-1.1.0/js/jquery.js') }}"></script>
<script src="{{ asset('jquery-nice-select-1.1.0/js/jquery.nice-select.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<aside role="complementary">
    <div class="csh-aside">
        <div class="csh-article-category csh-navigation">
            <a href="../../category/elements-ekqxm7/index.html" role="link"
                class="csh-navigation-back csh-navigation-back-item"><span
                    style="background-color: #000000" data-has-category="true"
                    class="csh-category-badge csh-font-sans-medium">Back</span></a>
        </div>
        <p class="csh-aside-title csh-text-wrap csh-font-sans-bold">
            Search filters

        </p>

        <div class="row mt-4">

            <div class="col-12">
                <label for="" class="static_label_style">Country</label>
                <select>
                    <option data-display="Select Country">Select Country</option>
                    <option value="1" selected>Poland</option>
                </select>
            </div>

            <div class="col-12 mt-4">
                <label for="" class="static_label_style">City</label>
                <select>
                    <option data-display="Select City">Select City</option>
                    <option value="1">Warsaw</option>
                    <option value="1">All City</option>
                    <option value="1">Poznan</option>
                </select>
            </div>

            <div class="col-12 mt-4">
                <label for="" class="static_label_style">Academic Disciplines</label>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class=" radio-btn-flex">
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationFather"
                                value="T" class="common-radio relationButton" checked="">
                            <label for="relationFather">Art, Design & Media</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Business & Management</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Computer Science & IT</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Engineering & Technology</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Environment & Agriculture</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Humanities</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Law</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Medicine & Health</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Natural Sciences & Mathematics</label>
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" name="subject_type" id="relationMother"
                                value="P" class="common-radio relationButton">
                            <label for="relationMother">Social Sciences</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <label for="" class="static_label_style">Level</label>
                <select>
                    <option data-display="Select Level">Select Level</option>
                    <option value="1">All (Bachelor/Master's/PHD)</option>
                    <option value="1">Bachelor</option>
                    <option value="1">Masters</option>
                    <option value="1">PHD</option>
                </select>
            </div>

            <div class="col-12 mt-4">
              <label for="" class="static_label_style">English Proficiency</label>
            </div>

            <div class="row">
              <div class="col-lg-12">
                  <div class="d-flex radio-btn-flex">
                      <div class="mt-2">
                          <input type="checkbox" name="subject_type" id="relationFather"
                              value="T" class="common-radio relationButton" checked="">
                          <label for="relationFather">Yes</label>
                      </div>
                      <div class="mt-2" style="margin-left: 10px !important;">
                          <input type="checkbox" name="subject_type" id="relationMother"
                              value="P" class="common-radio relationButton ml-2">
                          <label for="relationMother">No</label>
                      </div>
                      
                  </div>
              </div>
          </div>

            <div class="col-12 mt-4">
                <label for="" class="static_label_style">Delivery Mode</label>
                <select>
                    <option data-display="Select Delivery Mode">Select Delivery Mode</option>
                    <option value="1">All (Campus/Remote/Blended)</option>
                    <option value="1">On Campus</option>
                    <option value="1">Remote</option>
                    <option value="1">Blended (Campus/Remote)</option>
                </select>
            </div>

            <div class="col-12 mt-4">
                <label for="" class="static_label_style">Country Category</label>
                <select>
                    <option data-display="Select Country  Category">Select Country Category</option>
                    <option value="1">EU/EEA Countries</option>
                    <option value="1">Non-EU/EEA Countries</option>
                </select>
            </div>
            <style>
                input[type="range"] {
                    display: block;
                    width: 100%;
                }

                .btn-main-color {
                    background-color: #62a18b;
                    color: #fff;
                    border: 1px solid #62a18b;
                }

                .btn-main-color:hover {
                    background-color: #fff;
                    color: #62a18b;
                    border: 1px solid #62a18b;
                }

                .text-bold {
                    font-weight: 800 !important;
                }

                .current-search-filters {
                    font-weight: 400 !important;
                    color: #62a18b;
                    font-size: 11px
                }

                /* .acitive-search-img-size {
                  width: 25px;
                  height: 20px;
                  margin-left: 5px;
                  padding-top: 8px;
              }
            .remove-search-filter {
              background-color: rgba(87, 85, 88, 0.25);
              padding: 5px;
            } */

                .acitive-search-img-size {
                    width: 28px;
                    height: 17px;
                    margin-left: 5px;
                    padding-top: 0px;
                }

                .remove-search-filter {
                    background-color: rgba(87, 85, 88, 0.25);
                    padding: 4px;
                    display: inline-flex;
                    align-items: center;
                    text-decoration: none;
                    color: #000;
                }

                .remove-search-filter img.cross-icon {
                    width: 16px;
                    /* Adjust the size of the cross icon */
                    height: 16px;
                    margin-right: 5px;
                    cursor: pointer;
                }

                .remove-search-filter:hover {
                    text-decoration: line-through !important;
                }

                .list-group {
                    padding-left: 0;
                    margin-bottom: 20px;
                }

                .panel-default {
                    border-color: #ddd;
                }

                .panel {
                    margin-bottom: 20px;
                    background-color: #fff;
                    border: 1px solid transparent;
                    border-radius: 4px;
                    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
                    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
                }

                .panel,
                .panel-heading,
                .btn,
                .thumbnail {
                    border-radius: 0 !important;
                }
                .custom-search-banner {
                    width: 100%;
                    object-fit: cover !important;
                    height: 150px;
                }

                .panel-default>.panel-heading {
                    color: #333333;
                    background-color: #f5f5f5;
                    border-color: #ddd;
                }

                .panel-heading {
                    padding: 10px 15px;
                    border-bottom: 1px solid transparent;
                    border-top-left-radius: 3px;
                    border-top-right-radius: 3px;
                }

                .row:before,
                .row:after {
                    display: table;
                    content: " ";
                }

                .panel-body {
                    padding: 15px;
                }

                .panel-body:before,
                .panel-body:after {
                    display: table;
                    content: " ";
                }

                img.search-result-logo {
                    max-height: 4em;
                    max-width: 100%;
                }
                .search-degree-type-text {
                    font-size: 12px;
                    font-weight: 600;
                    color: #fff;
                    background-color: #62a18b;
                    padding: 2px 5px;
                    border-radius: 5px;
                }

                .text-subject-title {
                   color: #726f6f !important;
                }
            </style>

            <div class="col-12 mt-4">
                <label for="tuition_max" class="static_label_style">Tuition Fees <span
                        id="tuition_max_value">any</span></label>
                <input type="range" class="sliderx custom-range-color" id="tuition_max"
                    name="tuition_max" min="0" max="25000" value="25000" step="2500">
            </div>

            <div class="col-12">
                <button type="submit" style="width: 100%" class="btn btn-main-color mt-4">Search
                    Programmes</button>
            </div>


        </div>


        <script>
            const tuitionMax = document.getElementById('tuition_max');
            const tuitionMaxValue = document.getElementById('tuition_max_value');
            const initialValue = tuitionMax.value;

            tuitionMax.addEventListener('input', function() {
                if (tuitionMax.value === initialValue) {
                    tuitionMaxValue.textContent = 'any';
                } else {
                    tuitionMaxValue.textContent = `up to ${tuitionMax.value}`;
                }
            });

            tuitionMax.dispatchEvent(new Event('input'));
        </script>

    </div>
</aside>
<div role="main" class="csh-article-content csh-article-content-split">
    <div class="csh-article-content-wrap">
        <article class="csh-text-wrap">
            <div role="heading" class="csh-article-content-header">
                <div class="csh-article-content-header-metas">
                    <div class="csh-article-content-header-metas-category csh-font-sans-regular">
                        <span class="text-bold">365 programmes found:</span> <span> </span><a
                            href="../../category/elements-ekqxm7/index.html" role="link">Showing 01
                            to 10</a> <br class="csh-new-line" /> <br class="csh-new-line" />

                        <span class="current-search-filters">Current Search Filters:</span>

                        <a class="remove-search-filter"
                            href="/search?countries=&amp;currency=EUR&amp;page=3&amp;sort=name&amp;tuition_max=25000&amp;tuition_region=eea&amp;tuition_term=annual"
                            title="Remove this filter">
                            <img class="cross-icon" src="{{ asset('cross_icon.jpg') }}"
                                alt="Remove Filter"> <!-- Cross icon image -->
                            Computer Science
                        </a>
                        <a class="remove-search-filter"
                            href="/search?countries=&amp;currency=EUR&amp;page=3&amp;sort=name&amp;tuition_max=25000&amp;tuition_region=eea&amp;tuition_term=annual"
                            title="Remove this filter">
                            <img class="cross-icon" src="{{ asset('cross_icon.jpg') }}"
                                alt="Remove Filter"> <!-- Cross icon image -->
                            Poland
                            <img class="acitive-search-img-size" src="{{ asset('poland-logo.png') }}"
                                alt="Poland">
                        </a>

                    </div>
                </div>
                <br class="csh-new-line" />
                <img src="{{asset('ad_banner.png')}}" class="custom-search-banner" alt="">
                <br class="csh-new-line" /> <br class="csh-new-line" /> <br class="csh-new-line" /><br class="csh-new-line" />

                <ul class="list-group">
                  
                    <li class="featured-search-result" data-track-rendering-ga="true"
                        data-event-category="Search Result"
                        data-event-label="/university/gdansk-university-of-technology/msc-automatic-control-cybernetics-and-robotics-specializatio"
                        data-trackvalue-country-id="30" data-trackvalue-university-id="736"
                        data-trackvalue-programme-id="20840">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="search-degree-type" title="Master of Science">
                                           <span class="search-degree-type-text">MSc</span> 
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <a data-track-click-ga="true" class="csh-article-rate-title csh-font-sans-medium  text-subject-title"
                                            data-event-category="Search Result"
                                            data-event-label="/university/gdansk-university-of-technology/msc-automatic-control-cybernetics-and-robotics-specializatio"
                                            data-trackvalue-country-id="30"
                                            data-trackvalue-university-id="736"
                                            data-trackvalue-programme-id="20840"
                                            href="/university/gdansk-university-of-technology/msc-automatic-control-cybernetics-and-robotics-specializatio">Automatic
                                            Control, Cybernetics and Robotics&nbsp;Specialization:
                                            Computer Control Systems</a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="col-md-2">
                                        <a href="/university/gdansk-university-of-technology">
                                            <img class="search-result-logo"
                                                src="https://study-eu.s3.eu-west-1.amazonaws.com/uploads/university/desktop_gdansk-university-of-technology-logo.svg">
                                        </a>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a title="Learn more about Gdańsk University of Technology"
                                                    data-track-click-ga="true"
                                                    data-event-category="Search Result"
                                                    data-event-label="/university/gdansk-university-of-technology"
                                                    data-trackvalue-country-id="30"
                                                    data-trackvalue-university-id="736"
                                                    href="{{route('university.details')}}">Gdańsk
                                                    University of Technology</a><br>
                                                <i class="fa fa-map"
                                                    style="color: #999;"></i>&nbsp; <span
                                                    class="search-result-additional-info">Gdansk,
                                                    Poland</span>
                                                <span style="font-size: 85%"></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 search-result-additional-info">
                                                18 months (95 ECTS)

                                                full-time
                                            </div>

                                            <div class="col-md-12 search-result-additional-info">
                                                4,033 EUR per year (students from EU/EEA)
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3 search-result-buttons">
                                        <p>
                                            <a class="btn btn-main-color search-result-button"
                                                data-track-click-ga="true"
                                                data-event-category="Search Result"
                                                data-event-label="/university/gdansk-university-of-technology/msc-automatic-control-cybernetics-and-robotics-specializatio"
                                                data-trackvalue-country-id="30"
                                                data-trackvalue-university-id="736"
                                                data-trackvalue-programme-id="20840"
                                                href="/university/gdansk-university-of-technology/msc-automatic-control-cybernetics-and-robotics-specializatio">Learn
                                                more</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                  
                   
                </ul>

            </div>
            <div role="article" class="csh-article-content-text csh-article-content-text-large">
            </div>
        </article>
        <section data-has-answer="false" role="none" class="csh-article-rate">
            <div class="csh-article-rate-ask csh-text-wrap">
                <p class="csh-article-rate-title csh-font-sans-medium">
                    Was this article helpful?
                </p>
                <ul>
                    <li>
                        <a href="#" role="button" aria-label="Yes"
                            onclick="CrispHelpdeskArticle.answer_feedback(true); return false;"
                            class="csh-button csh-button-grey csh-button-small csh-font-sans-medium">Yes</a>
                    </li>
                    <li>
                        <a href="#" role="button" aria-label="No"
                            onclick="CrispHelpdeskArticle.answer_feedback(false); return false;"
                            class="csh-button csh-button-grey csh-button-small csh-font-sans-medium">No</a>
                    </li>
                </ul>
            </div>
            <div data-is-open="false" class="csh-article-rate-feedback-wrap">
                <div data-had-error="false" class="csh-article-rate-feedback-container">
                    <form
                        action="https://help.teleporthq.io/en/article/elements-basics-arxh3r/feedback/"
                        method="post"
                        onsubmit="CrispHelpdeskArticle.send_feedback_comment(this); return false;"
                        data-is-locked="false" class="csh-article-rate-feedback">
                        <p class="csh-article-rate-feedback-title csh-font-sans-bold">
                            Share your feedback
                        </p>
                        <textarea name="feedback_comment" cols="1" rows="1" maxlength="200"
                            placeholder="Explain shortly what you think about this article.
            We may get back to you."
                            onkeyup="CrispHelpdeskArticle.type_feedback_comment(event)"
                            class="csh-article-rate-feedback-field csh-font-sans-regular"></textarea>
                        <div class="csh-article-rate-feedback-actions">
                            <button type="submit" role="button" aria-label="Send My Feedback"
                                data-action="send"
                                class="csh-button csh-button-accent csh-font-sans-medium">
                                Send My Feedback</button><a href="#" role="button"
                                aria-label="Cancel"
                                onclick="CrispHelpdeskArticle.cancel_feedback_comment(); return false;"
                                data-action="cancel"
                                class="csh-button csh-button-grey csh-font-sans-medium">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
            <div data-is-satisfied="true" class="csh-article-rate-thanks">
                <p class="csh-article-rate-title csh-article-rate-thanks-title csh-font-sans-semibold">
                    Thank you!
                </p>
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
<script>
    $(document).ready(function() {
        $('select').niceSelect();
    });
</script>
@endsection