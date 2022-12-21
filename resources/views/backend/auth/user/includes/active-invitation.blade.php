<select name="status" class="form-control change-status" data-route="{{ route('admin.auth.user.active-invitation', $user->id) }}" id="invitation">
        <option value="notAccept" {{ (empty($user->request_active_invitation) || $user->request_active_invitation == 'notAccept') ? 'selected' : '' }}>Not Accept</option>
        <option value="pending" {{ $user->request_active_invitation == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="accept" {{ $user->request_active_invitation == 'accept' ? 'selected' : '' }}>Accept</option>
</select>