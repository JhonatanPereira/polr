@extends('layouts.base')

@section('css')
<link rel='stylesheet' href='/css/shorten_result.css' />
@endsection

@section('content')
<h3>Shortened URL</h3>
<div class="input-group">
    <input type='text' class='result-box form-control' value='{{$short_url}}' id='short_url' />
    <div class='input-group-addon' id='clipboard-copy' data-clipboard-target='#short_url' data-toggle='tooltip' data-placement='bottom' data-title='Copied!'>
        <i class='fa fa-clipboard' aria-hidden='true' title='Copy to clipboard'></i>
    </div>
</div>
<a id="generate-qr-code" class='btn btn-primary'>Generate QR Code</a>
<a href='{{route('index')}}' class='btn btn-info'>Shorten another</a>

<canvas id="qr-code-container" style="display: none;"></canvas>

@endsection


@section('js')
<script src="//www.promisejs.org/polyfills/promise-6.1.0.js"></script>
<script src='/js/qr-code-with-logo.browser.min.js'></script>
<script src='/js/qrcode.min.js'></script>
<script src='/js/clipboard.min.js'></script>
<script src='/js/shorten_result.js'></script>
<script>
$('#generate-qr-code').click(function () {
    var container = $('#qr-code-container');
    container.show();
    QrCodeWithLogo.toCanvas({
        canvas: container[0],
        content: original_link,
        width: 300,
        logo: {
          src: '{{env('QRCODE_ICON_URL')}}',
          borderRadius: 3,
          logoSize: 0.20,
          borderSize: 0.05
        }
    })
});
</script>
@endsection
