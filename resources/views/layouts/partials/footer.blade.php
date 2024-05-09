
<footer class="text-sm space-x-4 flex items-center border-t border-gray-100 flex-wrap justify-center py-4 ">
    <div class="flex space-x-4">
        @foreach (config('app.supported_locales') as $locale => $data)
            <a wire:navigate href="{{ route('language', $locale) }}">
                <x-dynamic-component :component="'flag-country-'.$data['icon']" class="w-6 h-6"/>
            </a>
        @endforeach
            {{-- <x-flag-country-$data['icon'] class="w-6 h-6"/> --}}
            {{-- <a wire:navigate href="{{ route('language', 'id') }}"><x-flag-country-id class="w-6 h-6"/></a> --}}
    </div>
    <a class="text-gray-500 hover:text-yellow-500" href="">{{ __('menu.about_us') }}</a>
    <a class="text-gray-500 hover:text-yellow-500" href="">{{ __('menu.help') }}</a>
    <a class="text-gray-500 hover:text-yellow-500" href="{{ route('login') }}">{{ __('menu.login') }}</a>
    <a wire:navigate class="text-gray-500 hover:text-yellow-500" href="{{ route('posts.index') }}">{{ __('menu.blog') }}</a>
</footer>

