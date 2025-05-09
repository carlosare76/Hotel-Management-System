var detailpanel = document.getElementById("guestdetailpanel");

adduseropen = () => {
    detailpanel.style.display = "flex";
}
adduserclose = () => {
    detailpanel.style.display = "none";
}

// Lógica de búsqueda usando JS
const searchFun = () => {
    let filter = document.getElementById('search_bar').value.toUpperCase();
    let myTable = document.getElementById("table-data");
    let tr = myTable.getElementsByTagName('tr');

    for (var i = 0; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td')[1];
        if (td) {
            let textvalue = td.textContent || td.innerHTML;
            tr[i].style.display = textvalue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
}
