<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script nonce="{{ $cspNonce ?? '' }}">
    tailwind.config = { theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'] } } } };
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/brand/icon_32.png') }}">
<link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/brand/icon_64.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/brand/icon_512.png') }}">
