getMySonds();

function getMySonds(){   
    $.ajax({
        url:"../Functions.php?function=MySonds",
        dataType: "json",
        success:function (response) {  
            $('.zisection').empty();
            response.forEach(sondage => {
                if(sondage.status_sondage == 'On'){

                    $('#sonds-actives').append(`             
                    <div>
                    <a href='sondPage.php?id=${sondage.sondage_id}'>${sondage.sondage_title}</a>
                    <button class='endThis' data-i='${sondage.sondage_id}'> Mettre fin à ce sondage </button>
                    </div>               
                    `);
                }else{
                    $('#sonds-inactives').append(`             
                    <div>
                        <a href='sondPage.php?id=${sondage.sondage_id}'>${sondage.sondage_title}</a>
                    </div>               
                    `);                  
                } 
                console.log(sondage.status_sondage);          
            });
        }
    });
}



$(document).on('click', 'button.endThis', function(){  
    let id = $(this).attr('data-i');
    console.log(id);
    $.ajax({
        url:"../Functions.php?function=endSond",
        method: "POST",
        data:{id},
        success:function(response){
            getMySonds();
        }
    });
});

