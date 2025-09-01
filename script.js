document.addEventListener("DOMContentLoaded", () => {
  const addBtn = document.getElementById("addBtn");
  const taskInput = document.getElementById("taskInput");
  const taskList = document.getElementById("taskList");


  fetch("obtener.php")
    .then(res => res.json())
    .then(data => {
      data.forEach(task => renderTask(task.id, task.tarea, task.completada));
    });

  
  addBtn.addEventListener("click", () => {
    const taskText = taskInput.value.trim();
    if (taskText === "") return;

    fetch("agregar.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "tarea=" + encodeURIComponent(taskText)
    })
    .then(res => res.json())
    .then(data => {
      renderTask(data.id, data.tarea, 0);
      taskInput.value = "";
    });
  });


  function renderTask(id, text, completed) {
    const li = document.createElement("li");
    li.textContent = text;
    if (completed == 1) li.classList.add("completed");


    li.addEventListener("click", () => {
      li.classList.toggle("completed");
      fetch("completar.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `id=${id}&completada=${li.classList.contains("completed") ? 1 : 0}`
      });
    });

 
    const deleteBtn = document.createElement("button");
    deleteBtn.textContent = "X";
    deleteBtn.classList.add("delete-btn");
    deleteBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      li.remove();
      fetch("eliminar.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "id=" + id
      });
    });

    li.appendChild(deleteBtn);
    taskList.appendChild(li);
  }
});
