<div class="d-flex gap-2">
    <div class="">
        <i class="fa-solid fa-user me-3"></i>{{ Auth::user()->name }}
    </div>
    <div class="">
        <i class="fa-solid fa-user me-3"></i>{{ Auth::user()->role }}
    </div>
    <div class="">
        <i class="fa-solid fa-at me-3"></i>{{ Auth::user()->email }}
    </div>
    <div class="">
        <i class="fa-regular fa-calendarys-days me-3"></i>{{ Auth::user()->created_at->format('d/m/Y') }}
    </div>
</div>
