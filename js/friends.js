$('button').click(function (e) {
    e.preventDefault();
});

getFriends();

$('#friendsButton').click(function () {

    $('#friendsButton').toggleClass('hideFriends');
    if($('#friendsButton').hasClass('hideFriends')){
        $('#friendsList').empty();
        $('#friendsButton').html('Afficher tes amis');
    } else{
        getFriends();
        $('#friendsButton').html('Cacher tes amis');
    }
});

function deletefriend(id) {

    let data = {"friend_user_id": id};

    $.ajax({
        url: "../Functions.php?function=deleteInFriendList",
        method: "POST",
        data: data,
        success:function(response){
            getFriends();
        }
    });
}

function getFriends(){
    $.ajax({
        url: "../Functions.php?function=friendsList",
        method: "GET",
        dataType: "json",
        success:function(response){
            // location.href= "../Public/profil.php";
            // console.log(response);

            var friends = response
            $("#friendsList").append('<h2>Liste d\'amis</h2>');
            friends.forEach((item, index) => {
                $("#friendsList").append("<li>"+ (index + 1) + " " + item["pseudo"] + " </li><button onclick='deletefriend(" + item["user_id"] + ")'>Supprimer</button><br>");
            });
        }
    });
}