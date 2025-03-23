$(document).ready(function () {
    // Événement de soumission du formulaire
    $('#dataForm').on('submit', function (e) {
        e.preventDefault();  // Empêche l'envoi traditionnel du formulaire
        
        // Récupération des valeurs des champs du formulaire
        var name = $('#name').val();
        var firstname = $('#firstname').val();
        var age = $('#age').val();

        // Envoi des données via Ajax
        $.ajax({
            url: 'save_data.php',  // Le fichier PHP où les données seront envoyées
            type: 'POST',          // Méthode POST
            data: {
                name: name,
                firstname: firstname,
                age: age
            },
            success: function (response) {
                // Affichage du message de confirmation
                $('#datas').text(response);
                
                // Optionnel : Réinitialiser les champs du formulaire
                $('#dataForm')[0].reset();
            },
            error: function () {
                // En cas d'erreur
                $('#datas').text('Une erreur est survenue.');
            }
        });
    });
});
