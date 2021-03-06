//funckja pobierania rekordów z bazy i wyświetlania listy w elemencie <ul>
function showTasks() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".todo-list").innerHTML = this.responseText; //wyświetlenie odpowiedzi serwera w elemencie ul
            let trashList = document.querySelectorAll(".todo-item i"); //handler do kosza
            let checkBoxList = document.querySelectorAll(".todo-item input"); //handler do checkbox`a
            //dodanie obsługi usuwania zadania po kliknięciu na kosz
            trashList.forEach(trash => trash.addEventListener("click", removeTask));
            //dodanie obsługi zmiany statusu zadania po kliknięciu na checkbox
            checkBoxList.forEach(checkBox => checkBox.addEventListener("click", updateTask));
        }
    }

    //wysłanie żądania CRUD typu 'read' do backendu
    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/crud.php?requestType=read", true);
    xmlhttp.send();

}

//funkcja dodawania nowego zadania do listy
function addTask() {
    let val = document.getElementById("input-field").value; //pole tekstowe

    if (!val) {
        return false; //walidacja pustego pola tekstowego
    } else {

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                showTasks(); //wyświetlenie aktualnej listy po dodaniu zadania
                document.getElementById("input-field").value = ""; //wyczyszczenie pola tekstowego po dodaniu zadania
            }
        }
        //wysłanie żądania CRUD typu 'create' o dodanie zadania z atrybutem Task zawierającym treść pola tekstowego (val)
        xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/crud.php?requestType=create&Task=" + val, true);
        xmlhttp.send();
    }

}

//funkcja usuwania zadania z listy
function removeTask() {
    let taskId = this.parentElement.getAttribute("id"); //pobranie id zadania, w którym kliknięto kosz

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            showTasks(); //wyświetlenie aktualnej listy po usunięciu zadania
        }
    }
    //wysłanie żądania CRUD typu 'delete' o usunięcie zadania o określonym id (TaskId)
    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/crud.php?requestType=delete&TaskId=" + taskId, true);
    xmlhttp.send();
}

//funkcja zmiany stanu zadania (do wykonania <-> wykonane)
function updateTask() {
    let taskId = this.parentElement.getAttribute("id"); //pobranie id zadania, w którym kliknięto checkbox

    //pobranie aktualnego stanu zadania - jeżeli zawiera atrybut 'checked' to status jest pusty(checkbox zaznaczony a zadanie ma status 'wykonane'), w przeciwnym wypadku status=null (checkbox odznaczony a status zadania 'do wykonania')
    let status = this.getAttribute("checked");

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            showTasks(); //wyświetlenie aktualnej listy po zmianie stanu zadania
        }
    }
    //wysłanie żądania CRUD typu 'update' o zmiane stanu zadania (isComplete) o określonym id (TaskId)
    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/crud.php?requestType=update&TaskId=" + taskId + "&isComplete=" + status, true);
    xmlhttp.send();
}

//funkcje i eventy wywołane po załadowaniu całego DOM
document.addEventListener("DOMContentLoaded", function () {
    showTasks(); //wyświetlenie aktualnej listy zadań
    document.querySelector(".input i").addEventListener("click", addTask); //obsługa dodawania zadania po kliknięciu na 'plus' 
    document.addEventListener("keydown", function (e) { //obsługa dodawania zadania po naciśnięciu klawiszu "enter"
        if (e.keyCode == 13) {
            addTask();
        }
    });
});