<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Administration CJ AONG</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Quill CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    
    <!-- Additional CSS -->
    @yield('styles')

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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <!-- Custom JS -->
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    
    <!-- Additional JS -->
    @yield('scripts')

    <script>
        // Configuration globale de Quill
        function initQuillEditor(selector, placeholder = '') {
            return new Quill(selector, {
                theme: 'snow',
                placeholder: placeholder,
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'script': 'sub'}, { 'script': 'super' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        [{ 'direction': 'rtl' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'font': [] }],
                        [{ 'align': [] }],
                        ['clean'],
                        ['link', 'image', 'video']
                    ]
                }
            });
        }
    </script>
</body>
</html> 