<x-app-layout>
    <x-slot name="header">
            <div class="flex justify-between">
         <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Post') }}
        </h2>
        <Link href="{{ route('posts.create') }}" class="px-4 py-2 bg-indigo-400 hover:bg-indigo-600 text-white rounded-md"> New Post</Link>

       </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           <x-splade-form :action="route('posts.store')" class="max-w-md mx-auto p-4  bg-white  rounded-md">
            <x-splade-select name="category_id" label="Category" :options="$categories" />
                <x-splade-input name="title" label="Title" />
                <x-splade-input name="slug" label="Slug" />
                <x-splade-textarea name="description" label="Description" class="mt-2" autosize />

                <x-splade-submit class="mt-4" />
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
