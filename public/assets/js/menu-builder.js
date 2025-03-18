$(document).ready(function() {
    // Vérifier si l'élément Nestable existe
    if ($('#nestable-menu').length) {
        // Ajouter un message d'aide visuel
        $('.menu-builder').prepend('<div class="alert alert-info mb-3"><i class="fas fa-info-circle me-2"></i> Utilisez les poignées <i class="fas fa-grip-vertical"></i> pour faire glisser et réorganiser les éléments du menu.</div>');
        
        // Initialiser Nestable
        var nestable = $('#nestable-menu').nestable({
            group: 1,
            maxDepth: 3,
            expandBtnHTML: '<button class="dd-expand" data-action="expand" type="button"><i class="fa fa-plus"></i></button>',
            collapseBtnHTML: '<button class="dd-collapse" data-action="collapse" type="button"><i class="fa fa-minus"></i></button>'
        });
        
        // Fonction pour mettre à jour l'ordre
        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target);
            if (window.JSON) {
                var data = list.nestable('serialize');
                
                // Récupérer l'URL du data-attribute
                var updateUrl = $('#nestable-menu').data('update-url');
                
                // Envoyer les données au serveur
                $.ajax({
                    url: updateUrl,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        items: JSON.stringify(data)
                    },
                    success: function(response) {
                        // Afficher un message de succès
                        if (response.success) {
                            toastr.success(response.message || 'Ordre du menu mis à jour avec succès');
                        } else {
                            toastr.error(response.message || 'Une erreur est survenue');
                        }
                    },
                    error: function() {
                        toastr.error('Une erreur est survenue lors de la mise à jour de l\'ordre');
                    }
                });
            }
        };
        
        // Écouter les changements et mettre à jour l'ordre
        nestable.on('change', updateOutput);
        
        // Initialiser les tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Empêcher le comportement par défaut des boutons dans les éléments de menu
        $('.menu-item-actions button, .menu-item-actions a').on('mousedown', function(e) {
            e.stopPropagation();
        });
    }
}); 