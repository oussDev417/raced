<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Administration RACED ONG</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.7/quill.core.css" rel="stylesheet">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    
    <!-- Additional CSS -->
    @stack('styles')

    <style>
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            min-height: 100vh;
            background: #f8f9fa;
        }
        .content-wrapper {
            padding: 20px 0;
        }
        .breadcrumb {
            margin-bottom: 20px;
            background: white;
            padding: 15px;
            border-radius: 5px;
        }
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.125);
        }
        .image-preview img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            margin-top: 10px;
        }
        .editor-container {
            height: 300px;
            margin-bottom: 20px;
        }
        .ql-editor {
            min-height: 200px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .ql-toolbar {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px 4px 0 0;
            margin-bottom: 0;
        }
        .ql-container {
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 4px 4px;
            min-height: 200px;
        }
        .ql-editor p {
            margin-bottom: 1em;
        }
        .ql-editor h1,
        .ql-editor h2,
        .ql-editor h3,
        .ql-editor h4,
        .ql-editor h5,
        .ql-editor h6 {
            margin-top: 1em;
            margin-bottom: 0.5em;
        }
        .ql-editor ul,
        .ql-editor ol {
            padding-left: 1.5em;
            margin-bottom: 1em;
        }
        .ql-editor blockquote {
            border-left: 4px solid #ccc;
            margin-bottom: 1em;
            padding-left: 1em;
        }
        /* Styles personnalisés */
        .nav-section-title {
            margin-top: 20px;
            margin-bottom: 10px;
            padding-left: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #6c757d;
            letter-spacing: 0.5px;
            pointer-events: none;
            border-left: 3px solid #2e90a7;
        }
        /* Styles Quill */
        .quill-editor-container {
            margin-bottom: 20px;
        }
        .ql-toolbar {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px 4px 0 0;
            margin-bottom: 0;
        }
        .ql-container {
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 4px 4px;
            min-height: 200px;
            background: white;
        }
        .ql-editor {
            min-height: 200px;
        }
        .ql-editor p {
            margin-bottom: 1em;
        }
        .ql-editor h1,
        .ql-editor h2,
        .ql-editor h3,
        .ql-editor h4,
        .ql-editor h5,
        .ql-editor h6 {
            margin-top: 1em;
            margin-bottom: 0.5em;
        }
        .ql-editor ul,
        .ql-editor ol {
            padding-left: 1.5em;
            margin-bottom: 1em;
        }
        .ql-editor blockquote {
            border-left: 4px solid #ccc;
            margin-bottom: 1em;
            padding-left: 1em;
        }
        /* Styles personnalisés */
        .ql-toolbar.ql-snow {
            display: flex;
            flex-wrap: wrap;
            padding: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .ql-container.ql-snow {
            border: 1px solid #ccc;
            min-height: 200px;
            background: white;
        }

        .ql-editor {
            min-height: 200px;
            padding: 12px 15px;
        }

        .ql-formats {
            display: inline-block;
            vertical-align: middle;
            margin-right: 15px;
        }

        .ql-toolbar.ql-snow .ql-formats {
            margin-right: 15px;
        }

        .ql-toolbar.ql-snow button {
            height: 24px;
            padding: 3px 5px;
            width: 28px;
            background: none;
            border: none;
            cursor: pointer;
            display: inline-block;
            float: left;
            height: 24px;
            padding: 3px 5px;
            width: 28px;
            margin: 0 2px;
        }

        .ql-toolbar.ql-snow button:hover {
            color: #06c;
        }

        .ql-toolbar.ql-snow .ql-active {
            color: #06c;
        }

        .ql-snow .ql-stroke {
            stroke: currentColor;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 2;
        }

        .ql-snow .ql-fill {
            fill: currentColor;
        }

        /* Styles Quill */
        .quill-editor-full {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: white;
        }

        .ql-toolbar.ql-snow {
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 4px 4px 0 0;
        }

        .ql-container.ql-snow {
            border: none;
            min-height: 200px;
        }

        .ql-editor {
            min-height: 200px;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Force l'affichage des icônes */
        .ql-formats {
            display: inline-flex !important;
            align-items: center;
            margin-right: 15px !important;
        }

        .ql-toolbar.ql-snow .ql-formats {
            margin-right: 15px !important;
        }

        .ql-toolbar.ql-snow button {
            width: 28px !important;
            height: 24px !important;
            padding: 3px 5px !important;
            margin: 0 2px !important;
        }

        .ql-toolbar.ql-snow button svg {
            width: 18px !important;
            height: 18px !important;
        }

        /* Styles Quill */
        .quill-editor-wrapper {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: white;
        }

        .ql-toolbar.ql-snow {
            border: none;
            border-bottom: 1px solid #ccc;
            padding: 8px;
            background: #f8f9fa;
            border-radius: 4px 4px 0 0;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .ql-container.ql-snow {
            border: none;
            min-height: 200px;
        }

        .ql-editor {
            min-height: 200px;
            font-size: 14px;
            line-height: 1.5;
            padding: 12px 15px;
        }

        /* Styles pour les groupes de boutons */
        .ql-formats {
            display: inline-flex !important;
            align-items: center;
            margin-right: 15px !important;
            border-right: 1px solid #ddd;
            padding-right: 15px;
        }

        .ql-formats:last-child {
            border-right: none;
        }

        /* Styles pour les boutons */
        .ql-toolbar.ql-snow button {
            width: 28px !important;
            height: 28px !important;
            padding: 3px !important;
            margin: 0 2px !important;
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            border-radius: 3px;
        }

        .ql-toolbar.ql-snow button:hover {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .ql-toolbar.ql-snow button.ql-active {
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        /* Styles pour les icônes */
        .ql-toolbar.ql-snow button svg {
            width: 18px !important;
            height: 18px !important;
            float: none !important;
            margin: 0 !important;
        }

        /* Styles pour les sélecteurs */
        .ql-toolbar.ql-snow .ql-picker {
            height: 28px !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        
        <div class="main-content">
            <!-- Header -->
            @include('admin.layouts.header')
            
            <!-- Breadcrumb -->
            @yield('breadcrumb')
            
            <!-- Content -->
            <div class="content-wrapper">
                @include('admin.layouts.alerts')
                @yield('content')
            </div>
            
            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    
    <!-- Additional JS -->
    @stack('scripts')

    <script>
        // Configuration globale de Quill
        function initQuillEditor(selector, placeholder = '') {
            return new Promise((resolve, reject) => {
                const container = document.querySelector(selector);
                if (!container) {
                    console.error(`Container ${selector} not found`);
                    reject(`Container ${selector} not found`);
                    return;
                }

                // Créer la structure HTML nécessaire
                const editorWrapper = document.createElement('div');
                editorWrapper.className = 'quill-editor-wrapper';
                container.parentNode.insertBefore(editorWrapper, container);

                // Créer la barre d'outils explicitement
                const toolbarContainer = document.createElement('div');
                toolbarContainer.innerHTML = `
                    <span class="ql-formats">
                        <button type="button" class="ql-bold"></button>
                        <button type="button" class="ql-italic"></button>
                        <button type="button" class="ql-underline"></button>
                        <button type="button" class="ql-strike"></button>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-blockquote"></button>
                        <button type="button" class="ql-code-block"></button>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-header" value="1"></button>
                        <button type="button" class="ql-header" value="2"></button>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-list" value="ordered"></button>
                        <button type="button" class="ql-list" value="bullet"></button>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-script" value="sub"></button>
                        <button type="button" class="ql-script" value="super"></button>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-indent" value="-1"></button>
                        <button type="button" class="ql-indent" value="+1"></button>
                    </span>
                    <span class="ql-formats">
                        <select class="ql-align"></select>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-link"></button>
                        <button type="button" class="ql-image"></button>
                        <button type="button" class="ql-video"></button>
                    </span>
                    <span class="ql-formats">
                        <button type="button" class="ql-clean"></button>
                    </span>
                `;
                toolbarContainer.id = `${container.id}-toolbar`;
                toolbarContainer.className = 'ql-toolbar ql-snow';
                editorWrapper.appendChild(toolbarContainer);

                // Préparer le conteneur d'édition
                container.className = 'ql-container ql-snow';
                editorWrapper.appendChild(container);

                // Initialiser Quill
                const editor = new Quill(container, {
                    theme: 'snow',
                    placeholder: placeholder,
                    modules: {
                        toolbar: toolbarContainer
                    }
                });

                console.log(`Editor initialized for ${selector} with toolbar`);
                resolve(editor);
            });
        }

        // Initialisation après le chargement complet de la page
        window.addEventListener('load', function() {
            console.log('Window loaded, initializing editors...');
            const editors = [
                { selector: '#description_editor', placeholder: 'Entrez la description détaillée...' },
                { selector: '#mission_editor', placeholder: 'Entrez la mission...' },
                { selector: '#vision_editor', placeholder: 'Entrez la vision...' },
                { selector: '#values_editor', placeholder: 'Entrez les valeurs...' }
            ];

            Promise.all(editors.map(editor => 
                initQuillEditor(editor.selector, editor.placeholder)
            )).then(quillEditors => {
                console.log('All editors initialized successfully');
                // Configurer les gestionnaires de formulaire
                document.getElementById('aboutForm')?.addEventListener('submit', function(e) {
                    quillEditors.forEach((editor, index) => {
                        const inputId = editors[index].selector.replace('_editor', '_input');
                        document.querySelector(inputId).value = editor.root.innerHTML;
                    });
                });
            }).catch(error => {
                console.error('Error initializing editors:', error);
            });
        });
    </script>
</body>
</html> 