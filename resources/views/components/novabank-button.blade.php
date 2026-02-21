@props(['type' => 'submit'])

<button {{ $attributes->merge(['type' => $type, 'class' => 'w-full bg-[#065f46] hover:bg-[#047857] text-white font-semibold py-3 rounded-xl transition duration-200']) }}>
    {{ $slot }}
</button>