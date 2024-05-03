
function calculateAge() {
    var dob = new Date(document.getElementById('inp3').value);
    var today = new Date();
    var age = today.getFullYear() - dob.getFullYear();
    var m = today.getMonth() - dob.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
        age--;
    }
    if(isNaN(age)) {
        document.getElementById('inp3').nextElementSibling.textContent = "Enter valid age";
    } else {
        document.getElementById('inp3').nextElementSibling.textContent = `Age : ${age}`;
    }
}
let inp1 = document.getElementById("inp1");

inp1.addEventListener("keyup",()=>{
    let inp = document.getElementById("inp1").value;
    for(i = 0; i < inp.length; i++)
    {
        if(!((inp[i]<='z' && inp[i]>='a') || (inp[i])<='A' && inp[i]>='Z'))
        {
            document.getElementById("name").style.visibility = "visible";
        }
        else{
            document.getElementById("name").style.visibility = "hidden";
        }
    }
});