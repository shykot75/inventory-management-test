class Modal {
    constructor(modalElement, options = {}) {
        this.modalElement = modalElement;
        this.options = {
            onOpen: options.onOpen || null,
            onClose: options.onClose || null,
            animationIn: options.animationIn || null,
            animationOut: options.animationOut || null
        };
        this.modalOverlay = null;
        this.init();
    }

    init() {
        // Bind all close buttons inside the modal
        const closeButtons = this.modalElement.querySelectorAll('[data-modal-close]');
        closeButtons.forEach(button => {
            button.addEventListener('click', () => this.close());
        });

        // Automatically close the modal if overlay is clicked
        this.modalElement.addEventListener('click', (e) => {
            if (e.target === this.modalElement) {
                this.close();
            }
        });
    }

    open() {
        if (typeof this.options.onOpen === 'function') {
            this.options.onOpen(this.modalElement);
        }

        this.showOverlay();

        if (this.options.animationIn) {
            this.applyAnimation(this.options.animationIn, () => {
                this.modalElement.classList.add('modal-visible');
                this.modalElement.classList.remove('modal-hidden');
            });
        } else {
            this.modalElement.classList.add('modal-visible');
            this.modalElement.classList.remove('modal-hidden');
        }
    }

    close() {
        if (typeof this.options.onClose === 'function') {
            this.options.onClose(this.modalElement);
        }

        if (this.options.animationOut) {
            this.applyAnimation(this.options.animationOut, () => {
                this.modalElement.classList.remove('modal-visible');
                this.modalElement.classList.add('modal-hidden');
                this.removeOverlay();
            });
        } else {
            this.modalElement.classList.remove('modal-visible');
            this.modalElement.classList.add('modal-hidden');
            this.removeOverlay();
        }
    }

    toggle() {
        if (this.modalElement.classList.contains('modal-visible')) {
            this.close();
        } else {
            this.open();
        }
    }

    showOverlay() {
        if (!document.querySelector('.modal-overlay')) {
            this.modalOverlay = document.createElement('div');
            this.modalOverlay.className = 'modal-overlay fixed inset-0 bg-black opacity-50 z-40';
            document.body.appendChild(this.modalOverlay);

            this.modalOverlay.addEventListener('click', () => this.close());
        }
    }

    removeOverlay() {
        const otherModalsOpen = document.querySelectorAll('.modal-visible').length > 1;
        if (!otherModalsOpen && this.modalOverlay) {
            this.modalOverlay.remove();
            this.modalOverlay = null;
        }
    }

    applyAnimation(animation, callback) {
        this.modalElement.classList.add(animation);

        const handleAnimationEnd = () => {
            this.modalElement.classList.remove(animation);
            this.modalElement.removeEventListener('animationend', handleAnimationEnd);
        };
        this.modalElement.addEventListener('animationend', handleAnimationEnd);
        if (callback) callback();
    }

    static getInstance(modalSelector) {
        const modalElement = document.querySelector(modalSelector);
        if (modalElement) {
            return new Modal(modalElement);
        }
        return null;
    }

    static autoInitialize() {
        document.querySelectorAll('[data-modal]').forEach(trigger => {
            const targetModal = document.querySelector(trigger.getAttribute('data-modal-target'));
            if (targetModal) {
                const modalInstance = new Modal(targetModal, {
                    animationIn: trigger.getAttribute('data-modal-animation-in'),
                    animationOut: trigger.getAttribute('data-modal-animation-out')
                });

                trigger.addEventListener('click', () => {
                    modalInstance.toggle();
                });
            }
        });
    }
}

// Initialize modals based on data attributes
Modal.autoInitialize();

// Optional: Export the Modal class if using a module system
export default Modal;
