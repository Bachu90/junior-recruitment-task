function createDB() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {}
    }
    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/createDB.php", true);
    xmlhttp.send();

}

function showTasks() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.querySelector(".todo-list").innerHTML = this.responseText;
            let trashList = document.querySelectorAll(".todo-item i");
            let checkBoxList = document.querySelectorAll(".todo-item input");
            trashList.forEach(trash => trash.addEventListener("click", removeTask));
            checkBoxList.forEach(checkBox => checkBox.addEventListener("click", updateTask));
        }
    }

    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/getTasks.php", true);
    xmlhttp.send();

}

function addTask() {
    let val = document.getElementById("input-field").value;

    if (!val) {
        return false;
    } else {

        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                showTasks();
                document.getElementById("input-field").value = "";
            }
        }
        xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/addTask.php?Task=" + val, true);
        xmlhttp.send();
    }

}

function removeTask() {
    let taskId = this.parentElement.getAttribute("id");

    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            showTasks();
        }
    }
    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/removeTask.php?TaskId=" + taskId, true);
    xmlhttp.send();
}

function updateTask() {
    let taskId = this.parentElement.getAttribute("id");
    let status = this.getAttribute("checked");
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            showTasks();
        }
    }
    xmlhttp.open("GET", "http://" + document.domain + "/to-do-list/backend/updateTask.php?TaskId=" + taskId + "&isComplete=" + status, true);
    xmlhttp.send();
}

createDB();
showTasks();
document.querySelector(".input i").addEventListener("click", addTask);
document.addEventListener("keydown", function (e) {
    if (e.keyCode == 13) {
        addTask();
    }
});