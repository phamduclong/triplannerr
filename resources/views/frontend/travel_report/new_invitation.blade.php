<form action="{{ route('frontend.sendInvitation') }}" method="POST" class="row">
  @csrf
  <div class="col-md-2 border border-secondary" style="padding-top:5px">{{ $numberOfInvitation }}</div>
  <div class="col-md-2 border border-secondary" style="padding-top:5px">{{ $today }}</div>
  <div class="col-md-2 border border-secondary" style="padding-top:5px">
    <input type="text" name="surname" id="surname" class="form-control" placeholder="Name">
  </div>
  <div class="col-md-2 border border-secondary" style="padding-top:5px">
    <input type="text" name="emailaddress" id="emailaddress" class="form-control" placeholder="Email">
  </div>
  <div class="col-md-2 border border-secondary" style="padding-top:5px">
    <div class="row">
      <div class="col-md-6">
        <a href="javascript:void(0)"><i id="share_telegram" class="fa fa-telegram" aria-hidden="true" style="font-size: 3em;color:#1E90FF"></i></a>
      </div>
      <div class="col-md-6">
        <a href="javascript:void(0)" data-action="share/whatsapp/share"><i id="shareWhatsapp" class="fa fa-whatsapp" aria-hidden="true" style="font-size: 3em;color:green"></i></a>
      </div>
    </div>
  </div>
  <div class="col-md-2 border border-secondary"></div>
  {{-- <div>accept</div>
  <div>not accept</div> --}}
  <input type="submit" value="OK" id="sendInvitation" hidden>
</form>