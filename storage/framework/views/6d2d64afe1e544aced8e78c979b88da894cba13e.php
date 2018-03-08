<?php $__env->startSection('content'); ?>


<!-- !PAGE CONTENT! -->
<input id="searchTxt" type="text" name="search" placeholder="Search.." onkeyup="SearchMovies()">


<div  class="w3-main w3-content w3-padding borderIn" style="max-width:1200px;">
  <div id="PageTitle" class="w3-row-padding w3-padding-16 w3-center s-quarter" style="width: 10% auto; text-align: left;"></div>

  <div id="MovieList" class="w3-row-padding w3-padding-16 w3-center">

</div>
</div>
<br><br>
<!-- End page content -->




</body>
</html>
<script>
$(this).ready(function() {
getNewMovies()
});

function getNewMovies(){

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
            "<p style='	text-align: justify;'>"+myObj.results[i].overview +"</p>"+
            "<a href='<?php echo e('/MovieDetails/'); ?>"+myObj.results[i].id+"' class='btnBrowser' style='text-decoration: none;'>Details!</a>"+
          "</div>";
        }
        //stop
        document.getElementById("PageTitle").innerHTML ="<h1>Movies List</h1>";
        document.getElementById("MovieList").innerHTML = x;
      }
    };
    xhttp.open("GET", "/getStart", true);
    xhttp.send();
  }// End get New Movies function


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
            "<a href='<?php echo e('/MovieDetails/'); ?>"+myObj.results[i].id+"' class='btnBrowser' style='text-decoration: none;'>Details!</a>"+
          "</div>";
        }
        //stop
        document.getElementById("PageTitle").innerHTML ="<h1>Search Results</h1>";
        document.getElementById("MovieList").innerHTML = x;
      }
    };
    xhttp.open("GET", "/search/"+str, true);
    xhttp.send();

  }else {
    getNewMovies();
  }
    }




</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.Master', ['title' => $title], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>