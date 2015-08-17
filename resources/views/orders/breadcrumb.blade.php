<ol class="breadcrumb">
	@if($active == 1)
		<li class="active">Adressen</li>
		<li>Bezahlung</li>
		<li>Überprüfung</li>
	@endif
  
  @if($active == 2)
		<li><a href="{{ url('orders/choose-address/') }}">Adressen</a></li>
		<li class="active">Bezahlung</li>
		<li>Überprüfung</li>
	@endif

	@if($active == 3)
		<li><a href="{{ url('orders/choose-address/') }}">Adressen</a></li>
		<li><a href="{{ url('orders/choose-payment-method/') }}">Bezahlung</a></li>
		<li class="active">Überprüfung</li>
	@endif
</ol>