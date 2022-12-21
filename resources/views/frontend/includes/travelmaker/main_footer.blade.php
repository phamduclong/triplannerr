<footer class="footer sec-space notranslate">
  <div class="container-fluid">
    <div class="contact_section">
      <div class="row">
       <div class="col-md-12">
       
          <div class="row">
            <div class="col-md-6">
              <div class="about-sec" style="text-align: center;">
                <img class="img-footer" src="{{ url('img/frontend/logo-footer.png') }}">
                <p>Triplannerr is a tool that you can use to organize travel and holidays independently.</p>
                <p>It is based on the free and spontaneous sharing of information.</p>
                <p>It is free and always will be.</p>
              </div>
            </div>
            <div class="col-md-6" style="text-align: right;padding-right: 120px;">
              <div class="quick-link">
                <h3>Quick Links</h3>
                <ul class="left_link">
                  <li><a href="{{url('about-us')}}">About us</a></li>
                  <li><a href="{{url('discover')}}">Discover</a></li>
                  <li><a href="{{url('why_travel')}}">Why Travel Maker</a></li>
                  <li><a href="{{ url('contact') }}">Contact Us</a></li>
                </ul>

                <div class="social_icon">
                  <a href="{{isset(get_social_data()->fb_url)?get_social_data()->fb_url:''}}"><i class="fa fa-facebook"></i></a>
                  <a href="{{isset(get_social_data()->twitter_url)?get_social_data()->twitter_url:''}}"><i class="fa fa-twitter"></i></a>
                  <a href="{{isset(get_social_data()->instagram_url)?get_social_data()->instagram_url:''}}"><i class="fa fa-instagram"></i></a>
                  <a href="{{isset(get_social_data()->tiktok_url)?get_social_data()->tiktok_url:''}}"><i class="fa fa-youtube-play"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="copyright_section">
            <div class="row">
              <div class="col-md-6">
                <p>Brain and Heart SH.P.K. ©{{ date('Y') }}. All Rights Reserved</p>
              </div>
              <div class="col-md-6">
                <div class="copy_links">
                  <a href="{{url('pages/policy')}}">Privacy & Policy</a>
                </div>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>
  </div>
 </div>
</footer>

<script>
var title = 'Triplannerr';

setTimeout(function(){
    $(document).on('click','.facebook-share',function() {   
      var shareUrl = window.location.href;
      link = 'https://www.facebook.com/sharer/sharer.php?u='+shareUrl+'&t=Share';
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");

    });

    $(document).on('click','.twitter-share',function() {    
      var shareUrl = window.location.href;
      link = 'http://twitter.com/share?url='+shareUrl+'&text='+title;
      window.open(link, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=400,height=400");

    }); 
},500); 

</script>


