import {createApp} from 'vue';
import vueDebounce from 'vue-debounce'

const form = document.querySelector('#payment-form');

const data = {
    plan: form.dataset.plan,
    quantity: 1,
    price: form.dataset.price/1,
    priceRefreshRequest: false,
}

const priceFetchUrl = form.dataset.priceUrl;
const refreshPrice = function() {

    axios.get(`${priceFetchUrl}?plan=${this.plan}&quantity=${this.quantity}`)
        .then(result => {
            this.price = result.data['amount'] / 100;
        }).finally(() => {
            this.priceRefreshRequest = false;
        });

    this.priceRefreshRequest = true;
}

const app = createApp({
    data() {
        return data;
    },
    watch: {
        plan: refreshPrice,
        quantity: refreshPrice,
    },
})

app.config.globalProperties.$filters = {
    currency(value, currency, minimumFractionDigits=2) {
        if (typeof value !== "number")
            return value;

        let formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: currency,
            minimumFractionDigits: minimumFractionDigits
        });
        return formatter.format(value);
    }
}

app.use(vueDebounce);

app.mount(form);
