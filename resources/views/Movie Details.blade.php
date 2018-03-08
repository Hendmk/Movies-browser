@extends('layout.Master', ['title' => $title])

@section('content')


<!-- !PAGE CONTENT! -->
<input id="searchTxt" type="text" name="search" placeholder="Search.." onkeyup="SearchMovies()">


<div  class="w3-main w3-content w3-padding borderIn" style="max-width:1200px;">
  <div class="w3-row-padding w3-padding-16 w3-center s-quarter" style="width: 10% auto; text-align: left;">
<div id="MovieDetails" ></div>
<div id="favorite" ></div>
  </div>
  <br>
  <div id="MovieCast" class="w3-row-padding w3-padding-16 w3-center borderIn"></div>
<br>
  <div id="SimilarMovieList" class="w3-row-padding w3-padding-16 w3-center borderIn"></div>
</div>
<br><br>
<!-- End page content -->


</body>
</html>
<script>
$(this).ready(function() {
startPage();
});

function startPage(){
  MovieDetails({{$id}});
  MovieCast({{$id}});
  SimilarMovie({{$id}});
}

var like;

    function MovieDetails(id){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myObj = JSON.parse(this.responseText);
          var x = "  <h1>Details</h1> ";
          //Here
                 x+="<img src='https://image.tmdb.org/t/p/w500/"+myObj.poster_path +"' style='width:25%'>"+
                     "<h3>"+ myObj.title +"</h3>"+
                     "<p><strong>"+myObj.overview +"</strong></p>"+
                     "<p><strong>Genres: </strong>";

                     for (i in myObj.genres) {
                       x += myObj.genres[i].name + ", ";
                     }
                     document.getElementById("MovieDetails").innerHTML = x +"</p>";
                     checkIsfavorite(id);
          //stop

        }

      };
      xhttp.open("GET", "/RetriveMovieDetails/"+id, true);
      xhttp.send();

    }//End MovieDetails function

    function MovieCast(id){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myObj = JSON.parse(this.responseText);
          var x ="  <h1>Cast</h1> ";
          //Here
          for(i=0 ; i<myObj['cast'].length  && i<6; i++){
          x+=  "<div class='w3-quarter'>"+
              "<img src='https://image.tmdb.org/t/p/w500/"+myObj.cast[i].profile_path +"' style='width:20%'>"+
              "<h3>"+myObj.cast[i].name +"</h3>"+
              "<p>Character: "+myObj.cast[i].character +"</p>"+
              "<a href='{{'/RetriveCastDetails/'}}"+myObj.cast[i].id+"' class='btnBrowser' style='text-decoration: none;'>See More!</a>"+
              "</div>";
          }
          //stop
          document.getElementById("MovieCast").innerHTML = x;
        }
      };
      xhttp.open("GET", "/RetriveMovieCast/"+id, true);
      xhttp.send();

    }//End MovieCast function



      function SimilarMovie(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            var x = "  <h1>Similar Movie</h1> ";
            //Here
            for(i=0 ; i<myObj['results'].length && i<6; i++){
            x+="<div class='w3-quarter'>"+
                "<img src='https://image.tmdb.org/t/p/w500/"+myObj.results[i].poster_path +"' style='width:70%'>"+
                "<h3>"+myObj.results[i].title +"</h3>"+
                "<p style='	text-align: justify;'>"+myObj.results[i].overview +"</p>"+
                "<a href='{{'/MovieDetails/'}}"+myObj.results[i].id+"' class='btnBrowser' style='text-decoration: none;'>Details!</a>"+
              "</div>";
            }
            //stop
            document.getElementById("SimilarMovieList").innerHTML += x +"</p>";
          }
        };
        xhttp.open("GET", "/RetriveSimilarMovies/"+id, true);
        xhttp.send();

        }



        function SearchMovies(){
          var str = document.getElementById("searchTxt").value;
          if(str !=  ""){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var myObj = JSON.parse(this.responseText);
              var x = "";
              //Here
              for(i=0 ; i<myObj['results'].length; i++){

              x+="<div class='w3-quarter'>"+
                  "<img src='https://image.tmdb.org/t/p/w500/"+myObj.results[i].poster_path +"' style='width:70%'>"+
                  "<h3>"+myObj.results[i].title +"</h3>"+
                  "<p style='	text-align: justify;'><strong>"+myObj.results[i].overview +"</strong></p>"+
                  "<a href='{{'/MovieDetails/'}}"+myObj.results[i].id+"' class='btnBrowser' style='text-decoration: none;'>Details!</a>"+
                "</div>";
              }
              //stop
              document.getElementById("MovieDetails").innerHTML = "<h1>Search Results</h1>";
              document.getElementById("MovieCast").innerHTML = x;
              document.getElementById("SimilarMovieList").innerHTML = "";
            }
          };
          xhttp.open("GET", "/search/"+str, true);
          xhttp.send();

        }else {
          document.getElementById("MovieCast").innerHTML = "";
          startPage();
        }
          }

          function checkIsfavorite(id){

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                var myObj = JSON.parse(this.responseText);
                var x = "";
                //Here
                like =  myObj.item_present;
                if(like){
                document.getElementById("favorite").innerHTML +="</p> <li onclick='Addfavorite("+id+")' class='fa fa-gittip' style='font-size:36px;color:#ff1a66' style='text-decoration: none;'></li>";
              } else {
                document.getElementById("favorite").innerHTML +="</p> <li onclick='Addfavorite("+id+")' class='fa fa-gittip' style='font-size:36px;color:#000000' style='text-decoration: none;'></li>";
              }

                //stop

              }
            };
            xhttp.open("GET", "/checkIsfavorite/"+id, true);
            xhttp.send();

            }



            function Addfavorite(id){

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  var myObj = JSON.parse(this.responseText);

                  document.getElementById("favorite").innerHTML ="</p> <li class='fa fa-gittip' style='font-size:36px;color:#ff1a66' style='text-decoration: none;'></li>";

                  //stop

                }
              };
              xhttp.open("GET", "/checkIsfavorite/"+id, true);
              xhttp.send();

              }

</script>
@endsection
