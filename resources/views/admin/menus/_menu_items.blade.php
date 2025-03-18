@forelse($items as $item)
    <li class="dd-item" data-id="{{ $item->id }}">
        <div class="dd-handle">
            <i class="fas fa-grip-vertical me-2 text-muted"></i>
        </div>
        <div class="dd-content d-flex justify-content-between align-items-center">
            <div>
                @if($item->icon)
                    <i class="{{ $item->icon }} me-2"></i>
                @endif
                
                <span class="fw-bold">{{ $item->title }}</span>
                
                @if(!$item->is_active)
                    <span class="badge bg-warning ms-2">Inactif</span>
                @endif
                
                @if($item->target == '_blank')
                    <span class="badge bg-info ms-2">Nouvel onglet</span>
                @endif
                
                @if($item->url && !$item->page_id)
                    <span class="badge bg-secondary ms-2">Lien externe</span>
                @endif
            </div>
            
            <div class="menu-item-actions">
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('admin.menu_items.edit', [$menu, $item]) }}" 
                       class="btn btn-sm btn-warning" 
                       data-bs-toggle="tooltip" 
                       title="Modifier">
                        <i class="fa fa-edit"></i>
                    </a>
                    
                    <form action="{{ route('admin.menu_items.toggle', [$menu, $item]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" 
                            class="btn btn-sm {{ $item->is_active ? 'btn-dark' : 'btn-success' }}" 
                            data-bs-toggle="tooltip" 
                            title="{{ $item->is_active ? 'Désactiver' : 'Activer' }}">
                            <i class="fa fa-{{ $item->is_active ? 'eye-slash' : 'eye' }}"></i>
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.menu_items.destroy', [$menu, $item]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="btn btn-sm btn-danger" 
                            data-bs-toggle="tooltip" 
                            title="Supprimer"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément de menu ? Cette action est irréversible et supprimera également tous les sous-éléments.')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="menu-item-details">
            <div class="row">
                <div class="col-md-6">
                    @if($item->page_id)
                        <p><i class="fa fa-file-alt me-1"></i> <strong>Page :</strong> {{ $item->page->title ?? 'Page non trouvée' }}</p>
                    @elseif($item->url)
                        <p><i class="fa fa-link me-1"></i> <strong>URL :</strong> {{ $item->url }}</p>
                    @endif
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">Créé le {{ $item->created_at->format('d/m/Y') }}</small>
                </div>
            </div>
        </div>
        
        @if($item->children && $item->children->count() > 0)
            <ol class="dd-list">
                @include('admin.menus._menu_items', ['items' => $item->children()->orderBy('order')->get()])
            </ol>
        @endif
    </li>
@empty
    <div class="alert alert-info">Aucun élément de menu disponible.</div>
@endforelse 