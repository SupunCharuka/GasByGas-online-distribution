@if ($gasRequest->status === 'pending')
    <a class="btn btn-sm cancel-gas-request btn-danger" data-gasrequest="{{ $gasRequest->id }}"
        id="gasRequest-{{ $gasRequest->id }}" href="javascript:void(0)" title="Cancel Request">
        <i class="fa fa-times"></i> Cancel
    </a>
@endif

<a class="btn btn-primary btn-sm show-token" href="javascript:void(0)" data-id="{{ $gasRequest->id }}">Show Token</a>
