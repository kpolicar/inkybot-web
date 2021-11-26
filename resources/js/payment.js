import {createApp} from 'vue';
import vueDebounce from 'vue-debounce'

const form = document.querySelector('#payment-form');

const data = {
    plan: form.dataset.plan,
    quantity: 1,
    queue: false,
    price: form.dataset.price/1,
    priceRefreshRequest: false,
    promocode: '',
}

const priceFetchUrl = form.dataset.priceUrl;
const refreshPrice = function() {

    axios.get(`${priceFetchUrl}?plan=${this.plan}&quantity=${this.quantity}&queue=${this.queue}&promocode=${this.promocode}`)
        .then(result => {
            this.price = result.data['amount'] / 100;
        }).finally(() => {
            this.priceRefreshRequest = false;
            document.querySelector('.error').classList.remove('visible');
        });

    this.priceRefreshRequest = true;
}



const app = createApp({
    mounted() {
        window.VueAppSetPromoCode = function(value) {
            this.promocode = value;
        }.bind(this);
    },
    data() {
        return data;
    },
    watch: {
        plan: refreshPrice,
        quantity: refreshPrice,
        queue: refreshPrice,
        promocode: refreshPrice,
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
