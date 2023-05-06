<div x-data="{ showBanner: true }" x-init="setTimeout(() => { showBanner = false }, 2000)">
    @if(session('success'))
        <div x-show="showBanner" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">{{ session('success') }}</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652c-.39-.39-1.023-.39-1.414 0L10 8.586 6.066 4.652c-.39-.39-1.023-.39-1.414 0-.39.39-.39 1.023 0 1.414L8.586 10l-3.934 3.934c-.39.39-.39 1.023 0 1.414.39.39 1.023.39 1.414 0L10 11.414l3.934 3.934c.39.39 1.023.39 1.414 0 .39-.39.39-1.023 0-1.414L11.414 10l3.934-3.934c.39-.39.39-1.023 0-1.414z"/></svg>
            </span>
        </div>
    @endif
</div>