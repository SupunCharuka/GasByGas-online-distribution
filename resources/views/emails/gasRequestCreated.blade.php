<x-mail::message>
    # New Gas Request Submitted

    Dear Outlet Manager,

    A new gas request has been submitted.

    **Outlet:** {{ $gasRequest->outlet->name }}
    **Requested By:** {{ $gasRequest->user->name }}
    **Gas Size:** {{ $gasRequest->gas_size }}
    **Quantity:** {{ $gasRequest->quantity }}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
