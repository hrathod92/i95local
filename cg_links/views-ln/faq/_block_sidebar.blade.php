<ul>
  <li><a class='button' href='/faqs'>List</a></li>
  @if ( Auth::user()->role == 'admin' )
    <li><a class='button' href='/faqs/create'>Create</a></li>
  @endif
</ul>

<?php $blockFaqs = \App\Faq::orderBy( 'refno' )->get(); ?>
<ul class='menu'>
  @foreach ( $blockFaqs AS $blockFaq )
    <li><a class='button' href='/faqs/{{ $blockFaq->id }}'>{{ $blockFaq->refno }} {{ $blockFaq->title }}</a></li>
  @endforeach
</ul>


<style>
  #sidebar #sidebar-inner ul {
    padding: 0;
  }
  #sidebar #sidebar-inner ul li {
    list-style: none;
  }
  #sidebar #sidebar-inner ul li .button {
    width: 100%;
    padding: 0.25em 2em;
  }
  #sidebar #sidebar-inner ul.menu li a {
    text-align: left;
  }
</style>
