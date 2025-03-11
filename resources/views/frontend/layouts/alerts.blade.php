@if(session('success'))
    <div class="alert alert-success">
        <div class="container">
            <div class="alert-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-message">
                {{ session('success') }}
            </div>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <div class="container">
            <div class="alert-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="alert-message">
                {{ session('error') }}
            </div>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        <div class="container">
            <div class="alert-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="alert-message">
                {{ session('warning') }}
            </div>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        <div class="container">
            <div class="alert-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="alert-message">
                {{ session('info') }}
            </div>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    </div>
@endif 