// all javascript functions and scripts stored here

/*
Location: index.html
Usage: print current date & time (format dd/mm/yyyy, hh:mm:ss)
*/
function getDateTime() { 
    var dt = new Date();
    document.getElementById("datetime").innerHTML = dt.toLocaleString();
    console.log('UPDATED')
}