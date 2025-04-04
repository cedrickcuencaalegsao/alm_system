@props([
    'icon' => '',
    'label' => '',
    'active' => false,
    'link' => '#',
    'count' => null
])

<a href="{{ $link }}" 
   class="category-btn {{ $active ? 'active' : '' }} text-decoration-none">
    <div class="d-flex align-items-center p-3 rounded-3 mb-2 position-relative 
        {{ $active ? 'bg-brown text-white' : 'bg-light text-dark' }}">
        
        <div class="d-flex align-items-center flex-grow-1">
            @if($icon)
                <i class="bi {{ $icon }} me-3 fs-5"></i>
            @endif
            
            <span class="fw-medium">{{ $label }}</span>
        </div>

        @if($count !== null)
            <span class="badge rounded-pill {{ $active ? 'bg-light text-dark' : 'bg-brown text-white' }}">
                {{ $count }}
            </span>
        @endif
        
        @if($active)
            <i class="bi bi-chevron-right ms-2"></i>
        @endif
    </div>
</a>

<style>
.category-btn .bg-light:hover {
    background-color: #DEB887 !important;
    color: white !important;
    transform: translateX(5px);
}

.bg-brown {
    background-color: #8B4513 !important;
}

.category-btn {
    display: block;
    transition: all 0.3s ease;
}

.badge {
    font-size: 0.8rem;
    padding: 0.4em 0.8em;
}
</style>