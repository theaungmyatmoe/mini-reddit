<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('communities.show',$community) }}" class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $community->name }}
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                @if(session('message'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="py-8 relative overflow-x-auto shadow-md sm:rounded-lg px-8">
                    @if($post->image !== "")
                        <img src="{{ asset($post->image)  }}" alt="{{ $post->title }}" class="w-48 h-48"
                    @endif

                    <div
                        href="{{ route('communities.posts.show',[$community,$post]) }}"
                        class="block max-w-2xl mx-auto p-6 mb-2 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->title }}
                        </h5>
                        @if($post->url != "")
                            <a href="{{ $post->url }}"
                               target="_blank"
                               class="font-normal text-gray-700 dark:text-gray-400 underline">
                                {{ $post->url }}
                            </a>
                        @endif
                        <p class="font-normal text-gray-700 dark:text-gray-400">
                            {{ $post->body }}
                        </p>

                        <div class="mt-8">
                            <a href="{{ route('communities.posts.edit',[$community,$post]) }}" type="button"
                               class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Edit
                            </a>

                            @can('can-delete',$post)
                                <form action="{{ route('communities.posts.destroy',[$community,$post]) }}" method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300
                                    font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600
                                    dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800
                            ">
                                        Delete
                                    </button>
                                </form>
                            @endcan

                        </div>
                    </div>
                </div>


                {{--                     comment section --}}
                <section class="bg-white rounded-lg my-4 py-4 px-8">

                    @foreach($post->comments as $comment)
                        <div
                            class="mb-3 block max-w-sm mx-auto p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="flex justify-between mb-2 text-sm  tracking-tight text-gray-900 dark:text-white">
                                <div class="font-bold">    {{ $comment->user->name }}</div>
                                <div> {{ $comment->created_at->diffForHumans() }}</div>
                            </h5>
                            <p class="font-normal text-gray-700 dark:text-gray-400">{{ $comment->body }}</p>
                        </div>
                    @endforeach


                    @auth()
                        <div>
                            <form method="POST" action="{{ route('posts.comments.store',[$post]) }}"
                                  class="max-w-sm container mx-auto my-12">
                                @csrf

                                <!-- Comment  -->
                                <div class="mt-4">
                                    <x-input-label for="comment" :value="__('Comment')"/>
                                    <x-text-input id="comment" class="block mt-1 w-full" type="text"
                                                  name="body"
                                                  lder="Comment"
                                                  :value="old('body')" required autocomplete="body"/>
                                    <x-input-error :messages="$errors->get('body')" class="mt-2"/>

                                    <div class="flex items-center justify-end mt-4">

                                        <x-primary-button type="submit" class="ml-4">
                                            {{ __('Submit') }}
                                        </x-primary-button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    @endauth
                </section>

            </div>
        </div>
    </div>
</x-app-layout>
