getComs();




$("#sendCom") .click(function(){
    let msg = $("#userCom").val();
    console.log("message : " + msg);
    let sondId = $('#sondage_container').attr('data-i');
    console.log("id sondage : " + sondId);
    let data = {
        "message" : msg,
        "sondage_id" : sondId
    }
    console.log(data);
    $.ajax({
        url:'../Functions.php?function=sendMessage',
        method:"POST",
        data:data,
        success:function(response){
            getComs();
        }
    })
})



function getComs(){

    let data = {"sondage_id" : $('#sondage_container').attr('data-i')}
    console.log(data);
    $.ajax({
        url:"../Functions.php?function=getMsg",
        method: "POST",
        dataType: 'json',
        data: data,
        success:function(response){
            $('#comments').empty();
            console.log(response);
            response.forEach(message => {
                $('#comments').append(`
                    <br>
                    <p>${message.message}</p><br>
                    <p>Par : ${message.pseudo}, le : ${message.date_envoi}</p><br>
                    <hr>
                `);
            });
        }
    });
}