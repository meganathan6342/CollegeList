let isVisible = false;

function collegeDetails(collegeId) {
    let collegeDetails = document.querySelectorAll('.college-details');
    collegeDetails.forEach(function (cd) {
        if (cd.getAttribute('data-college-id') === collegeId) {
            if (!isVisible) {
                cd.style.visibility = 'visible';
                isVisible = true;
            } else {
                cd.style.visibility = 'hidden';
                isVisible = false;
            }
        }
    });
}

function search() {
    let input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

window.onload = function () {
    var warnings = document.getElementsByClassName("warning");
    if (warnings) {
        setTimeout(() => {
            for (i = 0; i < warnings.length; i++) {
                warnings[i].textContent = "";
            }
        }, 3000);
    }
}

function shuffle(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir = "asc",
        switchcount = 0;
    table = document.getElementById("dataTable");
    switching = true;
    while (switching) {
        switching = false;
        rows = document.querySelectorAll("#dataTable tr");
        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;
            x = rows[i].querySelectorAll("#dataTable td")[n];
            console.log(rows[2]);
            y = rows[i + 1].querySelectorAll("#dataTable td")[n];
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount++;
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
function addPopup() {
    document.getElementById("addForm").style.visibility = "visible";
    document.getElementById("addForm").style.top = "50%";
    document.getElementById("backDrop").style.visibility = "visible";
}
function closePopup() {
    document.getElementById("addForm").style.visibility = "hidden";
    document.getElementById("addForm").style.top = "0%";
    document.getElementById("backDrop").style.visibility = "hidden";
}

function addUpdatePopup() {
    document.getElementById("updateForm").style.visibility = "visible";
    document.getElementById("updateForm").style.top = "50%";
    document.getElementById("backDrop").style.visibility = "visible";
}
function closeUpdatePopup() {
    document.getElementById("updateForm").style.visibility = "hidden";
    document.getElementById("updateForm").style.top = "0%";
    document.getElementById("backDrop").style.visibility = "hidden";
}

let name1 = document.getElementById("inp11");
name1.addEventListener("input", () => {
    let value = document.getElementById("inp11").value;
    for (i = 0; i < value.length; i++) {
        if (((value[i] <= 'Z' && value[i] >= 'A') || value[1] == '.') || ((value[i] <= 'z' && value[i] >= 'a') || value[1] == '.')) {
            document.getElementById("msg11").style.visibility = "hidden";
        }
        else {
            document.getElementById("msg11").style.visibility = "visible";
        }
    }
}, false);

let name2 = document.getElementById("inp21");
name1.addEventListener("input", () => {
    let value = document.getElementById("inp21").value;
    for (i = 0; i < value.length; i++) {
        if (((value[i] <= 'Z' && value[i] >= 'A') || value[1] == '.') || ((value[i] <= 'z' && value[i] >= 'a') || value[1] == '.')) {
            document.getElementById("msg21").style.visibility = "hidden";
        }
        else {
            document.getElementById("msg21").style.visibility = "visible";
        }
    }
}, false);

