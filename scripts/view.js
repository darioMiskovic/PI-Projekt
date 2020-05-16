//View Ctrl
const View = (function () {
  const domElements = {
    form: document.getElementById("form"),

    movieInput: document.getElementById("ime-filma"),
    container: document.querySelector(".container"),
    icons: document.querySelector(".menu-icons"),
    movies: document.getElementById("movies"),
    series: document.getElementById("series"),
    home: document.getElementById("home"),
    topRates: document.getElementById("topRated"),
    favorite: document.getElementById("favorite"),
  };

  function cleanInput() {
    domElements.movieInput.value = "";
  }

  function cleanContainer() {
    const card = document.querySelectorAll(".card");
    [...card].forEach((el) => domElements.container.removeChild(el));
  }

  loadinfoID = () => document.querySelector(".poster").dataset.id;

  const limitTile = (title, limit = 20) => {
    const newTitle = [];
    if (title.length > limit) {
      title.split(" ").reduce((acc, cur) => {
        if (acc + cur.length <= limit) {
          newTitle.push(cur);
        }
        return acc + cur.length;
      }, 0);

      return `${newTitle.join(" ")} ...`;
    }
    return title;
  };

  return {
    domElements,
    cleanInput,
    cleanContainer,
    loadinfoID,
    limitTile,
  };
})();
