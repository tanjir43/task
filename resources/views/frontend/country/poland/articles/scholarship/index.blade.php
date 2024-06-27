@extends('layouts.app')

@section('body')
    <section data-type="frequently_read">
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Government Scholarships
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Polish
                            Government Scholarship Programmes</span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('ivac.procedure') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Stefan
                            Banach Scholarship Programme</span></span></a>
            </li>
        </ul>
        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            University-Specific Scholarships
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">University
                            of Warsaw Scholarships</span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('ivac.procedure') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Jagiellonian
                            University Scholarships</span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('ivac.procedure') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">AGH
                            University of Science and Technology Scholarships</span></span></a>
            </li>


        </ul>
        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Erasmus+ Programme
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Erasmus+
                            Scholarships</span></span></a>
            </li>
        </ul>
        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Scholarships from International Organizations
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Visegrad
                            Fund Scholarships</span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Fulbright
                            Program in Polands</span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">UNESCO/Poland
                            Co-Sponsored Fellowships Programme
                        </span></span></a>
            </li>
        </ul>

        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Poland My First Choice Programme
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                        class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Poland
                            My First Choice</span></span></a>
            </li>
        </ul>



        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Scientific Scholarships
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Doctoral
                            Scholarships</span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Research
                            Grants by the Polish National Science Centre (NCN)</span></span></a>
            </li>
        </ul>


        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            NAWA Scholarship for Citizens of Developing Countries
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">NAWA
                            Scholarship for Citizens of Developing Countries</span></span></a>
            </li>
        </ul>


        <br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" /><br class="csh-new-line" />
        <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
            Other Notable Scholarships
        </h1>
        <ul role="list" class="csh-home-list">
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Ignacy
                            Łukasiewicz Scholarship Programme
                        </span></span></a>
            </li>
            <li role="listitem">
                <a href="{{ route('universities') }}" role="link"
                    class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Eastern
                            Partnership Scholarships</span></span></a>
            </li>
        </ul>
        <span class="csh-markdown csh-markdown-line csh-article-content-separate csh-article-content-separate-top custom-br-paddng-left"></span>
            <p class="csh-article-content-updated csh-text-wrap csh-font-sans-light custom-updated-date">Updated on:
                20/04/2023
            </p>
        <span class="csh-markdown csh-markdown-line csh-article-content-separate csh-article-content-separate-bottom custom-br-paddng-left"></span>
        @include('common.comment_section.comment')

    </section>
@endsection
