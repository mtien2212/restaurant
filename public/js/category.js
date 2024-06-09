function insertValidate() {
    if( document.getElementById("name1").value == "" ) {
        document.getElementById("errorname1").classList.add("error");
        return false;
     }
}
function updateValidate(x) {
    if( document.getElementById("name"+x).value == "" ) {
        document.getElementById("errorname"+x).classList.add("error");
        return false;
     }
}