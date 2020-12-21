$('button').click(function (e) {
    e.preventDefault();
});


$('#login').click(function () {
    let data = $('#login-form').serializeArray();
    
    if($('#email').val() && $('#password').val()){
        console.log(data);
        $.ajax({
            url: "../Functions.php?function=login",
            method: "POST",
            data: data,
            success:function(response){
                location.href= "../Public/profil.php";
                console.log("youpi");
            }
        });
    }else{
        alert('veuillez remplir tous les champs');
    }
});

$('#signup').click(function () {
    let data = $('#signup-form').serializeArray();
    if($('#email').val() && $('#password').val() && $('#pseudo').val()){
        console.log(data);
        $.ajax({
            url: "../Functions.php?function=signup",
            method: "POST",
            data: data,
            success:function(response){
                location.href= "../Public/login.php";
                console.log(response);
            }
        });
    }else{
        alert('veuillez remplir tous les champs');
    }
});