getMyInfos();


function getMyInfos(){
    $.ajax({
        url:'../Functions.php?function=getMyInfos',
        dataType:'json',
        success:function(response){
            console.log(response);
            $('#pseudo').val(`${response.pseudo}`);
            $('#email').val(`${response.email}`);
            $('#pass-1').val(`${response.password}`);
        }
    });
}

$('#change').click(function() {  
    $(this).toggleClass('changing');
    if($(this).hasClass('changing')){
        $('#infos input').attr('readonly', false);
        $('#pass-1').val('');
        $(this).html('Annuler les changements');
        $('#confirm').css('display', 'initial');
        $('#mdp-confirm').css('display', 'initial');
    }else{
        $('#infos input').attr('readonly', true);
        $(this).html('Changer mes informations');
        $('#confirm').css('display', 'none');
        $('#mdp-confirm').css('display', 'none');
        getMyInfos();
    }
});

$('#confirm').click(function(){
    if($('#pass-1').val() && $('#pass-2').val() && $('#pseudo').val() && $('#email').val()){
        if($('#pass-1').val() == $('#pass-2').val()){
            
            let data = $('#infos').serializeArray();
            console.log(data);
            $.ajax({
                url:'../Functions.php?function=updateInfos',
                method:"POST",
                data:data,
                success:function(response){
                   alert('Les changements ont bien été effectués !')
                   location.reload();
                }
            });
        }else{
            alert('les mots de passe ne correspondent pas');
        }
    }else{
        alert('veuillez remplir tous les champs')
    }
});