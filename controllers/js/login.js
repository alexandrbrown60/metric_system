$('#send').on('click', function() {
	var pass = $('#password').val();
	if(pass == "") {
		alert("Введите пароль!");
	} else {
		$.post("../php/login.php", {password: pass}, function(data) {
			if(data) {
				document.location.href = "../../views/main.html";
			} else {
				alert("Неверный пароль");
			}
		});
	}
	
});