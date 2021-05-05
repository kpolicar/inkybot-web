import {createApp} from 'vue';

const form = document.querySelector('#coinbase-form');

const data = {
    plan: form.dataset.plan,
    quantity: 1,
    price: form.dataset.price/1,
    priceRefreshRequestsCount: 0
}

const priceFetchUrl = form.dataset.priceUrl;
const refreshPrice = function() {
    this.priceRefreshRequestsCount++;

    axios.get(`${priceFetchUrl}?plan=${this.plan}&quantity=${this.quantity}`)
        .then(result => {
            if (this.priceRefreshRequestsCount === 1)
                this.price = result.data['amount'] / 100;
        }).finally(() => this.priceRefreshRequestsCount--);
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

app.mount('#coinbase-form');
