@if (session('status') || session('error'))
<div class="alert alert-<?php if(session('status')){ echo 'success'; }else{ echo 'danger'; } ?>" role="alert">
    @if (config('alertmessage.options.closeButton'))
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    @endif
    {{ session('status')??session('error') }}
</div>
@endif

@if(AlertMessage::render())
    {!! AlertMessage::render() !!}
@endif
