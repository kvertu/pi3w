var s = document.getElementById("searchbar");
s.addEventListener('keyup', (event) => {
    if (event.key === "Enter") {
        if (s.value != "") {
            window.location.replace("med.php?search=" + s.value);
        } else {
            window.location.replace("med.php");
        }
    }
});