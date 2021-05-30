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

<div class="my-2" v-if="plan == 'unlimited'">
    <label for="quantity" class="mr-2">{{ __('pricing.instances') }}:</label>
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
