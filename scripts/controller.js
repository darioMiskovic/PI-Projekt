//Controller
const Ctrl = (function(model, view) {
  //Get DOM Object from View Ctrl
  const domElements = view.domElements;

  //Events
  domElements.form.addEventListener("submit", getInputValue);
  domElements.form.addEventListener("submit", getInput);
  domElements.container.addEventListener("click", ShowList);
  domElements.container.addEventListener("click", goBack);

  // function for insert API results in DOM
  function insertMovie(movie) {
    if (movie.Title !== undefined) {
      let div = document.createElement("div");
      div.classList = "card";
      let html = `
    <div class="movie-img">
      <img src="${model.checkPoster(movie.Poster)}" id="posterInfo" data-id=${
        movie.imdbID
      } />
    </div>
  
    <h4 class="title-h" >${view.limitTile(movie.Title)}</h4>
    <div class="rate-date">
      <!--<div class="rate">
        <i class="fas fa-star star-icon"></i>
        <p class="rate-num">7.3/10</p>
      </div>-->
  
      <div class="date">
        <i class="far fa-calendar-alt date-icon"></i>
        <p class="date-num">${movie.Year}</p>
      </div>
    </div>
  
    `;
      div.innerHTML = html;

      domElements.icons === true
        ? (document.icons.style.display = "block")
        : false;

      domElements.container.insertAdjacentElement("beforeend", div);
    }
  }

  //Get input value and manipulate with DOM
  let saveInput;
  function getInputValue(e) {
    saveInput = domElements.movieInput.value;
    e.preventDefault();
  }

  function getInput() {
    view.cleanContainer();

    let cardMovies = model.onlyMovies(saveInput);
    let cardSeries = model.onlySeries(saveInput);

    [cardMovies, cardSeries].forEach(item => {
      item.then(res => {
        const data = res.data.Search;
        data.forEach(el => insertMovie(el));
        domElements.icons.style.display = "block";
      });
    });

    view.cleanInput();
  }

  //fun. for showing mov,ser or all
  function sortingType(query, type) {
    view.cleanContainer();
    let card = model.sortType(query, type);

    card.then(res => {
      const data = res.data.Search;

      data.forEach(el => insertMovie(el));
      domElements.icons.style.display = "block";
    });
  }

  //event for container
  function ShowList(e) {
    if (e.target.id === "movies") {
      sortingType(saveInput, "movie");
    } else if (e.target.id === "series") {
      sortingType(saveInput, "series");
    } else if (e.target.id === "home") {
      getInput();
    }
  }

  function cardInfo(arr) {
    let id = sessionStorage.getItem("movieId");
    // let id = view.loadinfoID();

    model.searchById(id).then(item => {
      const output = `
      <div class="container-info">
      <div class='child-info'>
          <div class="info-card">
          <div class="poster" data-id=${item.imdbID}><img src="${
        item.Poster
      }" /></div>

          <div class="info-movie">
            <div class="info-heading">
              <h2>${item.Title}</h2>
              <a href="#" id="favorite"><img src="#" class=${addClassFav(
                arr,
                id
              )}></a>
            </div>
              <ul>
                <li>Genre: ${item.Genre}</li>
                <li>Released: ${item.Released}</li>
                <li>IMDB Rating: ${item.imdbRating}</li>
                <li>Runtime: ${item.Runtime}</li>
                <li>Writer: ${item.Writer}</li>
                <li>Actors: ${item.Actors}</li>
              </ul>
            </div>
          </div>

          <div class="plot">
            <p class="plot-txt">
            ${item.Plot}
            </p>
            <a href="#" id="nazad">Nazad</a>
          </div>
          <div>
      </div>
      `;
      domElements.container.insertAdjacentHTML("afterbegin", output);
    });
  }

  //event for container
  function ShowList(e) {
    if (e.target.id === "movies") {
      sortingType(saveInput, "movie");
    } else if (e.target.id === "series") {
      sortingType(saveInput, "series");
    } else if (e.target.id === "home") {
      getInput();
    } else if (e.target.dataset.id) {
      sessionStorage.setItem("movieId", e.target.dataset.id);
    }
  }

  //add class to favorite's content
  function addClassFav(arr, id) {
    clasName = "";
    arr.indexOf(id) > -1 ? (clasName = "liked") : (clasName = "unliked");
    return clasName;
  }

  function updateFavorite(id) {
    model.updateFavoritePage(id, insertMovie);
  }

  //Go back btn
  function goBack(e) {
    if (e.target.id === "nazad") {
      //reload the page

      document.querySelector(".container-info").remove();
    } else {
      return false;
    }
  }

  return {
    cardInfo,
    updateFavorite,
    insertMovie,
    addClassFav
  };
})(Model, View);
