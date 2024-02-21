<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (!empty(session('status')))   
                        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="flex items-center bg-red-500 text-white text-sm font-bold px-3 py-1 my-2 rounded" role="alert">
                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                            <p class="m-2 text-lg font-medium leading-tight text-white">
                                {{ session('status') }}
                            </p>
                        </div>
                    @endif

                    <div class="align-center text-center mb-10">
                        <p class="font-extrabold md:text-4xl mt-5 text-3xl text-black">Cadastrar Cliente</p>
                    </div>

                    <form method="POST" action="{{ route('client.store') }}">
                        @csrf

                        <p class="font-extrabold text-black">*Digite o CEP para preencher seu endereço automaticamente</p>

                        <div class="grid md:grid-cols-2 md:gap-6 m-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="name" :value="__('Nome')" />
                                <x-text-input id="name" maxlength="255" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="cep" :value="__('CEP')" />
                                <x-text-input id="cep" minlength="8" maxlength="9" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" required autofocus autocomplete="cep" />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6 m-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="address" :value="__('Endereço')" />
                                <x-text-input id="address" readonly class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus autocomplete="address" />
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="district" :value="__('Bairro')" />
                                <x-text-input id="district" readonly class="block mt-1 w-full" type="text" name="district" :value="old('district')" required autofocus autocomplete="district" />
                                <x-input-error :messages="$errors->get('district')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6 m-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="city" :value="__('Cidade')" />
                                <x-text-input id="city" readonly class="block mt-1 w-full" type="text" name="city" :value="old('city')" required autofocus autocomplete="city" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="state" :value="__('Estado')" />
                                <x-text-input id="state" readonly class="block mt-1 w-full" type="text" name="state" :value="old('state')" required autofocus autocomplete="state" />
                                <x-input-error :messages="$errors->get('state')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Cadastrar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="align-center text-center mb-10">
                        <p class="font-extrabold md:text-4xl mt-5 text-3xl text-black">Clientes</p>
                    </div>

                    <div class="overflow-y-auto max-h-96">
                        <table class="min-w-full">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nome</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">CEP</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Cidade</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Estado</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Operação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($clients[0]))
                                    @foreach($clients as $client)
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $client->name }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $client->cep }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $client->city }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $client->state }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{$client->id}}')">
                                                {{ __('Delete') }}
                                            </x-danger-button>

                                            <x-modal name="confirm-user-deletion{{$client->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                                <form method="post" action="{{ route('client.destroy', $client->id) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Deseja deletar este cliente?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('Nome do/da cliente: ' . $client->name) }}
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Cancel') }}
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            {{ __('Delete') }}
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <div class="px-8 text-center">
                                        <p class="px-4 py-2 text-red-500 md:text-2xl text-2xl">Não há nenhum cliente.</p>
                                        <hr class="border-1 border-red-500">
                                    </div> 
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/form.js') }}"></script>