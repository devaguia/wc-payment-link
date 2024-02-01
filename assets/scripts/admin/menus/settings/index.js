class Settings
{
    constructor() {
        this.addPaymentLink();
        this.editPaymentLink();
    }

    addPaymentLink() {
        const button = document.querySelector('#add-payment-link');
        button.addEventListener('click', () => {
            this.openModal();
        });
    }

    editPaymentLink() {
        const anchors = document.querySelectorAll('.open-link-form');
        const close = document.querySelector('#close-link-form');

        anchors.forEach((anchor) => {
            anchor.addEventListener('click', () => {
                this.openModal();
            });
        });

        close.addEventListener('click', () => {
            this.closeModal();
        });
    }

    openModal() {
        const modal = document.querySelector('#link-form');
        modal.classList.remove('hidden');
    }

    closeModal() {
        const modal = document.querySelector('#link-form');
        modal.classList.add('hidden');
        this.clearModal(modal);
    }

    clearModal(modal) {
        if (!modal) return;

        const fields = [
            'name',
            'token',
            'expire_at',
            'hour',
            'coupon'
        ];

        fields.forEach((field) => {
            const element = modal.querySelector(`#${field}`);
            if (element) {
                element.value = '';
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
}

document.addEventListener('DOMContentLoaded', () => {
    new Settings();
});
