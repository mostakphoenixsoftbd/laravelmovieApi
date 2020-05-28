@extends('layouts.frontend')

@section('styles')

@endsection


@section('content')
<div class="container" id="app">
<h1>@{{title}}</h1>
<div class="row">
<!-- m-1, mb-3 -->
<div class="card col-md-3 mb-3" v-for="(article, index) in articles" :key="index">
<!-- Card -->
{{-- @{{ article }} --}}
<!-- Card image -->
<a :href="`/single/media/${article.id}`">
    <img class="card-img-top" :src="`https://image.tmdb.org/t/p/w500/${article.poster_path}`" alt="Card image cap">
</a>
    <!-- Card content -->
{{-- <div class="card-body">

  <!-- Title -->
  <h4 class="card-title" v-if="article.name != ''">@{{article.name }}</h4>
  <h4 class="card-title" v-if="article.title != ''">@{{article.title }}</h4>
  <!-- Text -->
  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
    content.</p>
  <!-- Button -->
  <a href="#" class="btn btn-primary">@{{ article.media_type }}</a>
<hr>


<small v-if="article.original != ''">Original Language: @{{article.original_language }}</small><hr>
<small v-if="article.vote_average != ''">Vote Ave: @{{article.vote_average }}</small><hr>
<small v-if="article.vote_count != ''">Total Vote: @{{article.vote_count }}</small>

</div> --}}
  <!-- Card -->
{{-- <div class="card-body">
    @{{ article.name }}
    {{-- @{{ article }} --}}

{{-- </div> --}}



</div>

</div>

</div>




@endsection


@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript">

new Vue({
  el: '#app',
  data: {
    title:"MovieDB Api Laravel Vue Project",
            articles:[]
          },
          created(){
                          var self = this;
                          let pageNumber = 1;
                          let presentUrl = window.location.href;
                          let newData = presentUrl.split("=");
                          pageNumber = newData[newData.length-1];
                          console.log(pageNumber);

                          if(!$.isNumeric(pageNumber)){
                             pageNumber = 1;
                          }



                            var settings = {
                               "async": true,
                               "crossDomain": true,
                               'url':'https://api.themoviedb.org/3/trending/all/day?api_key=c644e54334668dccc41ba9804d21827f&language=en-US&page='+pageNumber,
                               "method": "GET",
                               "headers": {
                                 "content-type": "application/json;charset=utf-8",
                                 "authorization": "Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJjNjQ0ZTU0MzM0NjY4ZGNjYzQxYmE5ODA0ZDIxODI3ZiIsInN1YiI6IjVlOGMyODk0YWQ4N2Y3MDAxOTZhNDQzMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.Ri4YE4GrFoQOAb5U9lGiM0iHEGGm14_NuznsnIM_eV4"
                               },
                               "processData": false,
                               "data": "{}"
                             }

                             $.ajax(settings).done(function (response) {
                               self.articles = response.results;

                               for(let i=0; i<self.articles.length; i++){
                                //console.log(self.similars[i].title);
                                 data = '<div class="item">'+
                                  '<img width="100%"  src="https://image.tmdb.org/t/p/original/'+self.articles[i].backdrop_path+'">'+
                                 +
                                 '</div>';
                                 //$('.owl-carousel').owlCarousel('add',data).owlCarousel('refresh');
                             }




                               console.log(self.articles);
                             });
          }
        })

// $ (function(){
// console.log("Its works!");

// })

</script>

@endsection
