function applyFilters() {
    var selectedGenre = document.getElementById("select-genre").value;
    var selectedCountry = document.getElementById("select-country").value;
    var selectedYear = document.getElementById("select-year").value;

    var url = "filter.php?";
    if (selectedGenre !== "") {
        url += "genre=" + encodeURIComponent(selectedGenre) + "&";
    }
    if (selectedCountry !== "") {
        url += "country=" + encodeURIComponent(selectedCountry) + "&";
    }
    if (selectedYear !== "") {
        url += "year=" + encodeURIComponent(selectedYear) + "&";
    }

    window.location.href = url.slice(0, -1);
}