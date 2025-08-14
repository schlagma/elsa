<div>
    <form action="{{ route('language.switch') }}" method="POST">
        @csrf
        <select name="language" onchange="this.form.submit()" aria-label="{{ __('messages.select_site_language') }}" class="py-1.5 pl-3 pr-10 bg-zinc-700 border-zinc-600">
            <option value="de" {{ app()->getLocale() === 'de' ? 'selected' : '' }} aria-label="{{ __('messages.german') }}">
                <span aria-hidden="true">&#127465;&#127466;</span>
                {{ __('messages.german') }}
            </option>
            <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }} aria-label="{{ __('messages.english') }}">
                <span aria-hidden="true">&#127482;&#127480;</span>
                {{ __('messages.english') }}
            </option>
        </select>
    </form>
</div>
