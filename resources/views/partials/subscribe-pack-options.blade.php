<div>
    <label for="plan" class="mr-2">
        {{ __('subscribe.package') }}:
    </label>

    <select id="plan" name="plan" class="text-gray-900 px-4 pl-3 py-1 rounded" v-model="plan">
        <option value="starter">
            {{ __('pricing.package_starter') }}
        </option>
        <option value="standard">
            {{ __('pricing.package_standard') }}
        </option>
        <option value="unlimited">
            {{ __('pricing.package_unlimited') }}
        </option>
    </select>
</div>

<div class="my-2 flex items-start" v-if="plan == 'unlimited'">
    <label for="quantity" class="mr-2">{!! __('pricing.instances') !!}:</label>
    <input name="quantity"
           id="quantity"
           class="text-gray-900 px-4 pl-3 py-1 rounded w-16"
           type="number"
           v-bind:class="[priceRefreshRequest ? 'cursor-wait' : '']"
           v-bind:disabled="priceRefreshRequest"
           :value="this.quantity"
           v-debounce:500ms="(val) => this.quantity = val"
           debounce-events="change"
           min="1"
           max="10">

    @error('quantity')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>

<div class="my-2" v-if="plan == 'unlimited'">
    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
        <input
            type="checkbox"
            name="queue"
            id="queue"
            v-bind:class="[priceRefreshRequest ? 'cursor-wait border-gray-600 bg-gray-500 opacity-50' : '']"
            v-bind:disabled="priceRefreshRequest"
            v-model="this.queue"
            class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-400"
        />
        <label
            for="queue"
            v-bind:class="[priceRefreshRequest ? 'bg-gray-600' : '']"
            class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-400 cursor-pointer"
        ></label>
    </div>
    <label for="queue">{{ __('pricing.queues') }}</label>

    @error('queue')
        <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
</div>
