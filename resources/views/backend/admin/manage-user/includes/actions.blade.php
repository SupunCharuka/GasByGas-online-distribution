@can('manage-user.update')
    <a class="btn btn-sm btn-primary" href="{{ route('admin.manage-user.edit', ['user' => $user]) }}" title="Edit">
        <i class="fa fa-pencil"> </i>
    </a>
@endcan

@can('manage-user.reset-password')
    <a class="btn btn-sm btn-primary" href="{{ route('admin.manage-user.resetPassword', ['user' => $user]) }}"
        title="Reset Password">
        <i class="fa fa-lock"> </i>
    </a>
@endcan

@can('manage-user.delete')
    <a class="btn btn-sm delete-user btn-danger" data-user="{{ $user->id }}" id="user-{{ $user->id }}"
        href="javascript:void(0)" title="Delete">
        <i class="fa fa-trash"> </i>
    </a>
@endcan

@can('manage-user.suspend')
    <a class="btn btn-sm suspend-user {{ $user->suspended_at ? 'btn-success' : 'btn-warning' }}"
        data-user="{{ $user->id }}" data-suspended="{{ $user->suspended_at ? 'true' : 'false' }}"
        href="javascript:void(0)" title="{{ $user->suspended_at ? 'Unsuspend' : 'Suspend' }}">
        <i class="fa {{ $user->suspended_at ? 'fa-check' : 'fa-ban' }}"></i>
        {{ $user->suspended_at ? 'Unsuspend' : 'Suspend' }}
    </a>
@endcan
