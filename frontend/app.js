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
  const firstNameValue = document.getElementById("firstName").value;
  const lastNameValue = document.getElementById("lastName").value;
  const secondLastNameValue = document.getElementById("secondLastName").value;
  const emailValue = document.getElementById("email").value;
  const dniValue = document.getElementById("dni").value;

  // console.log(
  //   firstName +
  //     " " +
  //     lastName +
  //     " " +
  //     secondLastName +
  //     " - " +
  //     email +
  //     " - " +
  //     dni,
  // );
  const user = {
    firstName: firstNameValue,
    lastName: lastNameValue,
    secondLastName: secondLastNameValue,
    email: emailValue,
    dni: dniValue,
  };

  callAdUSerServer(user);
  // const realJSON = JSON.stringify(user);

  // const realObjet = JSON.parse(realJSON);

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
    // model users:
    /**
     * {
        "id": "1",
        "name": "Juan Mauricio 3",
        "lastName": "Pérez",
        "secondLastName": "González",
        "email": "juan.perez@modificado5.com",
        "dni": "A12345678"
    },
     */
    if (this.readyState === 4) {
      //console.log(this.responseText);
      let users = [];
      if (this.responseText && this.responseText.length > 0) {
        users = JSON.parse(this.responseText);
      }
      //console.log(users);

      const tbody = document.getElementById("usersList");
      // tbody.childNodes.forEach((element) => {
      //   tbody.removeChild(element);
      // });
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

        const tdActions = document.createElement("td");
        const button = document.createElement("button");
       // eliminar = eliminar.bind({useride: users[i].id});
        button.addEventListener("click", eliminar);
        button.textContent= "Eliminar";
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
