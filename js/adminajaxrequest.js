//Ajax call for student login
function checkAmdinLogin() {
  var adminLoginemail = $("#adminLoginemail").val();
  var adminpLogpass = $("#adminpLogpass").val();

  $.ajax({
    url: "admin/admin.php",
    method: "POST",
    data: {
      checkLogEmail: "checkLogEmail",
      adminLoginemail: adminLoginemail,
      adminpLogpass: adminpLogpass,
    },
    success: function (data) {
      if (data == 0) {
        $("#statusAdminLogMsg").html(
          '<small class="alert alert-danger">Credenciales invalidas</small>'
        );
      } else if (data == 1) {
        $("#statusAdminLogMsg").html(
          '<div class="spinner-border text-success" role="status"></div>'
        );
        setTimeout(() => {
          window.location.href = "admin/adminDashboard.php";
        }, 1000);
      }
    },
  });
}
