
@foreach($clients as $special)
<div class="agency-dashoard-client-wrapper">
	<div class="client-heading">
		<h2>{{ $special->title}}</h2>
		<span class="remove-btn"><a class='button small icon-left confirmation' href="agency/terminate/{{$special->id}}/{{\Auth::user()->company_id}}">Remove</a></span>
	</div>
  <div class="client-details profile-wrapper">
      <button onclick="myFunction('profile-{{$special->id}}')" id="button-profile-{{$special->id}}" class="profile w3-button w3-block w3-left-align">Profile</button>
      <div id="profile-{{$special->id}}" class="w3-container w3-hide">
        @include( 'dashboard.agency._block_agency_company_profile' )
      </div>
  </div>
  <div class="client-details ads-wrapper">
      <?php
        $ads = \App\Ad::with( 'ad_type', 'company', 'publish_status', 'status' )
          ->where( 'company_id', $special->id )
          ->where(function($query){
              $query->where('ad_type_id', 20)
                    ->orWhere('ad_type_id', 25)
                    ->orWhere('ad_type_id', 26);
          }) 
          ->orderBy('ad_type_id')
          ->get();
      ?>
      <button onclick="myFunction('ad-{{$special->id}}')" id="button-ad-{{$special->id}}" class="ad w3-button w3-block w3-left-align">Company Ads<span class="badge-count">{{ count($ads) }}</span></button>
      <div id="ad-{{$special->id}}" class="w3-container w3-hide">
          <br/>
        @include( 'dashboard.agency._block_agency_ads' )
      </div>
  </div>
  <div class="client-details authors-wrapper">
      <?php
        $authors = \App\Author::where( 'status_id', 0 )
          ->where( 'company_id', $special->id )
          ->orderBy( 'id', 'DESC' )
          ->get();
      ?>
      <button onclick="myFunction('author-{{$special->id}}')" id="button-author-{{$special->id}}" class="author w3-button w3-block w3-left-align">Authors<span class="badge-count">{{ count($authors) }}</span></button>
      <div id="author-{{$special->id}}" class="w3-container w3-hide">
        @include( 'dashboard.agency._block_agency_authors' )
      </div>
  </div>
  <div class="client-details articles-wrapper">
      <?php
        $articlesCurrent = \App\Article::with('category')
          ->where( 'status_id', 0 )
          ->where( 'publish_status_id', 1 )
          ->where( 'company_id', $special->id )
          ->orderBy( 'id', 'DESC' )
          ->get();
      
      $articlesPending = \App\Article::with('category')
          ->where( 'status_id', 1 )
          ->where( 'publish_status_id', 1 )
          ->where( 'company_id', $special->id )
          ->orderBy( 'id', 'DESC' )
          ->get();
      
      $articles = count($articlesPending) + count($articlesCurrent);
      ?>
      <button onclick="myFunction('article-{{$special->id}}')" id="button-article-{{$special->id}}" class="article w3-button w3-block w3-left-align">Articles<span class="badge-count">{{ $articles }}</span></button>
      <div id="article-{{$special->id}}" class="w3-container w3-hide">
        @include( 'dashboard.agency._block_agency_recent_articles' )
      </div>
  </div>
  <div class="client-details videos-wrapper">
      <?php
        $videos = \App\Video::where( 'company_id', $special->id )
          ->orderBy( 'id', 'DESC' )
          ->get();
      ?>
      <button onclick="myFunction('video-{{$special->id}}')" id="button-video-{{$special->id}}" class="video w3-button w3-block w3-left-align">Videos<span class="badge-count">{{ count($videos) }}</span></button>
      <div id="video-{{$special->id}}" class="w3-container w3-hide">
        <br/>
        @include( 'dashboard.agency._block_agency_videos' )
      </div>
  </div>
</div>
@endforeach()

<script>
    function myFunction(id) {
        var x = document.getElementById(id);
		var y = document.getElementById('button-'+id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
			y.className += " open";
        } else { 
            x.className = x.className.replace(" w3-show", "");
			y.className = y.className.replace(" open", "");
        }
    }
    
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure you want to remove this client?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
    
</script>