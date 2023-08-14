<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit a Community') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('communities.update',$community) }}"
                      class="max-w-sm container mx-auto my-12">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')"/>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                      :value="$community->name"
                                      required autofocus autocomplete="name"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    <!-- Description  -->
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Description')"/>
                        <x-text-input id="description" class="block mt-1 w-full h-24" type="text" name="description"
                                      :value="$community->description" required autocomplete="description"/>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>


                    <!-- Topics -->
                    <div class="mt-4">
                        <x-input-label class="mb-1" for="topics" :value="__('Topics')"/>
                        <select class="select2" style="width: 100%;" name="topics[]" multiple>
                            @foreach($topics as $topic)
                                <option value="{{ $topic->id }}"
                                        @if($community->topics->contains($topic->id))
                                            selected
                                    @endif
                                >{{ $topic->name }}</option>
                            @endforeach
                        </select>
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
