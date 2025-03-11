/**
 * CJ AONG - Admin Panel JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Toggle Sidebar
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            mainContent.classList.toggle('sidebar-hidden');
        });
    }
    
    // Close Sidebar on Mobile
    const sidebarClose = document.querySelector('.sidebar-close');
    
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            sidebar.classList.remove('show');
        });
    }
    
    // Dropdown Menus
    const dropdownToggles = document.querySelectorAll('.has-dropdown');
    
    dropdownToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            if (window.innerWidth < 768) {
                e.preventDefault();
                const dropdownList = this.nextElementSibling;
                dropdownList.classList.toggle('show');
            }
        });
    });
    
    // Image Preview
    const imageInputs = document.querySelectorAll('.image-upload');
    
    imageInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            const preview = document.querySelector(this.dataset.preview);
            
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    
    // Confirm Delete
    const deleteButtons = document.querySelectorAll('.delete-confirm');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.')) {
                e.preventDefault();
            }
        });
    });
    
    // Sortable Tables
    if (typeof Sortable !== 'undefined') {
        const sortableTables = document.querySelectorAll('.sortable-table tbody');
        
        sortableTables.forEach(function(table) {
            Sortable.create(table, {
                handle: '.sortable-handle',
                animation: 150,
                onEnd: function() {
                    updateOrder(table);
                }
            });
        });
    }
    
    // Update Order Function
    function updateOrder(table) {
        const rows = table.querySelectorAll('tr');
        const orderData = [];
        
        rows.forEach(function(row, index) {
            const id = row.dataset.id;
            
            if (id) {
                orderData.push({
                    id: id,
                    order: index + 1
                });
            }
        });
        
        if (orderData.length > 0) {
            const url = table.dataset.url;
            const token = document.querySelector('meta[name="csrf-token"]').content;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ items: orderData })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Ordre mis à jour avec succès', 'success');
                } else {
                    showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Erreur lors de la mise à jour de l\'ordre', 'error');
            });
        }
    }
    
    // Show Notification
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show notification`;
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(function() {
            notification.remove();
        }, 5000);
    }
    
    // Initialize CKEditor if available
    if (typeof ClassicEditor !== 'undefined') {
        const editors = document.querySelectorAll('.ckeditor');
        
        editors.forEach(function(editor) {
            ClassicEditor
                .create(editor)
                .catch(error => {
                    console.error(error);
                });
        });
    }
    
    // Initialize Select2 if available
    if (typeof $.fn.select2 !== 'undefined') {
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    }
    
    // Initialize Datepicker if available
    if (typeof $.fn.datepicker !== 'undefined') {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            language: 'fr'
        });
    }
    
    // Custom File Input
    const fileInputs = document.querySelectorAll('.custom-file-input');
    
    fileInputs.forEach(function(input) {
        const label = input.nextElementSibling;
        
        input.addEventListener('change', function(e) {
            let fileName = '';
            
            if (this.files && this.files.length > 1) {
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            } else {
                fileName = e.target.value.split('\\').pop();
            }
            
            if (fileName) {
                label.querySelector('span').innerHTML = fileName;
            } else {
                label.innerHTML = label.getAttribute('data-default-text');
            }
        });
    });
}); 