<div id="paypal-button-container"></div>
<script src="{{ asset('admin/js/paypal.js') }}"></script>
<script defer>
    window.onload = function () {
        var amount = '{{ $amount }}';
        var route = '{{ route('account.liveaccounts') }}';
        paypalFunc(amount, route);
    }
</script>
