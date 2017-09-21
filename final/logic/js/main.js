document.addEventListener('DOMContentLoaded', function(){


  var movieSection = document.querySelector('#movies-sec');
  if(movieSection){
    movieSection.addEventListener('click', sectionHandler);

    function sectionHandler(event){
      // console.log(event.target);

      if(event.target.classList.contains('movie__watched')){

        var btn = event.target;
        var movieId = btn.parentNode.getAttribute('data-movie-id');
        var watchedCounter = document.querySelector('#watched-count');
        var currentCount = watchedCounter.textContent;

        doAjax({
          method: 'POST',
          url: 'logic/watched_movie.php',
          data: 'watched_id=' + movieId,
          contentType: 'application/x-www-form-urlencoded',
          callback: function(){
            if( btn.classList.contains('movie__watched_active') ){
              btn.textContent = '(Не смотрел)';
              --currentCount;
            }else{
              btn.textContent = '(Смотрел)';
              ++currentCount;
            }

            btn.classList.toggle('movie__watched_active');
            watchedCounter.textContent = currentCount;

          }
        });

      }

      if(event.target.classList.contains('movie__del')){
        event.preventDefault();

        var movie = {};

        movie.container = event.target.parentNode;
        movie.id = movie.container.getAttribute('data-movie-id');
        movie.title = movie.container.firstElementChild.textContent;

        doAjax({
          method: 'POST',
          url: 'logic/del_movie.php',
          data: 'del_id=' + movie.id,
          contentType: 'application/x-www-form-urlencoded',
          callback: delMovie
        });

        function delMovie(response){
          if(response){
            alert('Фильм ' + movie.title + ' был успешно удален!');
            movie.container.nextElementSibling.remove() //Удалить горизонтальную линию
            movie.container.remove()
          }else{
            alert('Во время удаления фильма что-то пошло не так');
          }
        }

      }

    }

  }

  var moreBtn = document.querySelector('#showMore');
  if(moreBtn){

    moreBtn.addEventListener('click', showMoreMovies);

    var lastShownMovie = 0;

    function showMoreMovies(){
      lastShownMovie++;

      doAjax({
        method: 'POST',
        url: 'logic/more_movies.php',
        data: 'last_shown_movie=' + lastShownMovie,
        contentType: 'application/x-www-form-urlencoded',
        callback: appendMovie
      });

      function appendMovie(movie){
        movie = JSON.parse(movie);

        if(movie){
          var title = document.createElement('h4');
          var link = document.createElement('a');
          link.href = 'movies.php#movie_' + movie.id;
          link.textContent = movie.title;

          title.appendChild(link);
          document.body.appendChild(title);
        }else{
          moreBtn.textContent = 'Фильмов больше нет :(';
          moreBtn.setAttribute('disabled', 'disabled');
        }

      }

    }

  }

  if(document.forms.newMovie){
    document.forms.newMovie.addEventListener('submit', addNewMovie);

    function addNewMovie(event){
      event.preventDefault();

      var formData = new FormData(this);

      doAjax({
        method: 'POST',
        url: 'logic/add_movie.php',
        data: formData,
        callback: function(response){
          alert(response);
        }
      });

    }

  }
















});
