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

function searchData() {
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

// var array_length = 50;
// var tab_size = 5;
// var start_index = 1;
// var end_index = 5;
// var current_index = 1;
// var max_index = 4;

// function displayIndexButtons() {
//     $("#pagination button").remove();
//     $("#pagination").append('<button><<</button>');

//     for (i = 1; i <= max_index; i++) {
//         $("#pagination").append('<button index = "' + i + '">' + i + '</button>');
//     }
//     $("#pagination").append('<button>>></button>');
//     highlight();
// }
// displayIndexButtons();

// function highlight() {
//     start_index = ((current_index - 1) * tab_size) + 1;
//     end_index = (start_index + tab_size) - 1;
//     if (end_index > array_length) {
//         end_index = array_length;
//     }
//     $("#footer span").text('Showing '+start_index+' to '+end_index+' of '+array_length+' entries');
//     $("#pagination button").removeClass('active');
//     $("#pagination button[index='" + current_index + "']").addClass('active');
// }

// var current_page = 1;
// var records_per_page = 10;

// function prevPage() {
//     if (current_page > 1) {
//         current_page--;
//         changePage(current_page);
//     }
// }

// function nextPage() {
//     if (current_page < numPages()) {
//         current_page++;
//         changePage(current_page);
//     }
// }

// function changePage(page) {
//     var btn_next = document.getElementById("next");
//     var btn_prev = document.getElementById("prev");
//     var table = document.getElementById("dataTable");
//     var rows = table.getElementsByTagName("tr");
//     var numPages = Math.ceil(rows.length / records_per_page);

//     if (page < 1) page = 1;
//     if (page > numPages) page = numPages;

//     for (var i = 1; i < rows.length; i++) {
//         rows[i].style.display = "none";
//     }

//     for (var i = (page - 1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
//         if (rows[i]) {
//             rows[i].style.display = "";
//         }
//     }

//     btn_prev.style.visibility = page == 1 ? "hidden" : "visible";
//     btn_next.style.visibility = page == numPages ? "hidden" : "visible";
// }

// window.onload = function () {
//     changePage(1);
// };

// document.getElementById("prev").addEventListener("click", prevPage);
// document.getElementById("next").addEventListener("click", nextPage);
