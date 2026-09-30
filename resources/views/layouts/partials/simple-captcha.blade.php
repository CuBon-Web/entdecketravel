<style>
.simple-captcha-box {
	display: flex;
	align-items: center;
	gap: 12px;
	flex-wrap: wrap;
}
.simple-captcha-image {
	display: block;
	height: 56px;
	width: 160px;
	border: 2px dashed #85d200;
	border-radius: 6px;
	background: #f5f5f5;
}
.simple-captcha-refresh {
	border: 0;
	background: transparent;
	color: #85d200;
	font-weight: 600;
	cursor: pointer;
	padding: 0;
}
.simple-captcha-refresh:hover {
	text-decoration: underline;
}
</style>
<div class="form-group">
	<label>Verification code</label>
	<div class="simple-captcha-box">
		<img
			id="simple-captcha-img"
			class="simple-captcha-image"
			src="{{ route('contactCaptcha') }}"
			alt="Captcha"
		>
		<button type="button" class="simple-captcha-refresh" onclick="refreshSimpleCaptcha()">Refresh</button>
	</div>
	<input
		class="form-control mt-2"
		name="captcha_code"
		type="text"
		required
		maxlength="4"
		pattern="[0-9]{4}"
		inputmode="numeric"
		autocomplete="off"
		placeholder="Enter 4 digits in the image"
		value="{{ old('captcha_code') }}"
	>
</div>
<script>
if (typeof refreshSimpleCaptcha !== 'function') {
	function refreshSimpleCaptcha() {
		var img = document.getElementById('simple-captcha-img');
		if (img) {
			img.src = '{{ route('contactCaptcha') }}?t=' + Date.now();
		}
	}
}
@if(session('error'))
document.addEventListener('DOMContentLoaded', refreshSimpleCaptcha);
@endif
</script>
