@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://ecom.holidaythrill.in/images/logo.png" class="logo" alt="fruitables">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
