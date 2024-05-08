function alphabetValidation(value, a) {
    for (i = 0; i < value.length; i++) {
        if ((value[i] == ' ') || (value[i] >= 'a' && value[i] <= 'z') || (value[i] >= 'A' && value[i] <= 'Z')) {
            document.getElementsByClassName("al-msgs")[a].style.visibility = "hidden";
        }
        else {
            document.getElementsByClassName("al-msgs")[a].style.visibility = "visible";
        }
    }
}

function deptNameValidation(value) {
    for (i = 0; i < value.length; i++) {
        if ((value[i] == ' ') || (value[i] == '.') || (value[i] >= 'a' && value[i] <= 'z') || (value[i] >= 'A' && value[i] <= 'Z')) {
            document.getElementsByClassName("dept-msg")[0].style.visibility = "hidden";
        }
        else {
            document.getElementsByClassName("dept-msg")[0].style.visibility = "visible";
        }
    }
}

function streetValidation(value, a) {
    for (i = 0; i < value.length; i++) {
        if ((value[i] == ' ') || (value[i] >= 'a' && value[i] <= 'z') || (value[i] >= 'A' && value[i] <= 'Z') || (value[i] <= '9' && value[i] >= '0')) {
            document.getElementsByClassName("st-msgs")[a].style.visibility = "hidden";
        }
        else {
            document.getElementsByClassName("st-msgs")[a].style.visibility = "visible";
        }
    }
}

function mobileNumberValidation(element) {
    var number = element.value.trim();
    var pattern = /^[6-9]\d{9}$/;

    if (!pattern.test(number)) {
        document.getElementsByClassName("mob-msgs")[0].style.visibility = "visible";
    }
    else {
        document.getElementsByClassName("mob-msgs")[0].style.visibility = "hidden";
    }
}

function calculateAge(element) {
    var dob = new Date(element.value);
    var today = new Date();
    var age = today.getFullYear() - dob.getFullYear();
    var m = today.getMonth() - dob.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
        age--;
    }
    if (isNaN(age)) {
        element.nextElementSibling.textContent = "Enter valid age";
        element.nextElementSibling.style.color = "red";
        element.nextElementSibling.style.fontSize = "15px";
    } else {
        element.nextElementSibling.textContent = `Age : ${age}`;
        element.nextElementSibling.style.color = "green";
        element.nextElementSibling.style.fontSize = "17px";
    }
}
