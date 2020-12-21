$('button').click(function (e) {
    e.preventDefault();
});

$('#research').click(function () {

    $.ajax({
        url: "../Functions.php?function=search&pseudo=" + $("#recherche").val(),
        method: "GET",
        dataType: "json",
        success:function(response){
            // location.href= "../Public/profil.php";
            console.log(response);

            var friends = response
            $("#friendSearch").html("");

            friends.forEach(item => {
                $("#friendSearch").append("<li>" + item["pseudo"] + "</li> <button onclick='addfriend(" + item["user_id"] + ")'>Ajouter</button><br>");
            });
        }
    });
});


function addfriend(id) {

    let data = {"friend_user_id": id};

    $.ajax({
        url: "../Functions.php?function=addInFriendList",
        method: "POST",
        data: data,
        success:function(response){
            getFriends();
        }
    });
}

