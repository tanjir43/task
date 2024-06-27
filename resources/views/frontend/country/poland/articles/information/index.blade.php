@extends('layouts.app')
@section('body')
    <section data-type="frequently_read">
      <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
          Information for you
      </h1>
      <ul role="list" class="csh-home-list">
          <li role="listitem">
            <a href="{{ route('universities') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                class="csh-home-list-wrap csh-text-wrap"><span
                class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Universities</span></span></a>
          </li>
          <li role="listitem">
            <a href="{{ route('ivac.procedure') }}" role="link"
                class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Indian
            Visa Application Center (IVAC)</span></span></a>
          </li>
          <li role="listitem">
            <a href="{{ route('vfs.procedure') }}" role="link"
                class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">VFS
            (Poland)</span></span></a>
          </li>
          <li role="listitem">
            <a href="{{ route('banking.procedure') }}" role="link"
                class="csh-box csh-box-link csh-font-sans-medium"><span class="csh-home-list-wrap csh-text-wrap"><span
                class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Banking</span></span></a>
          </li>
          <li role="listitem">
            <a href="{{ route('scholarship') }}" role="link" class="csh-box csh-box-link csh-font-sans-medium"><span
                class="csh-home-list-wrap csh-text-wrap"><span
                class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Scholarship</span></span></a>
          </li>
      </ul>
    </section>
<div class="csh-home-separator"></div>
<section data-type="categories">
   <h1 class="csh-home-title csh-text-wrap csh-font-sans-bold">
      Browse All Programmes
   </h1>
   <ul role="list" class="csh-home-list csh-home-list-large">
      <li role="listitem">
         <a href="{{ route('academic.levels','bachelor') }}" role="link" class="csh-box csh-box-link csh-font-sans-regular"><span
            style="
            background-image: url({{ asset('frontend/program/graduate.jpg') }});
            "
            class="csh-home-list-image"></span><span class="csh-home-list-aside"><span
            class="csh-home-list-category"><span style="background-color: #000000" data-has-category="true"
            class="csh-category-badge csh-font-sans-medium">Bachelor</span></span><span
            class="csh-home-list-wrap csh-text-wrap"><span
            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Discover
         Your University and Access the Application Portal</span></span></span></a>
      </li>
      <li role="listitem">
         <a href="category/elements-ekqxm7/index.html" role="link"
            class="csh-box csh-box-link csh-font-sans-regular"><span
            style="
            background-image: url({{ asset('frontend/program/graduate1.jpg') }});
            "
            class="csh-home-list-image"></span><span class="csh-home-list-aside"><span
            class="csh-home-list-category"><span style="background-color: #000000" data-has-category="true"
            class="csh-category-badge csh-font-sans-medium">Master's</span></span><span
            class="csh-home-list-wrap csh-text-wrap"><span
            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Discover
         Your University and Access the Application Portal</span></span></span></a>
      </li>
      <li role="listitem">
         <a href="category/layout-design-199z79k/index.html" role="link"
            class="csh-box csh-box-link csh-font-sans-regular"><span
            style="
            background-image: url({{ asset('frontend/program/graduate2.jpg') }});
            "
            class="csh-home-list-image"></span><span class="csh-home-list-aside"><span
            class="csh-home-list-category"><span style="background-color: #000000" data-has-category="true"
            class="csh-category-badge csh-font-sans-medium">PHD</span></span><span
            class="csh-home-list-wrap csh-text-wrap"><span
            class="csh-home-list-label csh-text-ellipsis-multiline csh-text-ellipsis-multiline-lines-2">Discover
         Your University and Access the Application Portal</span></span></span></a>
      </li>
   </ul>
</section>
@endsection