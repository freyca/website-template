@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="https://roteco.es/wp-content/uploads/2020/12/roteco-logo-web.png" class="logo" alt="{{ $slot }}">
@endif
</a>
</td>
</tr>
