@extends('layouts.frontend')
@section('styles')
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/docs.theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">




    <style>
        .owl-stage-outer.owl-height {
            height: 450px !important;
        }
    </style>
@endsection


@section('content')
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-6 mt-5">

                <!--Section: Content-->
                <section class="mx-md-5 dark-grey-text">

                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-12">

                    <!-- Card -->
                    <div class="card card-cascade wider reverse">

                        <!-- Card image -->
                        <div class="view view-cascade overlay">
<img class="card-img-top" :src="`https://image.tmdb.org/t/p/w500/${singleArticle.poster_path}`" alt="Sample image">
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                        </div>

                        <!-- Card content -->
                        <div class="card-body card-body-cascade text-center">

                        <!-- Title -->
                        <h3 class="font-weight-bold"><a>@{{singleArticle.title}}</a></h3>
                        <!-- Data -->
                        <p>Status <a><strong>@{{singleArticle.status}}</strong></a>, @{{singleArticle.release_date}}</p>


                        <ul class="list-group">
                            <li class="list-group-item">Language: @{{singleArticle.original_language}}</li>
                            <li class="list-group-item">Run Time: @{{singleArticle.runtime}}</li>
                            <li class="list-group-item">Popularity: @{{singleArticle.popularity}}</li>
                            <li class="list-group-item">Adult Content: @{{singleArticle.adult}}</li>
                            <li class="list-group-item" v-if='details.budget > 0 '>Budget: @{{ details.budget }}</li>
                            <li class="list-group-item" v-if='details.homepage !=""'>Website: @{{ details.homepage }}</li>
                            <li class="list-group-item" v-if='details.revenue > 0 '>Revenue: @{{ details.revenue }}</li>
                            <li class="list-group-item" v-if='details.tagline !="" '>Tagline: @{{ details.tagline }}</li>
                            <li class="list-group-item" v-if='details.vote_average !="" '>
                                Rating:@{{ details.vote_average }} / 10</li>
                            <li class="list-group-item" v-if='details.budget > 0 '>Budget: @{{ details.budget }}</li>
                        </ul>

                        </div>
                        <!-- Card content -->

                    </div>
                    <!-- Card -->

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

                </section>
                <!--Section: Content-->
            </div>
            <div class="col-md-6 mt-5">
                <div v-for='(video,index) in videos' :key='index'>
                    <div class="container z-depth-1 ">
                    <!-- Section: Block Content -->
                    <iframe width="100%" height="350px" id="player" class="embed-responsive-item" :src="`https://www.youtube.com/embed/${video.key}`" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

                    <!-- Section: Block Content -->
                    </div>

                </div>
            </div>

            <!-- Excerpt -->
                    <div class="mt-5">
                        <h2 class="text-info">Overview</h2>
                        <p> @{{singleArticle.overview}}</p>
                        <br>
                        <hr>
                        <br>
                    </div>
        </div>


          <section>
            <div class="row">
              <div class="large-12 columns">
                <div class="owl-carousel owl-theme">

                </div>
              </div>
            </div>
          </section>


          <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://rock-7.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


   </div>


