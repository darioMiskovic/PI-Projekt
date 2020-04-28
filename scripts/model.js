//Model Crl
const Model = (function() {
  const key = "85341b33";

  //Search only movies
  async function onlyMovies(q) {
    return await axios.get(
      `http://www.omdbapi.com/?apikey=${key}&s=${q}&type=movie`
    );
  }

  //Search only series
  async function onlySeries(q) {
    return await axios.get(
      `http://www.omdbapi.com/?apikey=${key}&s=${q}&type=series`
    );
  }

  //Sort series or movies
  async function sortType(q, type) {
    return await axios.get(
      `http://www.omdbapi.com/?apikey=${key}&s=${q}&type=${type}`
    );
  }

  //Search by ID
  async function searchById(id) {
    const res = await axios.get(
      `http://www.omdbapi.com/?apikey=${key}&i=${id}`
    );
    return await res.data;
  }

  function updateFavoritePage(movieID, cb) {
    searchById(movieID).then(item => {
      cb(item);
    });
  }

  //Check poster img
  function checkPoster(posterUrl) {
    let posterSrc;

    posterUrl === "N/A"
      ? (posterSrc = "../img/nema-slike.png")
      : (posterSrc = posterUrl);

    return posterSrc;
  }

  return {
    onlyMovies,
    onlySeries,
    sortType,
    searchById,
    updateFavoritePage,

    checkPoster
  };
})();
