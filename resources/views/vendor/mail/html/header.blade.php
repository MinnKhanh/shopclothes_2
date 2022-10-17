<tr>
    <td class="header">
        <a href="{{ $web }}" style="display: inline-block;"
            style="display: flex !important;
    justify-content: center !important;
    align-items: center !important;">
            <img src="{{ $logo }}" class="logo" data-skip-embed>
            MultiShop
        </a>
    </td>
</tr>
<script>
    $('.logo').attr('src', {{ $logo }})
</script>
