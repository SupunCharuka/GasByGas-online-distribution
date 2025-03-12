@component('mail::message')
# Gas Request Status Update

Dear {{ $gasRequest->user->name }},

Your gas request has been updated.

**Gas Size:** {{ $gasRequest->gas_size }}  
**Quantity:** {{ $gasRequest->quantity }}  
**Status:** **{{ ucfirst($gasRequest->status) }}**  

@if($gasRequest->status === 'scheduled')
Your request has been scheduled for pickup.  
**Expected Pickup Date:** {{ $gasRequest->expected_pickup_date->format('F j, Y') }}  
**Token Number:** {{ $gasRequest->token->token_number }}

@elseif($gasRequest->status === 'completed')
Your request has been completed.
@elseif($gasRequest->status === 'cancelled')
Your request has been cancelled.
@endif

Thank you,  
{{ config('app.name') }}
@endcomponent
