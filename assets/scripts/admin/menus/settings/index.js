import {v4 as uuidv4} from 'uuid';
class Settings
{
    constructor() {
        this.addPaymentLink();
        this.editPaymentLink();
        this.copyLink();
        this.handlerToken();
    }

    handlerToken() {
        const button = document.querySelector('#generate-token');

        if (button) {
            button.addEventListener('click', () => {
                this.generateToken();
            });
        }
    }

    generateToken() {
        const token = document.querySelector('#token');

        if (token) {
            token.value = uuidv4();
        }
    }

    copyLink() {
        const elements = document.querySelectorAll('.copy-element');

        elements.forEach((element) => {
            element.addEventListener('click', () => {
                const text = element.getAttribute('data-copy');
                console.log(text)
                if (navigator?.clipboard?.writeText) {
                    navigator.clipboard.writeText(text.value);
                }
            })
        });
    }

    addPaymentLink() {
        const button = document.querySelector('#add-payment-link');
        button.addEventListener('click', () => {
            this.openModal();
            this.generateToken();
        });
    }

    editPaymentLink() {
        const anchors = document.querySelectorAll('.open-link-form');
        const close = document.querySelector('#close-link-form');

        anchors.forEach((anchor) => {
            anchor.addEventListener('click', () => {
                this.openModal();
                this.fillModalFields(anchor.getAttribute('data-link'));
            });
        });

        close.addEventListener('click', () => {
            this.closeModal();
        });
    }

    openModal() {
        const modal = document.querySelector('#link-form');

        this.clearModal(modal);
        this.clearModalProducts();

        modal.classList.remove('hidden');
    }

    closeModal() {
        const modal = document.querySelector('#link-form');

        this.clearModal(modal);
        this.clearModalProducts();
        modal.classList.add('hidden');
    }

    clearModal(modal) {
        if (!modal) return;

        const fields = [
            'name',
            'token',
            'expire_at',
            'expire_hour',
            'coupon',
            'link_id',
            'link_url'
        ];

        fields.forEach((field) => {
            const element = modal.querySelector(`#${field}`);

            switch (field) {
                case 'link_id':
                    element.innerText = '';
                    break;
                case 'link_url':
                    element.removeAttribute('href');
                    element.classList.add('hidden')
                    break;
                default:
                    if (element) element.value = '';
                    break;
            }
        });

        ['product-checkbox','product-quantity'].forEach((field) => {
            const elements = modal.querySelectorAll(`.${field}`);
            elements.forEach((element) => {
                element.value = '';

                if (field === 'product-checkbox') {
                    element.checked = false;
                }
            });
        })
    }

    fillModalFields(fields) {
        const object = JSON.parse(fields);

        if (object) {
            for (const key in object) {
                const element = document.querySelector(`#${key}`);

                switch (key) {
                    case 'products':
                        this.fillModalProducts();
                    break;
                    case 'link_id':
                        element.innerText = `#${object[key]}`;
                    break;
                    case 'link_url':
                        element.setAttribute('href', object[key]);
                        element.classList.remove('hidden')
                    break;
                    default:
                        if (element) element.value = object[key];
                    break;

                }
            }
        }
    }

    setLinkUrl(url) {

    }

    fillModalProducts() {
        // do nothing
    }

    clearModalProducts() {
        // do nothing
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new Settings();
});
