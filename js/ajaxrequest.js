$(document).ready(function () {
  //Ajax call from already exists email verification
  $("#stuemail").on("keypress blur", function () {
    var stuemail = $("#stuemail").val();
    $.ajax({
      url: "Students/addStudent.php",
      method: "POST",
      data: {  
        checkemail: "checkmail",
        stuemail: stuemail,
      },
       dataType: "json",
      success: function (response) {
        if (response != 0) {
          $("#statudMsg3").html('<small style="color:red;">Email no disponible</small>'
          );
          $("#stusignup").attr("disabled", true);
        } else if (response == 0) {
          $("#statudMsg3").html(
            '<small style="color:green;">Email Disponible</small>'
          );
          $("#stusignup").attr("disabled", false);
        }
      },
    });
  });
});




function addStu() {
  var reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  var stuname = $("#stuname").val();
  var stupass = $("#stupass").val();
  var stuemail = $("#stuemail").val();

  //Cheking Form fields on form
  if (stuname.trim() == "") {
    $("#statudMsg1").html(
      '<small style="color:red;">Ingresa tu nombre</small>'
    );
    $("#stuname").focus();
    return false;
  } else if (stupass.trim() == "") {
    $("#statudMsg2").html(
      '<small style="color:red;">Ingresa una contraseña</small>'
    );
    $("#stupass").focus();
    return false;
  } else if (stuemail.trim() == "") {
    $("#statudMsg3").html('<small style="color:red;">Ingresa un email</small>');
    $("#stuemail").focus();
    return false;
  } else if (stuemail.trim() != "" && !reg.test(stuemail)) {
    $("#statudMsg3").html(
      '<small style="color:red;">Por favor ingresa un email valido</small>'
    );
  } else {
    $.ajax({
      url: "Students/addStudent.php",
      method: "POST",
      dataType: "json",
      data: {
        stusignup: "stusignup",
        stuname: stuname,
        stupass: stupass,
        stuemail: stuemail,
      },
      success: function (data) {
        if (data == "Done") {
          $("#sucessMsg").html(
            "<span class='alert alert-success'>Registrado con exito</span>"
          );
          clearForm();
        } else if (data == "Failed") {
          $("#sucessMsg").html(
            "<span class='alert alert-danger'>Error al hacer el registro</span>"
          );
        }
      },
    });
    $("#statudMsg1").hide();
    $("#statudMsg2").hide();
    $("#statudMsg3").hide();
  }
}

//Empty all fields
function clearForm() {
  $("#stuRegForm").trigger("reset");
  $("#statudMsg1").html("");
  $("#statudMsg2").html("");
  $("#statudMsg3").html("");
}

//Ajax call for student login
function checkStuLogin() {
  var stulogEmail = $("#stuLoginemail").val();
  var stuLogpass = $("#stuLogpass").val();

  $.ajax({
    url: "Students/addStudent.php",
    method: "POST",
    data: {
      checkLogEmail: "checkLogEmail",
      stulogEmail: stulogEmail,
      stuLogpass: stuLogpass,
    },
    success: function (data) {
      if (data == 0) {
        $("#statusLogMsg").html(
          '<small class="alert alert-danger">Credenciales invalidas</small>'
        );
      } else if (data == 1) {
        $("#statusLogMsg").html(
          '<div class="spinner-border text-success" role="status"></div>'
        );
        setTimeout(() => {
          window.location.href = "index.php";
        }, 1000);
      }
    },
  });
}
