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

window.onload = function () {
    var warnings = document.getElementById("warnings")
    if (warnings) {
        setTimeout(() => {
            warnings.innerText = "";
        }, 5000);
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

function reload() {
    console.log("hi");
    window.location.reload();
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