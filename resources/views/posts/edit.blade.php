<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('communities.posts.update',[$community,$post]) }}"
                      enctype="multipart/form-data"
                      class="max-w-sm container mx-auto my-12">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                      :value="$post->title"
                                      required autofocus autocomplete="title"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <!-- Body  -->
                    <div class="mt-4">
                        <x-input-label for="body" :value="__('Body')"/>
                        <x-text-input id="body" class="block mt-1 w-full h-24" type="text" name="body"
                                      :value="$post->body" required autocomplete="body"/>
                        <x-input-error :messages="$errors->get('body')" class="mt-2"/>
                    </div>

                    <!-- Image  -->
                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Image')"/>
                        <input id="image" class="block mt-1 w-full" type="file" name="image"
                               value="{{$post->image }}" autocomplete="image"/>
                        <x-input-error :messages="$errors->get('image')" class="mt-2"/>
                    </div>


                    <!-- URL -->
                    <div class="mt-4">
                        <x-input-label for="url" :value="__('Post URL')"/>
                        <x-text-input id="url" class="block mt-1 w-full" type="url" name="url"
                                      :value="$post->url"
                                      required autofocus autocomplete="url"/>
                        <x-input-error :messages="$errors->get('url')" class="mt-2"/>
                    </div>


                    <div class="flex items-center justify-end mt-4">

                        <x-primary-button class="ml-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
