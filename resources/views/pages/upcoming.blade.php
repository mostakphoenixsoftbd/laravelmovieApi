@extends('layouts.frontend')
@section('styles')

@endsection


@section('content')
    <div class="container" id="app">

      <h1 class="pageTitleEveryPage text-info text-center" >@{{title}}</h1>
      <hr>
                    @component('components.pagination')
                    @endcomponent
                    <div class="row">
                     <div class='col-md-3 mb-3'  v-for="(article,index) in articles" :key="index">
                            <!-- Card -->
                            <div class="card" v-if="article.name != ''">
                            <!-- Card image -->
                            <a :href="`/single/media/${article.id}`">
                              <img class="card-img-top" :src="`https://image.tmdb.org/t/p/w500/${article.poster_path}`" alt="Card image cap">
                            </a>
                            </div>
                            <!-- Card -->
                        </div>
                    </div>
                    @component('components.pagination')
                    @endcomponent
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript">
        new Vue({
          el:'#app',
          data:{
            title:"Upcoming Movies",
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
                               "url":'https://api.themoviedb.org/3/movie/upcoming?api_key=c644e54334668dccc41ba9804d21827f&language=en-US&page=1',
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
                               console.log(self.articles);
                             });
          }
        })
    </script>
@endsection
