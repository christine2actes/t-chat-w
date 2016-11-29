$(document).ready(function() {
    console.log('test1');
    $('button.close').click(function(e){
        console.log('test');
        e.preventDefault();
        // $(this).attr('dataDismiss')
        var dataDismiss = $(this).data('dismiss');

        // closest : sélectionne l'élément le plus proche
        $(this).closest('.' + dataDismiss).remove();
    });
});
