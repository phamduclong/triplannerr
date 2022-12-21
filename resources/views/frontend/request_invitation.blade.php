<script>
    $(document).on('click', '.activation-request', function(){
        $.ajax({
            data:{'_token' : '{{ csrf_token()}}'},
            url: "{{ route('frontend.user.request_invitation') }}",
            method: 'POST',
        }).then( result => {
            alert('Your request has been sent to the Triplannerr administrator. If approved you will find the button to invite your friends in the control panel.');
            $(this).text('Awaiting Approval');
            $(this).attr('disabled','disabled');
        });
    })
</script>