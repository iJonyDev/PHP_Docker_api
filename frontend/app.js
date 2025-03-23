console.log("Hello, js!");
console.log(window.location.href);
window.moveTo(10, 10);
var variable = "Hello, World!";

window.addEventListener("DOMContentLoaded", (event) => {
  document.getElementById("lastName").addEventListener("click", function () {
    console.log("has clickeado en el apellido");
  });

  getUsersByXHR();
});

function addUser() {
  const userId = document.getElementById("userId").value;
  const firstNameValue = document.getElementById("firstName").value;
  const lastNameValue = document.getElementById("lastName").value;
  const secondLastNameValue = document.getElementById("secondLastName").value;
  const emailValue = document.getElementById("email").value;
  const dniValue = document.getElementById("dni").value;

  if (isNaN(dniValue)) {
    alert("DNI must be a numeric value");
    return;
  }

  const user = {
    id: userId,
    firstName: firstNameValue,
    lastName: lastNameValue,
    secondLastName: secondLastNameValue,
    email: emailValue,
    dni: dniValue,
  };

  if (userId) {
    updateUser(user);
  } else {
    callAdUSerServer(user);
  }
}

function updateUser(user) {
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  var raw = JSON.stringify(user);

  var requestOptions = {
    method: "PUT",
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };

  fetch("http://192.168.1.138:8090/api-rest/api/users/", requestOptions)
    .then((response) => {
      console.log(response);
      response.text();
    })
    .then((result) => {
      console.log(result);
      getUsersByXHR();
      resetForm();
    })
    .catch((error) => console.log("error", error));
}

function editUser(user) {
  document.getElementById("userId").value = user.id;
  document.getElementById("firstName").value = user.firstName;
  document.getElementById("lastName").value = user.lastName;
  document.getElementById("secondLastName").value = user.secondLastName;
  document.getElementById("email").value = user.email;
  document.getElementById("dni").value = user.dni;
  document.getElementById("submitBtn").textContent = "Modificar Usuario";
  document.getElementById("cancelEdit").style.display = "inline-block";
}

function cancelEdit() {
  resetForm();
}

function resetForm() {
  document.getElementById("userId").value = "";
  document.getElementById("firstName").value = "";
  document.getElementById("lastName").value = "";
  document.getElementById("secondLastName").value = "";
  document.getElementById("email").value = "";
  document.getElementById("dni").value = "";
  document.getElementById("submitBtn").textContent = "Agregar Usuario";
  document.getElementById("cancelEdit").style.display = "none";
}

function eliminar(event) {
  console.log(event.target.value);
  const userId = {
    id: event.target.value
  };
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");
  var raw = JSON.stringify(userId);

  var requestOptions = {
    method: "DELETE",
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };

  fetch("http://192.168.1.138:8090/api-rest/api/users/", requestOptions)
  .then((response) => {
    console.log(response);
    response.text();
  })
  .then((result) => {
    console.log(result);
    getUsersByXHR();
  })
  .catch((error) => console.log("error", error));

}

function modificar(event) {
  console.log(event.target.value);
  const userId = {
    id: event.target.value
  };
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");
  var raw = JSON.stringify(userId);

  var requestOptions = {
    method: "PUT",
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };

  fetch("http://192.168.1.138:8090/api-rest/api/users/", requestOptions)
    .then((response) => {
      console.log(response);
      response.text();
    })
    .then((result) => {
      console.log(result);
      getUsersByXHR();
    })
    .catch((error) => console.log("error", error));
  
  }

function callAdUSerServer(user) {
  var myHeaders = new Headers();
  myHeaders.append("Content-Type", "application/json");

  var raw = JSON.stringify(user);

  var requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: raw,
    redirect: "follow",
  };

  fetch("http://192.168.1.138:8090/api-rest/api/users/", requestOptions)
    .then((response) => {
      console.log(response);
      response.text();
    })
    .then((result) => {
      console.log(result);
      getUsersByXHR();
    })
    .catch((error) => console.log("error", error));
}

function vaApresionar() {
  console.log("quiere presiona el botón");
}

function enfocado() {
  console.log("el campo está enfoco");
}

function desenfocado() {
  console.log("el campo está desenfoco");
}

function getUsersByXHR() {
  const users = [];
  var data = "";

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;

  xhr.addEventListener("readystatechange", function () {
    if (this.readyState === 4) {
      let users = [];
      if (this.responseText && this.responseText.length > 0) {
        users = JSON.parse(this.responseText);
      }  

      const tbody = document.getElementById("usersList");
      tbody.innerHTML = "";
      for (var i = 0; i < users.length; i++) {
        const tr = document.createElement("tr");
        const tdName = document.createElement("td");
        tdName.textContent = users[i].name;
        tr.appendChild(tdName);

        const tdLastName = document.createElement("td");
        tdLastName.textContent = users[i].lastName;
        tr.appendChild(tdLastName);

        const tdSecondLastName = document.createElement("td");
        tdSecondLastName.textContent = users[i].secondLastName;
        tr.appendChild(tdSecondLastName);

        const tdEmail = document.createElement("td");
        tdEmail.textContent = users[i].email;
        tr.appendChild(tdEmail);

        const tdDni = document.createElement("td");
        tdDni.textContent = users[i].dni;
        tr.appendChild(tdDni);

        const tdActions1 = document.createElement("td");
        const button1 = document.createElement("button");
        button1.addEventListener("click", eliminar);
        button1.textContent= "Eliminar";
        button1.value = users[i].id;
        tdActions1.appendChild(button1);
        tr.appendChild(tdActions1);
        
        const tdActions = document.createElement("td");
        const button = document.createElement("button");
        button.addEventListener("click", ((user) => () => editUser(user))(users[i]));
        button.textContent = "Modificar";
        button.value = users[i].id;
        tdActions.appendChild(button);
        tr.appendChild(tdActions);

        tbody.appendChild(tr);
      }
    }
  });

  xhr.open(
    "GET",
    "http://192.168.1.138:8090/api-rest/api/users/details/details.php",
  );

  xhr.send(data);
}
