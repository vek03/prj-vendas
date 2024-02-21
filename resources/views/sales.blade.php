<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas') }}
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
                        <p class="font-extrabold md:text-4xl mt-5 text-3xl text-black">Cadastrar Vendas</p>
                    </div>

                    <form method="POST" action="{{ route('sale.store') }}">
                        @csrf

                        <div class="mb-5">
                            <p class="font-extrabold md:text-2xl mt-5 text-2xl text-black">Cliente</p>
                            <hr>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6 m-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="id_client" :value="__('Cliente')" />
                                <select class="block mt-1 w-full rounded" name="id_client" id="id_client" required value>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ 'ID: ' . $client->id . ' e Nome: ' . $client->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_client')" class="mt-2" />
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="method" :value="__('Forma de Pagamento')" />
                                <select class="block mt-1 w-full rounded" name="method" id="method" required value>
                                    <option selected value="Cartão">Cartão</option>
                                    <option value="Boleto">Boleto</option>
                                </select>
                                <x-input-error :messages="$errors->get('method')" class="mt-2" />
                            </div>
                        </div>


                        <div class="mb-5">
                            <p class="font-extrabold md:text-2xl mt-5 text-2xl text-black">Produtos(<span id="numProd">{{ count($products) }}</span>)</p>
                            <hr>
                        </div>

                        <div class="overflow-y-auto max-h-96">
                            <table class="min-w-full">
                                <thead class="border-b">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Nome</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Preço</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Quantidade</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Operações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($products[0]))
                                        <?php $i = 0; ?>
                                        @foreach($products as $product)
                                        <tr class="border-b">
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                            <td id="price{{ $i }}" class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $product->price }}</td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <input id="count{{ $i }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1" step="any" type="number" name="products[0]" readonly value=0 required="required" autocomplete="payments[0]">
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <x-secondary-button id="del-prod{{ $i }}" onclick="del('count{{ $i }}')" class="bg-green">-</x-secondary-button>
                                                <x-secondary-button id="add-prod{{ $i }}" onclick="add('count{{ $i }}')" class="bg-green">+</x-secondary-button>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        @endforeach
                                    @else
                                        <div class="px-8 text-center">
                                            <p class="px-4 py-2 text-red-500 md:text-2xl text-2xl">Não há nenhum produto.</p>
                                            <hr class="border-1 border-red-500">
                                        </div> 
                                    @endif
                                </tbody>
                            </table>
                        </div>


                        <div class="mb-5">
                            <p class="font-extrabold md:text-2xl mt-5 text-2xl text-black">Pagamento</p>
                            <hr>

                            <div class="grid md:grid-cols-3 md:gap-6 m-3">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="total">Total</label>
                                    <input readonly value=0 class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="total" step="any" type="number" name="total" required="required" autofocus="autofocus" autocomplete="0">
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="dist">Distribuído</label>
                                    <input readonly value=0 class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="dist" step="any" type="number" required="required" autofocus="autofocus" autocomplete="0">
                                </div>
                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="deft">Á Distribuir</label>
                                    <input readonly value=0 class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="deft" step="any" type="number" required="required" autofocus="autofocus" autocomplete="0">
                                </div>
                            </div>
                        </div>

                        <div id="payments" class="grid md:grid-cols-2 md:gap-6 m-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <label class="block font-medium text-sm text-gray-700" for="payments[0][0]">Valor</label>
                                <input oninput="calc2()" value=0 class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="value0" step="any" type="number" name="payments[0][0]" required="required" autofocus="autofocus" autocomplete="payments[0][0]">
                                <x-input-error :messages="$errors->get('payments[0][0]')" class="mt-2" />
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <label class="block font-medium text-sm text-gray-700" for="payments[0][1]">Vencimento</label>
                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="payments[0][1]" type="date" name="payments[0][1]" required="required" autofocus="autofocus" autocomplete="payments[0][1]">
                                <x-input-error :messages="$errors->get('payments[0][1]')" class="mt-2" />
                            </div>

                            <hr>
                            <br>
                        </div>

                        <div class="mb-5">
                            <x-secondary-button id="add-pay" class="bg-green">+</x-secondary-button>
                            <x-secondary-button id="del-pay" class="bg-green">-</x-secondary-button>
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
                        <p class="font-extrabold md:text-4xl mt-5 text-3xl text-black">Vendas</p>
                    </div>

                    <div class="overflow-y-auto max-h-96">
                        <table class="min-w-full">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Vendedor</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Cliente</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Total</th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Operações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($sales[0]))
                                    @foreach($sales as $sale)
                                    <tr class="border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $sale->seller()->first()->name }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $sale->client->first()->name }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{  'R$ '.number_format($sale->items()->sum('subtotal'), 2, ',', '.')    }}</td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{$sale->id}}')">
                                                {{ __('Delete') }}
                                            </x-danger-button>

                                            <x-modal name="confirm-user-deletion{{$sale->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                                <form method="post" action="{{ route('sale.destroy', $sale->id) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        {{ __('Deseja deletar esta venda?') }}
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        {{ __('Nome do/da cliente: ' . $sale->client()->first()->name) }}
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

                                            <a href="{{ route('sale.edit', $sale->id) }}">
                                                <x-secondary-button>
                                                    Editar
                                                </x-secondary-button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <div class="px-8 text-center">
                                        <p class="px-4 py-2 text-red-500 md:text-2xl text-2xl">Não há nenhuma venda.</p>
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

<script src="{{ asset('js/sale.js') }}"></script>