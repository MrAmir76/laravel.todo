<x-mail::message>
    {{-- Greeting --}}
    @if (! empty($greeting))
        {{ $greeting }}
    @else
        @if ($level === 'error')
            <p>اوه!</p>
        @else
            <p>سلام!</p>
        @endif
    @endif
    {{-- Intro Lines --}}
    @foreach ($introLines as $line)
        {{ $line }}
    @endforeach

    {{-- Action Button --}}
    @isset($actionText)
    <?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
        <x-mail::button :url="$actionUrl" :color="$color">
            {{ $actionText }}
        </x-mail::button>
    @endisset

    {{-- Outro Lines --}}
    @foreach ($outroLines as $line)
        {{ $line }}

    @endforeach
    {{-- Salutation --}}
    @if (! empty($salutation))
        {{ $salutation }}
    @else
        باتشکر.
    @endif

    {{-- Subcopy --}}
    @isset($actionText)
        <x-slot:subcopy>
            <p>اگر با کلیک بر روی دکمه
                "{{$actionText}}"
                مشکل دارید، از نشانی زیر را استفاده کنید:
                <br>
            </p>
            <small class="break-all">{{ $actionUrl }}</small>
        </x-slot:subcopy>
    @endisset
</x-mail::message>
