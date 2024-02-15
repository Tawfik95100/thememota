(function ($) {
    function chargerplusdimage() {
        const button = $(this);
        const data = {
            action: "load_more", 
            query: chargement.query_vars, 
            page: button.data("page"),
        };

        $.ajax({
            url: ajax_object.ajaxurl,
            data: data,
            type: "POST",
            beforeSend: function() {
                button.text('Loading');
            },
            success: function(data) {
                if(data === "aucune_photo"){
                    button.text('Pas de photos supplémentaires');
                } else if (data){
                    button.data("page", button.data("page") + 1);
                    $(".chargerplus").before($(data));
                    button.text("Charger plus");
                }
            },
            error: function(xhr, status, error){
                console.error('problème dans la requête ajax:', status, error);
                button.text('error');
            },
        });        
    }

    $('.charger_plus').click(chargerplusdimage); 

    function filtrephotos() {
        let filtres = {
            categorie: $("#categorie").val(),
            format: $("#format").val(),
            // Mettre à jour la sélection d'années en fonction des options "A partir des plus récentes" et "A partir des plus anciennes"
            annees: $('#annees').val() === 'recentes' ? 'recentes' : $('#annees').val() === 'anciennes' ? 'anciennes' : '', 
        };
    
        // Vérifier si tous les filtres sont vides
        const filtresvide = Object.values(filtres).every((value) => !value);
    
        // Si tous les filtres sont vides, actualiser la page
        if (filtresvide) {
            location.reload();
            return;
        }
    
        // Sinon, effectuer la requête AJAX de filtrage et tri
        $.ajax({
            url: ajax_object.ajaxurl,
            data: {
                action: "filter_photos",
                filter: filtres,
            },
            type: "POST",
            beforeSend: function () {
                $("#galerie_photo").html('<div class="load">Chargement...</div>');
            },
            success: function (data) {
                $("#galerie_photo").html(data);
                setTimeout(function () {
                    document.getElementById("galerie_photo").scrollIntoView();
                }, 0);
            },
        });
    }
    
    $('#dropdownbox select').on('change', function(event){
        event.preventDefault();
        filtrephotos();
    });
    

})(jQuery);

