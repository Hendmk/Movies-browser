@extends('layout.Master', ['title' => $title])

@section('content')


<!-- !PAGE CONTENT! -->
<input id="searchTxt" type="text" name="search" placeholder="Search.." onkeyup="SearchMovies()">


<div  class="w3-main w3-content w3-padding borderIn" style="max-width:1200px;">

  <div id="CastMovies" class="w3-row-padding w3-padding-16 w3-center s-quarter" style="width: 10% auto;"> </div>
<br>

<div id="MoviesCastIn" class="w3-row-padding w3-padding-16 w3-center borderIn"> </div>
<br>
</div>
<br><br>
<!-- End page content -->


</body>
</html>
<script>
$(this).ready(function() {
CastDetails({{$id}});
MovieCastIn({{$id}});
});

    function CastDetails(id){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myObj = JSON.parse(this.responseText);
          var x = "";
          //Here
                 x+="<img src='https://image.tmdb.org/t/p/w500/"+myObj.profile_path+"' style='width:25%'>"+
                     "<h3>"+ myObj.name +"</h3>"+
                     "<p><strong>Biography: </strong>"+myObj.biography +"</p>"+
                     "<p><strong>place of birth: </strong>"+myObj.place_of_birth+"</p>";
          //stop
          document.getElementById("CastMovies").innerHTML = "<h1>Details</h1>"+ x +"</p>";
        }
      };
      xhttp.open("GET", "/CastDetails/"+id, true);
      xhttp.send();

    }//End MovieDetails function

    function MovieCastIn(id){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var myObj = JSON.parse(this.responseText);
          var x = "";
          //Here
          for(i=0 ; i<myObj['cast'].length && i<6; i++){
          x+=  "<div class='w3-quarter'>"+
              "<img src='https://image.tmdb.org/t/p/w500/"+myObj.cast[i].poster_path +"'  style='width:50%'>"+
              "<h3>"+myObj.cast[i].original_title +"</h3>"+
              "<p><strong>Character: </strong>"+myObj.cast[i].character +"</p>"+
              "<p style='	text-align: justify;'><strong>overview: </strong>"+myObj.cast[i].overview+"</p>"+
              "<a href='{{'/MovieDetails/'}}"+myObj.cast[i].id+"' class='btnBrowser' style='text-decoration: none;'>Details!</a>"+
              "</div>";
          }
          //stop
          document.getElementById("MoviesCastIn").innerHTML ="<h1>Casted in</h1>"+ x ;
        }
      };
      xhttp.open("GET", "/MovieCastIn/"+id, true);
      xhttp.send();

    }//End MovieCast function


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
          document.getElementById("CastMovies").innerHTML ="<h1>Search Results</h1>";
          document.getElementById("MoviesCastIn").innerHTML = x;
        }
      };
      xhttp.open("GET", "/search/"+str, true);
      xhttp.send();

    }else {
      getNewMovies();
    }
      }




</script>
@endsection
