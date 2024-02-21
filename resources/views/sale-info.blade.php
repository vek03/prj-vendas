<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendas - Editar') }}
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
                        <p class="font-extrabold md:text-4xl mt-5 text-3xl text-black">Editar Venda</p>
                    </div>

                    <form method="POST" action="{{ route('sale.update', $sale->id) }}">
                        @csrf

                        <div class="mb-5">
                            <p class="font-extrabold md:text-2xl mt-5 text-2xl text-black">Cliente</p>
                            <hr>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6 m-3">
                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="id_client" :value="__('Cliente')" />
                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="products[0][1]" step="1" type="text" name="products[0][1]" required="required" autofocus="autofocus" autocomplete="products[0][1]" value="{{ $sale->client()->first()->name }}">
                                <x-input-error :messages="$errors->get('id_client')" class="mt-2" />
                            </div>

                            <div class="relative z-0 w-full mb-5 group">
                                <x-input-label for="method" :value="__('Forma de Pagamento')" />
                                <select class="block mt-1 w-full rounded" name="method" id="method" readonly required value>
                                    <option value="Cartão" @if($sale->method === "Cartão") selected @endif>Cartão</option>
                                    <option value="Boleto" @if($sale->method === "Boleto") selected @endif>Boleto</option>
                                </select>
                                <x-input-error :messages="$errors->get('method')" class="mt-2" />
                            </div>
                        </div>


                        <div class="mb-5">
                            <p class="font-extrabold md:text-2xl mt-5 text-2xl text-black">Produtos</p>
                            <hr>
                        </div>

                        <div id="produtos" class="grid md:grid-cols-2 md:gap-6 m-3">
                            @foreach($sale->items()->get() as $prod)
                                <div id="prod" class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="value">Produto</label>
                                    <select class="block mt-1 w-full rounded" name="products[0][0]" id="products[0][0]" required value>
                                        @foreach($products as $product)
                                            <option  @if($product->id == $prod->id) selected @endif value="{{ $product->id }}">{{ 'ID: ' . $product->id . ' e Produto: ' . $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('products[0][0]')" class="mt-2" />
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="products[0][1]">Quantidade</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="products[0][1]" step="1" type="number" name="products[0][1]" required="required" autofocus="autofocus" autocomplete="products[0][1]" value={{ $prod->quantity }}>
                                    <x-input-error :messages="$errors->get('products[0][1]')" class="mt-2" />
                                </div>
                            @endforeach

                            <hr>
                            <br>
                        </div>


                        <div class="mb-5">
                            <x-secondary-button id="add-prod" class="bg-green">+</x-secondary-button>
                            <x-secondary-button id="del-prod" class="bg-green">-</x-secondary-button>
                        </div>


                        <div class="mb-5">
                            <p class="font-extrabold md:text-2xl mt-5 text-2xl text-black">Pagamento</p>
                            <hr>
                        </div>

                        <div id="payments" class="grid md:grid-cols-2 md:gap-6 m-3">
                            @foreach($sale->payments()->get() as $pay)
                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="payments[0][0]">Valor</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="payments[0][0]" step="any" type="number" name="payments[0][0]" required="required" autofocus="autofocus" autocomplete="payments[0][0]" value={{ $pay->value }}>
                                    <x-input-error :messages="$errors->get('payments[0][0]')" class="mt-2" />
                                </div>

                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="block font-medium text-sm text-gray-700" for="payments[0][1]">Vencimento</label>
                                    <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="payments[0][1]" type="date" name="payments[0][1]" required="required" autofocus="autofocus" autocomplete="payments[0][1]" value={{ $pay->invoice }}>
                                    <x-input-error :messages="$errors->get('payments[0][1]')" class="mt-2" />
                                </div>

                                <hr>
                                <br>
                            @endforeach
                        </div>

                        <div class="mb-5">
                            <x-secondary-button id="add-pay" class="bg-green">+</x-secondary-button>
                            <x-secondary-button id="del-pay" class="bg-green">-</x-secondary-button>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Editar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/sale.js') }}"></script>