function searchFunction() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toUpperCase();
    let card = document.querySelector('.card');
    let text = card.textContent || card.innerText;

    if (text.toUpperCase().indexOf(filter) > -1) {
        card.style.display = "";
    } else {
        card.style.display = "none";
    }
}
