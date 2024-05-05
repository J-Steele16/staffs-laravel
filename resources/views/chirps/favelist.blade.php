<?php $cost = 0;
$items = [];
$delopt = 0;

// function typeopt($cost, $delopt)
//    {
//         $cost += 5;
//         $delopt += 2;
//    }

?>



<div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @foreach ($chirps as $chirp)
        <div class="p-6 flex space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <div class="flex-1">
                <p class="mt-4 text-lg text-gray-900">{{ $chirp->name }}</p>
                <p class="mt-4 text-lg text-gray-900">{{ $chirp->toppings }}</p>
                <p class="mt-4 text-lg text-gray-900">{{ $chirp->size }}</p>
                <p class="mt-4 text-lg text-gray-900">£{{ $chirp->price }}</p>
            </div>
            <?php $cost += $chirp->price ?>;
            <?php array_push($items, $chirp->name) ?>;
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                    <form method="POST" action="{{ route('chirps.favourites.remove', $chirp) }}">
                        @csrf
                        <x-dropdown-link :href="route('chirps.favourites.remove', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Remove from Order') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    @endforeach
    <div class="flex-1">
        <p class="mt-4 text-lg text-gray-900">Order Total: £{{ $cost }}</p>
    </div>
    <form method="POST">
        <input type="radio" id="delivery" name="ordertype" value="Delivery" onClick="typeOpt($cost, 'Delivery')">
        <label for="delivery">Delivery (+£5)</label><br>
        <input type="radio" id="collection" name="ordertype" value="Collection" onClick="typeOpt($cost, 'Collection')">
        <label for="collection">Collection</label><br>
    </form>
    <?php array_push($items, $delopt) ?>
    <?php array_push($items, $cost) ?>
    <form method="POST" action="route('dashboard')">
        <button class="mt-4 text-lg text-gray-900" :href="route('dashboard')" onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Place Order') }}
        </button>
    </form>
    
</div>
