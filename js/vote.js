$('#vote').click(function(){
    let data = [];
    data.push($('input:checked').val()); 
    
    data.push($('#sondage_container').attr('data-i'));
    console.log(data);

    $.ajax({
        url: "../Functions.php?function=vote",
        method: "POST",
        data: {data},
        success:function(response){
            $('#sondage_container').html(`<h2>Merci d'avoir voté!</h2>
                                        <a href='index.php'>Retour à l'accueil</a>`);      
        }
    });
})