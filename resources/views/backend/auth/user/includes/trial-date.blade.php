<input type="text" name="trial-date" value="{{ !empty( $user->trial_date ) ? Carbon\Carbon::parse($user->trial_date)->format('d/m/Y') : '' }}" data-route="{{ route('admin.auth.user.update-trial-date', $user->id) }}">