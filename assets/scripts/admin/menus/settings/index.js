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
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new Settings();
});