@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

    <script src="{{ asset('assets/js/owl.carousel.js') }}"></script>
    <script>
        $(function(){

            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:10,
                items:3,
                autoplay:true,
                autoplayTimeout:2000,
                autoHeight:true
            });
        })
    </script>
    <script type="text/javascript">
        new Vue({
          el:'#app',
          data:{
            title:"MovieDB Api Laravel Vue Project",
            singleArticle:[],
            videos:[],
            similars:[],
            details:[]
          },
          created(){
                            var self = this;
                            let presentUrl = window.location.href;
                            let newData = presentUrl.split("/");
                            let id = newData[newData.length-1];
                            var settings = {
                               "async": true,
                               "crossDomain": true,
                               'url':'https://api.themoviedb.org/3/movie/'+id+'?api_key=c644e54334668dccc41ba9804d21827f&language=en-US',
                               //'url':'https://api.themoviedb.org/3/trending/all/day?api_key=c644e54334668dccc41ba9804d21827f&language=en-US&page='+pageNumber,
                               "method": "GET",
                               "headers": {
                                 "content-type": "application/json;charset=utf-8",
                                 "authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNjQ0ZTU0MzM0NjY4ZGNjYzQxYmE5ODA0ZDIxODI3ZiIsInN1YiI6IjVlOGMyODk0YWQ4N2Y3MDAxOTZhNDQzMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ri4YE4GrFoQOAb5U9lGiM0iHEGGm14_NuznsnIM_eV4"
                               },
                               "processData": false,
                               "data": "{}"
                             }

                             $.ajax(settings).done(function (response) {
                               self.singleArticle = response;
                               //console.log(response);
                             });


                            setTimeout(()=>{
                              var video = {
                                "async": true,
                                "crossDomain": true,
                                "url":'https://api.themoviedb.org/3/movie/'+id+'/videos?api_key=c644e54334668dccc41ba9804d21827f&language=en-US',
                                "method": "GET",
                                "headers": {
                                  "content-type": "application/json;charset=utf-8",
                                  "authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNjQ0ZTU0MzM0NjY4ZGNjYzQxYmE5ODA0ZDIxODI3ZiIsInN1YiI6IjVlOGMyODk0YWQ4N2Y3MDAxOTZhNDQzMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ri4YE4GrFoQOAb5U9lGiM0iHEGGm14_NuznsnIM_eV4"
                                },
                                "processData": false,
                                "data": "{}"
                              }

                              $.ajax(video).done(function (response) {
                                self.videos = response.results;
                                    //console.log(self.videos);
                              });
                            },1000)


                            setTimeout(()=>{
                                var similar = {
                                    "async": true,
                                    "crossDomain": true,
                                    "url":'https://api.themoviedb.org/3/movie/'+id+'/similar?api_key=c644e54334668dccc41ba9804d21827f&language=en-US',
                                    "method": "GET",
                                    "headers": {
                                      "content-type": "application/json;charset=utf-8",
                                      "authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNjQ0ZTU0MzM0NjY4ZGNjYzQxYmE5ODA0ZDIxODI3ZiIsInN1YiI6IjVlOGMyODk0YWQ4N2Y3MDAxOTZhNDQzMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ri4YE4GrFoQOAb5U9lGiM0iHEGGm14_NuznsnIM_eV4"
                                    },
                                    "processData": false,
                                    "data": "{}"
                                  }

                                  $.ajax(similar).done(function (response) {
                                    self.similars = response.results;
                                    //console.log(self.similars);

                                    for(let i=0; i<self.similars.length; i++){
                                       //console.log(self.similars[i].title);
                                        data = '<div class="item">'+
                                         '<img width="400px"  src="https://image.tmdb.org/t/p/w500/'+self.similars[i].poster_path+'">'+
                                        +'<h4>'+self.similars[i].title+'</h4>'+
                                        '</div>';
                                        $('.owl-carousel').owlCarousel('add',data).owlCarousel('refresh');
                                    }



                                  });
                            },1500);


          },
          mounted(){
            let self = this;
            let presentUrl = window.location.href;
            let newData = presentUrl.split("/");
            let id = newData[newData.length-1];
            var detailOfMovie = {
                "async": true,
                "crossDomain": true,
                "url":'https://api.themoviedb.org/3/movie/'+id+'?api_key=c644e54334668dccc41ba9804d21827f&language=en-US',
                "method": "GET",
                "headers": {
                  "content-type": "application/json;charset=utf-8",
                  "authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNjQ0ZTU0MzM0NjY4ZGNjYzQxYmE5ODA0ZDIxODI3ZiIsInN1YiI6IjVlOGMyODk0YWQ4N2Y3MDAxOTZhNDQzMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ri4YE4GrFoQOAb5U9lGiM0iHEGGm14_NuznsnIM_eV4"
                },
                "processData": false,
                "data": "{}"
              }

              $.ajax(detailOfMovie).done(function (response) {
                self.details = response;
                console.log(response);


              });
          }

        })

    </script>

@endsection
