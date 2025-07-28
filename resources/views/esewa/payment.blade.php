<form id="paymentForm" action="{{ env('ESEWA_BASE_URL') }}/epay/main" method="POST">
    @foreach ($formData as $key => $value)
        <input value="{{ $value }}" name="{{ $key }}" type="hidden">
    @endforeach
</form>
<script>
    document.getElementById('paymentForm').submit();
</script>
